@extends('layout.cdn1')
@section('title','Tashriflar')
@section('content')
<style>
    div.dataTables_filter {
        text-align: right !important;
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
                        <h3>Tashriflar</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tashriflar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="list-group list-group-horizontal text-center" id="inbox-menu">
                    <a href="{{ route('child_vakancy') }}" class="list-group-item list-group-item-action active">Tashriflar</a>
                    <a href="{{ route('child_vakancy_create') }}" class="list-group-item list-group-item-action ">Yangi tashrif</a>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
            </div>
        @endif
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered text-center align-middle" id="table1">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>FIO</th>
                                <th>Tug'ilgan kuni</th>
                                <th>Tashrif vaqti</th>
                                <th>Meneger</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($VacancyChild as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td style="text-align:left"><a href="{{ route('child_vakancy_show',$item['id']) }}">{{ $item['name'] }}</a></td>
                                    <td>{{ $item['birthday'] }}</td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td>{{ $item['fio'] }}</td>
                                    <td>
                                        @if($item['status'] == 'new')
                                            <span class="badge bg-info">
                                                <i class="bi bi-plus-circle me-1"></i> Yangi
                                            </span>
                                        @elseif($item['status'] == 'pedding')
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-hourglass-split me-1"></i> Jarayonda
                                            </span>
                                        @elseif($item['status'] == 'cancel')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle me-1"></i> Bekor qilindi
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="bi bi-check2-circle me-1"></i> Qabul qilindi
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
