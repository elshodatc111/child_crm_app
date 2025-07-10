@extends('layout.cdn2')
@section('title','Menejer haqida')

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
                        <h3>Menejer haqida</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('hodim') }}">Menejerlar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Menejer haqida</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('meneger_show', $id) }}" class="list-group-item list-group-item-action text-center active">Menejer haqida</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('meneger_show_paymart',$id) }}" class="list-group-item list-group-item-action text-center">Ish haqi to'lovlari</a>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-4 mb-2">
                    <div class="card">
                        <div class="card-body pb-4">
                            <h5 class="card-title mb-2"></i>Hodim haqida</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>FIO:</th>
                                    <td style="text-align:right">{{ $about['fio'] }}</td>
                                </tr>
                                <tr>
                                    <th>Telefon:</th>
                                    <td style="text-align:right">{{ $about['phone'] }}</td>
                                </tr>
                                <tr>
                                    <th>Manzil:</th>
                                    <td style="text-align:right">{{ $about['address'] }}</td>
                                </tr>
                                <tr>
                                    <th>Tug'ilgan kuni:</th>
                                    <td style="text-align:right">{{ $about['tkun'] }}</td>
                                </tr>
                                <tr>
                                    <th>Lavozim:</th>
                                    <td style="text-align:right">
                                        @if($about['type']=='direktor')
                                            Drektor
                                        @else
                                            Menejer
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Login:</th>
                                    <td style="text-align:right">{{ $about['email'] }}</td>
                                </tr>
                                <tr>
                                    <th>Holati:</th>
                                    <td style="text-align:right">
                                        @if($about['status']=='active')
                                            Aktiv
                                        @elseif($about['status']=='block')
                                            Bloklangan
                                        @else
                                            Ishdan bo'shatilgan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ishga olindi:</th>
                                    <td style="text-align:right">{{ $about['created_at'] }}</td>
                                </tr>
                            </table>
                            <div class="w-100 row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-info text-white w-100 d-flex justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#profileUpdate">
                                        <i class="bi bi-pencil-square"></i> Tahrirlash
                                    </button>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary w-100 d-flex justify-content-center gap-2"
                                            data-bs-toggle="modal" data-bs-target="#profileStatus">
                                        <i class="bi bi-arrow-repeat"></i> <!-- Holat yangilash uchun icon -->
                                        Holatini yangilash
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-2"></i>Hodimning joriy oydagi davomadi</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Joriy oyda davomad soni:</th>
                                    <td style="text-align:right">{{ $davomad['all'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ishga keldi:</th>
                                    <td style="text-align:right">{{ $davomad['keldi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ishga kelmagan:</th>
                                    <td style="text-align:right">{{ $davomad['kelmadi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Kechikib keldi:</th>
                                    <td style="text-align:right">{{ $davomad['kechikdi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Formada kelmadi:</th>
                                    <td style="text-align:right">{{ $davomad['formada_emas'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ish kuni emas:</th>
                                    <td style="text-align:right">{{ $davomad['ish_kuni_emas'] }}</td>
                                </tr>
                                <tr>
                                    <th>Naqt to'lovlar:</th>
                                    <td style="text-align:right">{{ number_format($paymart['naqt'], 0, '', ' ') }} so'm</td>
                                </tr>
                                <tr>
                                    <th>Plastik to'lovlar:</th>
                                    <td style="text-align:right">{{ number_format($paymart['plastik'], 0, '', ' ') }} so'm</td>
                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-success w-100 d-flex justify-content-center gap-2"
                                            data-bs-toggle="modal" data-bs-target="#salaryModal">
                                        <i class="bi bi-cash-coin"></i> <!-- Ish haqi uchun ikonka -->
                                        Ish haqi to'lov
                                    </button>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn btn-warning w-100 d-flex justify-content-center gap-2"
                                            data-bs-toggle="modal" data-bs-target="#passwordUpdate">
                                        <i class="bi bi-shield-lock"></i> <!-- Parol yangilash uchun ikonka -->
                                        Parolni yangilash
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">Izohlar ({{ $count_comment }})</h5>
                            <div class="comment-list">
                                @foreach ($comments as $item)
                                    <div class="comment-box d-flex align-items-start">
                                        <div>
                                            <strong>{{ $item['meneger'] }}</strong> <small class="text-muted">– {{ $item['created_at'] }}</small><br>
                                            {{ $item['comment'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="my-3">
                            <form method="post" action="{{ route('hodim_showcreate_commentss') }}">
                                @csrf
                                <input type="hidden" name="id" value = "{{ $about['id'] }}">
                                <div class="row">
                                    <div class="col-7">
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

    <div class="modal fade" id="salaryModal" tabindex="-1" aria-labelledby="salaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hodim_create_paymarts') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value = "{{ $about['id'] }}">
                    <input type="hidden" name="naqt" value = "{{ $paymart['naqt'] }}">
                    <input type="hidden" name="plastik" value = "{{ $paymart['plastik'] }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Hodimga ish haqi to'lovi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr>
                                    <th colspan='2'>Balansda mavjud</th>
                                </tr>
                                <tr>
                                    <td>{{ number_format($balans['naqt'], 0, '', ' ') }} so'm</td>
                                    <td>{{ number_format($balans['plastik'], 0, '', ' ') }} so'm</td>
                                </tr>
                            </thead>
                        </table>
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
                            <label for="note" class="form-label">Izoh (ixtiyoriy):</label>
                            <textarea class="form-control" id="note" name="note" rows="2" placeholder="To‘lov haqida izoh..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Saqlash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="passwordUpdate" tabindex="-1" aria-labelledby="salaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hodim_show_update_password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value = "{{ $about['id'] }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Hodim parolini yangilash</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Yangi parol</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="repet_password" class="form-label">Yangi prolni takrorlang</label>
                            <input type="password" class="form-control" id="repet_password" name="repet_password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Saqlash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="profileUpdate" tabindex="-1" aria-labelledby="salaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hodim_show_update_post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value = "{{ $about['id'] }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Hodim malumotlarini yangilash</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="fio" class="form-label">FIO</label>
                            <input type="text" value="{{ $about['fio'] }}" class="form-control" id="fio" name="fio" required>
                        </div>
                        <div class="mb-2">
                            <label for="phone" class="form-label">Telefon raqam</label>
                            <input type="text" value="{{ $about['phone'] }}" class="form-control phone" id="phone" name="phone" required>
                        </div>
                        <div class="mb-2">
                            <label for="address" class="form-label">Manzil</label>
                            <input type="text" value="{{ $about['address'] }}" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-2">
                            <label for="tkun" class="form-label">Tug'ilgan kuni</label>
                            <input type="text" value="{{ $about['tkun'] }}" class="form-control" id="tkun" name="tkun" required>
                        </div>
                        <div class="mb-2">
                            <label for="type" class="form-label">Lavozimi</label>
                            <select name="type" class="form-select" required>
                                <option value="">Lavozimni tanlang</option>
                                <option value="direktor" {{ ($about['type'] ?? '') == 'direktor' ? 'selected' : '' }}>Direktor</option>
                                <option value="menejer" {{ ($about['type'] ?? '') == 'menejer' ? 'selected' : '' }}>Menejer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Saqlash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="profileStatus" tabindex="-1" aria-labelledby="salaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hodim_show_update_post_status') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value = "{{ $about['id'] }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Hodim holatini yangilash</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="type" class="form-label">Hodim holatini tanlang</label>
                            <select name="type" class="form-select" required>
                                <option value="">Holatni tanlang</option>
                                <option value="active" {{ ($about['status'] ?? '') == 'active' ? 'selected' : '' }}>Aktiv</option>
                                <option value="block" {{ ($about['status'] ?? '') == 'block' ? 'selected' : '' }}>Block</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="comment" class="form-label">Holatni o'zgartirish haqida</label>
                            <textarea name="comment" required class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Saqlash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

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
    <style>
        .comment-list {max-height: 310px;overflow-y: auto;padding-right: 10px;}
        .comment-box {background-color: #f8f9fa;border-left: 4px solid #0d6efd;padding: 10px 15px;border-radius: 8px;margin-bottom: 10px;}
        .avatar {width: 40px;height: 40px;object-fit: cover;border-radius: 50%;margin-right: 10px;}
    </style>
@endsection
