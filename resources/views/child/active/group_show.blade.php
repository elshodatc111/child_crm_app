@extends('layout.cdn2')
@section('title','История групп')
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
                        <h3>История групп</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('child') }}">Дети</a></li>
                                <li class="breadcrumb-item active" aria-current="page">История групп</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="list-group list-group-horizontal text-center" id="inbox-menu">
                    <a href="{{ route('child_show',$id) }}" class="list-group-item list-group-item-action ">О ребенке</a>
                    <a href="{{ route('child_show_group',$id) }}" class="list-group-item list-group-item-action active">История групп</a>
                    <a href="{{ route('child_show_davomad',$id) }}" class="list-group-item list-group-item-action">Посещаемость</a>
                    <a href="{{ route('child_show_paymart',$id) }}" class="list-group-item list-group-item-action ">История платежей</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">История групп</h5>
            </div>
            <div class="card-body">
            <table class="table table-bordered table-hover align-middle text-center" style="font-size:14px;">
    <thead class="table-light">
        <tr>
            <th rowspan="2" class="align-middle">№</th>
            <th rowspan="2" class="align-middle">Группа</th>
            <th rowspan="2" class="align-middle">Тип оплаты</th>
            <th colspan="3">Принят в группу</th>
            <th colspan="3">Исключён из группы</th>
            <th rowspan="2" class="align-middle">Статус группы</th>
        </tr>
        <tr>
            <th>Время приёма</th>
            <th>Менеджер</th>
            <th>Комментарий</th>
            <th>Время исключения</th>
            <th>Менеджер</th>
            <th>Комментарий</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groups as $item)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{ $item['group_name'] }}</td>
            <td>
                @if($item['paymart_type']=='monch')
                    Ежемесячно
                @else
                    Ежедневно
                @endif
            </td>
            <td>{{ $item['start_time'] }}</td>
            <td>{{ $item['start_manager_id'] }}</td>
            <td>{{ $item['start_comment'] }}</td>
            <td>{{ $item['end_time'] }}</td>
            <td>{{ $item['end_manager_id'] }}</td>
            <td>{{ $item['end_comment'] }}</td>
            <td>
                @if($item['status']=='true')
                    Активный
                @else
                    Блокировка
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

            </div>
        </div>

    </div>
</div>
    <style>
        .notes-area {padding: 1rem;max-height: 500px;overflow-y: auto;background-color: #f8f9fa;border-radius: 1rem;}
        .note-box {padding: 12px 15px;background-color: #fff;border-left: 5px solid #0d6efd;border-radius: 8px;box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);}
        .note-meta {font-size: 0.85rem;}
        .note-message {font-size: 1rem;}
    </style>

@endsection
