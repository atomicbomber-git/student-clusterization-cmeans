@extends('shared.layout')

@section('title', 'Cluster Mahasiswa')

@section('content')

@include('shared.header')

@include('shared.navbar')

<div class="section">
    <div class="container">
        <nav class="breadcrumb box" aria-label="breadcrumbs">
            <ul>
                <li class="is-active"> <a> Cluster Mahasiswa </a> </li>
            </ul>
        </nav>

        @include('shared.account')

        @if(session('message.success'))
        <article class="message is-success">
            <div class="message-body">
                {{ session('message.success') }}
            </div>
        </article>
        @endif

        <h1 class="title is-3">
            {{ $mahasiswa->user->name }} ({{ $mahasiswa->NIM }})
        </h1>

        <div class="row mt-8">
            <div class="card is-inline-block">
                <div class="card-header">
                    <h1 class="card-header-title">
                        <span class="icon mr-1">
                            <i class="fa fa-list"></i>
                        </span>
                        Daftar Cluster Mahasiswa
                    </h1>
                </div>

                <div class="card-content">
                    <table class="table is-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Tahun Ajaran </th>
                                <th> Ganjil / Genap </th>
                                <th> IPK </th>
                                <th> IPS </th>
                                <th> <em> Cluster </em> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa->nilais as $nilai)
                            <tr>
                                <td> {{ $loop->iteration }}. </td>
                                <td> {{ $nilai->tahun_ajaran->nama() }} </td>
                                <td> {{ $nilai->ganjil_genap }} </td>
                                <td> {{ $nilai->IPK }} </td>
                                <td> {{ $nilai->IPS }} </td>
                                <td> {{ $nilai->cluster ?? "-" }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
