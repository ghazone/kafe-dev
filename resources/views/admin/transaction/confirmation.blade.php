<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-bold h5 text-dark leading-tight">
            {{ __('Transaction Confirmation') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Pesanan Anda Sedang Diproses</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center">
                        <p>Terima kasih atas pesanan Anda. Pesanan Anda sedang diproses.</p>
                        <button id="deliveryButton" class="btn btn-primary mt-3">Pesanan Anda Sedang Dikirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('deliveryButton').addEventListener('click', function() {
            alert('Pesanan Anda sedang dikirim. Terima Kasih atas kepercayaannya.');
            window.location.href = '{{ route('admin.dashboard') }}';
        });
    </script>
</x-app-layout>
