@extends('layout.cdn1')
@section('title','Статистика')
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
                            <h3>Статистика</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Статистика</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Yopish"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <div class="list-group list-group-horizontal text-center" id="inbox-menu">
                        <a href="{{ route('chart') }}" class="list-group-item list-group-item-action ">Kunlik</a>
                        <a href="{{ route('chart_oylik') }}" class="list-group-item list-group-item-action active">Oylik</a>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Bolalar haqida(Oylik)</h4>
                            </div>
                            <div class="card-body">
                                <div id="bolalar_bolalar"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#bolalar_bolalar"), {
                                            series: [{
                                                    name: 'Aktiv bolalar',
                                                    data: [8,10,12,33,45,64,75]
                                                },
                                                {
                                                    name: 'Kelgan bolalar',
                                                    data:  [9,5,16,33,45,64,75]
                                                },
                                                {
                                                    name: 'Kelmagan bolalar',
                                                    data:  [9,5,16,33,45,64,75]
                                                },
                                                {
                                                    name: 'Qo\'shimcha darslar',
                                                    data:  [9,5,16,33,45,64,75]
                                                },
                                            ],
                                            chart: {
                                                type: 'bar',
                                                height: 350
                                            },
                                            plotOptions: {
                                                bar: {
                                                    horizontal: false,
                                                    columnWidth: '55%',
                                                    endingShape: 'rounded'
                                                },
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                show: true,
                                                width: 2,
                                                colors: ['transparent']
                                            },
                                            xaxis: {
                                                categories:  [
                                                    @foreach ($monch as $item)
                                                        "{{ $item }}",
                                                    @endforeach
                                                ],
                                            },
                                            yaxis: {
                                                title: {
                                                    text: 'Посещаемости'
                                                }
                                            },
                                            fill: {
                                                opacity: 1
                                            },
                                            tooltip: {
                                                y: {
                                                    formatter: function(val) {
                                                    return ": " + val
                                                    }
                                                }
                                            }
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>To'lovlar(Oylik)</h4>
                            </div>
                            <div class="card-body">
                                <div id="kunliklar_tolovlar"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#kunliklar_tolovlar"), {
                                            series: [{
                                                    name: 'Naqt to\'lovlar',
                                                    data: [8,10,12,4,8,3,14]
                                                },
                                                {
                                                    name: 'Plastik to\'lovlar',
                                                    data:  [9,5,16,4,8,3,14]
                                                },
                                                {
                                                    name: 'Chegirmalar',
                                                    data:  [9,5,16,4,8,3,14]
                                                },
                                                {
                                                    name: 'Xarajatlar',
                                                    data:  [9,5,16,4,8,3,14]
                                                },
                                            ],
                                            chart: {
                                                type: 'bar',
                                                height: 350
                                            },
                                            plotOptions: {
                                                bar: {
                                                    horizontal: false,
                                                    columnWidth: '55%',
                                                    endingShape: 'rounded'
                                                },
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                show: true,
                                                width: 2,
                                                colors: ['transparent']
                                            },
                                            xaxis: {
                                                categories:  [
                                                    @foreach ($monch as $item)
                                                        "{{ $item }}",
                                                    @endforeach
                                                ],
                                            },
                                            yaxis: {
                                                title: {
                                                    text: 'Посещаемости'
                                                }
                                            },
                                            fill: {
                                                opacity: 1
                                            },
                                            tooltip: {
                                                y: {
                                                    formatter: function(val) {
                                                    return ": " + val
                                                    }
                                                }
                                            }
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Kassa(Oylik)</h4>
                            </div>
                            <div class="card-body">
                                <div id="kassa_tarih"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#kassa_tarih"), {
                                            series: [{
                                                    name: 'Naqt to\'lovlar',
                                                    data: [8,10,12,4,8,3,14]
                                                },
                                                {
                                                    name: 'Plastik to\'lovlar',
                                                    data:  [9,5,16,4,8,3,14]
                                                },
                                                {
                                                    name: 'Chegirmalar',
                                                    data:  [9,5,16,4,8,3,14]
                                                },
                                                {
                                                    name: 'Xarajatlar',
                                                    data:  [9,5,16,4,8,3,14]
                                                },
                                                {
                                                    name: 'Chiqimlar',
                                                    data:  [9,5,16,4,8,3,14]
                                                },
                                            ],
                                            chart: {
                                                type: 'bar',
                                                height: 350
                                            },
                                            plotOptions: {
                                                bar: {
                                                    horizontal: false,
                                                    columnWidth: '55%',
                                                    endingShape: 'rounded'
                                                },
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                show: true,
                                                width: 2,
                                                colors: ['transparent']
                                            },
                                            xaxis: {
                                                categories:  [
                                                    @foreach ($monch as $item)
                                                        "{{ $item }}",
                                                    @endforeach
                                                ],
                                            },
                                            yaxis: {
                                                title: {
                                                    text: 'Посещаемости'
                                                }
                                            },
                                            fill: {
                                                opacity: 1
                                            },
                                            tooltip: {
                                                y: {
                                                    formatter: function(val) {
                                                    return ": " + val
                                                    }
                                                }
                                            }
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Moliya(Oylik)</h4>
                            </div>
                            <div class="card-body">
                                <div id="oylik_bolalar"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#oylik_bolalar"), {
                                            series: [{
                                                    name: 'To\'lovlar',
                                                    data: [8,10,12,20,15,64,21]
                                                },
                                                {
                                                    name: 'Chegirmalar',
                                                    data:  [9,5,16,20,15,64,21]
                                                },
                                                {
                                                    name: 'Xarajatlar',
                                                    data:  [9,5,16,20,15,64,21]
                                                },
                                                {
                                                    name: 'Ish haqlari',
                                                    data:  [9,5,16,20,15,64,21]
                                                },
                                            ],
                                            chart: {
                                                type: 'bar',
                                                height: 350
                                            },
                                            plotOptions: {
                                                bar: {
                                                    horizontal: false,
                                                    columnWidth: '55%',
                                                    endingShape: 'rounded'
                                                },
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                show: true,
                                                width: 2,
                                                colors: ['transparent']
                                            },
                                            xaxis: {
                                                categories:  [
                                                    @foreach ($monch as $item)
                                                        "{{ $item }}",
                                                    @endforeach
                                                ],
                                            },
                                            yaxis: {
                                                title: {
                                                    text: 'Посещаемости'
                                                }
                                            },
                                            fill: {
                                                opacity: 1
                                            },
                                            tooltip: {
                                                y: {
                                                    formatter: function(val) {
                                                    return ": " + val
                                                    }
                                                }
                                            }
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
