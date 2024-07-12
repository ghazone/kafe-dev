<x-app-layout>
    <x-slot name="header">
        @if (auth()->user()->isAdmin())
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Admin') }}
            </h2>
        @else
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}  {{ auth()->user()->name }}
            </h2>
        @endif
    </x-slot>

   <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order This Month </h5>
                        <p class="card-text">{{ $transactionsThisMonth }} orders</p>
                        <a href="{{ route('history') }}" class="btn btn-primary">Go </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gross Receive</h5>
                        <p class="card-text">{{ $grosreceive }}</p>
                        <a href="{{ route('history') }}" class="btn btn-primary">Go </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Order</h5>
                        <p class="card-text">{{ $transactions }}</p>
                        <a href="{{ route('history') }}" class="btn btn-primary">Go </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User</h5>
                        <p class="card-text">{{ $user }}</p>
                        <a href="{{ route('admin.user')}}" class="btn btn-primary">Go </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
