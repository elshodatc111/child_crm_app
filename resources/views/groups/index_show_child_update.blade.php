@extends('layout.cdn3')
@section('title','О группе')
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
                        <h3>Редактировать статус ребёнка в группе</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('groups') }}">Группы</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('groups_show_child',$group_id) }}">Дети в группе</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Редактировать</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="card-title">Информация о ребёнке</h5>
                        <table class="table table-bordered taxt-center">
                            <tr>
                                <td>Группа:</td>
                                <td>{{ $child_about['group_name'] }}</td>
                            </tr>
                            <tr>
                                <td>Ребёнок:</td>
                                <td>{{ $child_about['child_name'] }}</td>
                            </tr>
                            <tr>
                                <td>Добавлен в группу:</td>
                                <td>{{ $child_about['start_data'] }}</td>
                            </tr>
                            <tr>
                                <td>Комментарий:</td>
                                <td>{{ $child_about['start_izoh'] }}</td>
                            </tr>
                            <tr>
                                <td>Менеджер:</td>
                                <td>{{ $child_about['start_meneger'] }}</td>
                            </tr>
                            <tr>
                                <td>Тип оплаты:</td>
                                <td>
                                    @if($child_about['paymart_type']=='monch')
                                        Ежемесячно
                                    @else
                                        Ежедневно
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @if($child_about['status']=='active')
            <div class="col-lg-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="card-title">Изменить тип оплаты</h5>
                        <form action="{{ route('groups_show_child_paymart_update') }}" method="post">
                            @csrf
                            <input type="hidden" name="child_id" value="{{ $child_about['child_id'] }}">
                            <input type="hidden" name="group_id" value="{{ $child_about['group_id'] }}">
                            <label for="paymart_type">Выберите тип оплаты</label>
                            @php
                                $selected = $child_about['paymart_type'] ?? '';
                            @endphp
                            <select name="paymart_type" class="form-select my-2" required>
                                <option value="">Выбрать</option>
                                <option value="day" {{ $selected == 'day' ? 'selected' : '' }}>Ежедневно</option>
                                <option value="monch" {{ $selected == 'monch' ? 'selected' : '' }}>Ежемесячно</option>
                            </select>
                            <label for="comments">Причина изменения</label>
                            <textarea name="comments" required class="form-control my-2"></textarea>
                            <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="card-title">Удалить из группы</h5>
                        <form action="{{ route('groups_show_child_delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="child_id" value="{{ $child_about['child_id'] }}">
                            <input type="hidden" name="group_id" value="{{ $child_about['group_id'] }}">
                            <input type="hidden" name="status" value="{{ $child_about['status'] }}">
                            <label for="comments">Причина удаления</label>
                            <textarea name="comments" required class="form-control my-2"></textarea>
                            <button type="submit" class="btn btn-danger w-100">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
