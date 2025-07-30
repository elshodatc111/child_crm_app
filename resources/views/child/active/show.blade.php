@extends('layout.cdn2')
@section('title','О ребенке')
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
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <h3>О ребенке</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('child') }}">Дети</a></li>
                                <li class="breadcrumb-item active" aria-current="page">О ребенке</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="list-group list-group-horizontal text-center" id="inbox-menu">
                    <a href="{{ route('child_show',$id) }}" class="list-group-item list-group-item-action active">О ребенке</a>
                    <a href="{{ route('child_show_group',$id) }}" class="list-group-item list-group-item-action">История групп</a>
                    <a href="{{ route('child_show_davomad',$id) }}" class="list-group-item list-group-item-action">Посещаемость</a>
                    <a href="{{ route('child_show_paymart',$id) }}" class="list-group-item list-group-item-action">История платежей</a>
                </div>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
            </div>
        @elseif (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <h5 class="mb-0 text-primary">{{ $child['name'] }}</h5>
                            </div>
                            <div class="col-5 text-end">
                                @if ($child['balans']>0)
                                    <h5 class="mb-0 text-success">
                                        {{ number_format($child['balans'], 0, '', ' ') }} сум
                                    </h5>
                                @elseif ($child['balans']==0)
                                    <h5 class="mb-0 text-info">
                                        {{ number_format($child['balans'], 0, '', ' ') }} сум
                                    </h5>
                                @else
                                    <h5 class="mb-0 text-danger">
                                        {{ number_format($child['balans'], 0, '', ' ') }} сум
                                    </h5>
                                @endif
                            </div>
                        </div>
                        <table class="table table-sm table-bordered mt-3 mb-0" style="font-size: 14px">
                            <tbody>
                                <tr>
                                    <th width="40%">📍 Адрес</th>
                                    <td class="text-end">{{ $child['addres'] }}</td>
                                </tr>
                                <tr>
                                    <th>🎂 Дата рождения</th>
                                    <td class="text-end">{{ $child['tkun'] }}</td>
                                </tr>
                                <tr>
                                    <th>📞 Телефон 1</th>
                                    <td class="text-end">{{ $child['phone1'] }}</td>
                                </tr>
                                <tr>
                                    <th>📞 Телефон 2</th>
                                    <td class="text-end">{{ $child['phone2'] }}</td>
                                </tr>
                                <tr>
                                    <th>📌 Статус</th>
                                    <td class="text-end">
                                        @php
                                            $status = $child['status'];
                                            $badgeClass = match($status) {
                                                'active' => 'success',
                                                'inactive' => 'danger',
                                                default => 'info',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }} text-uppercase">
                                            @if(ucfirst($status)=='Inactive')
                                                Группа не активна
                                            @else
                                                Группа активна
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>🧒 О ребёнке</th>
                                    <td class="text-end">{{ $child['description'] }}</td>
                                </tr>
                                <tr>
                                    <th>🗓 Дата регистрации</th>
                                    <td class="text-end">{{ $child['created_at'] }}</td>
                                </tr>
                                <tr>
                                    <th>👤 Зарегистрировал</th>
                                    <td class="text-end">{{ $child['meneger'] }}</td>
                                </tr>
                                <tr>
                                    <th>🏫 Группа</th>
                                    <td class="text-end">{{ $child['group'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            @if(auth()->user()->type == 'direktor' OR auth()->user()->type == 'menejer')
                                <div class="col-6">
                                    <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#tolovModal">
                                        <i class="bi bi-credit-card me-1"></i> Оплата
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="bi bi-pencil-square me-1"></i> Редактировать
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Ближайшие родственники</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" style="font-size:14px">
                            <thead>
                                <tr class="text-center">
                                    <th>ФИО</th>
                                    <th>Телефон</th>
                                    <th>Удалить</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parent as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['phone'] }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('child_delete_qarindosh') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                <button class="btn btn-danger p-1"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            @if(auth()->user()->type == 'direktor' OR auth()->user()->type == 'menejer')
                            <div class="col-6">
                                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#updateGroupModal">
                                    <i class="bi bi-arrow-repeat me-1"></i> Обновить группу
                                </button>
                            </div>
                            @endif
                            <div class="col-6">
                                <button class="btn btn-info text-white w-100" data-bs-toggle="modal" data-bs-target="#newRelativeModal">
                                    <i class="bi bi-person-plus me-1"></i> Новый родственник
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Заметки</h5>
                    </div>
                    <div class="card-body pt-4 bg-light notes-area mx-4">
                        @foreach ($commit as $item)
                            <div class="note-box mb-3">
                                <div class="note-meta mb-1 text-muted small">
                                    <strong>{{ $item['user'] }} | </strong>{{ $item['created_at'] }}
                                </div>
                                <div class="note-message">{{ $item['description'] }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer bg-white border-top">
                        <form action="{{ route('child_new_eslatma') }}" method="post">
                            @csrf
                            <div class="message-form d-flex align-items-center">
                                <div class="d-flex flex-grow-1 ms-3">
                                    <input type="hidden" name="child_id" value="{{ $id }}">
                                    <input type="text" name="description" class="form-control rounded-pill px-4 py-2" placeholder="Напишите новую заметку...">
                                </div>
                                <button type="submit" class="btn btn-success ms-3 rounded-pill px-4">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

    <div class="modal fade" id="tolovModal" tabindex="-1" aria-labelledby="tolovModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('create_paymarts') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tolovModalLabel"> Оплата</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="child_id" value="{{ $id }}">
                        <table class="table">
                            <tr>
                                <th colspan="2">В кассе доступно</th>
                            </tr>
                            <tr>
                                <td>Наличные: {{ number_format($kassa['naqt'], 0, '', ' ') }} сум</td>
                                <td>Пластик: {{ number_format($kassa['plastik'], 0, '', ' ') }} сум</td>
                            </tr>
                        </table>
                        <label for="type">Тип оплаты <i style="color: red;font-size:12px">(Qaytariladigan to'lov summasi kassada mavjud bo'lishi kerak)</i></label>
                        <select name="type" required class="form-select my-2">
                            <option value="naqt">Наличный платеж</option>
                            <option value="plastik">Платеж по карте</option>
                            <option value="qaytar_naqt">Возврат (наличные)</option>
                            <option value="qaytar_plastik">Возврат (карта)</option>
                            <option value="chegirma">Скидка</option>
                        </select>
                        <label for="amount">Сумма оплаты</label>
                        <input type="text" name="amount" required class="form-control my-2 price-format">
                        <label for="child_parent_id">Плательщик</label>
                        <select name="child_parent_id" class="form-select my-2">
                            <option value="">Выбрать</option>
                            @foreach ($parent as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                        <label for="description">Комментарий к оплате</label>
                        <textarea name="description" class="form-control my-2" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Tahrirlash -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('child_update') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Редактирование</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $id }}">
                        <label for="name">ФИО ребёнка</label>
                        <input type="text" required name="name" value="{{ $child['name'] }}" class="form-control my-2">
                        <label for="address">Адрес</label>
                        <input type="text" required name="address" value="{{ $child['addres'] }}" class="form-control my-2">
                        <label for="birthday">Дата рождения</label>
                        <input type="date" required name="birthday" value="{{ $child['tkun'] }}" class="form-control my-2">
                        <label for="phone1">Телефон</label>
                        <input type="text" required name="phone1" value="{{ $child['phone1'] }}" class="form-control phone my-2">
                        <label for="phone2">Дополнительный телефон</label>
                        <input type="text" required name="phone2" value="{{ $child['phone2'] }}" class="form-control phone my-2">
                        <label for="description">О ребёнке</label>
                        <input type="text" required name="description" value="{{ $child['description'] }}" class="form-control my-2">
                        <label for="status">Статус</label>
                        <select name="status" class="form-select my-2">
                            <option value="active" {{ $child['status'] == 'active' ? 'selected' : '' }}>Активный</option>
                            <option value="inactive" {{ $child['status'] == 'inactive' ? 'selected' : '' }}>Заблокирован</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-warning">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<!-- Modal: Guruh yangilash -->
    <div class="modal fade" id="updateGroupModal" tabindex="-1" aria-labelledby="updateGroupModalLabel" aria-hidden="true">
        <form action="{{ route('child_update_group') }}" method="post">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateGroupModalLabel"><i class="bi bi-arrow-repeat me-1"></i> Обновление группы</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="child_id" value="{{ $id }}">
                        <label for="group_id" class="my-2">Выберите новую группу</label>
                        <select name="group_id" required class="form-select">
                            <option value="">Выбрать</option>
                            @foreach ($newGroups as $item)
                                <option value="{{ $item['group_id'] }}">{{ $item['group_name'] }}</option>
                            @endforeach
                        </select>
                        <label for="paymart_type" class="my-2">Выберите тип оплаты</label>
                        <select name="paymart_type" required class="form-select">
                            <option value="">Выбрать</option>
                            <option value="day">Дневная  оплата</option>
                            <option value="monch">Месячная оплата</option>
                        </select>
                        <label for="comment" class="my-2">Причина смены группы</label>
                        <textarea name="comment" required class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal: Yangi qarindosh -->
    <div class="modal fade" id="newRelativeModal" tabindex="-1" aria-labelledby="newRelativeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('child_new_qarindosh') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newRelativeModalLabel">Новый родственник</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="child_id" value="{{ $id }}">
                        <label for="name">Близкий родственник</label>
                        <input type="text" required name="name" class="form-control my-2">
                        <label for="phone">Номер телефона</label>
                        <input type="text" required name="phone" value="+998" class="form-control phone my-2">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-info text-white">Добавить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .notes-area {padding: 1rem;max-height: 500px;overflow-y: auto;background-color: #f8f9fa;border-radius: 1rem;}
        .note-box {padding: 12px 15px;background-color: #fff;border-left: 5px solid #0d6efd;border-radius: 8px;box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);}
        .note-meta {font-size: 0.85rem;}
        .note-message {font-size: 1rem;}
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
