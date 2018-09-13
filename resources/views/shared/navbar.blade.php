<div class="container">
    <div class="tabs">
        <ul>
            <li class="{{ Route::is("tahun_ajaran.*") ? 'is-active' : '' }}">
                <a href="{{ route('tahun_ajaran.index') }}"> Tahun Ajaran </a>
            </li>

            <li class="{{ Route::is("angkatan.*") ? 'is-active' : '' }}">
                <a href="{{ route('angkatan.index') }}"> Angkatan </a>
            </li>
            
            <li class="{{ Route::is("mahasiswa.*") ? 'is-active' : '' }}">
                <a href="{{ route('mahasiswa.index') }}"> Mahasiswa </a>
            </li>
            
            <li class="{{ Route::is("nilai.*") ? 'is-active' : '' }}">
                <a href="#"> Nilai </a>
            </li>
        </ul>
    </div>
</div>