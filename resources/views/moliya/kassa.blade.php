@extends('layout.cdn1')
@section('title','Касса')
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
                        <h3 class="fw-bold">Касса</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Касса</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Кассовые карточки -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card shadow-lg border-start border-4 border-success rounded-3">
                    <div class="card-body">
                        <h3 class="card-title text-center">
                            <i class="bi bi-cash-coin me-1 text-success"></i> Доступная сумма в кассе
                        </h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="bi bi-cash-stack me-1 text-success"></i> Наличные: <b>{{ number_format($Kassa['naqt'], 0, '.', ' ') }}</b> сум
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-credit-card-2-front me-1 text-primary"></i> Карта: <b>{{ number_format($Kassa['plastik'], 0, '.', ' ') }}</b> сум
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card shadow-lg border-start border-4 border-warning rounded-3">
                    <div class="card-body">
                        <h3 class="card-title text-center">
                            <i class="bi bi-exclamation-circle me-1 text-warning"></i> Неподтвержденные расходы
                        </h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="bi bi-cash-stack me-1 text-success"></i> Наличные: <b>{{ number_format($Kassa['naqt_chiqim'], 0, '.', ' ') }}</b> сум
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-credit-card-2-front me-1 text-primary"></i> Карта: <b>{{ number_format($Kassa['plastik_chiqim'], 0, '.', ' ') }}</b> сум
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card shadow-lg border-start border-4 border-danger rounded-3">
                    <div class="card-body">
                        <h3 class="card-title text-center">
                            <i class="bi bi-exclamation-triangle me-1 text-danger"></i> Неподтвержденные затраты
                        </h3>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="bi bi-cash-stack me-1 text-success"></i> Наличные: <b>{{ number_format($Kassa['naqt_xarajat'], 0, '.', ' ') }}</b> сум
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-credit-card-2-front me-1 text-primary"></i> Карта: <b>{{ number_format($Kassa['plastik_xarajat'], 0, '.', ' ') }}</b> сум
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5 class="mb-0">Неподтвержденные расходы и затраты</h5>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#chiqimModal">
                            <i class="bi bi-plus-circle me-1"></i> Расход из кассы
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Тип расхода</th>
                            <th>Сумма</th>
                            <th>Тип оплаты</th>
                            <th>Комментарий</th>
                            <th>Менеджер</th>
                            <th>Дата расхода</th>
                            <th>Подтверждение</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($res as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>
                                @if($item['status'] == 'naqt_xarajat' OR $item['status'] == 'plastik_xarajat')
                                    <span class="badge bg-primary">Затрата</span>
                                @else
                                    <span class="badge bg-success">Расход</span>
                                @endif
                            </td>
                            <td>{{ number_format($item['amount'], 0, '.', ' ') }} сум</td>
                            <td>
                                @if($item['status'] == 'naqt_xarajat' OR $item['status'] == 'naqt_chiqim')
                                    Наличные
                                @else
                                    Карта
                                @endif
                            </td>
                            <td>{{ $item['start_comment'] }}</td>
                            <td>{{ $item['meneger'] }}</td>
                            <td>{{ $item['created_at'] }}</td>
                            <td>
                                @if(auth()->user()->type == 'direktor')
                                <form action="{{ route('kassa_chiqim_success') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <button type="submit" class="btn btn-primary px-1 py-1"><i class="bi bi-check"></i></button>
                                </form>
                                @endif
                                <form action="{{ route('kassa_chiqim_delete') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <button class="btn btn-danger px-1 py-1"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="chiqimModal" tabindex="-1" aria-labelledby="chiqimModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <form action="{{ route('kassa_chiqim') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="chiqimModalLabel">Расход из кассы</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="payment_type" class="form-label">Тип расхода</label>
                                <select class="form-select" name="expense_type" id="expense_type" required>
                                    <option value="">Выберите</option>
                                    <option value="chiqim">Расход</option>
                                    <option value="xarajat">Затрата</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Сумма расхода</label>
                                <input type="text" class="form-control" name="amount" id="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="payment_type" class="form-label">Тип оплаты</label>
                                <select class="form-select" name="payment_type" id="payment_type" required>
                                    <option value="">Выберите</option>
                                    <option value="Naqt">Наличные</option>
                                    <option value="Plastik">Карта</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Комментарий</label>
                                <textarea class="form-control" name="note" id="note" rows="2" placeholder="Например: расход из кассы..." required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Выполнить расход</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
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
