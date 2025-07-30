@extends('layout.cdn1')
@section('title','Вакансии')

@section('content')
<style>
    div.dataTables_filter {
        text-align: right !important;
    }
</style>
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
                        <h3>Вакансии</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Вакансии</li>
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
                        <div class="col-12">
                            <div class="list-group mb-2">
                                <a href="{{ route('hodim_vacancy') }}" class="list-group-item list-group-item-action text-center active">Вакансии</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim') }}" class="list-group-item list-group-item-action text-center">Директор & Менеджер</a>
                                <a href="{{ route('hodim_tarbiyachi') }}" class="list-group-item list-group-item-action text-center">Воспитатели</a>
                                <a href="{{ route('hodim_oshpazlar') }}" class="list-group-item list-group-item-action text-center">Поварa</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim_boshqalar') }}" class="list-group-item list-group-item-action text-center">Сотрудники</a>
                                <a href="{{ route('hodim_techer') }}" class="list-group-item list-group-item-action text-center">Преподаватели</a>
                                <a href="{{ route('hodim_vacancy_create') }}" class="list-group-item list-group-item-action text-center">Добавить вакансию</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <h5 class="card-title">Список вакансий</h5>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center" id="table1">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th class="text-white">#</th>
                                    <th class="text-white">ФИО</th>
                                    <th class="text-white">Дата рождения</th>
                                    <th class="text-white">Должность</th>
                                    <th class="text-white">Статус</th>
                                    <th class="text-white">Дата регистрации</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($res['vacancy'] as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->index+1 }}</td>
                                    <td style="text-align:left"><a href="{{ route('hodim_vacancy_show',$item->id) }}">{{ $item->fio }}</a></td>
                                    <td class="text-center">{{ $item->tkun }}</td>
                                    <td class="text-center">
                                        @if($item->type == 'bogbon')
                                            <span class="badge bg-warning">Садовник</span>
                                        @elseif($item->type == 'oshpaz')
                                            <span class="badge bg-warning">Повар</span>
                                        @elseif($item->type == 'qarovul')
                                            <span class="badge bg-dark text-white">Охранник</span>
                                        @elseif($item->type == 'farrosh')
                                            <span class="badge bg-warning">Уборщик</span>
                                        @elseif($item->type == 'techer')
                                            <span class="badge bg-primary">Преподаватель</span>
                                        @elseif($item->type == 'tarbiyachi')
                                            <span class="badge bg-danger">Воспитатель</span>
                                        @else
                                            <span class="badge bg-info">Менеджер</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == 'new')
                                            <span class="badge bg-primary">Новый</span>
                                        @elseif($item->status == 'pending')
                                            <span class="badge bg-warning">В рассмотрении</span>
                                        @elseif($item->status == 'cancel')
                                            <span class="badge bg-danger">Отклонен</span>
                                        @else
                                            <span class="badge bg-success">Принят</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item['created_at'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Вакансии отсутствуют.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
