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
                <h3>О сотруднике</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Панель управления</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('hodim_boshqalar') }}">Сотрудники</a></li>
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
                                <a href="{{ route('hodim_boshqa_show',$id) }}" class="list-group-item list-group-item-action text-center active">О сотруднике</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim_boshqa_show_tulovlar',$id) }}" class="list-group-item list-group-item-action text-center ">Выплаты зарплаты</a>
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
                                    <th>Дата приема на работу:</th>
                                    <td style="text-align:right">{{ $about['created_at'] }}</td>
                                </tr>
                            </table>
                            <div class="w-100 text-center">
                                @if(auth()->user()->type == 'direktor')
                                <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#salaryModal">Выплата зарплаты</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Посещаемость сотрудника в текущем месяце</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Всего рабочих дней:</th>
                                    <td style="text-align:right">{{ $davomad['all'] }}</td>
                                </tr>
                                <tr>
                                    <th>Присутствовал:</th>
                                    <td style="text-align:right">{{ $davomad['keldi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Отсутствовал:</th>
                                    <td style="text-align:right">{{ $davomad['kelmadi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Опоздал:</th>
                                    <td style="text-align:right">{{ $davomad['kechikdi'] }}</td>
                                </tr>
                                <tr>
                                    <th>Без формы:</th>
                                    <td style="text-align:right">{{ $davomad['formada_emas'] }}</td>
                                </tr>
                                <tr>
                                    <th>Не рабочий день:</th>
                                    <td style="text-align:right">{{ $davomad['ish_kuni_emas'] }}</td>
                                </tr>
                            </table>
                            <div class="w-100 text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#salaryModal2">Изменить рабочую активность</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">Комментарии ({{ $countComment }})</h5>
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
                                        <input type="text" class="form-control rounded" id="comment" name="comment" placeholder="Напишите свой отзыв о сотруднике...">
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
                        <h5 class="modal-title" id="salaryModalLabel">Выплата заработной платы сотруднику</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr>
                                    <th colspan=2>Доступный баланс</th>
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
                            <label for="amount" class="form-label">Сумма платежа (сум):</label>
                            <input type="text" class="form-control price-format" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_type" class="form-label">Тип оплаты</label>
                            <select name="payment_type" class="form-select" required>
                                <option value="">Выберите</option>
                                <option value="naqt">Наличные</option>
                                <option value="plastik">Пластик</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Комментарий (необязательно):</label>
                            <textarea class="form-control" id="comment" name="comment" required rows="2" placeholder="Комментарий о платеже..."></textarea>
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
                            <label for="note" class="form-label">Комментарий</label>
                            <textarea class="form-control" id="note" name="note" rows="2" required placeholder="Комментарий о платеже..."></textarea>
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
