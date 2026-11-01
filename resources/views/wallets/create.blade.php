<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tambah Wallet') }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-md sm:rounded-lg">
                <h3 class="text-xl font-bold mb-6 text-gray-900">Form Wallet Baru</h3>
                <form action="{{ route('wallets.store') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Wallet (Misal: BCA, Tunai)</label>
                        <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <div class="mb-6">
                        <label for="balance" class="block mb-2 text-sm font-medium text-gray-900">Saldo Awal</label>
                        <input type="number" id="balance" name="balance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required min="0">
                    </div>
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('wallets.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Batal</a>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Simpan Wallet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>