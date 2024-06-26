user()
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-bold h5 text-dark leading-tight">
            {{ __('Menu') }}
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
                             @if (Auth::check() && Auth::user()->usertype == 'admin')
                                <div class="input-group mb-3">
                                    <button class="btn btn-primary" type="submit" data-bs-toggle="collapse"
                                        href="#collapse-2" aria-expanded="false">
                                        Tambah
                                    </button>
                                </div>
                            @endif
                            <!-- Daftar menu -->
                            <ul class="list-group mb-4" id="todo-list">
                                @foreach ($data as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="task-text">{{ $item->Nama_menu }}</span>
                                        @if (Auth::check() && Auth::user()->usertype == 'admin')
                                            <!-- Tombol update dan hapus -->
                                            <div class="btn-group">
                                                <form action="{{ route('menu.delete', ['id' => $item->id]) }}"
                                                 method="POST" onsubmit="return confirm('Apakah yakin?')">
                                                 @csrf
                                                 @method('delete')
                                                 <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                                                </form>
                                                <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                                 data-bs-target="#collapse-{{ $loop->index }}"
                                                 aria-expanded="false">Edit</button>
                                            </div>
                                     @endif
                                    </li>
                                @endforeach
                            </ul>
                                <!-- 05. Update Data -->
                                <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                    <form action="{{ route('menu.update', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div>
                                            <div>Nama</div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="nama"
                                                    value={{ $item->Nama_menu }}>
                                            </div>
                                            <div>harga</div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="harga"
                                                    value={{ $item->harga }}>
                                            </div>
                                            <div>Deskripsi</div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="deskripsi"
                                                    value={{ $item->deskripsi }}>
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
