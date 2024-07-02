<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-bold h5 text-dark leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Total Pesanan</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Jumlah Pesanan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $id => $details)
                                    <tr>
                                        <td>{{ $details['name'] }}</td>
                                        <td>{{ $details['quantity'] }}</td>
                                        <td>{{ $details['price'] * $details['quantity'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            <form action="{{ route('transaction.store') }}" method="POST">
                                @csrf
                                <label for="payment-method" class="form-label">Pilih Pembayaran</label>
                                <select class="form-select" id="payment-method" name="payment_method">
                                    <option value="cash">Tunai</option>
                                    <option value="credit_card">Kartu Kredit</option>
                                </select>
                                <button class="btn btn-primary mt-3" type="submit">Pesan Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</x-app-layout>
