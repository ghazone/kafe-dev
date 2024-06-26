<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-bold h5 text-dark leading-tight">
            {{ __('Pesanan') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <!-- 01. Content-->
        <h1 class="text-center mb-4">Menu</h1>
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
                        <!-- 02. Form input data -->
                        <div class="input-group mb-3 justify-content-end">
                        @if (Auth::check() && Auth::user()->usertype == 'admin')
                            <button class="btn btn-primary " type="submit" data-bs-toggle="collapse"
                                data-bs-target="#collapse-2" aria-expanded="false">
                                Tambah
                            </button>
                        @endif
                        </div>
                    </div>
                </div>
                <li class="list-group-item collapse" id="collapse-2">
                    <form id="todo-form" action="{{ route('menu.post') }}" method="post">
                        @csrf
                        <div>
                            <div class="input-group mb-3">
                                <div>Nama</div>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                                <div>Harga</div>
                                <input type="text" class="form-control" name="harga" value="{{ old('harga') }}">
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

                        <ul class="list-group mb-4" id="todo-list">
                            @foreach ($menus as $item)
                                <!-- 04. Display Data -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Nama:</strong> {{ $item->Nama_menu }}<br>
                                        <strong>Harga:</strong> {{ $item->harga }}<br>
                                        <strong>Deskripsi:</strong> {{ $item->deskripsi }}
                                    </div>
                                    <div class="btn-group">
                                        <form action="{{ route('menu.delete', ['id' => $item->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin untuk menghapus menu ini?')">
                                            @csrf
                                            @method('DELETE')
                                        @if (Auth::check() && Auth::user()->usertype == 'admin')
                                            <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                        <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $loop->index }}"
                                            aria-expanded="false">Edit</button>
                                        @endif
                                    </div>
                                </li>
                                <!-- 05. Update Data -->
                                <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                    <form action="{{ route('menu.update', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <div>Nama</div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="nama"
                                                    value="{{ $item->Nama_menu }}">
                                            </div>
                                            <div>Harga</div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="harga"
                                                    value="{{ $item->harga }}">
                                            </div>
                                            <div>Deskripsi</div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="deskripsi"
                                                    value="{{ $item->deskripsi }}">
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-primary" type="submit">Update</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</x-app-layout>
