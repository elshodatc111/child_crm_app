@extends('layout.cdn2')
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
                        <h3>О группе</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('groups') }}">Группы</a></li>
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
                        <a href="{{ route('groups_show',$id) }}" class="list-group-item list-group-item-action">О группе</a>
                    </div>
                    <div class="col-lg-3 list-group mt-lg-0 mt-2">
                        <a href="{{ route('groups_show_child',$id) }}" class="list-group-item list-group-item-action active">Дети и Воспитатели</a>
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

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h5 class="card-title">Дети в группе</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>ФИО ребенка</th>
                                <th>Тип оплаты</th>
                                <th>Баланс</th>
                                <th>Статус в группе</th>
                                <th>Добавлен в группу</th>
                                <th>Комментарий</th>
                                <th>Добавил</th>
                                <th>Удалён из группы</th>
                                <th>Комментарий</th>
                                <th>Удалил</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($child as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td style="text-align:left"><a href="{{ route('child_show',$item['id']) }}">{{ $item['child'] }}</a></td>
                                    <td>
                                        @if ($item['paymart_type']=='day')
                                            Ежедневно
                                        @else
                                            Ежемесячно
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item['balans']==0)
                                            <span class="text-dark">{{ $item['balans'] }} сум</span>
                                        @elseif($item['balans']>0)
                                            <span class="text-success">{{ number_format($item['balans'], 0, '.', ' ') }} сум</span>
                                        @else
                                            <span class="text-danger">{{ number_format($item['balans'], 0, '.', ' ') }} сум</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item['status']=='true')
                                            <span class="text-success">Активен</span>
                                        @else
                                            <span class="text-danger">Удалён</span>
                                        @endif
                                    </td>
                                    <td>{{ $item['start_time'] }}</td>
                                    <td>{{ $item['start_comment'] }}</td>
                                    <td>{{ $item['start_manejer'] }}</td>
                                    <td>{{ $item['end_time'] }}</td>
                                    <td>{{ $item['end_comment'] }}</td>
                                    <td>
                                        {{ $item['end_manejer'] }}
                                        @if ($item['status']=='true')
                                            <a href="{{ route('groups_show_child_update', ['group_id' => $id,'child_id' => $item['id']]) }}" class="btn btn-primary px-1 py-1"><i class="bi bi-pen"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h5 class="card-title">Воспитатели</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Воспитатель</th>
                                <th>Назначен в группу</th>
                                <th>Удалён из группы</th>
                                <th>Роль</th>
                                <th>Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($res as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item['tarbiyachi'] }}</td>
                                    <td>{{ $item['start_time'] }}</td>
                                    <td>{{ $item['end_time'] }}</td>
                                    <td>
                                        @if($item['type'] == 'tarbiyachi')
                                            Воспитатель
                                        @else
                                            Помощник воспитателя
                                        @endif
                                    </td>
                                    <td>
                                        @if($item['status']==1)
                                            Активен
                                        @else
                                            Завершён
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
</div>
@endsection
