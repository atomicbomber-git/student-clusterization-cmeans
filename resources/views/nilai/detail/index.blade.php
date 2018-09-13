@extends('shared.layout')

@section('title', 'Nilai Mahasiswa Angkatan ... Tahun Ajaran ... Semester')

@section('content')

@include('shared.header')
@include('shared.navbar')

<div class="section">
    <div class="container">
        <nav class="breadcrumb box" aria-label="breadcrumbs">
            <ul>
                <li> <a href="{{ route('nilai.index') }}"> Kelola Nilai </a> </li>
                <li class="is-active">
                    <a>
                        Nilai Mahasiswa Angkatan {{ $angkatan->tahun }}
                        Tahun Ajaran {{ $tahun_ajaran->nama() }}
                        Semester {{ $ganjil_genap }}
                    </a>
                </li>
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
                        <i class="fa fa-list"></i>
                    </span>
                    Nilai Mahasiswa Angkatan {{ $angkatan->tahun }} Tahun Ajaran {{ $tahun_ajaran->nama()  }} Semester {{ $ganjil_genap }}
                </h1>
            </div>
            <div class="card-content">
                <form method="POST" action="{{ route('nilai.detail.update', [$tahun_ajaran, $ganjil_genap, $angkatan]) }}">
                    @csrf
                    <table class="table is-narrow is-striped is-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> NIM </th>
                                <th> IPK </th>
                                <th> IPS </th>
                                <th> Kluster </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mahasiswa)
                            <tr>
                                <td> {{ $loop->iteration }}. </td>
                                <td> {{ $mahasiswa->NIM }} </td>
                                <td>
                                    <input 
                                        name="nilais[{{$mahasiswa->nilai->id}}][IPK]"
                                        style="width: 5rem" type="number" 
                                        value="{{ old('nilais.'.$mahasiswa->nilai->id.'.IPK', $mahasiswa->nilai->IPK) }}"
                                        class="input is-small {{ $errors->has('nilais.'.$mahasiswa->nilai->id.'.IPK') ? 'is-danger' : '' }}">
                                    @if($errors->has('nilais.'.$mahasiswa->nilai->id.'.IPK'))
                                    <p class="help is-danger">
                                        {{ $errors->first('nilais.'.$mahasiswa->nilai->id.'.IPK') }}
                                    </p>
                                    @endif
                                </td>
                                <td>
                                    <input 
                                        name="nilais[{{$mahasiswa->nilai->id}}][IPS]"
                                        style="width: 5rem" type="number" 
                                        value="{{ old('nilais.'.$mahasiswa->nilai->id.'.IPS', $mahasiswa->nilai->IPS) }}"
                                        class="input is-small {{ $errors->has('nilais.'.$mahasiswa->nilai->id.'.IPS') ? 'is-danger' : '' }}">
                                    @if($errors->has('nilais.'.$mahasiswa->nilai->id.'.IPS'))
                                    <p class="help is-danger">
                                        {{ $errors->first('nilais.'.$mahasiswa->nilai->id.'.IPS') }}
                                    </p>
                                    @endif
                                </td>
                                <td> {{ $mahasiswa->nilai->cluster ?? '-' }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="field has-text-right">
                        <button class="button is-primary">
                            <span> Perbarui Nilai </span>
                            <span>
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