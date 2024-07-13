<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-bold h5 text-dark leading-tight">
            {{ __('Transaksi') }}
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
                                {{ session('success') }} <a href="{{ route('history') }}">Lihat Riwayat</a>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
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
                            <form id="order-form" action="{{ route('transaction.store') }}" method="POST"
                                onsubmit="return false;">
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

                            <div id="no-order-alert" class="alert alert-warning mt-3" style="display: none;">
                                Tidak ada pesanan yang dipilih.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="transaction-details-body" class="table-group-divider">
                                <!-- Dynamic content will be added here -->
                            </tbody>
                            <tfoot id="total-price-container" class="text-end fw-bold">
                                <td colspan="4">
                                    Total: Rp. <span id="total-price">0</span>
                                </td>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirm-order-btn">Konfirmasi Pesanan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

        $(document).ready(function() {
            // Handle "Pesan Sekarang" button click
            $('#order-form').submit(function(event) {
                event.preventDefault();

                // Empty the modal table body
                $('#transaction-details-body').empty();

                // Get the cart data
                var cart = @json($cart);
                var totalHarga = 0;

                // Loop through the cart items and append them to the modal table
                $.each(cart, function(id, details) {
                    var subtotal = details.price * details.quantity;
                    var row = `
                        <tr>
                            <td>${details.name}</td>    
                            <td>${details.quantity}</td>
                            <td>${details.price}</td>
                            <td>${subtotal}</td>
                        </tr>
                    `;
                    $('#transaction-details-body').append(row);
                    totalHarga += subtotal;
                });

                // Update total price in modal
                $('#total-price').text(totalHarga);
                // $('#total-price-container').append(totalHarga);

                // Show the modal
                $('#orderModal').modal('show');
            });

            // Handle order confirmation
            $('#confirm-order-btn').click(function() {
                $('#order-form')[0].submit();
            });
        });
    </script>
</x-app-layout>
