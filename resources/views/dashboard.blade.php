@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('name')
    {{ Auth::check() ? Auth::user()->name : 'Guest' }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Members</h5>
                    <p class="card-text">
                        <h4>{{ $totalMembers }}</h4>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Members Registered Today</h5>
                    <p class="card-text">
                        <h4>{{ $membersRegisteredToday }}</h4>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Registrations (Last 30 Minutes)</h5>
                    <p class="card-text">
                        <h4>{{ $recentUsersCount }}</h4>
                    </p>
                </div>
            </div>
        </div>
        <br><br>
    </div>
</div>
@endsection