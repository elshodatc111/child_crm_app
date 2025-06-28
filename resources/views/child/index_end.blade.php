@extends('layout.cdn1')
@section('title','Tark etganlar')
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
                        <h3>Tark etganlar</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item " aria-current="page">Tark etganlar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="list-group list-group-horizontal mb-4" id="inbox-menu">
                    <a href="{{ route('child') }}" class="list-group-item list-group-item-action ">Aktiv bolalar</a>
                    <a href="{{ route('child_end') }}" class="list-group-item list-group-item-action active">Tark etgan bolalar</a>
                    <a href="{{ route('child_debit') }}" class="list-group-item list-group-item-action">Qarzdorlar</a>
                </div>
                <form action="" method="get">
                    <input type="text" placeholder="Qirduv.." class="form-control">
                </form>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Ismi</th>
                                <th>Yoshi</th>
                                <th>Guruh</th>
                                <th>Balans</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Graiden</td>
                                <td>vehicula.aliquet@semconsequat.co.uk</td>
                                <td>076 4820 8838</td>
                                <td>Offenburg</td>
                                <td><span class="badge bg-success">Faol</span></td>
                            </tr>
                            <tr>
                                <td>Yusuf Karimov</td>
                                <td>karimov@example.com</td>
                                <td>+998 90 123 45 67</td>
                                <td>Toshkent</td>
                                <td><span class="badge bg-warning text-dark">Jarayonda</span></td>
                            </tr>
                            <tr>
                                <td>Gulbahor Saidova</td>
                                <td>gulbahor@example.com</td>
                                <td>+998 91 876 54 32</td>
                                <td>Andijon</td>
                                <td><span class="badge bg-danger">Bekor qilingan</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
