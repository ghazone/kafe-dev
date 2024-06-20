<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('dashboard') }}" class="text-gray-800 hover:text-gray-600" style="text-decoration: none;">
                <h2 class="font-semibold text-xl leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </a>
            <a href="{{ route('menu') }}" class="ml-4 no-underline text-gray-800 hover:text-gray-600"
                style="text-decoration: none;">
                <h2 class="font-semibold text-xl leading-tight">
                    {{ __('Menu') }}
                </h2>
            </a>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
