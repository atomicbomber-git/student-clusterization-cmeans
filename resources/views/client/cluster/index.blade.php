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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa_clusters as $cluster)
                        <tr>
                            <td> {{ $cluster->tahun_mulai }}-{{ $cluster->tahun_selesai }} </td>
                            <td> {{ $cluster->ganjil_genap }} </td>
                            <td> {{ $cluster->IPK ?? '-' }} </td>
                            <td> {{ $cluster->IPS ?? '-' }} </td>
                            <td> {{ $cluster->cluster ?? '-' }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection