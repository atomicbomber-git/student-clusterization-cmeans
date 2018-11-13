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
                                <th> <a href="{{ $sortable_url('NIM') }}"> NIM </a></th>
                                <th> <a href="{{ $sortable_url('name') }}"> Nama </a></th>
                                <th> <a href="{{ $sortable_url('IPK') }}"> IPK </a> </th>
                                <th> <a href="{{ $sortable_url('IPS') }}"> IPS </a> </th>
                                <th> <a href="{{ $sortable_url('cluster') }}"> Cluster </a> </th>
                                <th> Rata-Rata Cluster </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mahasiswa)
                            <tr {{ $mahasiswa->cluster == $lowest_average_cluster && !empty($mahasiswa->cluster) ? "class=has-text-danger" : '' }}>
                                <td> {{ $loop->iteration }}. </td>
                                <td> {{ $mahasiswa->NIM }} </td>
                                <td> {{ $mahasiswa->name }} </td>
                                <td>
                                    <input 
                                        name="nilais[{{$mahasiswa->nilai_id}}][IPK]"
                                        style="width: 5rem" type="number" 
                                        step="0.01"
                                        value="{{ old('nilais.'.$mahasiswa->nilai_id.'.IPK', $mahasiswa->IPK) }}"
                                        class="input is-small {{ $errors->has('nilais.'.$mahasiswa->nilai_id.'.IPK') ? 'is-danger' : '' }}">
                                    @if($errors->has('nilais.'.$mahasiswa->nilai_id.'.IPK'))
                                    <p class="help is-danger">
                                        {{ $errors->first('nilais.'.$mahasiswa->nilai_id.'.IPK') }}
                                    </p>
                                    @endif
                                </td>
                                <td>
                                    <input 
                                        name="nilais[{{$mahasiswa->nilai_id}}][IPS]"
                                        style="width: 5rem" type="number"
                                        step="0.01"
                                        value="{{ old('nilais.'.$mahasiswa->nilai_id.'.IPS', $mahasiswa->IPS) }}"
                                        class="input is-small {{ $errors->has('nilais.'.$mahasiswa->nilai_id.'.IPS') ? 'is-danger' : '' }}">
                                    @if($errors->has('nilais.'.$mahasiswa->nilai_id.'.IPS'))
                                    <p class="help is-danger">
                                        {{ $errors->first('nilais.'.$mahasiswa->nilai_id.'.IPS') }}
                                    </p>
                                    @endif
                                </td>
                                <td> {{ $mahasiswa->cluster ?? '-' }} </td>
                                <td> {{ number_format($averages[$mahasiswa->cluster], 2) ?? '-' }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <div class="field">
                                    <button class="button is-primary">
                                        <span> Perbarui Data Nilai </span>
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="level-right ml-10">
                            <div class="level-item">
                                <div class="field has-addons">
                                    <div class="control">
                                        <input placeholder="Jumlah cluster" form="clusterize" value="{{ old('n_clusters') }}" type="number" name="n_clusters" class="input {{ $errors->first("n_clusters", "is-danger") }}">
                                        @if($errors->has("n_clusters"))
                                        <p class="help is-danger"> {{ $errors->first("n_clusters") }} </p>
                                        @endif
                                    </div>
        
                                    <div class="control">
                                        <button form="clusterize" class="button is-info">
                                            <span> Kelompokkan Kedalam Kluster </span>
                                            <span class="icon">
                                                <i class="fa fa-cog"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <form id="clusterize" method="POST" action="{{ route('nilai.detail.clusterize', [$tahun_ajaran, $ganjil_genap, $angkatan]) }}">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection