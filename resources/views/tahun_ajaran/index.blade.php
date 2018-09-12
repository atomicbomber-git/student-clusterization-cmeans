@extends('shared.layout')

@section('content')

<section class="hero is-dark">
    <div class="hero-body">
        <div class="container">
        <h1 class="title">
            Klusterisasi Mahasiswa dengan Algoritma C-Means Clusterization
        </h1>
        <h2 class="subtitle">
            Berdasarkan Nilai IPK dan IPS per Angkatan
        </h2>
        </div>
    </div>
</section>



<div class="container">

    @include('shared.navbar')

    <div class="section">
        <div class="card" style="display: inline-block">
            <div class="card-header">
                <h1 class="card-header-title">
                    <span class="icon">
                        <i class="fa fa-list"></i>
                    </span>
                    
                    Daftar Seluruh Tahun Ajaran
                </h1>
            </div>

            <div class="card-content">
            </div>
        </div>
        
    </div>
</div>
@endsection