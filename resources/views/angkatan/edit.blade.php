@extends('shared.layout')

@section('title', 'Sunting Angkatan ' . $angkatan->tahun)

@section('content')

@include('shared.header')

@include('shared.navbar')

<div class="section">
    <div class="container">
        <nav class="breadcrumb box" aria-label="breadcrumbs">
            <ul>
                <li> <a href="{{ route('angkatan.index') }}"> Kelola Angkatan </a> </li>
                <li class="is-active"> <a> Sunting Angkatan {{ $angkatan->tahun }} </a> </li>
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
                        <i class="fa fa-plus"></i>
                    </span>
                    Sunting Angkatan
                </h1>
            </div>
            <div class="card-content">
                <form method="POST" action="{{ route('angkatan.update', $angkatan) }}">
                    @csrf
                    <div class="field">
                        <label for="tahun" class="label"> Tahun: </label>
                        <input value="{{ old('tahun', $angkatan->tahun) }}" type="number" name="tahun" class="input {{ $errors->first("tahun", "is-danger") }}">
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
</div>
@endsection