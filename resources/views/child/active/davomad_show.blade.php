@extends('layout.cdn2')
@section('title','Davomad')
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
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                        <h3>Davomad</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('child') }}">Aktiv bolalar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Davomad</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="list-group list-group-horizontal text-center" id="inbox-menu">
                    <a href="{{ route('child_show',$id) }}" class="list-group-item list-group-item-action ">Bola haqida</a>
                    <a href="{{ route('child_show_group',$id) }}" class="list-group-item list-group-item-action ">Guruhlar tarixi</a>
                    <a href="{{ route('child_show_davomad',$id) }}" class="list-group-item list-group-item-action active">Davomad</a>
                    <a href="{{ route('child_show_paymart',$id) }}" class="list-group-item list-group-item-action ">To'lovlar tarixi</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="card-title">FIO</h5>
                            </div>
                            <div class="col-5" style="text-align:right">
                                <h5 class="card-title">16 500 so'm</h5>
                            </div>
                        </div>
                        <table class="table table-bordered" style="font-size:14px">
                            <tbody>
                                <tr>
                                    <td>Manzil</td>
                                    <td style="text-align:right">Alimov Salim</td>
                                </tr>
                                <tr>
                                    <td>Tug'ilgan kun</td>
                                    <td style="text-align:right">Alimov Salim</td>
                                </tr>
                                <tr>
                                    <td>Telefon raqam</td>
                                    <td style="text-align:right">Alimov Salim</td>
                                </tr>
                                <tr>
                                    <td>Telefon raqam</td>
                                    <td style="text-align:right">Alimov Salim</td>
                                </tr>
                                <tr>
                                    <td>Holati</td>
                                    <td style="text-align:right">Alimov Salim</td>
                                </tr>
                                <tr>
                                    <td>Bola haqida</td>
                                    <td style="text-align:right">Alimov Salim</td>
                                </tr>
                                <tr>
                                    <td>Ro'yhatga olindi</td>
                                    <td style="text-align:right">Alimov Salim</td>
                                </tr>
                                <tr>
                                    <td>Ro'yhatga Oldi</td>
                                    <td style="text-align:right">Alimov Salim</td>
                                </tr>
                                <tr>
                                    <td>Guruh</td>
                                    <td style="text-align:right">Alimov Salim</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Yaqin qarindoshlari</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" style="font-size:14px">
                            <thead>
                                <tr class="text-center">
                                    <th>FIO</th>
                                    <th>Telefon raqam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Elshod Musurmmonov</td>
                                    <td style="text-align:right">+998 90 883 0450</td>
                                </tr>
                                <tr>
                                    <td>Elshod Musurmmonov</td>
                                    <td style="text-align:right">+998 90 883 0450</td>
                                </tr>
                                <tr>
                                    <td>Elshod Musurmmonov</td>
                                    <td style="text-align:right">+998 90 883 0450</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Eslatmalari</h5>
                    </div>
                    <div class="card-body pt-4 bg-light notes-area mx-4">
                        <div class="note-box mb-3">
                            <div class="note-meta mb-1 text-muted small">
                                <strong>sas | </strong>sas
                            </div>
                            <div class="note-message">asas</div>
                        </div>
                        <div class="note-box mb-3">
                            <div class="note-meta mb-1 text-muted small">
                                <strong>sas | </strong>sas
                            </div>
                            <div class="note-message">asas</div>
                        </div>
                        <div class="note-box mb-3">
                            <div class="note-meta mb-1 text-muted small">
                                <strong>sas | </strong>sas
                            </div>
                            <div class="note-message">asas</div>
                        </div>
                        <div class="note-box mb-3">
                            <div class="note-meta mb-1 text-muted small">
                                <strong>sas | </strong>sas
                            </div>
                            <div class="note-message">asas</div>
                        </div>
                        <div class="note-box mb-3">
                            <div class="note-meta mb-1 text-muted small">
                                <strong>sas | </strong>sas
                            </div>
                            <div class="note-message">asas</div>
                        </div>
                        <div class="note-box mb-3">
                            <div class="note-meta mb-1 text-muted small">
                                <strong>sas | </strong>sas
                            </div>
                            <div class="note-message">asas</div>
                        </div>
                        <div class="note-box mb-3">
                            <div class="note-meta mb-1 text-muted small">
                                <strong>sas | </strong>sas
                            </div>
                            <div class="note-message">asas</div>
                        </div>
                        <div class="note-box mb-3">
                            <div class="note-meta mb-1 text-muted small">
                                <strong>sas | </strong>sas
                            </div>
                            <div class="note-message">asas</div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <form action="#" method="post">
                            @csrf
                            <div class="message-form d-flex align-items-center">
                                <input type="hidden" name="vacancy_child_id" value="#">
                                <div class="d-flex flex-grow-1 ms-3">
                                    <input type="text" name="description" class="form-control rounded-pill px-4 py-2" placeholder="Yangi eslatma yozing...">
                                </div>
                                <button type="submit" class="btn btn-success ms-3 rounded-pill px-4">Saqlash</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    <style>
        .notes-area {padding: 1rem;max-height: 500px;overflow-y: auto;background-color: #f8f9fa;border-radius: 1rem;}
        .note-box {padding: 12px 15px;background-color: #fff;border-left: 5px solid #0d6efd;border-radius: 8px;box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);}
        .note-meta {font-size: 0.85rem;}
        .note-message {font-size: 1rem;}
    </style>

@endsection
