@extends('layout.cdn2')
@section('title','O\'qituvchilar')

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
                        <h3>O'qituvchilar</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('hodim_techer') }}">O'qituvchilar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">O'qituvchi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="list-group">
                                <a href="{{ route('hodim_techer_show',$id) }}" class="list-group-item list-group-item-action text-center ">O'qituvchi haqida</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="list-group">
                                <a href="{{ route('hodim_techer_tarix',$id) }}" class="list-group-item list-group-item-action text-center active">Darslar tarixi</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="list-group">
                                <a href="{{ route('hodim_techer_paymart',$id) }}" class="list-group-item list-group-item-action text-center ">Ish haqi to'lovlari</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <h5 class="card-title">O'qituvchilar</h5>
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
                                    <th class="text-white">Guruh</th>
                                    <th class="text-white">Dars nomi</th>
                                    <th class="text-white">Bolalar soni</th>
                                    <th class="text-white">Menejer</th>
                                    <th class="text-white">Saqlangan vaqt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($res as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $item['group_name'] }}</td>
                                        <td>{{ $item['lesson_name'] }}</td>
                                        <td>{{ $item['child_count'] }}</td>
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
