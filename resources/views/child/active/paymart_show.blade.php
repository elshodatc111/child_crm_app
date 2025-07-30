@extends('layout.cdn2')
@section('title','История платежей')
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
                        <h3>История платежей</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('child') }}">Дети</a></li>
                                <li class="breadcrumb-item active" aria-current="page">История платежей</li>
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
                    <a href="{{ route('child_show_group',$id) }}" class="list-group-item list-group-item-action">История групп</a>
                    <a href="{{ route('child_show_davomad',$id) }}" class="list-group-item list-group-item-action">Посещаемость</a>
                    <a href="{{ route('child_show_paymart',$id) }}" class="list-group-item list-group-item-action active">История платежей</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">История платежей</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Тип оплаты</th>
                            <th>Сумма оплаты</th>
                            <th>Тип</th>
                            <th>О платеже</th>
                            <th>Оплатил</th>
                            <th>Время оплаты</th>
                            <th>Менеджер</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach($paymart as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>
                                @if($item['status']=='tulov')
                                    Оплата
                                @elseif($item['status']=='chegirma')
                                    Скидка
                                @elseif($item['status']=='qaytar')
                                    Он вернулся
                                @endif
                            </td>
                            <td>
                                {{ number_format($item['amount'], 0, '', ' ') }} сум
                            </td>
                            <td>
                                @if($item['type']=='naqt')
                                    Наличные
                                @elseif($item['type']=='plastik')
                                    Пластик
                                @elseif($item['type']=='chegirma')
                                    Он вернулся
                                @endif
                            </td>
                            <td>{{ $item['about'] }}</td>
                            <td>{{ $item['qarindosh'] }}</td>
                            <td>{{ $item['vaqt'] }}</td>
                            <td>{{ $item['meneger'] }}</td>
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
