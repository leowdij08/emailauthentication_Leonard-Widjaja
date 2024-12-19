<x-app-layout>
    <!-- Header yang menampilkan judul dashboard -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} <!-- Menampilkan teks "Dashboard" -->
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Container utama dengan lebar maksimum -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card untuk menampilkan pesan -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Menampilkan pesan bahwa pengguna telah berhasil login -->
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
