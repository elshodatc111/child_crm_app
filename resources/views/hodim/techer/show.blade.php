@extends('layout.cdn2')
@section('title','O\'qituvchilar')

@section('content')
<div id="app">
    @include('layout.menu')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>O'qituvchilar</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('hodim_techer') }}">O'qituvchilar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">O'qituvchi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="list-group">
                                <a href="{{ route('hodim_techer_show',$id) }}" class="list-group-item list-group-item-action text-center active">O'qituvchi haqida</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="list-group">
                                <a href="{{ route('hodim_techer_tarix',$id) }}" class="list-group-item list-group-item-action text-center ">Darslar tarixi</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="list-group">
                                <a href="{{ route('hodim_techer_paymart',$id) }}" class="list-group-item list-group-item-action text-center ">Ish haqi to'lovlari</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">O'qituvchi haqida</h5>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered text-center" style="font-size:14px">
                                    <tr>
                                        <th style="text-align:left">FIO</th>
                                        <td style="text-align:right">{{ $about['fio'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left">Telefon</th>
                                        <td style="text-align:right">{{ $about['phone'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left">Manzil</th>
                                        <td style="text-align:right">{{ $about['address'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left">Tug'ilgan kun</th>
                                        <td style="text-align:right">{{ $about['tkun'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left">Ishga olindi</th>
                                        <td style="text-align:right">{{ $about['created_at'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left">Holati</th>
                                        <td style="text-align:right">{{ $about['status'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">Joriy oydagi darslar statistikasi</h5>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle text-center" style="font-size:14px">
                                    <tr>
                                        <th style="text-align:left">Darslar soni</th>
                                        <td style="text-align:right">{{ $count['darslar'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left">Bolalar soni</th>
                                        <td style="text-align:right">{{ $count['child'] }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left">Ish haqi to'langan</th>
                                        <td style="text-align:right">{{ number_format($tulov, 0, '', ' ') }} so'm</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row pt-2 mt-3">
                                <div class="col-lg-6">
                                    <button class="btn btn-warning w-100 m-0 my-1" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="bi bi-pencil-square me-1"></i> Taxrirlash
                                    </button>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-info w-100 m-0 my-1 text-white" data-bs-toggle="modal" data-bs-target="#statusModal">
                                        <i class="bi bi-arrow-repeat me-1"></i> Holat yangilash
                                    </button>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-success w-100 m-0 my-1" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                        <i class="bi bi-credit-card-2-front me-1"></i> To'lov qilish
                                    </button>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-secondary w-100 m-0 my-1" data-bs-toggle="modal" data-bs-target="#lessonModal">
                                        <i class="bi bi-journal-plus me-1"></i> Yangi dars
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">Izohlar ({{ $countComment }})</h5>
                            <div class="comment-list">
                                @foreach ($UserComment as $item)
                                    <div class="comment-box d-flex align-items-start">
                                        <div>
                                            <strong>{{ $item['meneger'] }}</strong> <small class="text-muted">– {{ $item['created_at'] }}</small><br>
                                            {{ $item['comment'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="my-3">
                            <form action="{{ route('hodim_boshqalar_create_comments') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-7">
                                        <input type="hidden" name="user_id" value="{{ $id }}">
                                        <input type="text" class="form-control rounded" id="comment" name="comment" placeholder="Hodim haqida fikringizni yozing...">
                                    </div>
                                    <div class="col-5">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-send"></i> Saqlash
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('hodim_techer_update') }}" method="post">
                @csrf 
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil-square me-1"></i> Taxrirlash</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $about['id'] }}">
                        <label for="fio" class="my-2">FIO</label>
                        <input type="text" name="fio" class="form-control" value="{{ $about['fio'] }}" required>
                        <label for="phone" class="my-2">Telefon raqan</label>
                        <input type="text" name="phone" class="form-control phone" value="{{ $about['phone'] }}" required>
                        <label for="address" class="my-2">Yashash manzili</label>
                        <input type="text" name="address" class="form-control" value="{{ $about['address'] }}" required>
                        <label for="tkun" class="my-2">Tug'ilgan kuni</label>
                        <input type="date" name="tkun" class="form-control" value="{{ $about['tkun'] }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                        <button type="submit" class="btn btn-warning">Saqlash</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('hodim_boshqalar_update_status') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $about['id'] }}">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="statusModalLabel"><i class="bi bi-arrow-repeat me-1"></i> Holat yangilash</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Faoliyat turini tanlang</label>
                            <select name="status" class="form-select" required>
                                <option value="">Tanlang</option>
                                <option value="active" {{ ($about['status'] ?? '') == 'active' ? 'selected' : '' }}>Aktiv</option>
                                <option value="block" {{ ($about['status'] ?? '') == 'block' ? 'selected' : '' }}>Block</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Izoh</label>
                            <textarea class="form-control" id="note" name="note" rows="2" required placeholder="Izoh..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                        <button type="submit" class="btn btn-info text-white">Yangilash</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('hodim_boshqalar_paymart_post') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title text-white" id="paymentModalLabel"><i class="bi bi-credit-card-2-front me-1"></i> To'lov qilish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr>
                                    <th colspan=2>Balansda mavjud</th>
                                </tr>
                                <tr>
                                    <td>Naqt</td>
                                    <td>Plastik</td>
                                </tr>
                                <tr>
                                    <td>{{ number_format($balans['naqt'], 0, '', ' ') }} so'm</td>
                                    <td>{{ number_format($balans['plastik'], 0, '', ' ') }} so'm</td>
                                </tr>
                            </thead>
                        </table>
                        <input type="hidden" name="user_id" value="{{ $about['id'] }}">
                        <input type="hidden" name="naqt" value="{{ $balans['naqt'] }}">
                        <input type="hidden" name="plastik" value="{{ $balans['plastik'] }}">
                        <div class="mb-3">
                            <label for="amount" class="form-label">To‘lov miqdori (so‘m):</label>
                            <input type="text" class="form-control price-format" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_type" class="form-label">To‘lov turi</label>
                            <select name="payment_type" class="form-select" required>
                                <option value="">Tanlang</option>
                                <option value="naqt">Naqt</option>
                                <option value="plastik">Plastik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Izoh</label>
                            <textarea class="form-control" id="comment" name="comment" required rows="2" placeholder="To‘lov haqida izoh..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-success">To'lash</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="lessonModal" tabindex="-1" aria-labelledby="lessonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('hodim_create_dars') }}" method="post">
                @csrf 
                <input type="hidden" name="techer_id" value="{{ $about['id'] }}">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-white">
                        <h5 class="modal-title text-white" id="lessonModalLabel"><i class="bi bi-journal-plus me-1"></i> Yangi dars</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="lesson_name" class="my-2">Dars nomi</label>
                        <input type="text" name="lesson_name" class="form-control" required placeholder="Dars nomi">
                        <label for="group_id" class="my-2">Guruhni tanlang</label>
                        <select name="group_id" required class="form-select">
                            <option value="">Tanlang</option>
                            @foreach($group as $item)
                                <option value="{{ $item['id'] }}">{{ $item['group_name'] }}</option>
                            @endforeach
                        </select>
                        <label for="child_count" class="my-2">Darsga qatnashgan bolalar soni</label>
                        <input type="number" name="child_count" class="form-control" required min=1 placeholder="Bolalar soni">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
                        <button type="submit" class="btn btn-secondary">Saqlash</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <style>
        .comment-list {max-height: 175px;overflow-y: auto;padding-right: 10px;}
        .comment-box {background-color: #f8f9fa;border-left: 4px solid #0d6efd;padding: 10px 15px;border-radius: 8px;margin-bottom: 10px;}
        .avatar {width: 40px;height: 40px;object-fit: cover;border-radius: 50%;margin-right: 10px;}
    </style>
    <script>
        document.querySelectorAll('.price-format').forEach(function(input) {
            input.addEventListener('input', function(e) {
                let value = input.value.replace(/\D/g, '');
                if (value) {
                    input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                } else {
                    input.value = '';
                }
            });
            input.addEventListener('blur', function() {
                input.value = input.value.trim();
            });
        });
    </script>
@endsection
