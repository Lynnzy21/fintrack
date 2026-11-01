<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Import Facade

class TransactionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $transactions = Transaction::with(['category', 'wallet'])
            ->where('user_id', $userId)
            ->latest('transaction_date')
            ->get();
            
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $userId = Auth::id();
        $categories = Category::where('user_id', $userId)->get();
        $wallets = Wallet::where('user_id', $userId)->get();
        
        return view('transactions.create', compact('categories', 'wallets'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:500',
            'transaction_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'wallet_id' => 'required|exists:wallets,id',
        ]);

        $category = Category::where('id', $request->category_id)->where('user_id', $userId)->firstOrFail();
        $wallet = Wallet::where('id', $request->wallet_id)->where('user_id', $userId)->firstOrFail();

        $transaction = Transaction::create([
            'user_id' => $userId,
            'category_id' => $category->id,
            'wallet_id' => $wallet->id,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        if ($category->type === 'income') {
            $wallet->balance += $request->amount;
        } else {
            $wallet->balance -= $request->amount;
        }
        $wallet->save();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dicatat.');
    }

    public function edit(Transaction $transaction)
    {
        $userId = Auth::id();

        if ($transaction->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }
        
        $categories = Category::where('user_id', $userId)->get();
        $wallets = Wallet::where('user_id', $userId)->get();
        
        return view('transactions.edit', compact('transaction', 'categories', 'wallets'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $userId = Auth::id();

        if ($transaction->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:500',
            'transaction_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'wallet_id' => 'required|exists:wallets,id',
        ]);

        $category = Category::where('id', $request->category_id)->where('user_id', $userId)->firstOrFail();
        $wallet = Wallet::where('id', $request->wallet_id)->where('user_id', $userId)->firstOrFail();

        // Kembalikan saldo wallet lama
        $oldWallet = Wallet::find($transaction->wallet_id);
        if ($transaction->category->type === 'income') {
            $oldWallet->balance -= $transaction->amount;
        } else {
            $oldWallet->balance += $transaction->amount;
        }
        $oldWallet->save();

        // Update data transaksi
        $transaction->update([
            'category_id' => $category->id,
            'wallet_id' => $wallet->id,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        // Terapkan transaksi baru ke wallet
        if ($category->type === 'income') {
            $wallet->balance += $request->amount;
        } else {
            $wallet->balance -= $request->amount;
        }
        $wallet->save();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function destroy(Transaction $transaction)
    {
        $userId = Auth::id();

        if ($transaction->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        $wallet = Wallet::find($transaction->wallet_id);
        if ($transaction->category->type === 'income') {
            $wallet->balance -= $transaction->amount;
        } else {
            $wallet->balance += $transaction->amount;
        }
        $wallet->save();

        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}