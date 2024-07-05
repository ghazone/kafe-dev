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

                        <div class="container mt-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th>Jumlah Pesanan</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
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
                                            <td>
                                                <button class="btn btn-sm btn-transparent"
                                                    onclick="updateCart('{{ $id }}', 'remove')"><i
                                                        class="bi bi-dash-square"
                                                        style="font-size: 1.2rem;"></i></button>
                                                <button class="btn btn-sm btn-transparent"
                                                    onclick="updateCart('{{ $id }}', 'add')"><i
                                                        class="bi bi-plus-square"
                                                        style="font-size: 1.2rem;"></i></button>
                                            </td>
                                        </tr>
                                        @php
                                            $totalHarga += $details['price'] * $details['quantity'];
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                Total Harga: {{ $totalHarga }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('transaction.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="total" value="{{ $totalHarga }}">
                                <label for="payment-method" class="form-label">Pilih Pembayaran</label>
                                <select class="form-select" id="payment-method" name="payment_method">
                                    <option value="cash">Tunai</option>
                                    <option value="credit_card">Kartu Kredit</option>
                                </select>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary">Kembali
                                        ke pesanan</a>
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
    <script>
        function updateCart(productId, action) {
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: 'post',
                data: {
                    productId: productId,
                    action: action,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload(); // reload halaman setelah pembaruan
                }
            });
        }
    </script>
</x-app-layout>
