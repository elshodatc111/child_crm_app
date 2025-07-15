@extends('layout.cdn1')
@section('title','Profile')
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
                            <h3>Profile</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
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
                                <h5 class="card-title mb-4">Profil</h5>
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        <th>FIO</th>
                                        <td style="text-align:right">{{ auth()->user()->fio }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telefon raqam</th>
                                        <td style="text-align:right">{{ auth()->user()->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Manzil</th>
                                        <td style="text-align:right">{{ auth()->user()->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lavozim</th>
                                        <td style="text-align:right">{{ auth()->user()->type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Login</th>
                                        <td style="text-align:right">{{ auth()->user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ishga olindi</th>
                                        <td style="text-align:right">{{ auth()->user()->created_at }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Parolni yangilash</h5>
                                <form action="{{ route('profile_password_update') }}" method="POST">
                                    @csrf
                                    <label for="password" class="mb-1">Joriy parol</label>
                                    <input type="password" name="password" class="form-control" required>
                                    <label for="new_password" class="my-1">Yangi parol</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                    <label for="confirm_password" class="my-1">Yangi parolni takrorlang</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                    <button type="submit" class="btn btn-primary mt-1 w-100">Parolni yangilash</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
