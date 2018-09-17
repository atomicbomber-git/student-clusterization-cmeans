@extends('shared.layout')
@section('title', 'Halaman Login')
@section('content')
<div class="container mt-10">
    <div class="card" style="max-width: 40rem; margin: auto">
        <div class="card-header">
            <h1 class="card-header-title">
                <span class="icon mr-1">
                    <i class="fa fa-sign-in"></i>
                </span>
                Login Administrator
            </h1>
        </div>
        <div class="card-content">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <label for="username" class="label"> Username: </label>
                    <input value="{{ old('username') }}" type="text" name="username" class="input {{ $errors->first("username", "is-danger") }}"
                    placeholder="Username">
                    @if($errors->has("username"))
                    <p class="help is-danger"> {{ $errors->first("username") }} </p>
                    @endif
                </div>

                <div class="field">
                    <label for="password" class="label"> Password: </label>
                    <input value="{{ old('password') }}" type="password" name="password" class="input {{ $errors->first("password", "is-danger") }}"
                    placeholder="Password">
                    @if($errors->has("password"))
                    <p class="help is-danger"> {{ $errors->first("password") }} </p>
                    @endif
                </div>

                <div class="has-text-right">
                    <button class="button is-primary">
                        <span> Log In </span>
                        <span class="icon">
                            <i class="fa fa-sign-in"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection