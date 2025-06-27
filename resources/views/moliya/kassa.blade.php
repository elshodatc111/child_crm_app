@extends('layout.cdn1')
@section('title','Kassa')
@section('content')
<div id="app">
    @extends('layout.menu')
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
                        <h3 class="fw-bold">Kassa</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Kassa</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Kassa cardlar -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card shadow-lg border-start border-4 border-success rounded-3">
                    <div class="card-body">
                        <h3 class="card-title text-center">
                            <i class="bi bi-cash-coin me-1 text-success"></i> Kassada mavjud summa
                        </h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="bi bi-cash-stack me-1 text-success"></i> Naqt: <b>{{ number_format($Kassa['naqt'], 0, '.', ' ') }}</b> so'm
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-credit-card-2-front me-1 text-primary"></i> Plastik: <b>{{ number_format($Kassa['plastik'], 0, '.', ' ') }}</b> so'm
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card shadow-lg border-start border-4 border-warning rounded-3">
                    <div class="card-body">
                        <h3 class="card-title text-center">
                            <i class="bi bi-exclamation-circle me-1 text-warning"></i> Tasdiqlanmagan chiqim
                        </h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="bi bi-cash-stack me-1 text-success"></i> Naqt: <b>{{ number_format($Kassa['naqt_chiqim'], 0, '.', ' ') }}</b> so'm
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-credit-card-2-front me-1 text-primary"></i> Plastik: <b>{{ number_format($Kassa['plastik_chiqim'], 0, '.', ' ') }}</b> so'm
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card shadow-lg border-start border-4 border-danger rounded-3">
                    <div class="card-body">
                        <h3 class="card-title text-center">
                            <i class="bi bi-exclamation-triangle me-1 text-danger"></i> Tasdiqlanmagan xarajat
                        </h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="bi bi-cash-stack me-1 text-success"></i> Naqt: <b>{{ number_format($Kassa['naqt_xarajat'], 0, '.', ' ') }}</b> so'm
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-credit-card-2-front me-1 text-primary"></i> Plastik: <b>{{ number_format($Kassa['plastik_xarajat'], 0, '.', ' ') }}</b> so'm
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5 class="mb-0">Tasdiqlanmagan chiqim va xarajatlar</h5>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#chiqimModal">
                            <i class="bi bi-plus-circle me-1"></i> Kassadan chiqim
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Chiqim turi</th>
                            <th>Summa</th>
                            <th>To‘lov turi</th>
                            <th>Izoh</th>
                            <th>Meneger</th>
                            <th>Chiqim vaqti</th>
                            <th>Tasdiqlash</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><span class="badge bg-success">Kirim</span></td>
                            <td>50,000 so'm</td>
                            <td>Naqt</td>
                            <td>Ota-ona to‘lovi</td>
                            <td>Islom Karimov</td>
                            <td>2025-06-25 14:22</td>
                            <td>
                                <form action="" method="post" class="d-inline">
                                    <button class="btn btn-primary px-1"><i class="bi bi-check"></i></button>
                                </form>
                                <form action="" method="post" class="d-inline">
                                    <button class="btn btn-danger px-1"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="chiqimModal" tabindex="-1" aria-labelledby="chiqimModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <form action="#" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="chiqimModalLabel">Kassadn chiqim</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="payment_type" class="form-label">Chiqim turi</label>
                                <select class="form-select" name="expense_type" id="expense_type" required>
                                    <option value="">Tanlang</option>
                                    <option value="chiqim">Chiqim</option>
                                    <option value="xarajat">Xarajat</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Chiqim summasi</label>
                                <input type="text" class="form-control" name="amount" id="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="payment_type" class="form-label">To'lov turi</label>
                                <select class="form-select" name="payment_type" id="payment_type" required>
                                    <option value="">Tanlang</option>
                                    <option value="Naqt">Naqt</option>
                                    <option value="Plastik">Plastik</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Izoh</label>
                                <textarea class="form-control" name="note" id="note" rows="2" placeholder="Masalan: Kassadan chiqim..." required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Chiqim qilish</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const amountInput = document.getElementById("amount");
        amountInput.addEventListener("input", function (e) {
            let value = amountInput.value.replace(/\D/g, '');
            if (value.length > 0) {
                amountInput.value = Number(value).toLocaleString('uz-UZ');
            } else {
                amountInput.value = '';
            }
        });
        document.querySelector("form").addEventListener("submit", function () {
            amountInput.value = amountInput.value.replace(/\s/g, '');
        });
    });
</script>
@endsection
