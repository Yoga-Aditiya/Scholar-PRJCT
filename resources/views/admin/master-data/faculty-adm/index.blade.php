@extends('layouts.admin-sneat')
@section('title')
    Admin Fakultas | KPPM FKIP UNS
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <p style="background: linear-gradient(to right, #da8cff, #9a55ff); -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;">{{$user->roles->pluck('name')[0]}} </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @livewire('faculty-adm-index')
        </div>
    </div>
@endsection
