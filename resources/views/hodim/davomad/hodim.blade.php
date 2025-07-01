@extends('layout.cdn2')
@section('title','Davomad')

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
                        <h3>Davomad</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Davomad</li>
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
                    <div class="col-lg-3">
                        <div class="list-group">
                            <a href="{{ route('hodim_davomad_meneger') }}" class="list-group-item list-group-item-action text-center ">Menegerlar</a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="list-group">
                            <a href="{{ route('hodim_davomad_tarbiyachi') }}" class="list-group-item list-group-item-action text-center ">Tarbiyachilar</a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="list-group">
                            <a href="{{ route('hodim_davomad_hodim') }}" class="list-group-item list-group-item-action text-center active">Hodimlar</a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="list-group">
                            <a href="{{ route('hodim_davomad_techer') }}" class="list-group-item list-group-item-action text-center ">Oshpazlar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm rounded">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                    </div>
                @endif
                <h5 class="card-title d-flex justify-content-between align-items-center">
                    Menejerlar davomadi
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#davomadModal">
                        <i class="bi bi-plus-circle me-1"></i> Davomad olish
                    </button>
                </h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>#</th>
                                <th>FIO</th>
                                @foreach ($ishString as $item)
                                    <th class="text-center">
                                        <p class="vertical-text"
                                            style = "font-size:12px;
                                            font-weight:700;
                                            padding:0;margin:0">{{ $item }}
                                        </p>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadval as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->index+1 }}</td>
                                    <td>{{ $item['fio'] }}</td>
                                    @foreach ($item['status'] as $status)
                                        @if($status == 'present')
                                            <td class="text-center">
                                                <span class="badge bg-success badge-status">
                                                    <i class="bi bi-check-circle"></i>
                                                </span>
                                            </td>
                                        @elseif($status=='absent')
                                            <td class="text-center">
                                                <span class="badge bg-danger badge-status">
                                                    <i class="bi bi-x-circle"></i>
                                                </span>
                                            </td>
                                        @elseif($status=='late')
                                            <td class="text-center">
                                                <span class="badge bg-warning text-dark badge-status">
                                                    <i class="bi bi-clock"></i>
                                                </span>
                                            </td>
                                        @elseif($status=='no_uniform')
                                            <td class="text-center">
                                                <span class="badge bg-info text-dark badge-status">
                                                    <i class="bi bi-person-x"></i>
                                                </span>
                                            </td>
                                        @elseif($status=='off_day')
                                            <td class="text-center">
                                                <span class="badge bg-secondary badge-status">
                                                    <i class="bi bi-calendar-x"></i>
                                                </span>
                                            </td>
                                        @else
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark">
                                                    <i class="bi bi-question-circle"></i>
                                                </span>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <span class="badge bg-success badge-status">
                        <i class="bi bi-check-circle"></i> Keldi
                    </span>
                    <span class="badge bg-danger badge-status">
                        <i class="bi bi-x-circle"></i> Ishga kelmadi
                    </span>
                    <span class="badge bg-warning text-dark badge-status">
                        <i class="bi bi-clock"></i> Kechikdi
                    </span>
                    <span class="badge bg-info text-dark badge-status">
                        <i class="bi bi-person-x"></i> Forma yo'q
                    </span>
                    <span class="badge bg-secondary badge-status">
                        <i class="bi bi-calendar-x"></i> Ish kuni emas
                    </span>
                    <span class="badge bg-light text-dark border badge-status">
                        <i class="bi bi-question-circle"></i> Davomad olinmadi
                    </span>
                </div>
                <div class="modal fade" id="davomadModal" tabindex="-1" aria-labelledby="davomadModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="{{ route('meneger_davomad_store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="davomadModalLabel">Davomad olish</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle">
                                            <thead class="table-light text-center">
                                                <tr>
                                                    <th>#</th>
                                                    <th>F.I.O</th>
                                                    <th>Holat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($davomad as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->index+1 }}</td>
                                                        <td>{{ $item['fio'] }}</td>
                                                        <td>
                                                            <select name="statuses[{{ $item['id'] }}]" class="form-select" required>
                                                                <option value="">Tanlang</option>
                                                                <option value="present" {{ $item['status'] === 'present' ? 'selected' : '' }}>Keldi</option>
                                                                <option value="absent" {{ $item['status'] === 'absent' ? 'selected' : '' }}>Kelmadi</option>
                                                                <option value="late" {{ $item['status'] === 'late' ? 'selected' : '' }}>Kechikdi</option>
                                                                <option value="no_uniform" {{ $item['status'] === 'no_uniform' ? 'selected' : '' }}>Forma yo‘q</option>
                                                                <option value="off_day" {{ $item['status'] === 'off_day' ? 'selected' : '' }}>Ish kuni emas</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check2-circle me-1"></i> Saqlash
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>


        </section>
    </div>
</div>
@endsection
