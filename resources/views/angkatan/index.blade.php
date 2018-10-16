@extends('shared.layout')

@section('title', 'Kelola Angkatan')

@section('content')

@include('shared.header')

@include('shared.navbar')

<div class="section">
    <div class="container">
        <nav class="breadcrumb box" aria-label="breadcrumbs">
            <ul>
                <li class="is-active"> <a> Kelola Angkatan </a> </li>
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

        <div class="row">
            <div class="card is-inline-block">
                <div class="card-header">
                    <h1 class="card-header-title">
                        <span class="icon mr-1">
                            <i class="fa fa-plus"></i>
                        </span>
                        Tambahkan Angkatan
                    </h1>
                </div>
                <div class="card-content">
                    <form method="POST" action="{{ route('angkatan.create') }}">
                        @csrf

                        <div class="field">
                            <label for="tahun" class="label"> Tahun: </label>
                            <input value="{{ old('tahun') }}" type="number" name="tahun" class="input {{ $errors->first("tahun", "is-danger") }}">
                            @if($errors->has("tahun"))
                            <p class="help is-danger"> {{ $errors->first("tahun") }} </p>
                            @endif
                        </div>

                        <div class="field has-text-right">
                            <button class="button is-primary is-small">
                                <span> Tambah </span>
                                <span class="icon">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        <div class="row mt-8">
            <div class="card is-inline-block" style="width: 40rem">
                <div class="card-header">
                    <h1 class="card-header-title">
                        <span class="icon mr-1">
                            <i class="fa fa-list"></i>
                        </span>
                        Daftar Seluruh Angkatan
                    </h1>
                </div>
    
                <div class="card-content">
                    <table class="table is-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Tahun </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($angkatans as $angkatan)
                            <tr>
                                <td> {{ $loop->iteration }}. </td>
                                <td> {{ $angkatan->tahun }} </td>
                                <td>
                                    <form method="POST" class="is-inline-block" action="{{ route('angkatan.delete', $angkatan) }}">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button {{ $angkatan->mahasiswas_count > 0 ? 'disabled' : '' }} class="button is-danger">
                                            <span class="icon">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>

                                    <a href="{{ route('angkatan.edit', $angkatan) }}" class="button is-dark">
                                        <span class="icon">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                    </a>
                                </td>
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