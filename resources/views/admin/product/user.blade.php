<!-- resources/views/admin/product/home.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h1 class="text-center mb-4">List User</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Menampilkan pesan sukses dan error -->
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

                <!-- Form untuk menambah user (hanya untuk admin) -->
                @if(Auth::check() && Auth::user()->usertype == 'admin' )
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="task" id="todo-input"
                                    placeholder="Tambah user baru" required>
                                <button class="btn btn-primary" type="submit" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-add" aria-expanded="false">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Form untuk menambah user -->
                @if(Auth::check() && Auth::user()->usertype == 'admin')
                    <div class="card mb-3 collapse" id="collapse-add">
                        <div class="card-body">
                            <form id="todo-form" action="{{ route('menu.post') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="usertype" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="usertype" name="usertype" value="{{ old('usertype') }}">
                                </div>
                                <button class="btn btn-outline-primary" type="submit">Confirm</button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Form untuk mencari user -->
                

                <!-- Tabel untuk menampilkan daftar user -->
            <div class="card">
                <div class="card-body">
                    <div class="card mb-3">
                        <form id="search-form" action="" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value=""
                                    placeholder="Masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
            
            
                        <div class="overflow-auto">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Usertype</th>
                                        @if (Auth::check() && Auth::user()->usertype == 'admin')
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->usertype }}</td>
                                            @if (Auth::check() && Auth::user()->usertype == 'admin')
                                                <td>
                                                    <div class="btn-group">
                                                        <form action="{{ route('user.delete', ['id' => $item->id]) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Apakah Anda yakin untuk menghapus user ini?')">
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
                                                <form action="{{ route('user.update', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama</label>
                                                        <input type="text" class="form-control" id="nama"
                                                            name="name" value="{{ $item->name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" value="{{ $item->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="usertype" class="form-label">Status</label>
                                                        <input type="text" class="form-control" id="usertype"
                                                            name="usertype" value="{{ $item->usertype }}">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
