@extends('layout.cdn1')
@section('title','Kassa')
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
                            <h3>Kassa</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kassa</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm border-start border-4 border-primary">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3 text-primary">
                                <i class="bi bi-cash fs-1"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Balansda (Naqt)</h6>
                                <h5 class="mb-0 fw-bold">120,000 so'm</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm border-start border-4 border-info">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3 text-info">
                                <i class="bi bi-credit-card fs-1"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Balansda (Plastik)</h6>
                                <h5 class="mb-0 fw-bold">350,000 so'm</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm border-start border-4 border-success">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3 text-success">
                                <i class="bi bi-currency-exchange fs-1"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Exson (Naqt)</h6>
                                <h5 class="mb-0 fw-bold">80,000 so'm</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm border-start border-4 border-danger">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3 text-danger">
                                <i class="bi bi-wallet2 fs-1"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Exson (Plastik)</h6>
                                <h5 class="mb-0 fw-bold">112,000 so'm</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Moliya tarixi (Oxirgi 45 kun)</h5>
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chiqimModal">
                                <i class="bi bi-plus-circle me-1"></i> Balansdan chiqim
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover mb-0 text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Summa</th>
                                <th>To‘lov turi</th>
                                <th>Izoh</th>
                                <th>Meneger</th>
                                <th>Tasdiqladi</th>
                                <th>Vaqt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><span class="badge bg-success">Kirim</span></td>
                                <td>50,000 so'm</td>
                                <td>Naqt</td>
                                <td>Ota-ona to‘lovi</td>
                                <td>Islom Karimov</td>
                                <td>Admin 1</td>
                                <td>2025-06-25 14:22</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><span class="badge bg-danger">Chiqim</span></td>
                                <td>30,000 so'm</td>
                                <td>Plastik</td>
                                <td>Ofis harajatlari</td>
                                <td>Madina Qodirova</td>
                                <td>Admin 2</td>
                                <td>2025-06-25 09:10</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="chiqimModal" tabindex="-1" aria-labelledby="chiqimModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <form action="#" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="chiqimModalLabel">Balansdan chiqim qilish</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Chiqim summasi</label>
                                    <input type="number" class="form-control" name="amount" id="amount" required>
                                </div>
                                <div class="mb-3">
                                    <label for="payment_type" class="form-label">Chiqim turi</label>
                                    <select class="form-select" name="payment_type" id="payment_type" required>
                                        <option value="Naqt">Naqt</option>
                                        <option value="Plastik">Plastik</option>
                                        <option value="Plastik">Exson(Naqt)</option>
                                        <option value="Plastik">Exson(Plastik)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="note" class="form-label">Izoh</label>
                                    <textarea class="form-control" name="note" id="note" rows="2" placeholder="Masalan: Kommunal to‘lovlar..." required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Chiqim qilish</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
