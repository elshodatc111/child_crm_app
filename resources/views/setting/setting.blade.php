@extends('layout.cdn1')
@section('title','Sozlamalar')
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
                            <h3>Sozlamalar</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Sozlamalar</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card widget-todo">
                <div class="card-header">
                    <h4 class="card-title d-flex">
                        <i class="bx bx-check font-medium-5 pl-25 pr-75"></i>Sozlamalar
                    </h4>
                    <form action="{{  route('setting_update')  }}" method="post">
                        @csrf
                        <div class="w-100 my-2">
                            <input type="checkbox" name="message_send" id="message_send"
                                @if($Setting['message_send']=='true')
                                    @checked(true)
                                @else
                                    @checked(false)
                                @endif
                                >
                            <label for="message_send">SMS xabarlarni yuborishga ruxsat berilsin</label>
                        </div>
                        <div class="w-100 my-2">
                            <input type="checkbox" name="exson_type_naqt" id="exson_type_naqt"
                                @if($Setting['exson_type_naqt']=='true' && $Setting['exson_type_plastik']=='false')
                                    @checked(true)
                                @else
                                    @checked(false)
                                @endif
                                >
                            <label for="exson_type_naqt">Exson uchun faqat naqd pul ajratish</label>
                        </div>
                        <div class="w-100 my-2">
                            <input type="checkbox" name="exson_type_plastik" id="exson_type_plastik"
                                @if($Setting['exson_type_naqt']=='false' && $Setting['exson_type_plastik']=='true')
                                    @checked(true)
                                @else
                                    @checked(false)
                                @endif
                                >
                            <label for="exson_type_plastik">Exson uchun faqat plastik (karta) orqali ajratish</label>
                        </div>
                        <div class="w-100 my-2">
                            <input type="checkbox" name="exson_gibrid" id="exson_gibrid"
                                @if($Setting['exson_type_naqt']=='true' && $Setting['exson_type_plastik']=='true')
                                    @checked(true)
                                @else
                                    @checked(false)
                                @endif
                                >
                            <label for="exson_gibrid">
                                Exsonda naqd to‘lovdan faqat naqd, plastik to‘lovdan faqat plastik tarzda mablag‘ ajratilsin (belgilangan summadan).
                            </label>
                        </div>
                        <div class="w-100 my-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Saqlash
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
