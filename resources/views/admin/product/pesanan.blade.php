<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-bold h5 text-dark leading-tight">
            {{ __('Pesanan') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <!-- 01. Content-->
        <h1 class="text-center mb-4">Pesanan</h1>
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
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $item)
                                    <tr>
                                        <td>{{ $item->Nama_menu }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td class="quantity" data-id="{{ $item->id }}">0</td>
                                        <td class="d-flex justify-content-start align-items-center">
                                            <!-- Ikon Minus -->
                                            <button class="btn btn-sm decrement-btn" data-id="{{ $item->id }}"
                                                style="background-color: transparent; border: none; margin-right: 5px;">
                                                <i class="bi bi-dash-square" style="font-size: 1.2rem;"></i>
                                            </button>
                                            <!-- Ikon Plus -->
                                            <button class="btn btn-sm increment-btn" data-id="{{ $item->id }}"
                                                style="background-color: transparent; border: none;">
                                                <i class="bi bi-plus-square" style="font-size: 1.2rem;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button href="#" class="btn btn-primary" type="submit">Pesan</button>
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
