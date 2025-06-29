@extends('layout.cdn1')
@section('title','Yangi Vakansiya')

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
                        <h3>Yangi Vakansiya</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Yangi Vakansiya</li>
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
                                <a href="{{ route('hodim_vacancy_create') }}" class="list-group-item list-group-item-action text-center active">Yangi vakansiya</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim') }}" class="list-group-item list-group-item-action text-center">Drektor & Menejer</a>
                                <a href="{{ route('hodim_tarbiyachi') }}" class="list-group-item list-group-item-action text-center">Tarbiyachilar</a>
                                <a href="{{ route('hodim_oshpazlar') }}" class="list-group-item list-group-item-action text-center">Oshpazlar</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim_boshqalar') }}" class="list-group-item list-group-item-action text-center">Hodimlar</a>
                                <a href="{{ route('hodim_vacancy') }}" class="list-group-item list-group-item-action text-center ">Vakansiya</a>
                                <a href="{{ route('hodim_techer') }}" class="list-group-item list-group-item-action text-center">O'qituvchilar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <h5 class="card-title">Yangi vakansiya</h5>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                        </div>
                    @endif
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
        </section>
    </div>
</div>
@endsection
