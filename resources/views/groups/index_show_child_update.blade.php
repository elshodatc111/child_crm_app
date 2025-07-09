@extends('layout.cdn3')
@section('title','Bolaning guruhdagi holatini taxrirlash')
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
                        <h3>Bolaning guruhdagi holatini taxrirlash</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('groups') }}">Guruhlar</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('groups_show_child',$group_id) }}">Guruhdagi bolalar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Taxrirlash</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="card-title">Guruhdagi bola haqida</h5>
                        <table class="table table-bordered taxt-center">
                            <tr>
                                <td>Guruh:</td>
                                <td>{{ $child_about['group_name'] }}</td>
                            </tr>
                            <tr>
                                <td>Bola:</td>
                                <td>{{ $child_about['child_name'] }}</td>
                            </tr>
                            <tr>
                                <td>Guruhga qo'shildi:</td>
                                <td>{{ $child_about['start_data'] }}</td>
                            </tr>
                            <tr>
                                <td>Izoh:</td>
                                <td>{{ $child_about['start_izoh'] }}</td>
                            </tr>
                            <tr>
                                <td>Meneger:</td>
                                <td>{{ $child_about['start_meneger'] }}</td>
                            </tr>
                            <tr>
                                <td>To'lov turi:</td>
                                <td>
                                    @if($child_about['paymart_type']=='monch')
                                        Oylik
                                    @else
                                        Kunlik
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @if($child_about['status']=='active')
            <div class="col-lg-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="card-title">To'lov turini o'zgartirish</h5>
                        <form action="{{ route('groups_show_child_paymart_update') }}" method="post">
                            @csrf
                            <input type="hidden" name="child_id" value="{{ $child_about['child_id'] }}">
                            <input type="hidden" name="group_id" value="{{ $child_about['group_id'] }}">
                            <label for="paymart_type">To'lov turini tanlang</label>
                            @php
                                $selected = $child_about['paymart_type'] ?? '';
                            @endphp
                            <select name="paymart_type" class="form-select my-2" required>
                                <option value="">Tanlang</option>
                                <option value="day" {{ $selected == 'day' ? 'selected' : '' }}>Kunlik</option>
                                <option value="monch" {{ $selected == 'monch' ? 'selected' : '' }}>Oylik</option>
                            </select>
                            <label for="comments">O'zgartirish sababi</label>
                            <textarea name="comments" required class="form-control my-2"></textarea>
                            <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="card-title">Guruhdan o'chirish</h5>
                        <form action="{{ route('groups_show_child_delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="child_id" value="{{ $child_about['child_id'] }}">
                            <input type="hidden" name="group_id" value="{{ $child_about['group_id'] }}">
                            <input type="hidden" name="status" value="{{ $child_about['status'] }}">
                            <label for="comments">Guruhdan o'chirish sababi</label>
                            <textarea name="comments" required class="form-control my-2"></textarea>
                            <button type="submit" class="btn btn-danger w-100">O'chirish</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
