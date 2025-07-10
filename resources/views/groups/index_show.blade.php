@extends('layout.cdn2')
@section('title','Guruh haqida')
@section('content')

<style>
    div.dataTables_filter {
        text-align: right !important;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .list-group-horizontal .list-group-item {
        flex: 1;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 0;
    }

    .list-group-horizontal .list-group-item:first-child {
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
    }

    .list-group-horizontal .list-group-item:last-child {
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }

    .table td, .table th {
        vertical-align: middle;
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
                        <h3>Guruh haqida</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('groups') }}">Aktiv Guruhlar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Guruh haqida</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="list-group list-group-horizontal" id="inbox-menu">
                    <a href="{{ route('groups_show',$id) }}" class="list-group-item list-group-item-action active">Guruh haqida</a>
                    <a href="{{ route('groups_show_child',$id) }}" class="list-group-item list-group-item-action ">Guruhdagi bolalar</a>
                    <a href="{{ route('groups_show_davomad',$id) }}" class="list-group-item list-group-item-action ">Guruh davomadi</a>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-center rounded-top-4">
                        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Guruh haqida</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-hover align-middle">
                            <tbody>
                                <tr>
                                    <th class="text-muted">Guruh nomi</th>
                                    <td class="text-end fw-semibold">{{ $about['group_name'] }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Narxi (oy)</th>
                                    <td class="text-end fw-semibold">{{ number_format($about['price_month'], 0, '.', ' ') }} so‘m</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Narxi (kun)</th>
                                    <td class="text-end fw-semibold">{{ number_format($about['price_day'], 0, '.', ' ') }} so‘m</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Tarbiyachi</th>
                                    <td class="text-end">{{ $about['tarbiyachi'] }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Yordamchi tarbiyachi</th>
                                    <td class="text-end">{{ $about['yordamchi'] }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Guruh holati</th>
                                    <td class="text-end">
                                        @if($about['status']=='true')
                                            <span class="badge bg-success">Aktiv</span>
                                        @else
                                            <span class="badge bg-danger">Yakunlangan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Ish kunlari</th>
                                    <td class="text-end">
                                        @if($about['group_type']=='olti')
                                            Haftasiga 6 kunlik
                                        @else
                                            Haftasiga 5 kunlik
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Meneger</th>
                                    <td class="text-end">{{ $about['meneger'] }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Yaratilgan sana</th>
                                    <td class="text-end">{{ $about['created_at'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row g-3">
                            <div class="col-6">
                                <button class="btn btn-outline-primary w-100 py-3 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#editGroupModal">
                                    <i class="bi bi-pencil-square me-1"></i> Guruhni tahrirlash
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-success w-100 py-3 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#takeAttendanceModal">
                                    <i class="bi bi-check2-square me-1"></i> Davomad olish
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-warning w-100 py-3 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#changeMainModal">
                                    <i class="bi bi-person-gear me-1"></i> Tarbiyachini almashtirish
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-secondary w-100 py-3 rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#changeHelperModal">
                                    <i class="bi bi-person-gear me-1"></i> Yordamchini almashtirish
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mx-auto">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-center rounded-top-4">
                        <h5 class="mb-0">Joriy oy ish kunlari ({{ $ishKunlarSoni }} kun)</h5>
                    </div>
                    <div class="card-body">
                        <table class="table text-center table-bordered" style="font-size:12px">
                            <thead>
                                <tr>
                                    <th class="text-center px-3">#</th>
                                    <th class="text-center px-3">Hafta kuni</th>
                                    <th class="text-center px-3">Sana</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $today = \Carbon\Carbon::today();
                                @endphp
                                @foreach ($ishKunlar as $item)
                                    @php
                                        $sana = \Carbon\Carbon::parse($item['sanasi']);
                                        $badgeClass = '';
                                        if ($sana->isToday()) {
                                            $badgeClass = 'text-warning'; // bugungi kun: sariq
                                        } elseif ($sana->isPast()) {
                                            $badgeClass = 'text-success'; // o‘tib ketgan: qizil
                                        } else {
                                            $badgeClass = 'text-secondary'; // kelajak: ko‘k
                                        }
                                    @endphp
                                    <tr class="p-0 m-0">
                                        <td class="p-0 m-0">{{ $loop->index + 1 }}</td>
                                        <td class="p-0 m-0">
                                            <span class="badge p-0 m-0 {{ $badgeClass }} px-3 py-2 rounded-pill">
                                                {{ $item['hafta_kuni'] }}
                                            </span>
                                        </td>
                                        <td class="p-0 m-0">
                                            <span class="badge p-0 m-0 {{ $badgeClass }} px-3 py-2 rounded-pill">
                                                {{ $item['sanasi'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
    <!-- Guruhni tahrirlash -->
    <div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupModalLabel">
                        Guruhni tahrirlash
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('groups_updates') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <div class="mb-3">
                            <label for="group_name" class="form-label">Guruh nomi</label>
                            <input type="text" name="group_name" id="group_name" value="{{ $about['group_name'] }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="price_month" class="form-label">Guruh narxi (Oy)</label>
                            <input type="text" name="price_month" id="price_month" class="form-control price-format" value="{{ number_format($about['price_month'], 0, '.', ' ') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="price_day" class="form-label">Guruh narxi (Kun)</label>
                            <input type="text" name="price_day" id="price_day" value="{{ number_format($about['price_day'], 0, '.', ' ') }}" class="form-control price-format" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Guruh holati</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="true" {{ $about['status'] == 'true' ? 'selected' : '' }}>Aktiv</option>
                                <option value="false" {{ $about['status'] == 'false' ? 'selected' : '' }}>Yakunlangan</option>
                            </select>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> O'zgarishlarni saqlash
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!-- Davomad olish -->
    <div class="modal fade" id="takeAttendanceModal" tabindex="-1" aria-labelledby="takeAttendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="takeAttendanceModalLabel">
                        Davomad olish
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <form action="{{ route('groups_create_davomat') }}" method="POST">
                    @csrf
                    <input type="hidden" name="group_id" value="{{ $id }}">
                    <div class="modal-body">
                        @if($davomadDay=='false')
                        <p class="text-danger m-0 p-0 w-100 text-center">Davomad 1 ish kunida faqat 1 marta olish mumkun.</p>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Bola ismi</th>
                                        <th>Davomad holati</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($children as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td style="text-align:left">
                                                {{ $item['child_name'] }}
                                                (
                                                    @if($item['paymart_type'] == 'monch')
                                                        Oylik to'lov
                                                    @else
                                                        Kunlik to'lov
                                                    @endif
                                                )
                                            </td>
                                            <td>
                                                <select name="attendance[{{ $item['child_id'] }}]" class="form-select" required>
                                                    <option value="">Tanlang</option>
                                                    <option value="keldi">✅ Keldi</option>
                                                    <option value="kelmadi">❌ Kelmadi</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="text-success m-0 p-0 w-100 text-center">Bugungi kun uchun davomad olingan.</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if($davomadDay=='false')
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-save me-1"></i> Davomadni saqlash
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- Tarbiyachini almashtirish -->
    <div class="modal fade" id="changeMainModal" tabindex="-1" aria-labelledby="changeMainModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="changeMainModalLabel">Tarbiyachini almashtirish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('groups_updates_tarbiyachi') }}" method="post">
                    @csrf
                    <label for="user_id">Yangi tarbiyachini tanlang</label>
                    <input type="hidden" name="id" value="{{ $id }}">
                    <select name="user_id" class="form-select my-2" required>
                        <option value="">Tanlang...</option>
                        @foreach ($tarbiyachilar as $item)
                            <option value="{{ $item['user_id'] }}">{{ $item['user_name'] }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary w-100 mt-2" type="submit">Saqlash</button>
                </form>
            </div>
            </div>
        </div>
    </div>

<!-- Yordamchini almashtirish -->
    <div class="modal fade" id="changeHelperModal" tabindex="-1" aria-labelledby="changeHelperModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeHelperModalLabel">Yordamchini almashtirish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('groups_updates_yordamchi') }}" method="post">
                        @csrf
                        <label for="user_id">Yangi yordamchi tarbiyachini tanlang</label>
                        <input type="hidden" name="id" value="{{ $id }}">
                        <select name="user_id" class="form-select my-2" required>
                            <option value="">Tanlang...</option>
                            @foreach ($yordamchilar as $item)
                                <option value="{{ $item['user_id'] }}">{{ $item['user_name'] }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary w-100 mt-2" type="submit">Saqlash</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    document.querySelectorAll('.price-format').forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = input.value.replace(/\D/g, '');
            if (value) {
                input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
            } else {
                input.value = '';
            }
        });
        input.addEventListener('blur', function() {
            input.value = input.value.trim();
        });
    });
</script>
@endsection
