@extends('layout.cdn2')
@section('title','Посещаемость')
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
                        <h3>Посещаемость</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('child') }}">Дети</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Посещаемость</li>
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
                    <a href="{{ route('child_show_group',$id) }}" class="list-group-item list-group-item-action ">История групп</a>
                    <a href="{{ route('child_show_davomad',$id) }}" class="list-group-item list-group-item-action active">Посещаемость</a>
                    <a href="{{ route('child_show_paymart',$id) }}" class="list-group-item list-group-item-action ">История платежей</a>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h5 class="card-title">Посещаемость</h5>
                <table class="table table-bordered text-center" style="font-size:14px">
                    <tbody>
                        <tr>
                            <th>№</th>
                            <th>Группа</th>
                            <th>Статус посещаемости</th>
                            <th>Дата посещаемости</th>
                            <th>Оплата за группу</th>
                            <th>Принял посещаемость</th>
                            <th>Время посещаемости</th>
                        </tr>
                    </tbody>
                    @foreach($davomad as $item)
                        <tbody>
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item['guruh'] }}</td>
                                <td>{{ $item['status'] }}</td>
                                <td>{{ $item['data'] }}</td>
                                <td>-{{ number_format($item['amount'], 0, '', ' ') }} сум</td>
                                <td>{{ $item['meneger'] }}</td>
                                <td>{{ $item['created_at'] }}</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
