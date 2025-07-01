@extends('layout.cdn1')
@section('title','Tark etganlar')
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
                        <h3>Tark etganlar</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item " aria-current="page">Tark etganlar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="list-group list-group-horizontal mb-4" id="inbox-menu">
                    <a href="{{ route('child') }}" class="list-group-item list-group-item-action ">Aktiv bolalar</a>
                    <a href="{{ route('child_end') }}" class="list-group-item list-group-item-action active">Tark etgan bolalar</a>
                    <a href="{{ route('child_debit') }}" class="list-group-item list-group-item-action">Qarzdorlar</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Ismi</th>
                                <th>Yoshi</th>
                                <th>Balans</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($children as $key => $child)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td style="text-align:left"><a href="#">{{ $child->name }}</a></td>
                                    <td>
                                        @php
                                            $age = \Carbon\Carbon::parse($child->birthday)->age;
                                        @endphp
                                        {{ $age }} yosh
                                    </td>
                                    <td>
                                        @if($child->balans < 0)
                                            <span class="badge bg-danger">{{ number_format($child->balans, 0, ',', ' ') }} so‘m</span>
                                        @elseif($child->balans == 0)
                                            <span class="badge bg-secondary">0 so‘m</span>
                                        @else
                                            <span class="badge bg-success">{{ number_format($child->balans, 0, ',', ' ') }} so‘m</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Ma'lumot topilmadi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="w-100" style="text-align:right">
                    <div class="">
                        {{ $children->appends(request()->query())->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
