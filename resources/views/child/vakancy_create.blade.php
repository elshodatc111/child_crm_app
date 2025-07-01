@extends('layout.cdn1')
@section('title','Yangi Tashriflar')
@section('content')
<style>
    div.dataTables_filter {
        text-align: right !important;
    }
</style>
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
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <h3>Yangi Tashriflar</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Yangi Tashriflar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="list-group list-group-horizontal text-center" id="inbox-menu">
                    <a href="{{ route('child_vakancy') }}" class="list-group-item list-group-item-action ">Tashriflar</a>
                    <a href="{{ route('child_vakancy_create') }}" class="list-group-item list-group-item-action active">Yangi tashrif</a>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
            </div>
        @endif
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{  route('child_vakancy_store')  }}" method="post">
                    @csrf
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">FIO</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Bolaning Ism Familya">
                        </div>
                        <div class="col-md-6">
                            <label for="phone1" class="form-label">Telefon raqam</label>
                            <input type="text" required class="form-control phone" value="+998" name="phone1">
                        </div>
                        <div class="col-md-6">
                            <label for="birthday" class="form-label">Tug'ilgan sana</label>
                            <input type="date" class="form-control" id="birthday" required name="birthday">
                        </div>
                        <div class="col-md-6">
                            <label for="phone2" class="form-label">Qo'shimcha telefon raqam</label>
                            <input type="text" required class="form-control phone" value="+998" name="phone2">
                        </div>
                        <div class="col-md-6">
                            <label for="addres" class="form-label">Yashash manzili</label>
                            <input type="text" class="form-control" required id="addres" name="addres" placeholder="Kocha nomi uy raqami">
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Tashrif haqida</label>
                            <input type="text" class="form-control" required id="description" name="description" placeholder="Tashrifdan qisqacha maqsad">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Saqlash
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
