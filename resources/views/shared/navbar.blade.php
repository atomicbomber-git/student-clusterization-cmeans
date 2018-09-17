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
                <a href="{{ route("nilai.index") }}"> Nilai </a>
            </li>

            @auth
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="button is-small is-danger">
                        <span> Log Out </span>
                        <span class="icon">
                            <i class="fa fa-sign-out"></i>
                        </span>
                    </button>
                </form>
            </li>
            @endauth
        </ul>
    </div>
</div>