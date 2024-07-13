<x-app-layout>
    <x-slot name="header">        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History User') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Transaction</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="search-form" action="" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search"
                                    placeholder="Masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">Cari</button>
                            </div>
                        </form>
                    <div class="overflow-auto">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Total Harga</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->total_harga }}</td>
                                    <td>{{ $transaction->payment_method }}</td>
                                    <td>{{ $transaction->created_at->format('D/m/Y') }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $transaction->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        aria-expanded="false">Detail</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $transactions->links() }}
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
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th>ID Menu</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="transaction-details-body">
                            <!-- Dynamic content will be added here -->
                        </tbody>
                    </table>
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
                    // Mengosongkan isi tabel
                    $('#transaction-details-body').empty();
                    // Mengisi data tabel
                    data.menu.forEach(function(item) {
                        var row = `<tr>
                            <td>${item.nama_menu || 'Tidak ada'}</td>
                            <td>${item.id_menu || 'Tidak ada'}</td>
                            <td>${item.jumlah_pesanan || 'Tidak ada'}</td>
                            <td>${item.harga_menu || 'Tidak ada'}</td>
                            <td>${item.subtotal || 'Tidak ada'}</td>
                        </tr>`;
                        $('#transaction-details-body').append(row);
                    });
			var rowTotal = `<tr><td colspan='2'>Payment Method: ${data.payment_method}</td><td colspan='3'>Total: Rp.${data.total_harga}</td></tr>`
			$('#transaction-details-body').append(rowTotal)
                },
                error: function() {
                    alert('Data gagal diambil.');
                }
            });
        });
    });
</script>
</x-app-layout>
