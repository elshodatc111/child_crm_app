@extends('layout.cdn1')
@section('title','Tashriflar')
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
                        <h3>Tashriflar</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tashriflar</li>
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
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
            </div>
        @endif
        <div class="card shadow-sm">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab">📋 Tashriflar</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab">➕ Yangi tashrif</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content" id="myTabContent">
                    <!-- Jadval -->
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered text-center align-middle" id="table1">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>FIO</th>
                                        <th>Tug'ilgan kuni</th>
                                        <th>Tashrif vaqti</th>
                                        <th>Meneger</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($VacancyChild as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td style="text-align:left"><a href="{{ route('child_vakancy_show',$item['id']) }}">{{ $item['name'] }}</a></td>
                                            <td>{{ $item['birthday'] }}</td>
                                            <td>{{ $item['created_at'] }}</td>
                                            <td>{{ $item['fio'] }}</td>
                                            <td>
                                                @if($item['status'] == 'new')
                                                    <span class="badge bg-info">
                                                        <i class="bi bi-plus-circle me-1"></i> Yangi
                                                    </span>
                                                @elseif($item['status'] == 'pedding')
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-hourglass-split me-1"></i> Jarayonda
                                                    </span>
                                                @elseif($item['status'] == 'cancel')
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-x-circle me-1"></i> Bekor qilindi
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check2-circle me-1"></i> Qabul qilindi
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Yangi tashrif -->
                    <div class="tab-pane fade" id="profile" role="tabpanel">
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
    </div>
</div>

@endsection
