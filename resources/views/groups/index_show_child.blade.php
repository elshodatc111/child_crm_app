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
                <div class="list-group list-group-horizontal mb-4" id="inbox-menu">
                    <a href="{{ route('groups_show',$id) }}" class="list-group-item list-group-item-action">Guruh haqida</a>
                    <a href="{{ route('groups_show_child',$id) }}" class="list-group-item list-group-item-action active">Guruhdagi bolalar</a>
                    <a href="{{ route('groups_show_davomad',$id) }}" class="list-group-item list-group-item-action ">Guruh davomadi</a>
                    <a href="{{ route('groups_show_history',$id) }}" class="list-group-item list-group-item-action">Davomadi tarixi</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Bola FIO</th>
                                <th>To'lov turi</th>
                                <th>Balansi</th>
                                <th>Guruhdagi holati</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
