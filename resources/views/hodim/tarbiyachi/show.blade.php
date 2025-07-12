@extends('layout.cdn2')
@section('title','Hodim haqida')

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
                        <h3>Hodim haqida</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('hodim_tarbiyachi') }}">Tarbiyachilar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tarbiyachi haqida</li>
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
                        <div class="col-lg-4">
                            <div class="list-group">
                                <a href="{{ route('hodim_tarbiyachi_show',$id) }}" class="list-group-item list-group-item-action text-center active">Tarbiyachi haqida</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="list-group">
                                <a href="{{ route('hodim_tarbiyachi_show_tarix',$id) }}" class="list-group-item list-group-item-action text-center">Guruhlar tarixi</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="list-group">
                                <a href="{{ route('hodim_tarbiyachi_show_paymart',$id) }}" class="list-group-item list-group-item-action text-center">Ish haqi to'lovlari</a>
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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></i>Hodim haqida</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>FIO:</th>
                                    <td style="text-align:right">{{ $about['fio'] }}</td>
                                </tr>
                                <tr>
                                    <th>Telefon raqam:</th>
                                    <td style="text-align:right">{{ $about['phone'] }}</td>
                                </tr>
                                <tr>
                                    <th>Manzil:</th>
                                    <td style="text-align:right">{{ $about['address'] }}</td>
                                </tr>
                                <tr>
                                    <th>Lavozimi:</th>
                                    <td style="text-align:right">
                                        @if($about['type']=='tarbiyachi')
                                            Tarbiyachi
                                        @else
                                            Yordamchi Tarbiyachi
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Holati:</th>
                                    <td style="text-align:right">
                                        @if($about['status']=='active')
                                            Aktiv
                                        @else
                                            Bloklangan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ishga olindi:</th>
                                    <td style="text-align:right">{{ $about['created_at'] }}</td>
                                </tr>
                                <tr>
                                    <th>Tug'ilgan kun:</th>
                                    <td style="text-align:right">{{ $about['tkun'] }}</td>
                                </tr>
                            </table>
                            <div class="w-100 row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#salaryModal">
                                        <i class="bi bi-pencil-square me-1"></i> Taxrirlash
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#statusModal">
                                        <i class="bi bi-arrow-left-right me-1"></i> Holatni o'zgartirish
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></i>Hodimning joriy oydagi statistikasi</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Barcha ish kunlar soni:</th>
                                    <td style="text-align:right">{{ $davomad['all'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ishga keldi:</th>
                                    <td style="text-align:right">{{ $davomad['keldi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ishga kelmadi:</th>
                                    <td style="text-align:right">{{ $davomad['kelmadi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ishga kechikib keldi:</th>
                                    <td style="text-align:right">{{ $davomad['kechikdi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ishga formada kelmadi:</th>
                                    <td style="text-align:right">{{ $davomad['forma'] }}</td>
                                </tr>
                                <tr>
                                    <th>Guruhga kelgan bolalar soni:</th>
                                    <td style="text-align:right">{{ $child_count }}</td>
                                </tr>
                                <tr>
                                    <th>To'langan ish haqi:</th>
                                    <td style="text-align:right">{{ number_format($tulov, 0, '', ' ') }} so'm</td>
                                </tr>
                            </table>
                            <div class="w-100">
                                <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                    <i class="bi bi-cash-coin me-1"></i> Ish haqi to'lash
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">Izohlar ({{ $count_comment }})</h5>
                            <div class="comment-list">
                                @foreach ($comment as $item)
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
    <div class="modal fade" id="salaryModal" tabindex="-1" aria-labelledby="salaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hodim_tarbiyachi_show_update') }}" method="post">
                    @csrf
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="salaryModalLabel">Ma'lumotni taxrirlash</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $about['id'] }}">
                        <div class="mb-2">
                            <label for="fio" class="form-label">FIO</label>
                            <input type="text" name="fio" required value="{{ $about['fio'] }}" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="phone" class="form-label">Telefon raqam</label>
                            <input type="text" name="phone" required value="{{ $about['phone'] }}" class="form-control phone">
                        </div>
                        <div class="mb-2">
                            <label for="address" class="form-label">Manzil</label>
                            <input type="text" name="address" required value="{{ $about['address'] }}" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="type" class="form-label">Lavozim</label>
                            <select name="type" class="form-select" required>
                                <option value="">Tanlang</option>
                                <option value="tarbiyachi" {{ ($about['type'] ?? '') == 'tarbiyachi' ? 'selected' : '' }}>Tarbiyachi</option>
                                <option value="kichik_tarbiyachi" {{ ($about['type'] ?? '') == 'kichik_tarbiyachi' ? 'selected' : '' }}>Yordamchi Tarbiyachi</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="tkun" class="form-label">Tugilgan kuni </label>
                            <input type="date" name="tkun" required value="{{ $about['tkun'] }}" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-warning">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hodim_boshqalar_update_status') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Ish faoliyatini o'zgartirish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <p class="text-danger w-100 text-center">Tarbiyachi statistikasi faqai Aktiv bo'lganda o'zgaradi.</p>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Saqlash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hodim_boshqalar_paymart_post') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Ish haqi to'lovi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
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
                        <input type="hidden" name="user_id" value="{{ $id }}">
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
                            <label for="comment" class="form-label">Izoh:</label>
                            <textarea class="form-control" id="comment" name="comment" required rows="2" placeholder="To‘lov haqida izoh..."></textarea>
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
        .comment-list {max-height: 270px;overflow-y: auto;padding-right: 10px;}
        .comment-box {background-color: #f8f9fa;border-left: 4px solid #0d6efd;padding: 10px 15px;border-radius: 8px;margin-bottom: 10px;}
        .avatar {width: 40px;height: 40px;object-fit: cover;border-radius: 50%;margin-right: 10px;}
    </style>
@endsection
