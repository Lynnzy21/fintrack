<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Kelola Wallet') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Daftar Wallet / Akun</h3>
                <a href="{{ route('wallets.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Wallet
                </a>
            </div>

            @if(session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <span class="font-medium">Berhasil!</span> {{ session('success') }}
                </div>
            @endif

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white border border-gray-200">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-bold">Nama Wallet</th>
                            <th scope="col" class="px-6 py-3 font-bold">Saldo Saat Ini</th>
                            <th scope="col" class="px-6 py-3 text-right font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wallets as $wallet)
                        <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap" style="color: #111827 !important;">
                                {{ $wallet->name }}
                            </th>
                            <td class="px-6 py-4 font-bold text-gray-800">Rp {{ number_format($wallet->balance, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('wallets.edit', $wallet->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('wallets.destroy', $wallet->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:underline" onclick="return confirm('Yakin hapus wallet ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-gray-500">Belum ada wallet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>