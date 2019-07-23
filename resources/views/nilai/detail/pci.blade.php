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
                <li>
                    <a href="{{ route('nilai.detail.index', [$tahun_ajaran, $ganjil_genap, $angkatan]) }}">
                        Nilai Mahasiswa Angkatan {{ $angkatan->tahun }}
                        Tahun Ajaran {{ $tahun_ajaran->nama() }}
                        Semester {{ $ganjil_genap }}
                    </a>
                </li>
                <li class="is-active">
                    <a> PCI </a>
                </li>
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

        <div class="card is-inline-block">
            <div class="card-header">
                <h1 class="card-header-title">
                    <span class="icon mr-1">
                        <i class="fa fa-calculator"></i>
                    </span>
                    Pusat Cluster
                </h1>
            </div>

            <div class="card-content">
                <div style="overflow-x:auto">
                    <table class="table is-bordered is-striped is-narrow is-hoverable block">
                        <thead>
                            <th> Pusat Cluster </th>
                            <th> IPK </th>
                            <th> IPS </th>
                        </thead>
                        <tbody>
                            @foreach ($centroids as $centroid)
                            <tr>
                                <td> {{ $loop->iteration }}. </td>
                                <td> {{ $centroid["IPK"] }} </td>
                                <td> {{ $centroid["IPS"] }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card is-inline-block" style="margin-top: 4rem">
            <div class="card-header">
                <h1 class="card-header-title">
                    <span class="icon mr-1">
                        <i class="fa fa-calculator"></i>
                    </span>
                    Nilai Derajat Keanggotaan Kluster
                    Nilai Mahasiswa Angkatan {{ $angkatan->tahun }} Tahun Ajaran {{ $tahun_ajaran->nama()  }} Semester {{ $ganjil_genap }}
                </h1>
            </div>
            <div class="card-content">
                <div style="overflow-x:auto">
                    <table class="table is-bordered is-striped is-narrow is-hoverable block">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Nama </th>
                                <th> NIM </th>
                                @for($i = 1; $i <= count($membership_degrees->first() ?? []); ++$i)
                                <th> U{{ $i }} </th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $nilai_id => $mahasiswa)
                            <tr>
                                <td> {{ $loop->iteration }}. </td>
                                <td> {{ $mahasiswa->name }} </td>
                                <td> {{ $mahasiswa->NIM }} </td>
                                @for($i = 0; $i < count($membership_degrees->first() ?? []); ++$i)
                                <td> {{ $membership_degrees[$nilai_id][$i] }} </td>
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card is-inline-block" style="margin-top: 4rem">
            <div class="card-header">
                <h1 class="card-header-title">
                    <span class="icon mr-1">
                        <i class="fa fa-calculator"></i>
                    </span>
                    Nilai Partition Coefficient Index Kluster
                    Nilai Mahasiswa Angkatan {{ $angkatan->tahun }} Tahun Ajaran {{ $tahun_ajaran->nama()  }} Semester {{ $ganjil_genap }}
                </h1>
            </div>
            <div class="card-content">
                <div style="overflow-x:auto">
                    <table class="table is-bordered is-striped is-narrow is-hoverable block">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Nama </th>
                                <th> NIM </th>
                                @for($i = 1; $i <= count($membership_degrees->first() ?? []); ++$i)
                                <th> U{{ $i }} <sup> 2 </sup> </th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $nilai_id => $mahasiswa)
                            <tr>
                                <td> {{ $loop->iteration }}. </td>
                                <td> {{ $mahasiswa->name }} </td>
                                <td> {{ $mahasiswa->NIM }} </td>
                                @for($i = 0; $i < count($membership_degrees->first() ?? []); ++$i)
                                <td> {{ pow($membership_degrees[$nilai_id][$i], 2) }} </td>
                                @endfor
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="has-text-right">
                                    Nilai PCI:
                                </td>
                                <td colspan="{{ count($membership_degrees->first() ?? []) }}">
                                    @php
                                    $sum_squared = $membership_degrees->map(function ($score_degree) {
                                        return collect($score_degree)->map(function ($cluster_degree) {
                                            return pow($cluster_degree, 2);
                                        })
                                        ->sum();
                                    })
                                    ->sum()
                                    @endphp

                                    {{ $sum_squared }} / {{ $mahasiswas->count() }} = {{ $sum_squared / $mahasiswas->count() }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- Perhitungan Partition Coefficient Index untuk Kluster --}}
