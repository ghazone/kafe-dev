<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin User') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
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
                        @if (Auth::check() && Auth::user()->usertype == 'admin')
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="task" id="todo-input"
                                    placeholder="Tambah task baru" required>
                                <button class="btn btn-primary" type="submit" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-add" aria-expanded="false">
                                    Tambah
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <li class="list-group-item collapse" id="collapse-add">
                        <form id="todo-form" action="{{ route('menu.post') }}" method="post" class="">
                            @csrf
                            <div class="input-group mb-3">
                                <div>Nama</div>
                                <input type="text" class="form-control" name="Nama_menu"
                                    value="{{ old('Nama_menu') }}">
                                <div>Harga</div>
                                <input type="text" class="form-control" name="harga" value="{{ old('harga') }}">
                                <div>Deskripsi</div>
                                <input type="text" class="form-control" name="deskripsi"
                                    value="{{ old('deskripsi') }}">
                                <button class="btn btn-outline-primary" type="submit">Confirm</button>
                            </div>
                        </form>
                        </li>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form id="search-form" action="" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search"
                                    placeholder="Masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">Cari</button>
                            </div>
                        </form>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    @if (Auth::check() && Auth::user()->usertype == 'admin')
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $item)
                                    <tr>
                                        <td>{{ $item->Nama_menu }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        @if (Auth::check() && Auth::user()->usertype == 'admin')
                                            <td>
                                                <div class="btn-group">
                                                    <form action="{{ route('menu.delete', ['id' => $item->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin untuk menghapus menu ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                                                    </form>
                                                    <button class="btn btn-primary btn-sm edit-btn"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $loop->index }}"
                                                        aria-expanded="false">Edit</button>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr class="collapse" id="collapse-{{ $loop->index }}">
                                        <td colspan="4">
                                            <form action="{{ route('menu.update', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mb-3">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" id="nama"
                                                        name="nama" value="{{ $item->Nama_menu }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="harga">Harga</label>
                                                    <input type="text" class="form-control" id="harga"
                                                        name="harga" value="{{ $item->harga }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="deskripsi">Deskripsi</label>
                                                    <input type="text" class="form-control" id="deskripsi"
                                                        name="deskripsi" value="{{ $item->deskripsi }}">
                                                </div>
                                                <button type="submit" class="btn btn-outline-primary">Update</button>
                                            </form>
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
</x-app-layout>
