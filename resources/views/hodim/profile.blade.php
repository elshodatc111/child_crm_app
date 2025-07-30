@extends('layout.cdn1')
@section('title','Профиль')
@section('content')
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
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Профиль</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Профиль</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Профиль</h5>
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        <th>ФИО</th>
                                        <td style="text-align:right">{{ auth()->user()->fio }}</td>
                                    </tr>
                                    <tr>
                                        <th>Телефон</th>
                                        <td style="text-align:right">{{ auth()->user()->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Адрес</th>
                                        <td style="text-align:right">{{ auth()->user()->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Должность</th>
                                        <td style="text-align:right">{{ auth()->user()->type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Логин</th>
                                        <td style="text-align:right">{{ auth()->user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Дата приема</th>
                                        <td style="text-align:right">{{ auth()->user()->created_at }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Изменить пароль</h5>
                                <form action="{{ route('profile_password_update') }}" method="POST">
                                    @csrf
                                    <label for="password" class="mb-1">Текущий пароль</label>
                                    <input type="password" name="password" class="form-control" required>
                                    <label for="new_password" class="my-1">Новый пароль</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                    <label for="confirm_password" class="my-1">Повторите новый пароль</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                    <button type="submit" class="btn btn-primary mt-1 w-100">Обновить пароль</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
