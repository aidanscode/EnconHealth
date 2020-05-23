@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                  <p>You have successfully confirmed your email address</p>
                  <p><a href="{{ route('home') }}">Go home to get started!</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
