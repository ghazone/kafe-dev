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

                        <div style="margin-bottom: 20px;">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th>Jumlah Pesanan</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalHarga = 0;
                                    @endphp
                                    @foreach ($cart as $id => $details)
                                        <tr>
                                            <td>{{ $details['name'] }}</td>
                                            <td>{{ $details['quantity'] }}</td>
                                            <td>{{ $details['price'] * $details['quantity'] }}</td>
                                        </tr>
                                        @php
                                            $totalHarga += $details['price'] * $details['quantity'];
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <tr>
                                <td colspan="2">
                                    <strong style="font-size: 20px">Total harga :</strong> <span
                                        style="margin-left: 10px; font-weight:bold;">{{ $totalHarga }}</span>
                                </td>
                            </tr>

                        </div>

                        <div class="mt-4">
                            <form action="{{ route('transaction.store') }}" method="POST">
                                @csrf
                                <label for="payment-method" class="form-label">Pilih Pembayaran</label>
                                <select class="form-select" id="payment-method" name="payment_method">
                                    <option value="cash">Tunai</option>
                                    <option value="credit_card">Kartu Kredit</option>
                                </select>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary">Kembali ke pesanan</a>
                                    <button class="btn btn-primary" type="submit">Pesan Sekarang</button>
                                </div>
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
