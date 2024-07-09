<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-bold h5 text-dark leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <!-- 01. Content-->
        <h1 class="text-center mb-4">History</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="search-form" action="" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value=""
                                    placeholder="masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>User ID</th>
                                    <th>Total Harga</th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->user_id }}</td>
                                    <td>{{ $transaction->total_harga }}</td>
                                    <td>{{ $transaction->payment_method }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $transaction->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        aria-expanded="false">Detail</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama-pesanan" class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" id="nama-pesanan" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="id-menu" class="form-label">ID Menu</label>
                        <input type="text" class="form-control" id="id-menu" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah-pesanan" class="form-label">Jumlah Pesanan</label>
                        <input type="text" class="form-control" id="jumlah-pesanan" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="total-harga" class="form-label">Total Harga</label>
                        <input type="text" class="form-control" id="total-harga" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="payment-method" class="form-label">Payment</label>
                        <input type="text" class="form-control" id="payment-method" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit-btn').click(function() {
                var transactionId = $(this).data('id');
                var url = "{{ route('history.getTransactionDetails', ':id') }}";
                url = url.replace(':id', transactionId);

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        // Kosongkan field modal sebelum mengisinya
                        $('#nama-pesanan').val('');
                        $('#id-menu').val('');
                        $('#jumlah-pesanan').val('');
                        $('#total-harga').val('');
                        $('#payment-method').val('');

                        // Mengisi data modal
                        if (data.menu.length > 0) {
                            $('#nama-pesanan').val(data.menu[0].nama_menu || 'Tidak ada');
                            $('#id-menu').val(data.menu[0].id_menu || 'Tidak ada');
                            $('#jumlah-pesanan').val(data.menu[0].jumlah_pesanan || 'Tidak ada');
                        } else {
                            $('#nama-pesanan').val('Tidak ada');
                            $('#id-menu').val('Tidak ada');
                            $('#jumlah-pesanan').val('Tidak ada');
                        }
                        $('#total-harga').val(data.total_harga || 'Tidak ada');
                        $('#payment-method').val(data.payment_method || 'Tidak ada');
                    },
                    error: function() {
                        alert('Data gagal diambil.');
                    }
                });
            });
        });
    </script>
</x-app-layout>
