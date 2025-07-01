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
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
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
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Telefon:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Manzil:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Lavozim:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Holati:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Ishga olindi:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                            </table>
                            <div class="w-100 row">
                                <div class="col-6 mt-1">
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#salaryModal">Ish haqi to'lov</button>
                                </div>
                                <div class="col-6 mt-1">
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#passwordUpdate">Parolni yangilash</button>
                                </div>
                                <div class="col-6 mt-1">
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#profileUpdate">Tahrirlash</button>
                                </div>
                                <div class="col-6 mt-1">
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#profileStatus">Holatini yangilash</button>
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
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Ishga keldi:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Ishga kelmagan:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Kechikib keldi:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Formada kelmadi:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Ish kuni emas:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Naqt to'lovlar:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                                <tr>
                                    <th>Plastik to'lovlar:</th>
                                    <td style="text-align:right">5</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">Izohlar</h5>
                            <div class="comment-list">
                                <div class="comment-box d-flex align-items-start">
                                    <div>
                                        <strong>Nodira</strong> <small class="text-muted">– 2025-06-28</small><br>
                                        Juda mas'uliyatli va bolalar bilan yaxshi ishlaydi.
                                    </div>
                                </div>
                                <div class="comment-box d-flex align-items-start">
                                    <div>
                                        <strong>Nodira</strong> <small class="text-muted">– 2025-06-28</small><br>
                                        Juda mas'uliyatli va bolalar bilan yaxshi ishlaydi.
                                    </div>
                                </div>
                                <div class="comment-box d-flex align-items-start">
                                    <div>
                                        <strong>Nodira</strong> <small class="text-muted">– 2025-06-28</small><br>
                                        Juda mas'uliyatli va bolalar bilan yaxshi ishlaydi.
                                    </div>
                                </div>
                                <div class="comment-box d-flex align-items-start">
                                    <div>
                                        <strong>Nodira</strong> <small class="text-muted">– 2025-06-28</small><br>
                                        Juda mas'uliyatli va bolalar bilan yaxshi ishlaydi.
                                    </div>
                                </div>
                                <div class="comment-box d-flex align-items-start">
                                    <div>
                                        <strong>Nodira</strong> <small class="text-muted">– 2025-06-28</small><br>
                                        Juda mas'uliyatli va bolalar bilan yaxshi ishlaydi.
                                    </div>
                                </div>
                                <div class="comment-box d-flex align-items-start">
                                    <div>
                                        <strong>Umid</strong> <small class="text-muted">– 2025-06-26</small><br>
                                        Har doim o‘z vaqtida keladi va bolalar uni yaxshi ko‘radi.
                                    </div>
                                </div>
                            </div>
                            <hr class="my-3">
                            <form>
                                <div class="row">
                                    <div class="col-7">
                                        <input type="text" class="form-control rounded" id="comment" placeholder="Hodim haqida fikringizni yozing...">
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
                <form action="#" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Hodimga ish haqi to'lovi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <div class="modal-body">
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
                <form action="#" method="POST">
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
                <form action="#" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Hodim malumotlarini yangilash</h5>
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
    <div class="modal fade" id="profileStatus" tabindex="-1" aria-labelledby="salaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Hodim holatini yangilash</h5>
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
