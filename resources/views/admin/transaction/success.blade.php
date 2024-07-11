<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-bold h5 text-dark leading-tight">
            {{ __('Transaction Success') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Success</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="d-flex justify-content-center alert alert-success">
                        Pesanan Succes, pesanan anda sedang di buatkan ! , <a href="{{ route('history') }}"> Lihat
                            Riwayat</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary">Kembali ke
                            pesanan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
