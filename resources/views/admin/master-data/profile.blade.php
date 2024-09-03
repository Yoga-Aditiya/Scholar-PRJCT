@extends('layouts.admin-sneat')
@section('title')
    Profile | KPPM FKIP UNS
@endsection
@section('page-header')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">My Profile</h4>
@endsection
@section('content')
    <div class="row">
        @if(\Illuminate\Support\Facades\Auth::user()->hasRole(\App\Enum\RolesEnum::LECTURER))
            <div class="col-md-6">
                @livewire('update-main-profile-lecturer')
            </div>
        @else
            <div class="col-md-6">
                @livewire('update-main-profile')
            </div>
        @endif
    </div>
@endsection
