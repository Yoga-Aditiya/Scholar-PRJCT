@extends('layouts.admin-sneat')
@section('title')
    Dashboard - Analytics | KPPM FKIP UNS
@endsection
@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole(\App\Enum\RolesEnum::FACULTY_ADMIN))
        <div class="row">
            <div class="col-md-6 col-lg-6 order-1 mb-4">
                @livewire('dash-citation-per-faculty')
            </div>
            <div class="col-md-6 col-lg-6 order-2 mb-4">
                @livewire('dash-citation-faculty-per-study-program')
            </div>
        </div>
    @endif
@endsection
