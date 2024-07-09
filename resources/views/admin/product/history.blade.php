<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History User') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Transaction</h1>
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
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <form id="search-form" action="{{ route('admin.transaction.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search"
                                    placeholder="Masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">Cari</button>
                            </div>
                        </form>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Total Harga</th>
                                    <th>Payment Method</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user_id }}</td>
                                        <td>{{ $item->total_harga }}</td>
                                        <td>{{ $item->payment_method }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $loop->index }}">Detail</button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Transaction Detail
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="id-{{ $loop->index }}"
                                                            class="form-label">ID</label>
                                                        <input type="text" class="form-control" disabled="disabled"
                                                            id="id-{{ $loop->index }}" value="{{ $item->id }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="user_id-{{ $loop->index }}"
                                                            class="form-label">User ID</label>
                                                        <input type="text" class="form-control" disabled="disabled"
                                                            id="user_id-{{ $loop->index }}"
                                                            value="{{ $item->user_id }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="total_harga-{{ $loop->index }}"
                                                            class="form-label">Total Harga</label>
                                                        <input type="text" class="form-control" disabled="disabled"
                                                            id="total_harga-{{ $loop->index }}"
                                                            value="{{ $item->total_harga }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="payment_method-{{ $loop->index }}"
                                                            class="form-label">Payment Method</label>
                                                        <input type="text" class="form-control" disabled="disabled"
                                                            id="payment_method-{{ $loop->index }}"
                                                            value="{{ $item->payment_method }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
