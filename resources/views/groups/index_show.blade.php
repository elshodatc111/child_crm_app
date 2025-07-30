@extends('layout.cdn2')
@section('title','Guruh haqida')
@section('content')

<style>
    div.dataTables_filter {
        text-align: right !important;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .list-group-horizontal .list-group-item {
        flex: 1;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 0;
    }

    .list-group-horizontal .list-group-item:first-child {
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
    }

    .list-group-horizontal .list-group-item:last-child {
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }

    .table td, .table th {
        vertical-align: middle;
    }
</style>

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
                        <h3>О группе</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Панель управления</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('groups') }}">Активные группы</a></li>
                                <li class="breadcrumb-item active" aria-current="page">О группе</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-lg-3 list-group mt-lg-0 mt-2">
                        <a href="{{ route('groups_show',$id) }}" class="list-group-item list-group-item-action active">О группе</a>
                    </div>
                    <div class="col-lg-3 list-group mt-lg-0 mt-2">
                        <a href="{{ route('groups_show_child',$id) }}" class="list-group-item list-group-item-action">Дети и Воспитатели</a>
                    </div>
                    <div class="col-lg-3 list-group mt-lg-0 mt-2">
                        <a href="{{ route('groups_show_davomad',$id) }}" class="list-group-item list-group-item-action">Посещаемость группы</a>
                    </div>
                    <div class="col-lg-3 list-group mt-lg-0 mt-2">
                        <a href="{{ route('child_show_darslar',$id) }}" class="list-group-item list-group-item-action">Дополнительные занятия</a>
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
            <div class="col-lg-6 mx-auto">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-center rounded-top-4">
                        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>О группе</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-hover align-middle">
                            <tbody>
                                <tr>
                                    <th class="text-muted">Название группы</th>
                                    <td class="text-end fw-semibold">{{ $about['group_name'] }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Цена (месяц)</th>
                                    <td class="text-end fw-semibold">{{ number_format($about['price_month'], 0, '.', ' ') }} сум</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Цена (день)</th>
                                    <td class="text-end fw-semibold">{{ number_format($about['price_day'], 0, '.', ' ') }} сум</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Воспитатель</th>
                                    <td class="text-end">{{ $about['tarbiyachi'] }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Помощник воспитателя</th>
                                    <td class="text-end">{{ $about['yordamchi'] }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Статус группы</th>
                                    <td class="text-end">
                                        @if($about['status']=='true')
                                            <span class="badge bg-success">Активна</span>
                                        @else
                                            <span class="badge bg-danger">Завершена</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Рабочие дни</th>
                                    <td class="text-end">
                                        @if($about['group_type']=='olti')
                                            6 дней в неделю
                                        @else
                                            5 дней в неделю
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Менеджер</th>
                                    <td class="text-end">{{ $about['meneger'] }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Дата создания</th>
                                    <td class="text-end">{{ $about['created_at'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row g-3">
                            <div class="col-6">
                                <button class="btn btn-outline-primary w-100 py-3 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#editGroupModal">
                                    <i class="bi bi-pencil-square me-1"></i> Редактировать группу
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-success w-100 py-3 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#takeAttendanceModal">
                                    <i class="bi bi-check2-square me-1"></i> Отметить посещаемость
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-warning w-100 py-3 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#changeMainModal">
                                    <i class="bi bi-person-gear me-1"></i> Сменить воспитателя
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-secondary w-100 py-3 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#changeHelperModal">
                                    <i class="bi bi-person-gear me-1"></i> Сменить помощника
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mx-auto">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-center rounded-top-4">
                        <h5 class="mb-0">Рабочие дни текущего месяца ({{ $ishKunlarSoni }} дней)</h5>
                    </div>
                    <div class="card-body">
                        <table class="table text-center table-bordered" style="font-size:12px">
                            <thead>
                                <tr>
                                    <th class="text-center px-3">#</th>
                                    <th class="text-center px-3">День недели</th>
                                    <th class="text-center px-3">Дата</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $today = \Carbon\Carbon::today();
                                @endphp
                                @foreach ($ishKunlar as $item)
                                    @php
                                        $sana = \Carbon\Carbon::parse($item['sanasi']);
                                        $badgeClass = '';
                                        if ($sana->isToday()) {
                                            $badgeClass = 'text-warning'; // сегодня — желтый
                                        } elseif ($sana->isPast()) {
                                            $badgeClass = 'text-success'; // прошедшее — зеленый
                                        } else {
                                            $badgeClass = 'text-secondary'; // будущее — серый
                                        }
                                    @endphp
                                    <tr class="p-0 m-0">
                                        <td class="p-0 m-0">{{ $loop->index + 1 }}</td>
                                        <td class="p-0 m-0">
                                            <span class="badge p-0 m-0 {{ $badgeClass }} px-3 py-2 rounded-pill">
                                                {{ $item['hafta_kuni'] }}
                                            </span>
                                        </td>
                                        <td class="p-0 m-0">
                                            <span class="badge p-0 m-0 {{ $badgeClass }} px-3 py-2 rounded-pill">
                                                {{ $item['sanasi'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    <!-- Редактировать группу -->
    <div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupModalLabel">
                        Редактировать группу
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('groups_updates') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <div class="mb-3">
                            <label for="group_name" class="form-label">Название группы</label>
                            <input type="text" name="group_name" id="group_name" value="{{ $about['group_name'] }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="price_month" class="form-label">Цена группы (месяц)</label>
                            <input type="text" name="price_month" id="price_month" class="form-control price-format" value="{{ number_format($about['price_month'], 0, '.', ' ') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="price_day" class="form-label">Цена группы (день)</label>
                            <input type="text" name="price_day" id="price_day" value="{{ number_format($about['price_day'], 0, '.', ' ') }}" class="form-control price-format" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Статус группы</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="true" {{ $about['status'] == 'true' ? 'selected' : '' }}>Активна</option>
                                <option value="false" {{ $about['status'] == 'false' ? 'selected' : '' }}>Завершена</option>
                            </select>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Сохранить изменения
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Отметка посещаемости -->
    <div class="modal fade" id="takeAttendanceModal" tabindex="-1" aria-labelledby="takeAttendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="takeAttendanceModalLabel">
                        Отметка посещаемости
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <form action="{{ route('groups_create_davomat') }}" method="POST">
                    @csrf
                    <input type="hidden" name="group_id" value="{{ $id }}">
                    <div class="modal-body">
                        @if($davomadDay=='false')
                        <p class="text-danger m-0 p-0 w-100 text-center">Посещаемость можно отмечать только один раз в день.</p>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Имя ребёнка</th>
                                        <th>Статус посещаемости</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($children as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td style="text-align:left">
                                                {{ $item['child_name'] }}
                                                (
                                                    @if($item['paymart_type'] == 'monch')
                                                        Месячная оплата
                                                    @else
                                                        Дневная оплата
                                                    @endif
                                                )
                                            </td>
                                            <td>
                                                <select name="attendance[{{ $item['child_id'] }}]" class="form-select" required>
                                                    <option value="">Выбрать</option>
                                                    <option value="keldi">✅ Пришел</option>
                                                    <option value="kelmadi">❌ Не пришел</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="text-success m-0 p-0 w-100 text-center">Посещаемость уже отмечена на сегодня.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if($davomadDay=='false')
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-save me-1"></i> Сохранить посещаемость
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Сменить воспитателя -->
    <div class="modal fade" id="changeMainModal" tabindex="-1" aria-labelledby="changeMainModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="changeMainModalLabel">Сменить воспитателя</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('groups_updates_tarbiyachi') }}" method="post">
                    @csrf
                    <label for="user_id">Выберите нового воспитателя</label>
                    <input type="hidden" name="id" value="{{ $id }}">
                    <select name="user_id" class="form-select my-2" required>
                        <option value="">Выбрать...</option>
                        @foreach ($tarbiyachilar as $item)
                            <option value="{{ $item['user_id'] }}">{{ $item['user_name'] }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary w-100 mt-2" type="submit">Сохранить</button>
                </form>
            </div>
            </div>
        </div>
    </div>

<!-- Сменить помощника -->
    <div class="modal fade" id="changeHelperModal" tabindex="-1" aria-labelledby="changeHelperModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeHelperModalLabel">Сменить помощника</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('groups_updates_yordamchi') }}" method="post">
                        @csrf
                        <label for="user_id">Выберите нового помощника</label>
                        <input type="hidden" name="id" value="{{ $id }}">
                        <select name="user_id" class="form-select my-2" required>
                            <option value="">Выбрать...</option>
                            @foreach ($yordamchilar as $item)
                                <option value="{{ $item['user_id'] }}">{{ $item['user_name'] }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary w-100 mt-2" type="submit">Сохранить</button>
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
@endsection
