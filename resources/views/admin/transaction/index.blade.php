<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-bold h5 text-dark leading-tight">
            {{ __('Pesanan') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h1 class="text-center mb-4">List Pesanan</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <li class="list-group-item collapse" id="collapse-2">
                    <form id="todo-form" action="{{ route('transaction.addToCart') }}" method="post">
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
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="todo-form" action="" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value=""
                                    placeholder="masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">Cari</button>
                            </div>
                        </form>

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Stok</th>
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
                                            <button class="btn btn-sm decrement-btn minus"
                                                data-id="{{ $item->id }}" data-name="{{ $item->Nama_menu }}"
                                                data-price="{{ $item->harga }}"
                                                style="background-color: transparent; border: none; margin-right: 5px;">
                                                <i class="bi bi-dash-square" style="font-size: 1.2rem;"></i>
                                            </button>
                                            <button class="btn btn-sm increment-btn add-to-cart"
                                                data-id="{{ $item->id }}" data-name="{{ $item->Nama_menu }}"
                                                data-price="{{ $item->harga }}"
                                                style="background-color: transparent; border: none;">
                                                <i class="bi bi-plus-square" style="font-size: 1.2rem;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-primary" type="button"
                            onclick="window.location.href='{{ route('admin.transaction.cart') }}'">Lihat
                            Pesanan</button>
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
                console.log(id, currentQuantity)
            });

            $('.decrement-btn').click(function() {
                var id = $(this).data('id');
                var quantityElement = $('.quantity[data-id="' + id + '"]');
                var currentQuantity = parseInt(quantityElement.text());
                console.log(id, currentQuantity)
                if (currentQuantity > 0) {
                    quantityElement.text(currentQuantity - 1);
                }
            });

            $('.add-to-cart').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var price = $(this).data('price');
                var quantityElement = $('.quantity[data-id="' + id + '"]');
                var currentQuantity = parseInt(quantityElement.text());

                var quantity = currentQuantity;
                console.log(quantity)
                $.ajax({
                    url: '{{ route('transaction.addToCart') }}',
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name: name,
                        price: price,
                        quantity: quantity
                    },
                });
            });
            $('.minus').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var price = $(this).data('price');
                var quantityElement = $('.quantity[data-id="' + id + '"]');
                var currentQuantity = parseInt(quantityElement.text());

                var quantity = currentQuantity;
                var method = quantity == 0 ? 'delete' : 'post'
                var url = quantity == 0 ? '{{ route('transaction.removeFromCart') }}' : '{{ route('transaction.addToCart') }}';
                console.log(quantity, method)
                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name: name,
                        price: price,
                        quantity: quantity
                    },
                });
            });
        });
    </script>
</x-app-layout>
