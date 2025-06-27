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
            <!-- Sozlamalar -->
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

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="exson_type_naqt" class="form-check-input" id="exson_type_naqt"
                                        @if($Setting['exson_type_naqt']=='true' && $Setting['exson_type_plastik']=='false') checked @endif>
                                    <label for="exson_type_naqt" class="form-check-label">Exson uchun faqat naqd pul ajratish</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="exson_type_plastik" class="form-check-input" id="exson_type_plastik"
                                        @if($Setting['exson_type_naqt']=='false' && $Setting['exson_type_plastik']=='true') checked @endif>
                                    <label for="exson_type_plastik" class="form-check-label">Exson uchun faqat plastik (karta) orqali ajratish</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="exson_gibrid" class="form-check-input" id="exson_gibrid"
                                        @if($Setting['exson_type_naqt']=='true' && $Setting['exson_type_plastik']=='true') checked @endif>
                                    <label for="exson_gibrid" class="form-check-label">Exsonda naqd to‘lovdan faqat naqd, plastik to‘lovdan faqat plastik tarzda mablag‘ ajratilsin (belgilangan summadan)</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100 mt-4">
                                <i class="bi bi-save"></i> O'zgarishlarni saqlash
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Exson foiz -->
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
                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                <i class="bi bi-save"></i> O'zgarishlarni saqlash
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Qo'shimcha dam olish kunlari -->
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Qo'shimcha dam olish kunlari</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Dam olish kuni</th>
                                    <th>Dam olish kuni haqida</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Yangi yil</td>
                                    <td>2025-yil 1-yanvar</td>
                                    <td>Aktiv</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
