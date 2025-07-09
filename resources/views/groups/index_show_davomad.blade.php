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
                        <h3>Guruh haqida</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('groups') }}">Guruhlar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Guruh haqida</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="list-group list-group-horizontal" id="inbox-menu">
                    <a href="{{ route('groups_show',$id) }}" class="list-group-item list-group-item-action">Guruh haqida</a>
                    <a href="{{ route('groups_show_child',$id) }}" class="list-group-item list-group-item-action ">Guruhdagi bolalar</a>
                    <a href="{{ route('groups_show_davomad',$id) }}" class="list-group-item list-group-item-action active">Guruh davomadi</a>
                </div>
            </div>
        </div>
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h5 class="card-title">Joriy oy davomadi</h5>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle" style="font-size:14px;">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Bola ismi</th>
                                @foreach ($days as $date)
                                    <th>{{ $date }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($childs as $child)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td class="text-start"><a href="{{ route('child_show',$child['child_id']) }}">{{ $child['child_name'] }}</a></td>
                                @foreach ($child['natija'] as $item)
                                    <td>
                                        @if($item == 'kutilmoqda')
                                            ⏱
                                        @elseif($item == 'Olinmadi')
                                            ❓
                                        @elseif($item == 'keldi')
                                            ✅
                                        @elseif($item == 'kelmadi')
                                            ❌
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h5 class="card-title">O'tgan oy davomadi</h5>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle" style="font-size:14px;">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Bola ismi</th>
                                @foreach ($otganOy['days'] as $date)
                                    <th>{{ $date }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($otganOy['childs'] as $child)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td class="text-start"><a href="{{ route('child_show',$child['child_id']) }}">{{ $child['child_name'] }}</a></td>
                                @foreach ($child['natija'] as $item)
                                    <td>
                                        @if($item == 'kutilmoqda')
                                            ⏱
                                        @elseif($item == 'Olinmadi')
                                            ❓
                                        @elseif($item == 'keldi')
                                            ✅
                                        @elseif($item == 'kelmadi')
                                            ❌
                                        @endif
                                    </td>
                                @endforeach
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
