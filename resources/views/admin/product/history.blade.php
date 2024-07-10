<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History User') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Transaction</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <form id="search-form" action="{{ route('admin.transaction.index') }}" method="get">
                            <div class="card">
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Masukkan kata kunci">
                                        <button class="btn btn-secondary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Total Harga</th>
                                    <th>Payment Method</th>
                                    <th>Actions</th>
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
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $loop->index }}">Detail</button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Transaction Detail
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="id-{{ $loop->index }}"
                                                            class="form-label">ID</label>
                                                        <input type="text" class="form-control" disabled="disabled"
                                                            id="id-{{ $loop->index }}"
                                                            value="{{ $transaction->id }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="user_id-{{ $loop->index }}"
                                                            class="form-label">User ID</label>
                                                        <input type="text" class="form-control" disabled="disabled"
                                                            id="user_id-{{ $loop->index }}"
                                                            value="{{ $transaction->user_id }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="total_harga-{{ $loop->index }}"
                                                            class="form-label">Total Harga</label>
                                                        <input type="text" class="form-control" disabled="disabled"
                                                            id="total_harga-{{ $loop->index }}"
                                                            value="{{ $transaction->total_harga }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="payment_method-{{ $loop->index }}"
                                                            class="form-label">Payment Method</label>
                                                        <input type="text" class="form-control" disabled="disabled"
                                                            id="payment_method-{{ $loop->index }}"
                                                            value="{{ $transaction->payment_method }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table table-striped">
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
                                            <button class="btn btn-primary btn-sm edit-btn"
                                                data-id="{{ $transaction->id }}" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" aria-expanded="false">Detail</button>
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
                        $('#nama-pesanan').val('');
                        $('#id-menu').val('');
                        $('#jumlah-pesanan').val('');
                        $('#total-harga').val('');
                        $('#payment-method').val('');

                        if (data.menu.length > 0) {
                            $('#nama-pesanan').val(data.menu[0].nama_menu || 'Tidak ada');
                            $('#id-menu').val(data.menu[0].id_menu || 'Tidak ada');
                            $('#jumlah-pesanan').val(data.menu[0].jumlah_pesanan ||
                                'Tidak ada');
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
