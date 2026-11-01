<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Catat Transaksi Baru') }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-md sm:rounded-lg">
                <h3 class="text-xl font-bold mb-6 text-gray-900">Form Transaksi</h3>
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                        <div>
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">Jumlah (Rp)</label>
                            <input type="number" id="amount" name="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required min="1">
                        </div>
                        <div>
                            <label for="transaction_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                            <input type="date" id="transaction_date" name="transaction_date" value="{{ date('Y-m-d') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi / Catatan</label>
                        <input type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: Beli makan siang" required>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                            <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }} ({{ ucfirst($cat->type) }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="wallet_id" class="block mb-2 text-sm font-medium text-gray-900">Dari/Ke Wallet</label>
                            <select id="wallet_id" name="wallet_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="">-- Pilih Wallet --</option>
                                @foreach($wallets as $wal)
                                    <option value="{{ $wal->id }}">{{ $wal->name }} (Saldo: {{ number_format($wal->balance, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('transactions.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Batal</a>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>