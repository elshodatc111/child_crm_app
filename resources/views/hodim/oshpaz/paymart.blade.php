@extends('layout.cdn2')
@section('title','Hodim haqida')

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
                        <h3>Hodim haqida</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('hodim_oshpazlar') }}">Oshpazlar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Hodim haqida</li>
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
                                <a href="{{ route('oshpaz_show',$id) }}" class="list-group-item list-group-item-action text-center ">Oshpaz haqida</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('oshpaz_paymart',$id) }}" class="list-group-item list-group-item-action text-center active">Ish haqi to'lovlari</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                </div>
            @endif
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                        </div>
                    @endif
                    <h5 class="card-title">To'lovlar</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th class="text-white">#</th>
                                    <th class="text-white">To'lov summasi</th>
                                    <th class="text-white">To'lov turi</th>
                                    <th class="text-white">To'lov haqida</th>
                                    <th class="text-white">Menejer</th>
                                    <th class="text-white">To'lov vaqti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($res as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ number_format($item['amount'], 0, '', ' ') }} so'm</td>
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

    <script>
        document.querySelectorAll('.price-format').forEach(function(input) {
            input.addEventListener('input', function(e) {
                let value = input.value.replace(/\D/g, '');
                if (value) {
                    input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                } else {
                    input.value = '';
                }
            });
            input.addEventListener('blur', function() {
                input.value = input.value.trim();
            });
        });
    </script>
    <style>
        .comment-list {max-height: 210px;overflow-y: auto;padding-right: 10px;}
        .comment-box {background-color: #f8f9fa;border-left: 4px solid #0d6efd;padding: 10px 15px;border-radius: 8px;margin-bottom: 10px;}
        .avatar {width: 40px;height: 40px;object-fit: cover;border-radius: 50%;margin-right: 10px;}
    </style>
@endsection
