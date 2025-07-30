@extends('layout.cdn1')
@section('title','Финансы')
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
                        <h3>Финансы</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Панель управления</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Финансы</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-sm-6 col-lg-6">
                <div class="card shadow-sm border-start border-4 border-primary">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 text-primary">
                            <i class="bi bi-cash fs-1"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">На балансе (Наличные)</h6>
                            <h5 class="mb-0 fw-bold">{{ number_format($Balans['naqt'], 0, '.', ' ') }} сум</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-6">
                <div class="card shadow-sm border-start border-4 border-info">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3 text-info">
                            <i class="bi bi-credit-card fs-1"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">На балансе (Карта)</h6>
                            <h5 class="mb-0 fw-bold">{{ number_format($Balans['plastik'], 0, '.', ' ') }} сум</h5>
                        </div>
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="error" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5 class="mb-0">История финансов (последние 45 дней)</h5>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chiqimModal">
                            <i class="bi bi-plus-circle me-1"></i> Расход с баланса
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover mb-0 text-center" style="font-size:14px;">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Статус</th>
                            <th>Сумма</th>
                            <th>Комментарий</th>
                            <th>Подтвердил</th>
                            <th>Время</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($res as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td style="text-align:left">
                                    @if($item['status'] == 'naqt_chiqim')
                                        <span class="badge text-info">Расход из кассы (наличные)</span>
                                    @elseif($item['status'] == 'plastik_chiqim')
                                        <span class="badge text-info">Расход из кассы (карта)</span>
                                    @elseif($item['status'] == 'plastik_xarajat')
                                        <span class="badge text-danger">Затраты из кассы (карта)</span>
                                    @elseif($item['status'] == 'balans_naqt_xarajat')
                                        <span class="badge text-danger">Затраты с баланса (наличные)</span>
                                    @elseif($item['status'] == 'balans_plastik_xarajat')
                                        <span class="badge text-danger">Затраты с баланса (карта)</span>
                                    @elseif($item['status'] == 'naqt_xarajat')
                                        <span class="badge text-danger">Затраты из кассы (наличные)</span>
                                    @elseif($item['status'] == 'plastik_qaytar')
                                        <span class="badge text-secondary">Возврат платежа (карта)</span>
                                    @elseif($item['status'] == 'naqt_qaytar')
                                        <span class="badge text-secondary">Возврат платежа (наличные)</span>
                                    @elseif($item['status'] == 'plastik_ish_haqi')
                                        <span class="badge text-primary">Выплата зарплаты (карта)</span>
                                    @elseif($item['status'] == 'naqt_ish_haqi')
                                        <span class="badge text-primary">Выплата зарплаты (наличные)</span>
                                    @elseif($item['status'] == 'balans_naqt_daromad')
                                        <span class="badge text-success">Доход (наличные)</span>
                                    @elseif($item['status'] == 'balans_plastik_daromad')
                                        <span class="badge text-success">Доход (карта)</span>
                                    @else
                                        <span class="badge bg-success">{{ $item['status'] }}</span>
                                    @endif
                                </td>
                                <td>{{ number_format($item['amount'], 0, '.', ' ') }} сум</td>
                                <td style="text-align:left">{{ $item['start_comment'] }}</td>
                                <td>{{ $item['start_user_id'] }}</td>
                                <td style="text-align:right">{{ $item['created_at'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">За последние 45 дней финансовых операций не проводилось.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="chiqimModal" tabindex="-1" aria-labelledby="chiqimModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <form action="{{ route('moliya_chiqim') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="chiqimModalLabel">Списание с баланса</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Сумма списания</label>
                                <input type="text" class="form-control" name="amount" id="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Тип списания</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option value="">Выберите...</option>
                                    <option value="balans_naqt_xarajat">Затраты (наличные)</option>
                                    <option value="balans_plastik_xarajat">Затраты (карта)</option>
                                    <option value="balans_naqt_daromad">Доход (наличные)</option>
                                    <option value="balans_plastik_daromad">Доход (карта)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="start_comment" class="form-label">Комментарий</label>
                                <textarea class="form-control" name="start_comment" id="start_comment" rows="2" placeholder="Например: Коммунальные платежи..." required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Списать</button>
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
                amountInput.value = Number(value).toLocaleString('ru-RU');
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
