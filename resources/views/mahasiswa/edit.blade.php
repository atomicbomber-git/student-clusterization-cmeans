@extends('shared.layout')

@section('title', 'Sunting Mahasiswa ' . $mahasiswa->NIM)

@section('content')

@include('shared.header')

@include('shared.navbar')

<div class="section">
    <div class="container">
        <nav class="breadcrumb box" aria-label="breadcrumbs">
            <ul>
                <li> <a href="{{ route('mahasiswa.index') }}"> Kelola Mahasiswa </a> </li>
                <li class="is-active"> <a> Sunting Mahasiswa {{ $mahasiswa->NIM }} </a> </li>
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
                    Sunting Mahasiswa {{ $mahasiswa->NIM }}
                </h1>
            </div>
            <div class="card-content">
                <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}">
                        @csrf
    
                    <div class="field">
                        <label for="NIM" class="label"> NIM: </label>
                        <input value="{{ old('NIM', $mahasiswa->NIM) }}" type="text" name="NIM" class="input {{ $errors->first("NIM", "is-danger") }}">
                        @if($errors->has("NIM"))
                        <p class="help is-danger"> {{ $errors->first("NIM") }} </p>
                        @endif
                    </div>

                    <div class="field">
                        <label for="nama" class="label"> Nama: </label>
                        <input value="{{ old('nama', $mahasiswa->nama) }}" type="text" name="nama" class="input {{ $errors->first("nama", "is-danger") }}">
                        @if($errors->has("nama"))
                        <p class="help is-danger"> {{ $errors->first("nama") }} </p>
                        @endif
                    </div>

                    <div class="field">
                        <label for="angkatan_id" class="label"> Angkatan: </label>
                        <div class="select is-block">
                            <select name="angkatan_id" id="angkatan_id" style="width: 100%">
                                @foreach ($angkatans as $angkatan)
                                <option {{ old("angkatan_id", $mahasiswa->angkatan_id) === $angkatan->id ? 'selected' : '' }} value="{{ $angkatan->id }}">
                                    {{ $angkatan->tahun }}
                                </option>
                                @endforeach
                            </select>
                        </div>
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