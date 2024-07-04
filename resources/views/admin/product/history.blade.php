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
                <li class="list-group-item collapse" id="collapse-2">

                    <form id="todo-form" action="{{ route('menu.post') }}" method="post">
                        @csrf
                        <div>
                            <div class="input-group mb-3">
                                <div>Nama</div>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                                <div>Harga</div>
                                <input type="text" class="form-control" name="harga" value="{{ old('Harga') }}">
                                <div>Deskripsi</div>
                                <input type="text" class="form-control" name="deskripsi"
                                    value="{{ old('deskripsi') }}">
                                <button class="btn btn-outline-primary" type="submit">Confirm</button>
                            </div>
                        </div>
                    </form>
                </li>
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="todo-form" action="" method="get">
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
                                    <th>Nama Pesanan</th>
                                    <th>Jumlah pesanan</th>
                                    <th>Total harga</th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $item)
                                    <tr>
                                        <td>{{ $item->nama_menu }}</td>
                                        <td>{{ $item->jumlah_pesanan }}</td>
                                        <td>{{ $item->total_harga }}</td>
                                        <td >{{ $item->payment_method }}</td>
                                        <td>
                                         </form>
                                             <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                 aria-expanded="false">Detail</button>
                                         </div>
                                        </td>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                             <div class="mb-3">
                                                    <label for="nama-{{ $loop->index }}" class="form-label">Nama Pesanan</label>
                                                    <input type="text" class="form-control" disabled="disabled" id="nama-{{ $loop->index }}" name="nama"
                                                        value="{{ $item->nama_menu }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="harga-{{ $loop->index }}" class="form-label">Jumlah Pesanan</label>
                                                    <input type="text" class="form-control" disabled="disabled" id="harga-{{ $loop->index }}" name="harga"
                                                        value="{{ $item->jumlah_pesanan }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi-{{ $loop->index }}" class="form-label">Total Harga</label>
                                                    <input type="text" class="form-control" disabled="disabled" id="deskripsi-{{ $loop->index }}" name="deskripsi"
                                                     value="{{ $item->total_harga }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi-{{ $loop->index }}" class="form-label">Payment</label>
                                                    <input type="text" class="form-control"  disabled="disabled" id="deskripsi-{{ $loop->index }}" name="deskripsi"
                                                     value="{{ $item->payment_method }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
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
            $('.increment-btn').click(function() {
                var id = $(this).data('id');
                var quantityElement = $('.quantity[data-id="' + id + '"]');
                var currentQuantity = parseInt(quantityElement.text());
                quantityElement.text(currentQuantity + 1);
            });

            $('.decrement-btn').click(function() {
                var id = $(this).data('id');
                var quantityElement = $('.quantity[data-id="' + id + '"]');
                var currentQuantity = parseInt(quantityElement.text());
                if (currentQuantity > 0) {
                    quantityElement.text(currentQuantity - 1);
                }
            });
        });
    </script>

</x-app-layout>
