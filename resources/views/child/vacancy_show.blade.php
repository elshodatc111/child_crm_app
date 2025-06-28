@extends('layout.cdn2')
@section('title','Tashrif haqida')
@section('content')
<div id="app">
    @php
        use Carbon\Carbon;
    @endphp
    @extends('layout.menu')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <h3>Tashrif haqida</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('child_vakancy') }}">Tashriflar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tashrif haqida</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12 col-md-4 mb-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ $child['name'] }}</h5>
                        <table class="table table-borderless small text-start">
                            <tr><th>📍 Manzil:</th><td class="text-end">{{ $child['addres'] }}</td></tr>
                            <tr><th>📞 Telefon raqam:</th><td class="text-end">{{ $child['phone1'] }}</td></tr>
                            <tr><th>📞 Telefon raqam:</th><td class="text-end">{{ $child['phone2'] }}</td></tr>
                            <tr><th>🎂 Tug'ilgan kuni:</th><td class="text-end">{{ $child['birthday'] }} ( {{ Carbon::parse($child['birthday'])->age }} yoshda )</td></tr>
                            <tr><th>📋 Tashrif haqida:</th><td class="text-end">{{ $child['description'] }}</td></tr>
                            <tr><th>📋 Tashrif status:</th><td class="text-end">
                                @php
                                    $status = $child['status'];
                                    $badgeClass = match($status) {
                                        'new' => 'bg-primary',
                                        'pedding' => 'bg-warning',
                                        'cancel' => 'bg-danger',
                                        'success' => 'bg-success',
                                        default => 'bg-secondary'
                                    };
                                    $statusText = match($status) {
                                        'new' => 'Yangi',
                                        'pedding' => 'Jarayonda',
                                        'cancel' => 'Bekor qilingan',
                                        'success' => 'Qabul qilingan',
                                        default => ucfirst($status)
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                            </td></tr>
                        </table>
                            <div class="row" style="display:@if($child['status']=='success' OR $child['status']=='cancel') none @endif">
                                <div class="col-6">
                                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#blockModal">
                                        Yakunlash
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#acceptModal">
                                        Qabul qilish
                                    </button>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Menejer eslatmalari</h5>
                    </div>
                    <div class="card-body pt-4 bg-light notes-area mx-4">
                        @foreach ($comment as $item)
                            <div class="note-box mb-3">
                                <div class="note-meta mb-1 text-muted small">
                                    <strong>{{ $item['meneger'] }} | </strong>{{ $item['created_at'] }}
                                </div>
                                <div class="note-message">{{ $item['description'] }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer bg-white border-top">
                        <form action="{{ route('child_vakancy_show_pedding_post') }}" method="post">
                            @csrf
                            <div class="message-form d-flex align-items-center">
                                <input type="hidden" name="vacancy_child_id" value="{{ $child['id'] }}">
                                <div class="d-flex flex-grow-1 ms-3">
                                    <input type="text" name="description" class="form-control rounded-pill px-4 py-2" placeholder="Yangi eslatma yozing...">
                                </div>
                                <button type="submit" class="btn btn-success ms-3 rounded-pill px-4">Saqlash</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="blockModal" tabindex="-1" aria-labelledby="blockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('child_vakancy_show_cancel_post') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="blockModalLabel">Tashrifni yakunlash</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="vacancy_child_id" value="{{ $child['id'] }}">
                        <label for="description">Tashrifni yakunlash uchun izoh qoldiring</label>
                        <textarea name="description" class="form-control mt-2" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-danger">Yakunlash</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="#" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="acceptModalLabel">Tashrifni qabul qilish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <div class="modal-body">
                        Siz rostdan ham ushbu tashrifni <strong>qabul qilmoqchimisiz</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-success">Tasdiqlash</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <style>
        .notes-area {padding: 1rem;max-height: 400px;overflow-y: auto;background-color: #f8f9fa;border-radius: 1rem;}
        .note-box {padding: 12px 15px;background-color: #fff;border-left: 5px solid #0d6efd;border-radius: 8px;box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);}
        .note-meta {font-size: 0.85rem;}
        .note-message {font-size: 1rem;}
    </style>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>feather.replace()</script>
</div>
@endsection
