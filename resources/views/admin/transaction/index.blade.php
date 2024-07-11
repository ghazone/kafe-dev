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
                    <form id="todo-form" action="{{ route('transaction.addToCart') }}" method="post"
                        onsubmit="return validateForm()">
                        @csrf
                        <div>
                            <div class="input-group mb-3">
                                <div>Nama</div>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}"
                                    id="nama">
                                <div>Harga</div>
                                <input type="text" class="form-control" name="harga" value="{{ old('harga') }}"
                                    id="harga">
                                <div>Deskripsi</div>
                                <input type="text" class="form-control" name="deskripsi"
                                    value="{{ old('deskripsi') }}" id="deskripsi">
                                <button class="btn btn-outline-primary" type="submit">Confirm</button>
                            </div>
                        </div>
                    </form>
                    <div id="empty-fields-alert" class="alert alert-warning mt-3" style="display: none;">
                        Semua field harus diisi.
                    </div>
                </li>
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="search-form" action="{{ route('admin.transaction.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control mr-2" name="term"
                                    placeholder="Search projects" id="term">
                                <button class="btn btn-secondary" type="submit">Cari</button>
                            </div>
                        </form>
                    <div class="overflow-auto">
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
<<<<<<< HEAD
                        <button class="btn btn-primary" type="button" id="order-button">Pesan</button>
                        <div id="no-order-alert" class="alert alert-danger mt-3" style="display: none;">
                            Tidak Ada yang di pesan.
=======
                        <button class="btn btn-primary" type="button"
                            onclick="window.location.href='{{ route('admin.transaction.cart') }}'">Pesan</button>
>>>>>>> 43089ca296458b7ee26fe66f202acde5e294eb98
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function validateForm() {
            var nama = document.getElementById('nama').value;
            var harga = document.getElementById('harga').value;
            var deskripsi = document.getElementById('deskripsi').value;

            if (nama === "" || harga === "" || deskripsi === "") {
                document.getElementById('empty-fields-alert').style.display = 'block';
                return false; // Prevent form submission
            } else {
                document.getElementById('empty-fields-alert').style.display = 'none';
                return true; // Allow form submission
            }
        }

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
                var url = quantity == 0 ? '{{ route('transaction.removeFromCart') }}' :
                    '{{ route('transaction.addToCart') }}';
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

            $('#order-button').click(function() {
                var hasOrder = false;
                $('.quantity').each(function() {
                    if (parseInt($(this).text()) > 0) {
                        hasOrder = true;
                    }
                });

                if (hasOrder) {
                    window.location.href = '{{ route('admin.transaction.cart') }}';
                } else {
                    $('#no-order-alert').show();
                }
            });
        });
    </script>
</x-app-layout>
