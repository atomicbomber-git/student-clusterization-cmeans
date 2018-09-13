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
                                <input style="witdh: 5rem" class="input is-small" type="number" value="{{ $mahasiswa->nilai->IPK }}">
                            </td>
                            <td>
                                <input style="witdh: 5rem" class="input is-small" type="number" value="{{ $mahasiswa->nilai->IPS }}">
                            </td>
                            <td> {{ $mahasiswa->nilai->cluster ?? '-' }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection