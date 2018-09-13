@extends('shared.layout')

@section('title', 'Kelola Mahasiswa')

@section('content')

@include('shared.header')

@include('shared.navbar')

<div class="section">
    <div class="container">
        <nav class="breadcrumb box" aria-label="breadcrumbs">
            <ul>
                <li class="is-active"> <a> Kelola Mahasiswa </a> </li>
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
                        Tambahkan Mahasiswa
                    </h1>
                </div>
                <div class="card-content">
                    <form method="POST" action="{{ route('mahasiswa.create') }}">
                        @csrf

                        <div class="field">
                            <label for="NIM" class="label"> NIM: </label>
                            <input value="{{ old('NIM') }}" type="text" name="NIM" class="input {{ $errors->first("NIM", "is-danger") }}">
                            @if($errors->has("NIM"))
                            <p class="help is-danger"> {{ $errors->first("NIM") }} </p>
                            @endif
                        </div>

                        <div class="field">
                            <label for="angkatan_id" class="label"> Angkatan: </label>
                            <div class="select is-block">
                                <select name="angkatan_id" id="angkatan_id" style="width: 100%">
                                    @foreach ($angkatans as $angkatan)
                                    <option {{ old("angkatan_id") === $angkatan->id ? 'selected' : '' }} value="{{ $angkatan->id }}">
                                        {{ $angkatan->tahun }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
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
            <div class="card is-inline-block">
                <div class="card-header">
                    <h1 class="card-header-title">
                        <span class="icon mr-1">
                            <i class="fa fa-list"></i>
                        </span>
                        Daftar Seluruh Mahasiswa
                    </h1>
                </div>
    
                <div class="card-content">
                    <table class="table is-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> NIM </th>
                                <th> Angkatan </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mahasiswa)
                            <tr>
                                <td> {{ $mahasiswas->firstItem() + $loop->index }}. </td>
                                <td> {{ $mahasiswa->NIM }} </td>
                                <td> {{ $mahasiswa->angkatan }} </td>
                                <td>
                                    <form method="POST" class="is-inline-block" action="{{ route('mahasiswa.delete', $mahasiswa->id) }}">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button {{ $mahasiswa_nilai_counts->get($mahasiswa->id) > 0 ? 'disabled' : '' }} class="button is-danger">
                                            <span class="icon">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>

                                    <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="button is-dark">
                                        <span class="icon">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div>
                        {{ $mahasiswas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection