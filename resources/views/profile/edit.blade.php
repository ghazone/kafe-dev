<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-semibold h5 text-dark leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container space-y-4">
            <div class="p-4 sm:p-5 bg-white shadow rounded-lg">
                <div class="max-w-md">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-5 bg-white shadow rounded-lg">
                <div class="max-w-md">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-5 bg-white shadow rounded-lg">
                <div class="max-w-md">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
