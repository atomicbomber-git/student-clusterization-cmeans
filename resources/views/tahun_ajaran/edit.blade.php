@extends('shared.layout')

@section('title', 'Sunting Tahun Ajaran ' . $tahun_ajaran->tahun_mulai . '-' . $tahun_ajaran->tahun_selesai)

@section('content')

@include('shared.header')

@include('shared.navbar')

<div class="section">
    <div class="container">

        <nav class="breadcrumb box" aria-label="breadcrumbs">
            <ul>
                <li> <a href="{{ route('tahun_ajaran.index') }}"> Kelola Tahun Ajaran </a> </li>
                <li class="is-active"> <a> Sunting Tahun Ajaran {{ $tahun_ajaran->tahun_mulai . '-' . $tahun_ajaran->tahun_selesai }} </a> </li>
            </ul>
        </nav>

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
                        <i class="fa fa-pencil"></i>
                    </span>
                    Sunting Tahun Ajaran
                </h1>
            </div>
            <div class="card-content">
                <form method="POST" action="{{ route('tahun_ajaran.update', $tahun_ajaran) }}">
                    @csrf
                    <div class="field">
                        <label for="tahun_mulai" class="label"> Tahun Mulai: </label>
                        <input value="{{ old('tahun_mulai', $tahun_ajaran->tahun_mulai) }}" type="number" name="tahun_mulai" class="input {{ $errors->first("tahun_mulai", "is-danger") }}">
                        @if($errors->has("tahun_mulai"))
                        <p class="help is-danger"> {{ $errors->first("tahun_mulai") }} </p>
                        @endif
                    </div>

                    <div class="field">
                        <label for="tahun_selesai" class="label"> Tahun Selesai: </label>
                        <input value="{{ old('tahun_selesai', $tahun_ajaran->tahun_selesai) }}" type="number" name="tahun_selesai" class="input {{ $errors->first("tahun_selesai", "is-danger") }}">
                        @if($errors->has("tahun_selesai"))
                        <p class="help is-danger"> {{ $errors->first("tahun_selesai") }} </p>
                        @endif
                    </div>

                    <div class="field has-text-right">
                        <button class="button is-primary is-small">
                            <span> Perbarui </span>
                            <span class="icon">
                                <i class="fa fa-check"></i>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection