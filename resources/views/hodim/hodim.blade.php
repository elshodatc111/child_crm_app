@extends('layout.cdn1')
@section('title','Hodimlar')

@section('content')
<div id="app">
    @include('layout.menu')
    <div id="main">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Hodimlar</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="admin-tab" data-bs-toggle="tab" href="#admin" role="tab" aria-selected="true">Direktor & Menejer</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tarbiyachi-tab" data-bs-toggle="tab" href="#tarbiyachi" role="tab">Tarbiyachilar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="oshpazlar-tab" data-bs-toggle="tab" href="#oshpazlar" role="tab">Oshpazlar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="hodimlar-tab" data-bs-toggle="tab" href="#hodimlar" role="tab">Hodimlar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="arxiv-tab" data-bs-toggle="tab" href="#arxiv" role="tab">Arxiv Hodimlar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="vakansiya-tab" data-bs-toggle="tab" href="#vakansiya" role="tab">Vakansiya</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="new-vakansiya-tab" data-bs-toggle="tab" href="#new-vakansiya" role="tab">Yangi Vakansiya</a>
                        </li>
                    </ul>
                    <hr class="m-0 p-0">
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                            <p>1Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <div class="tab-pane fade" id="tarbiyachi" role="tabpanel" aria-labelledby="tarbiyachi-tab">
                            <p>2Integer interdum diam eleifend metus lacinia.</p>
                        </div>
                        <div class="tab-pane fade" id="oshpazlar" role="tabpanel" aria-labelledby="oshpazlar-tab">
                            <p>3Duis ultrices purus non eros fermentum hendrerit.</p>
                        </div>
                        <div class="tab-pane fade" id="hodimlar" role="tabpanel" aria-labelledby="hodimlar-tab">
                            <p>4Hodimlar ro'yxati yoki ma'lumotlari shu yerda.</p>
                        </div>
                        <div class="tab-pane fade" id="arxiv" role="tabpanel" aria-labelledby="arxiv-tab">
                            <p>5Arxiv Hodimlar ro'yxati yoki ma'lumotlari shu yerda.</p>
                        </div>
                        <div class="tab-pane fade" id="vakansiya" role="tabpanel" aria-labelledby="vakansiya-tab">
                            <p>6Vakansiya haqida ma'lumotlar shu yerda.</p>
                        </div>
                        <div class="tab-pane fade" id="new-vakansiya" role="tabpanel" aria-labelledby="new-vakansiya-tab">
                            <p>7Yangi vakansiya qo'shish uchun forma yoki ma'lumotlar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
