@extends('layout.cdn2')
@section('title','О сотруднике')

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
                        <h3>О сотруднике</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Панель управления</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('hodim_oshpazlar') }}">Поварa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">О сотруднике</li>
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
                                <a href="{{ route('oshpaz_show',$id) }}" class="list-group-item list-group-item-action text-center active">О поваре</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('oshpaz_paymart',$id) }}" class="list-group-item list-group-item-action text-center">Выплаты заработной платы</a>
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
                <!-- О поваре -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">О сотруднике</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>ФИО:</th>
                                    <td style="text-align:right">{{ $about['fio'] }}</td>
                                </tr>
                                <tr>
                                    <th>Телефон:</th>
                                    <td style="text-align:right">{{ $about['phone'] }}</td>
                                </tr>
                                <tr>
                                    <th>Адрес:</th>
                                    <td style="text-align:right">{{ $about['address'] }}</td>
                                </tr>
                                <tr>
                                    <th>Дата рождения:</th>
                                    <td style="text-align:right">{{ $about['tkun'] }}</td>
                                </tr>
                                <tr>
                                    <th>Статус:</th>
                                    <td style="text-align:right">{{ $about['status'] }}</td>
                                </tr>
                                <tr>
                                    <th>Принят на работу:</th>
                                    <td style="text-align:right">{{ $about['created_at'] }}</td>
                                </tr>
                            </table>
                            <div class="w-100 row">
                                <div class="col-6">
                                    @if(auth()->user()->type == 'direktor')
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#salaryModal">Выплата зарплаты</button>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#salaryModal2">Изменить статус</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Статистика за текущий месяц -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Статистика сотрудника за текущий месяц</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Количество рабочих дней:</th>
                                    <td style="text-align:right">{{ $ish_kun['barcha'] }}</td>
                                </tr>
                                <tr>
                                    <th>Количество опозданий:</th>
                                    <td style="text-align:right">{{ $ish_kun['kechikdi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Без формы:</th>
                                    <td style="text-align:right">{{ $ish_kun['forma_yoq'] }}</td>
                                </tr>
                                <tr>
                                    <th>Пропуски:</th>
                                    <td style="text-align:right">{{ $ish_kun['kelmadi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Нерабочие дни:</th>
                                    <td style="text-align:right">{{ $ish_kun['ish_kun_emas'] }}</td>
                                </tr>
                                <tr>
                                    <th>Количество обслуженных детей:</th>
                                    <td style="text-align:right">{{ $child_count }}</td>
                                </tr>
                                <tr>
                                    <th>Количество обслуженных сотрудников:</th>
                                    <td style="text-align:right">{{ $emploes_count }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Комментарии -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">Комментарии ({{ $count_comment }})</h5>
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
                                        <input type="text" class="form-control rounded" id="comment" name="comment" placeholder="Напишите своё мнение о сотруднике...">
                                    </div>
                                    <div class="col-5">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-send"></i> Сохранить
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
                <form action="{{ route('hodim_boshqalar_paymart_post') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Выплата зарплаты сотруднику</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr>
                                    <th colspan=2>Доступно в балансе</th>
                                </tr>
                                <tr>
                                    <td>Наличные</td>
                                    <td>Пластик</td>
                                </tr>
                                <tr>
                                    <td>{{ number_format($balans['naqt'], 0, '', ' ') }} сум</td>
                                    <td>{{ number_format($balans['plastik'], 0, '', ' ') }} сум</td>
                                </tr>
                            </thead>
                        </table>
                        <input type="hidden" name="user_id" value="{{ $id }}">
                        <input type="hidden" name="naqt" value="{{ $balans['naqt'] }}">
                        <input type="hidden" name="plastik" value="{{ $balans['plastik'] }}">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Сумма выплаты (сум):</label>
                            <input type="text" class="form-control price-format" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_type" class="form-label">Тип выплаты</label>
                            <select name="payment_type" class="form-select" required>
                                <option value="">Выберите</option>
                                <option value="naqt">Наличные</option>
                                <option value="plastik">Пластик</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Комментарий (необязательно):</label>
                            <textarea class="form-control" id="comment" name="comment" required rows="2" placeholder="Комментарий к выплате..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Сохранить</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="salaryModal2" tabindex="-1" aria-labelledby="salaryModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hodim_boshqalar_update_status') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Изменить статус деятельности</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Выберите тип деятельности</label>
                            <select name="status" class="form-select" required>
                                <option value="">Выберите</option>
                                <option value="active" {{ ($about['status'] ?? '') == 'active' ? 'selected' : '' }}>Активен</option>
                                <option value="block" {{ ($about['status'] ?? '') == 'block' ? 'selected' : '' }}>Заблокирован</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Примечание</label>
                            <textarea class="form-control" id="note" name="note" rows="2" required placeholder="Примечание..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Сохранить</button>
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
        .comment-list {max-height: 210px;overflow-y: auto;padding-right: 10px;}
        .comment-box {background-color: #f8f9fa;border-left: 4px solid #0d6efd;padding: 10px 15px;border-radius: 8px;margin-bottom: 10px;}
        .avatar {width: 40px;height: 40px;object-fit: cover;border-radius: 50%;margin-right: 10px;}
    </style>
@endsection
