<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Import Facade

class WalletController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $wallets = Wallet::where('user_id', $userId)->get();
        
        return view('wallets.index', compact('wallets'));
    }

    public function create()
    {
        return view('wallets.create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
        ]);

        Wallet::create([
            'user_id' => $userId,
            'name' => $request->name,
            'balance' => $request->balance,
        ]);

        return redirect()->route('wallets.index')->with('success', 'Wallet berhasil ditambahkan.');
    }

    public function edit(Wallet $wallet)
    {
        $userId = Auth::id();

        if ($wallet->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        return view('wallets.edit', compact('wallet'));
    }

    public function update(Request $request, Wallet $wallet)
    {
        $userId = Auth::id();

        if ($wallet->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
        ]);

        $wallet->update([
            'name' => $request->name,
            'balance' => $request->balance,
        ]);

        return redirect()->route('wallets.index')->with('success', 'Wallet berhasil diupdate.');
    }

    public function destroy(Wallet $wallet)
    {
        $userId = Auth::id();

        if ($wallet->user_id !== $userId) {
            abort(403, 'Unauthorized action.');
        }

        $wallet->delete();
        
        return redirect()->route('wallets.index')->with('success', 'Wallet berhasil dihapus.');
    }
}