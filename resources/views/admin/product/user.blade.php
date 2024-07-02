<!-- resources/views/admin/product/home.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h1 class="text-center mb-4">List user</h1>
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

                        <div class="input-group mb-3">
                            @if(Auth::check() && Auth::user()->usertype == 'admin' )
                            <input type="text" class="form-control" name="task" id="todo-input"
                                placeholder="Tambah task baru" required>
                            <button class="btn btn-primary" type="submit" data-bs-toggle="collapse"
                                data-bs-target="#collapse-add" aria-expanded="false">
                                Tambah
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                <li class="list-group-item collapse" id="collapse-add">
                    <form id="todo-form" action="{{ route('menu.post') }}" method="post">
                        @csrf
                        <div>
                            <div class="input-group mb-3">
                                <div>Nama</div>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                                <div>Email</div>
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                <div>Status</div>
                                <input type="text" class="form-control" name="usertype"
                                    value="{{ old('usertype') }}">
                                <button class="btn btn-outline-primary" type="submit">Confirm</button>
                            </div>
                        </div>
                    </form>
                </li>
                <div class="card">
                    <div class="card-body">
                        <form id="todo-form" action="" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value=""
                                    placeholder="masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>

<<<<<<< HEAD
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->usertype }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <form action="{{ route('user.delete', ['id' => $item->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                                                </form>
                                                <button class="btn btn-primary btn-sm edit-btn"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-edit{{ $loop->index }}"
                                                    aria-expanded="false">Edit</button>
=======
                        <ul class="list-group mb-4" id="todo-list">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h6>Nama</h6>
                                <h6>Email</h6>
                                <h6>Status</h6>
                                <h6>Aksi</h6>
                            </li>
                            @foreach ($data as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="task-text">{{ $item->name }}</span>
                                    <span class="task-text">{{ $item->email }}</span>
                                    <span class="task-text">{{ $item->usertype }}</span>
                                    <div class="btn-group">
                                        <form action="{{ route('user.delete', ['id' => $item->id]) }}" method="POST"
                                            onsubmit="return confirm('Are you sure, pingin di hapus ?')">
                                            @csrf
                                            @method('delete')
                                        @if(Auth::check() && Auth::user()->usertype == 'admin')
                                        <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                        <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-edit{{ $loop->index }}"
                                            aria-expanded="false">Edit</button>
                                        @endif
                                    </div>
                                </li>
                                <li class="list-group-item collapse" id="collapse-edit{{ $loop->index }}">
                                    <form action="{{ route('user.update', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div>
                                            <div>Nama</div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="nama"
                                                    value="{{ $item->name }}">
>>>>>>> 084d27401fd2442fe0d172296576554357f44a5d
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="collapse" id="collapse-edit{{ $loop->index }}">
                                        <td colspan="4">
                                            <form action="{{ route('user.update', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" id="nama"
                                                        name="nama" value="{{ $item->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" value="{{ $item->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <input type="text" class="form-control" id="status"
                                                        name="status" value="{{ $item->usertype }}">
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
