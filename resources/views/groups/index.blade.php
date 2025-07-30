@extends('layout.cdn1')
@section('title','Группы')
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
                        <h3>Группы</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Группы</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="list-group list-group-horizontal mb-4" id="inbox-menu">
                    <a href="{{ route('groups') }}" class="list-group-item list-group-item-action active">Активные группы</a>
                    <a href="{{ route('groups_arxiv') }}" class="list-group-item list-group-item-action">Архив групп</a>
                    <a href="{{ route('groups_new') }}" class="list-group-item list-group-item-action">Новая группа</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Название группы</th>
                                <th>Цена (день)</th>
                                <th>Цена (месяц)</th>
                                <th>Количество детей</th>
                                <th>Статус группы</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Group as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td><a href="{{ route('groups_show',$item['id']) }}">{{ $item['name'] }}</a></td>
                                    <td>{{ number_format($item['price_day'], 0, '.', ' ') }} сум</td>
                                    <td>{{ number_format($item['price_month'], 0, '.', ' ') }} сум</td>
                                    <td>{{ $item['child'] }}</td>
                                    <td><span class="badge bg-success">Активна</span></td>
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
