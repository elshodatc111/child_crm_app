@extends('layout.cdn1')
@section('title','Yangi Guruh')
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
                        <h3>Yangi Guruh</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Yangi Guruh</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body">
                <div class="list-group list-group-horizontal mb-4" id="inbox-menu">
                    <a href="{{ route('groups') }}" class="list-group-item list-group-item-action ">Aktiv guruhlar</a>
                    <a href="{{ route('groups_arxiv') }}" class="list-group-item list-group-item-action">Arxiv guruhlar</a>
                    <a href="{{ route('groups_new') }}" class="list-group-item list-group-item-action active">Yangi guruh</a>
                </div>
                <form action="{{ route('groups_create') }}" method="post">
                    @csrf
                    <label for="group_name">Guruh nomi</label>
                    <input type="text" class="form-control my-2" name="group_name" required>
                    <label for="price_month">Guruh uchun oylik to'lov</label>
                    <input type="text" class="form-control my-2 price-format" name="price_month" required>
                    <label for="price_day">Guruh uchun kunlik to'lov</label>
                    <input type="text" class="form-control my-2 price-format" name="price_day" required>
                    <label for="user_id1">Katta tarbiyachi</label>
                    <select name="user_id1" id="" class="form-select my-2" required>
                        <option value="">Tanlang</option>
                        @foreach ($katta as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <label for="user_id2">Kichik tarbiyachi</label>
                    <select name="user_id2" id="" class="form-select my-2" required>
                        <option value="">Tanlang</option>
                        @foreach ($kichik as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <div class="w-100 text-center mt-2">
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>
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
