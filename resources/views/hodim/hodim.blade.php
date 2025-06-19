@extends('layout.cdn1')
@section('title','Hodimlar')

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
                        <h3>Hodimlar</h3>
                        <p class="text-subtitle text-muted">...</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Hodimlar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">  

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="admin-tab" data-bs-toggle="tab" href="#admin" role="tab" aria-selected="true">Direktor & Menejer</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tarbiyachi-tab" data-bs-toggle="tab" href="#tarbiyachi" role="tab">Tarbiyachilar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="oshpazlar-tab" data-bs-toggle="tab" href="#oshpazlar" role="tab">Oshpazlar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="hodimlar-tab" data-bs-toggle="tab" href="#hodimlar" role="tab">Hodimlar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="arxiv-tab" data-bs-toggle="tab" href="#arxiv" role="tab">Arxiv Hodimlar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="vakansiya-tab" data-bs-toggle="tab" href="#vakansiya" role="tab">Vakansiya</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="new-vakansiya-tab" data-bs-toggle="tab" href="#new-vakansiya" role="tab">Yangi Vakansiya</a>
                        </li>
                    </ul>
                    <hr class="m-0 p-0">
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                            <h4 class="card-title">Direktor & Menejer</h4>
                            <div class="table-responsive datatable-minimal">
                                <table class="table table-bordered">
                                    <thead class="bg-primary">
                                        <tr class="text-center">
                                            <th class="text-white">#</th>
                                            <th class="text-white">FIO</th>
                                            <th class="text-white">Login</th>
                                            <th class="text-white">Lavozimi</th>
                                            <th class="text-white">Holati</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>
                                                <a href="#">Alisher Usmonov</a>
                                            </td>
                                            <td class="text-center">14-05-2025</td>
                                            <td class="text-center">
                                                <span class="badge bg-success">Bog'bon</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success">new</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tarbiyachi" role="tabpanel" aria-labelledby="tarbiyachi-tab">
                            <h4 class="card-title">Tarbiyachilar</h4>
                            <div class="table-responsive datatable-minimal">
                                <table class="table table-bordered">
                                    <thead class="bg-primary">
                                        <tr class="text-center">
                                            <th class="text-white">#</th>
                                            <th class="text-white">FIO</th>
                                            <th class="text-white">Login</th>
                                            <th class="text-white">Lavozimi</th>
                                            <th class="text-white">Holati</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>
                                                <a href="#">Alisher Usmonov</a>
                                            </td>
                                            <td class="text-center">14-05-2025</td>
                                            <td class="text-center">
                                                <span class="badge bg-success">Bog'bon</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success">new</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="oshpazlar" role="tabpanel" aria-labelledby="oshpazlar-tab">
                            <h4 class="card-title">Oshpazlar</h4>
                            <div class="table-responsive datatable-minimal">
                                <table class="table table-bordered">
                                    <thead class="bg-primary">
                                        <tr class="text-center">
                                            <th class="text-white">#</th>
                                            <th class="text-white">FIO</th>
                                            <th class="text-white">Login</th>
                                            <th class="text-white">Lavozimi</th>
                                            <th class="text-white">Holati</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>
                                                <a href="#">Alisher Usmonov</a>
                                            </td>
                                            <td class="text-center">14-05-2025</td>
                                            <td class="text-center">
                                                <span class="badge bg-success">Bog'bon</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success">new</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="hodimlar" role="tabpanel" aria-labelledby="hodimlar-tab">
                            <h4 class="card-title">Hodimlar</h4>
                            <div class="table-responsive datatable-minimal">
                                <table class="table table-bordered">
                                    <thead class="bg-primary">
                                        <tr class="text-center">
                                            <th class="text-white">#</th>
                                            <th class="text-white">FIO</th>
                                            <th class="text-white">Login</th>
                                            <th class="text-white">Lavozimi</th>
                                            <th class="text-white">Holati</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>
                                                <a href="#">Alisher Usmonov</a>
                                            </td>
                                            <td class="text-center">14-05-2025</td>
                                            <td class="text-center">
                                                <span class="badge bg-success">Bog'bon</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success">new</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="arxiv" role="tabpanel" aria-labelledby="arxiv-tab">
                            <h4 class="card-title">Arxiv Hodimlar</h4>
                            <div class="table-responsive datatable-minimal">
                                <table class="table table-bordered">
                                    <thead class="bg-primary">
                                        <tr class="text-center">
                                            <th class="text-white">#</th>
                                            <th class="text-white">FIO</th>
                                            <th class="text-white">Login</th>
                                            <th class="text-white">Lavozimi</th>
                                            <th class="text-white">Holati</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>
                                                <a href="#">Alisher Usmonov</a>
                                            </td>
                                            <td class="text-center">14-05-2025</td>
                                            <td class="text-center">
                                                <span class="badge bg-success">Bog'bon</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success">new</span>
                                            </td>
                                        </tr>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- All Vacancy -->
                        <div class="tab-pane fade" id="vakansiya" role="tabpanel" aria-labelledby="vakansiya-tab">
                            <h4 class="card-title">Vakansiyalar</h4>
                            <div class="table-responsive datatable-minimal">
                                <table class="table table-bordered" id="table2">
                                    <thead class="bg-primary">
                                        <tr class="text-center">
                                            <th class="text-white">#</th>
                                            <th class="text-white">FIO</th>
                                            <th class="text-white">Tug'ilgan kuni</th>
                                            <th class="text-white">Lavozimi</th>
                                            <th class="text-white">Holati</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vacancy as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->index+1 }}</td>
                                            <td>
                                                <a href="#">{{ $item->fio }}</a>
                                            </td>
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
                                                    <span class="badge bg-success">Ro'yhatga olindi</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Create Vacancy -->
                        <div class="tab-pane fade" id="new-vakansiya" role="tabpanel" aria-labelledby="new-vakansiya-tab">
                            <h4 class="card-title">Yangi Vakansiya</h4>
                            <form action="{{ route('vacancy_story') }}" method="POST" class="form form-vertical">
                                @csrf 
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="fio">FIO</label>
                                                <input type="text" required class="form-control" name="fio" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="phone">Telefon raqam</label>
                                                <input type="text" required class="form-control phone" value="+998" name="phone">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="address">Yashash manzil</label>
                                                <input type="text" required class="form-control" name="address">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="tkun">Tug'ilgan kun</label>
                                                <input type="date" required class="form-control" name="tkun">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="type">Lavozim</label>
                                                <select name="type" require class="form-select">
                                                    <option value="">Tanlang</option>
                                                    <option value="meneger">Meneger</option>
                                                    <option value="tarbiyachi">Tarbiyachi</option>
                                                    <option value="techer">O'qituvchi</option>
                                                    <option value="bogbon">Bog'bon</option>
                                                    <option value="oshpaz">Oshpaz</option>
                                                    <option value="qarovul">Qarovul</option>
                                                    <option value="farrosh">Farrosh</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class='form-group'>
                                                <label for="description">Vakansiya haqida</label>
                                                <textarea name="description" required class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Saqlash</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Tozalash</button>
                                        </div>
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
