@extends('layout.cdn1')
@section('title','Tarbiyachilar')

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
                        <h3>Tarbiyachilar</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tarbiyachilar</li>
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
                                <a href="{{ route('hodim_tarbiyachi') }}" class="list-group-item list-group-item-action text-center active">Tarbiyachilar</a>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="list-group">
                                <a href="{{ route('hodim') }}" class="list-group-item list-group-item-action text-center ">Drektor & Meneger</a>
                                <a href="{{ route('hodim_techer') }}" class="list-group-item list-group-item-action text-center">O'qituvchilar</a>
                                <a href="{{ route('hodim_oshpazlar') }}" class="list-group-item list-group-item-action text-center">Oshpazlar</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim_boshqalar') }}" class="list-group-item list-group-item-action text-center ">Hodimlar</a>
                                <a href="{{ route('hodim_vacancy') }}" class="list-group-item list-group-item-action text-center ">Vakansiya</a>
                                <a href="{{ route('hodim_vacancy_create') }}" class="list-group-item list-group-item-action text-center ">Yangi vakansiya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <h5 class="card-title">Tarbiyachilar</h5>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th class="text-white">#</th>
                                    <th class="text-white">FIO</th>
                                    <th class="text-white">Tarbiyachi haqida</th>
                                    <th class="text-white">Holati</th>
                                    <th class="text-white">Lavozimi</th>
                                    <th class="text-white">Login</th>
                                    <th class="text-white">Ishga olindi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($res as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->index+1 }}</td>
                                    <td style="text-align:left">
                                        <a href="{{ route('hodim_tarbiyachi_show',$item['id']) }}">{{ $item['fio'] }}</a>
                                    </td>
                                    <td class="text-center">{{ $item['commit'] }}</td>
                                    <td class="text-center">
                                        @if($item['status']=='active')
                                            Aktiv
                                        @else
                                            Block
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item['type'] }}</td>
                                    <td class="text-center">{{ $item['email'] }}</td>
                                    <td class="text-center">{{ $item['created_at'] }}</td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan=7 class="text-center">Tarbiyachilar mavjud emas.</td>
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
