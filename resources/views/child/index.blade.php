@extends('layout.cdn1')
@section('title','Bolalar')
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
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Bolalar</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bolalar</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Aktiv Bolalar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bitiruvchilar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Qarzdorlar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Vakansiya</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Yangi Vakansiya</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Graiden</td>
                                            <td>vehicula.aliquet@semconsequat.co.uk</td>
                                            <td>076 4820 8838</td>
                                            <td>Offenburg</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Leonard</td>
                                            <td>blandit.enim.consequat@mollislectuspede.net</td>
                                            <td>0800 1111</td>
                                            <td>Lobbes</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hamilton</td>
                                            <td>mauris@diam.org</td>
                                            <td>0800 256 8788</td>
                                            <td>Sanzeno</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Harding</td>
                                            <td>Lorem.ipsum.dolor@etnetuset.com</td>
                                            <td>0800 1111</td>
                                            <td>Obaix</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Emmanuel</td>
                                            <td>eget.lacus.Mauris@feugiatSednec.org</td>
                                            <td>(016977) 8208</td>
                                            <td>Saint-Remy-Geest</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="table-responsive">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Graiden</td>
                                            <td>vehicula.aliquet@semconsequat.co.uk</td>
                                            <td>076 4820 8838</td>
                                            <td>Offenburg</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Leonard</td>
                                            <td>blandit.enim.consequat@mollislectuspede.net</td>
                                            <td>0800 1111</td>
                                            <td>Lobbes</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hamilton</td>
                                            <td>mauris@diam.org</td>
                                            <td>0800 256 8788</td>
                                            <td>Sanzeno</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Harding</td>
                                            <td>Lorem.ipsum.dolor@etnetuset.com</td>
                                            <td>0800 1111</td>
                                            <td>Obaix</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Emmanuel</td>
                                            <td>eget.lacus.Mauris@feugiatSednec.org</td>
                                            <td>(016977) 8208</td>
                                            <td>Saint-Remy-Geest</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <p class="mt-2">Duis ultrices purus non eros fermentum hendrerit. Aenean ornare interdum
                                viverra. Sed ut odio velit. Aenean eu diam
                                dictum nibh rhoncus mattis quis ac risus. Vivamus eu congue ipsum. Maecenas id
                                sollicitudin ex. Cras in ex vestibulum,
                                posuere orci at, sollicitudin purus. Morbi mollis elementum enim, in cursus sem
                                placerat ut.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
