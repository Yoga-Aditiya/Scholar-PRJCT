@extends('layouts.admin-sneat')
@section('title')
    System Setting | KPPM FKIP UNS
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <p style="background: linear-gradient(to right, #da8cff, #9a55ff); -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;">{{$user->roles->pluck('name')[0]}} </p>
        </div>
    </div>
    <div class="row">
        @if (\Illuminate\Support\Facades\Auth::user()->hasRole(\App\Enum\RolesEnum::SYS_ADMIN))
            <div class="col-md-4">
                @livewire('system-setting-sys-admin-index')
            </div>
        @elseif(\Illuminate\Support\Facades\Auth::user()->hasRole(\App\Enum\RolesEnum::STUDY_PROGRAM_ADMIN))
            <div class="col-md-4">
                @livewire('system-setting-p-s-admin-index')
            </div>
        @elseif(\Illuminate\Support\Facades\Auth::user()->hasRole(\App\Enum\RolesEnum::FACULTY_ADMIN))
            <div class="col-md-4">
                @livewire('system-setting-faculty-admin-index')
            </div>
        @endif
    </div>
@endsection
