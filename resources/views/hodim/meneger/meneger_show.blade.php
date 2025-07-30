@extends('layout.cdn2')
@section('title','О менеджере')

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
                        <h3>О менеджере</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Панель управления</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('hodim') }}">Менеджеры</a></li>
                                <li class="breadcrumb-item active" aria-current="page">О менеджере</li>
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
        <a href="{{ route('meneger_show', $id) }}" class="list-group-item list-group-item-action text-center active">О менеджере</a>
    </div>
</div>
<div class="col-lg-6">
    <div class="list-group">
        <a href="{{ route('meneger_show_paymart',$id) }}" class="list-group-item list-group-item-action text-center">Выплаты заработной платы</a>
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
                            <h5 class="card-title mb-2"></i>О сотруднике</h5>
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
                                    <th>Должность:</th>
                                    <td style="text-align:right">
                                        @if($about['type']=='direktor')
                                            Директор
                                        @else
                                            Менеджер
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Логин:</th>
                                    <td style="text-align:right">{{ $about['email'] }}</td>
                                </tr>
                                <tr>
                                    <th>Статус:</th>
                                    <td style="text-align:right">
                                        @if($about['status']=='active')
                                            Активен
                                        @elseif($about['status']=='block')
                                            Заблокирован
                                        @else
                                            Уволен
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Принят на работу:</th>
                                    <td style="text-align:right">{{ $about['created_at'] }}</td>
                                </tr>
                            </table>
                            <div class="w-100 row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-info text-white w-100 d-flex justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#profileUpdate">
                                        <i class="bi bi-pencil-square"></i> Редактировать
                                    </button>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary w-100 d-flex justify-content-center gap-2"
                                            data-bs-toggle="modal" data-bs-target="#profileStatus">
                                        <i class="bi bi-arrow-repeat"></i>
                                        Обновить статус
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-2"></i>Посещаемость сотрудника за текущий месяц</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Всего рабочих дней:</th>
                                    <td style="text-align:right">{{ $davomad['all'] }}</td>
                                </tr>
                                <tr>
                                    <th>Пришел на работу:</th>
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
                                <tr>
                                    <th>Наличные выплаты:</th>
                                    <td style="text-align:right">{{ number_format($paymart['naqt'], 0, '', ' ') }} сум</td>
                                </tr>
                                <tr>
                                    <th>Пластиковые выплаты:</th>
                                    <td style="text-align:right">{{ number_format($paymart['plastik'], 0, '', ' ') }} сум</td>
                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-6">
                                    @if(auth()->user()->type == 'direktor')
                                    <button type="button" class="btn btn-success w-100 d-flex justify-content-center gap-2"
                                            data-bs-toggle="modal" data-bs-target="#salaryModal">
                                        <i class="bi bi-cash-coin"></i>
                                        Выплата зарплаты
                                    </button>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn btn-warning w-100 d-flex justify-content-center gap-2"
                                            data-bs-toggle="modal" data-bs-target="#passwordUpdate">
                                        <i class="bi bi-shield-lock"></i>
                                        Обновить пароль
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">Комментарии ({{ $count_comment }})</h5>
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
                <form action="{{ route('hodim_create_paymarts') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $about['id'] }}">
                    <input type="hidden" name="naqt" value="{{ $balans['naqt'] }}">
                    <input type="hidden" name="plastik" value="{{ $balans['plastik'] }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Выплата зарплаты сотруднику</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr>
                                    <th colspan='2'>Доступно на балансе</th>
                                </tr>
                                <tr>
                                    <td>{{ number_format($balans['naqt'], 0, '', ' ') }} сум</td>
                                    <td>{{ number_format($balans['plastik'], 0, '', ' ') }} сум</td>
                                </tr>
                            </thead>
                        </table>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Сумма выплаты (сум):</label>
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
                            <label for="note" class="form-label">Примечание (необязательно):</label>
                            <textarea class="form-control" id="note" name="note" rows="2" placeholder="Комментарий к выплате..."></textarea>
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

    <div class="modal fade" id="passwordUpdate" tabindex="-1" aria-labelledby="salaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hodim_show_update_password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $about['id'] }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Изменить пароль сотрудника</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Новый пароль</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="repet_password" class="form-label">Повторите новый пароль</label>
                            <input type="password" class="form-control" id="repet_password" name="repet_password" required>
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

    <div class="modal fade" id="profileUpdate" tabindex="-1" aria-labelledby="salaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hodim_show_update_post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value = "{{ $about['id'] }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="salaryModalLabel">Обновить информацию о сотруднике</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="fio" class="form-label">ФИО</label>
                            <input type="text" value="{{ $about['fio'] }}" class="form-control" id="fio" name="fio" required>
                        </div>
                        <div class="mb-2">
                            <label for="phone" class="form-label">Номер телефона</label>
                            <input type="text" value="{{ $about['phone'] }}" class="form-control phone" id="phone" name="phone" required>
                        </div>
                        <div class="mb-2">
                            <label for="address" class="form-label">Адрес</label>
                            <input type="text" value="{{ $about['address'] }}" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-2">
                            <label for="tkun" class="form-label">Дата рождения</label>
                            <input type="text" value="{{ $about['tkun'] }}" class="form-control" id="tkun" name="tkun" required>
                        </div>
                        <div class="mb-2">
                            <label for="type" class="form-label">Должность</label>
                            <select name="type" class="form-select" required>
                                <option value="">Выберите должность</option>
                                <option value="direktor" {{ ($about['type'] ?? '') == 'direktor' ? 'selected' : '' }}>Директор</option>
                                <option value="menejer" {{ ($about['type'] ?? '') == 'menejer' ? 'selected' : '' }}>Менеджер</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Сохранить</button>
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
                        <h5 class="modal-title" id="salaryModalLabel">Обновить статус сотрудника</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="type" class="form-label">Выберите статус сотрудника</label>
                            <select name="type" class="form-select" required>
                                <option value="">Выберите статус</option>
                                <option value="active" {{ ($about['status'] ?? '') == 'active' ? 'selected' : '' }}>Активен</option>
                                <option value="block" {{ ($about['status'] ?? '') == 'block' ? 'selected' : '' }}>Заблокирован</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="comment" class="form-label">Комментарий к изменению статуса</label>
                            <textarea name="comment" required class="form-control"></textarea>
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
        .comment-list {max-height: 310px;overflow-y: auto;padding-right: 10px;}
        .comment-box {background-color: #f8f9fa;border-left: 4px solid #0d6efd;padding: 10px 15px;border-radius: 8px;margin-bottom: 10px;}
        .avatar {width: 40px;height: 40px;object-fit: cover;border-radius: 50%;margin-right: 10px;}
    </style>
@endsection
