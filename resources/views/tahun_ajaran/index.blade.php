@extends('shared.layout')

@section('title', 'Kelola Tahun Ajaran')

@section('content')

@include('shared.header')

@include('shared.navbar')

<div class="section">
    <div class="container">
        <nav class="breadcrumb box" aria-label="breadcrumbs">
            <ul>
                <li class="is-active"> <a> Kelola Tahun Ajaran </a> </li>
            </ul>
        </nav>

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
                        Tambahkan Tahun Ajaran Baru
                    </h1>
                </div>
                <div class="card-content">
                    <form method="POST" action="{{ route('tahun_ajaran.create') }}">
                        @csrf

                        <div class="field">
                            <label for="tahun_mulai" class="label"> Tahun Mulai: </label>
                            <input value="{{ old('tahun_mulai') }}" type="text" name="tahun_mulai" class="input {{ $errors->first("tahun_mulai", "is-danger") }}">
                            @if($errors->has("tahun_mulai"))
                            <p class="help is-danger"> {{ $errors->first("tahun_mulai") }} </p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="tahun_selesai" class="label"> Tahun Selesai: </label>
                            <input value="{{ old('tahun_selesai') }}" type="text" name="tahun_selesai" class="input {{ $errors->first("tahun_selesai", "is-danger") }}">
                            @if($errors->has("tahun_selesai"))
                            <p class="help is-danger"> {{ $errors->first("tahun_selesai") }} </p>
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
                        Daftar Seluruh Tahun Ajaran
                    </h1>
                </div>
    
                <div class="card-content">
                    <table class="table is-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Tahun Ajaran </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tahun_ajarans as $tahun_ajaran)
                            <tr>
                                <td> {{ $loop->iteration }}. </td>
                                <td> {{ $tahun_ajaran->tahun_mulai . '-' . $tahun_ajaran->tahun_selesai }} </td>
                                <td>
                                    <form method="POST" class="is-inline-block" action="{{ route('tahun_ajaran.delete', $tahun_ajaran) }}">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button {{ $tahun_ajaran->nilais_count !== 0 ? 'disabled' : '' }} class="button is-danger">
                                            <span class="icon">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>

                                    <a href="{{ route('tahun_ajaran.edit', $tahun_ajaran) }}" class="button is-dark">
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