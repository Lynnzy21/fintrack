<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController; // <-- Import ProfileController
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // 1. Route Dashboard
    Route::get('/dashboard', function () {
        $userId = Auth::id();
        
        $totalIncome = Transaction::where('user_id', $userId)
            ->whereHas('category', function($query) { $query->where('type', 'income'); })
            ->sum('amount');
            
        $totalExpense = Transaction::where('user_id', $userId)
            ->whereHas('category', function($query) { $query->where('type', 'expense'); })
            ->sum('amount');
        
        $wallets = Wallet::where('user_id', $userId)->get();
        
        return view('dashboard', compact('totalIncome', 'totalExpense', 'wallets'));
    })->name('dashboard');

    // 2. Route Profile (Bawaan Breeze - Mengatasi Error Anda)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. Route Resource FinTrack
    Route::resource('categories', CategoryController::class);
    Route::resource('wallets', WalletController::class);
    Route::resource('transactions', TransactionController::class);
});

require __DIR__.'/auth.php';