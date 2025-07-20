@extends('layout.cdn1')
@section('title','Sozlamalar')
@section('content')
<div id="app">
    @extends('layout.menu')
    <div id="main">
        <header class="mb-4">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3 class="fw-bold">Sozlamalar</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sozlamalar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Sozlamalar
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Sozlamalar</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('setting_update') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="message_send" class="form-check-input" id="message_send"
                                        @if($Setting['message_send']=='true') checked @endif>
                                    <label for="message_send" class="form-check-label">SMS xabarlarni yuborishga ruxsat berilsin</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100 mt-4 mb-3">
                                <i class="bi bi-save"></i> O'zgarishlarni saqlash
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            Exson foiz
            <div class="col-lg-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Exson uchun ajratilgan ulush</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('setting_exson_update') }}" method="post">
                            @csrf
                            <label for="exson_foiz" class="form-label">Exson foizi (%)</label>
                            <input type="number" name="exson_foiz" value="{{ $Balans['exson_foiz'] }}" required class="form-control" placeholder="Exson foizini kiriting">
                            <button type="submit" class="btn btn-primary w-100 mt-1">
                                <i class="bi bi-save"></i> O'zgarishlarni saqlash
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            Qo'shimcha dam olish kunlari -->
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Qo'shimcha dam olish kunlari</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHolidayModal">
                            <i class="bi bi-plus-circle me-1"></i> Yangi qo‘shish
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped align-middle text-center" style="font-size: 14px;">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Dam olish kuni nomi</th>
                                    <th>Sana</th>
                                    <th>Meneger</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kun as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $item['comment'] }}</td>
                                        <td>{{ $item['data'] }}</td>
                                        <td>{{ $item['user'] }}</td>
                                        <td>
                                            <form action="{{ route('setting_delete_day') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                <button class="btn btn-danger p-1" type="submit"><i class="bi bi-trash"></i></button>
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

<!-- Modal: Yangi dam olish kuni qo‘shish -->
<div class="modal fade" id="addHolidayModal" tabindex="-1" aria-labelledby="addHolidayModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="addHolidayModalLabel">Yangi dam olish kuni qo‘shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <form action="{{ route('setting_create_day') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="comment" class="form-label">Dam olish kuni nomi</label>
                        <input type="text" name="comment" id="comment" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="data" class="form-label">Sana</label>
                        <input type="date" name="data" id="data" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Saqlash
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
