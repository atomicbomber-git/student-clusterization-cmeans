<div class="tabs">
    <ul>
        
        <li class="{{ Route::is("tahun_ajaran.*") ? 'is-active' : '' }}">
            <a href="#"> Tahun Ajaran </a>
        </li>

        <li class="{{ Route::is("angkatan.*") ? 'is-active' : '' }}">
            <a href="#"> Angkatan </a>
        </li>
        
        <li class="{{ Route::is("mahasiswa.*") ? 'is-active' : '' }}">
            <a href="#"> Mahasiswa </a>
        </li>
        
        <li class="{{ Route::is("nilai.*") ? 'is-active' : '' }}">
            <a href="#"> Nilai </a>
        </li>
        
    </ul>
</div>