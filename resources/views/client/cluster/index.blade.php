@extends('shared.layout')

@section('title', 'Kluster Mahasiswa')

@section('content')

@include('shared.header')

@include('shared.navbar')

<div class="section">
    <div class="container">
        @include('shared.account')

        @if(session('message.success'))
        <article class="message is-success">
            <div class="message-body">
                {{ session('message.success') }}
            </div>
        </article>
        @endif
    </div>
</div>
@endsection