@extends('shared.layout')

@section('title', 'Nilai Mahasiswa')

@section('content')

@include('shared.header')
@include('shared.navbar')

<div class="section">
    <div class="container">
        <div class="card is-inline-block">
            <div class="card-header">
                <h1 class="card-header-title">
                    <span class="icon mr-1">
                        <i class="fa fa-list"></i>
                    </span>
                    Nilai IPK dan IPS Mahasiswa
                </h1>
            </div>
            <div class="card-content">
                <table class="table is-narrow is-striped is-bordered">
                    <thead>
                        <tr>
                            <th class="has-text-centered" style="vertical-align: middle" rowspan="2"> Tahun Ajaran </th>
                            <th class="has-text-centered" style="vertical-align: middle" colspan="2"> Semester </th>
                        </tr>

                        <tr>
                            {{-- <th></th> --}}
                            <th class="has-text-centered" style="vertical-align: middle"> Ganjil </th>
                            <th class="has-text-centered" style="vertical-align: middle"> Genap </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tahun_ajarans as $tahun_ajaran)
                        <tr>
                            <td> {{ $tahun_ajaran->tahun_mulai . '-' . $tahun_ajaran->tahun_selesai }} </td>
                            <td>
                                @foreach ($angkatans as $angkatan)
                                <button class="button is-dark is-small">
                                    A. {{ $angkatan->tahun }}
                                </button>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($angkatans as $angkatan)
                                <button class="button is-dark is-small">
                                    A. {{ $angkatan->tahun }}
                                </button>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection