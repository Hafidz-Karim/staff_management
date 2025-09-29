<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <div class="mt-6 space-x-3">
                        <a href="{{ route('dashboard.admin') }}"
                           class="inline-block px-4 py-2 bg-blue-600  rounded-lg shadow hover:bg-blue-700">
                            Fitur Admin
                        </a>
                        <a href="{{ route('dashboard.guru') }}"
                           class="inline-block px-4 py-2 bg-green-600 rounded-lg shadow hover:bg-green-700">
                            Fitur Guru
                        </a>
                        <a href="{{ route('dashboard.pegawai') }}"
                           class="inline-block px-4 py-2 bg-purple-600 rounded-lg shadow hover:bg-purple-700">
                            Fitur Pegawai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
