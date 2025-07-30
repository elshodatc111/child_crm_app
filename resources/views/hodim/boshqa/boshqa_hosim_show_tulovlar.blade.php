@extends('layout.cdn2')
@section('title','Выплаченная зарплата сотруднику')

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
                        <h3>Выплаченная зарплата сотруднику</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('hodim_boshqalar') }}">Сотрудники</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Выплаченная зарплата сотруднику</li>
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
                                <a href="{{ route('hodim_boshqa_show',$id) }}" class="list-group-item list-group-item-action text-center ">О сотруднике</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim_boshqa_show_tulovlar',$id) }}" class="list-group-item list-group-item-action text-center active">Выплаты зарплаты</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
                        </div>
                    @endif
                    <h5 class="card-title">Выплаты</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th class="text-white">#</th>
                                    <th class="text-white">Сумма выплаты</th>
                                    <th class="text-white">Тип выплаты</th>
                                    <th class="text-white">О платеже</th>
                                    <th class="text-white">Менеджер</th>
                                    <th class="text-white">Дата выплаты</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($res as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ number_format($item['amount'], 0, '', ' ') }} сум</td>
                                        <td>{{ $item['type'] }}</td>
                                        <td>{{ $item['comment'] }}</td>
                                        <td>{{ $item['meneger'] }}</td>
                                        <td>{{ $item['created_at'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
