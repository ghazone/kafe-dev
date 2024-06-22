<x-app-layout>
    <x-slot name="header">
        <h2 class="font-weight-bold h5 text-dark leading-tight">
            {{ __('Menu') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <!-- 01. Content-->
        <h1 class="text-center mb-4">Pesanan</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- 02. Form input data -->
                        <form id="todo-form" action="" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="task" id="todo-input"
                                    placeholder="Tambah task baru" required>
                                <button class="btn btn-primary" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
                            <!-- 04. Display Data -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="task-text">Coding</span>
                                <input type="text" class="form-control edit-input" style="display: none;"
                                    value="Coding">
                                <div class="btn-group">
                                    <button class="btn btn-danger btn-sm delete-btn">✕</button>
                                    <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-1" aria-expanded="false">✎</button>
                                </div>
                            </li>
                            <!-- 05. Update Data -->
                            <li class="list-group-item collapse" id="collapse-1">
                                <form action="" method="POST">
                                    <div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="task" value="Coding">
                                            <button class="btn btn-outline-primary" type="button">Update</button>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="radio px-2">
                                            <label>
                                                <input type="radio" value="1" name="is_done"> Selesai
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="0" name="is_done"> Belum
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>
