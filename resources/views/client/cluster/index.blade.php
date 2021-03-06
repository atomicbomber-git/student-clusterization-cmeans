@extends('shared.layout')

@section('title', 'Kluster Mahasiswa')

@section('content')

@include('shared.header')

@include('shared.navbar')

<div class="section">
    <div class="container">
        @include('shared.account')

        @if(session('message.success'))
        <article class="message is-success">
            <div class="message-body">
                {{ session('message.success') }}
            </div>
        </article>
        @endif

        <div class="card is-inline-block">
            <div class="card-header">
                <h1 class="card-header-title">
                    <span class="icon mr-1">
                        <i class="fa fa-list"></i>
                    </span>
                    Daftar Kluster Anda
                </h1>
            </div>
            <div class="card-content">
                <table class="table is-striped">
                    <thead>
                        <tr>
                            <th> Tahun Ajaran </th>
                            <th> Ganjil / Genap </th>
                            <th> IPK </th>
                            <th> IPS </th>
                            <th> Kluster </th>
                            <th> Rata-Rata Kluster </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa_clusters as $cluster)
                        <tr {{ !empty($smallest_average_clusters[$cluster->tahun_ajaran_id.'-'.$cluster->ganjil_genap]) && $smallest_average_clusters[$cluster->tahun_ajaran_id.'-'.$cluster->ganjil_genap] == $cluster->cluster ? "class=has-text-danger" : "" }}>
                            <td> {{ $cluster->tahun_mulai }}-{{ $cluster->tahun_selesai }} </td>
                            <td> {{ $cluster->ganjil_genap }} </td>
                            <td> {{ $cluster->IPK ?? '-' }} </td>
                            <td> {{ $cluster->IPS ?? '-' }} </td>
                            <td> {{ $cluster->cluster ?? '-' }} </td>
                            <td>
                                {{ number_format($cluster_averages[$cluster->tahun_ajaran_id][auth()->user()->mahasiswa->angkatan_id][$cluster->ganjil_genap][$cluster->cluster][0]->avg ?? '0', 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection