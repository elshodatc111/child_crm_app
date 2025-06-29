@extends('layout.cdn1')
@section('title','Vakansiya')

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
                        <h3>Vakansiya</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Vakansiya</li>
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
                            <div class="list-group">
                                <a href="{{ route('hodim_techer') }}" class="list-group-item list-group-item-action text-center">O'qituvchilar</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim') }}" class="list-group-item list-group-item-action text-center">Drektor & Meneger</a>
                                <a href="{{ route('hodim_tarbiyachi') }}" class="list-group-item list-group-item-action text-center">Tarbiyachilar</a>
                                <a href="{{ route('hodim_oshpazlar') }}" class="list-group-item list-group-item-action text-center">Oshpazlar</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim_boshqalar') }}" class="list-group-item list-group-item-action text-center">Hodimlar</a>
                                <a href="{{ route('hodim_vacancy') }}" class="list-group-item list-group-item-action text-center active">Vakansiya</a>
                                <a href="{{ route('hodim_vacancy_create') }}" class="list-group-item list-group-item-action text-center">Yangi vakansiya</a>
                            </div>
                        </div>
                    </div>
                    <hr>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center"  id="table1">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th class="text-white">#</th>
                                    <th class="text-white">FIO</th>
                                    <th class="text-white">Tug'ilgan kuni</th>
                                    <th class="text-white">Lavozimi</th>
                                    <th class="text-white">Holati</th>
                                    <th class="text-white">Royhatga olindi</th>
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
                                            <span class="badge bg-warning">Bog'bon</span>
                                        @elseif($item->type == 'oshpaz')
                                            <span class="badge bg-warning">Oshpaz</span>
                                        @elseif($item->type == 'qarovul')
                                            <span class="badge bg-dark text-white">Qarovul</span>
                                        @elseif($item->type == 'farrosh')
                                            <span class="badge bg-warning">Farrosh</span>
                                        @elseif($item->type == 'techer')
                                            <span class="badge bg-primary">O'qituvchi</span>
                                        @elseif($item->type == 'tarbiyachi')
                                            <span class="badge bg-danger">Tarbiyachi</span>
                                        @else
                                            <span class="badge bg-info">Meneger</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == 'new')
                                            <span class="badge bg-primary">Yangi</span>
                                        @elseif($item->status == 'pending')
                                            <span class="badge bg-warning">Ko'rib chiqilmoqda</span>
                                        @elseif($item->status == 'cancel')
                                            <span class="badge bg-danger">Bekor qilindi</span>
                                        @else
                                            <span class="badge bg-success">Qabul qilindi</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item['created_at'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Vakansiyalar mavjud emas.</td>
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
