<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Finansial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Ringkasan Finansial (Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Pemasukan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                    <div class="p-6 text-gray-900">
                        <div class="text-sm text-gray-600 mb-2">Total Pemasukan</div>
                        <div class="text-3xl font-bold text-green-600">
                            Rp {{ number_format($totalIncome ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <!-- Total Pengeluaran -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-red-500">
                    <div class="p-6 text-gray-900">
                        <div class="text-sm text-gray-600 mb-2">Total Pengeluaran</div>
                        <div class="text-3xl font-bold text-red-600">
                            Rp {{ number_format($totalExpense ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <!-- Saldo Bersih -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500">
                    <div class="p-6 text-gray-900">
                        <div class="text-sm text-gray-600 mb-2">Saldo Bersih</div>
                        <div class="text-3xl font-bold text-blue-600">
                            Rp {{ number_format((($totalIncome ?? 0) - ($totalExpense ?? 0)), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Saldo Wallet -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Saldo Wallet Aktif</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @forelse($wallets ?? [] as $wallet)
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <div class="text-sm text-gray-600">{{ $wallet->name }}</div>
                                <div class="text-xl font-bold text-gray-900">
                                    Rp {{ number_format($wallet->balance, 0, ',', '.') }}
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-3">Belum ada wallet. Silakan tambah wallet di menu Wallets.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="flex justify-center gap-4">
                <a href="{{ route('transactions.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow transition">
                    + Catat Transaksi Baru
                </a>
                <a href="{{ route('categories.index') }}" class="bg-white hover:bg-gray-50 text-gray-800 font-bold py-3 px-6 rounded-lg shadow transition border border-gray-300">
                    Kelola Kategori
                </a>
            </div>

        </div>
    </div>
</x-app-layout>