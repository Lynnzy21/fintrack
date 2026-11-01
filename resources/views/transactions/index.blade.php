<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Riwayat Transaksi') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Riwayat Transaksi</h3>
                <a href="{{ route('transactions.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Catat Transaksi
                </a>
            </div>

            @if(session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <span class="font-medium">Berhasil!</span> {{ session('success') }}
                </div>
            @endif

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">Deskripsi</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3">Wallet</th>
                            <th scope="col" class="px-6 py-3 text-right">Jumlah</th>
                            <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $trx->description }}</td>
                            <td class="px-6 py-4">
                                <span class="{{ $trx->category->type === 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                                    {{ $trx->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $trx->wallet->name }}</td>
                            <td class="px-6 py-4 text-right font-bold {{ $trx->category->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $trx->category->type === 'income' ? '+' : '-' }} Rp {{ number_format($trx->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('transactions.edit', $trx->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:underline" onclick="return confirm('Hapus transaksi ini? Saldo akan dikembalikan.')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-gray-500">Belum ada transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>