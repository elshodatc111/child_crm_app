@extends('layout.cdn2')
@section('title','Bola haqida')
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
                        <h3>Bola haqida</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('child') }}">Aktiv bolalar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bola haqida</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="list-group list-group-horizontal text-center" id="inbox-menu">
                    <a href="{{ route('child_show',$id) }}" class="list-group-item list-group-item-action active">Bola haqida</a>
                    <a href="{{ route('child_show_group',$id) }}" class="list-group-item list-group-item-action">Guruhlar tarixi</a>
                    <a href="{{ route('child_show_davomad',$id) }}" class="list-group-item list-group-item-action">Davomad</a>
                    <a href="{{ route('child_show_paymart',$id) }}" class="list-group-item list-group-item-action">To'lovlar tarixi</a>
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
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#tolovModal">
                                    <i class="bi bi-credit-card me-1"></i> To'lov
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="bi bi-pencil-square me-1"></i> Tahrirlash
                                </button>
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#updateGroupModal">
                                    <i class="bi bi-arrow-repeat me-1"></i> Guruh yangilash
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-info text-white w-100" data-bs-toggle="modal" data-bs-target="#newRelativeModal">
                                    <i class="bi bi-person-plus me-1"></i> Yangi qarindosh
                                </button>
                            </div>
                        </div>
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
<div class="modal fade" id="tolovModal" tabindex="-1" aria-labelledby="tolovModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="tolovModalLabel"><i class="bi bi-credit-card me-1"></i> To'lov</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        To'lov bilan bog'liq ma'lumotlar kiriting...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
        <button type="button" class="btn btn-success">Saqlash</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Tahrirlash -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil-square me-1"></i> Tahrirlash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Ma'lumotlarni taxrirlash uchun form...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
        <button type="button" class="btn btn-warning">Saqlash</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Guruh yangilash -->
<div class="modal fade" id="updateGroupModal" tabindex="-1" aria-labelledby="updateGroupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="updateGroupModalLabel"><i class="bi bi-arrow-repeat me-1"></i> Guruh yangilash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Guruhni yangilash bo‘yicha ma’lumotlar...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
        <button type="button" class="btn btn-primary">Yangilash</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Yangi qarindosh -->
<div class="modal fade" id="newRelativeModal" tabindex="-1" aria-labelledby="newRelativeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="newRelativeModalLabel"><i class="bi bi-person-plus me-1"></i> Yangi qarindosh</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Yangi qarindosh qo‘shish formasi...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
        <button type="button" class="btn btn-info text-white">Qo‘shish</button>
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
