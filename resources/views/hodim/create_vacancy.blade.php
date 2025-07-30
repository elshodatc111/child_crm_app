@extends('layout.cdn1')
@section('title','Новая вакансия')

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
                        <h3>Новая вакансия</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Новая вакансия</li>
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
                                <a href="{{ route('hodim_vacancy_create') }}" class="list-group-item list-group-item-action text-center active">Новая вакансия</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim') }}" class="list-group-item list-group-item-action text-center">Директор & Менеджер</a>
                                <a href="{{ route('hodim_tarbiyachi') }}" class="list-group-item list-group-item-action text-center">Воспитатели</a>
                                <a href="{{ route('hodim_oshpazlar') }}" class="list-group-item list-group-item-action text-center">Поварa</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="list-group">
                                <a href="{{ route('hodim_boshqalar') }}" class="list-group-item list-group-item-action text-center">Сотрудники</a>
                                <a href="{{ route('hodim_vacancy') }}" class="list-group-item list-group-item-action text-center">Вакансии</a>
                                <a href="{{ route('hodim_techer') }}" class="list-group-item list-group-item-action text-center">Учителя</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <h5 class="card-title">Новая вакансия</h5>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
                        </div>
                    @endif
                    <form action="{{ route('vacancy_story') }}" method="POST" class="form form-vertical">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="fio">ФИО</label>
                                        <input type="text" required class="form-control" name="fio" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="phone">Номер телефона</label>
                                        <input type="text" required class="form-control phone" value="+998" name="phone">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address">Адрес проживания</label>
                                        <input type="text" required class="form-control" name="address">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tkun">Дата рождения</label>
                                        <input type="date" required class="form-control" name="tkun">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="type">Должность</label>
                                        <select name="type" required class="form-select">
                                            <option value="">Выберите</option>
                                            <option value="meneger">Менеджер</option>
                                            <option value="tarbiyachi">Воспитатель</option>
                                            <option value="techer">Учитель</option>
                                            <option value="bogbon">Садовник</option>
                                            <option value="oshpaz">Повар</option>
                                            <option value="qarovul">Охранник</option>
                                            <option value="farrosh">Уборщик</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class='form-group'>
                                        <label for="description">Описание вакансии</label>
                                        <textarea name="description" required class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Сохранить</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Очистить</button>
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
