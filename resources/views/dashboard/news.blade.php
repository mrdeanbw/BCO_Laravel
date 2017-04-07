@extends('dashboard')
@section('dashboard-content')
    @if(Auth::user()->admin_verifier)
        <new-members class="dashboard-block" ></new-members>
    @endif
    <latest-news class="dashboard-block" ></latest-news>
    <power-grid class="dashboard-block"></power-grid>

@endsection