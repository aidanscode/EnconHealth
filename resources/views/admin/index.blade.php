@extends('layouts.app')

@section('content')
<div class="container">
  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  <div class="row">

    <div class="col-12 col-md-6">
      <a href="{{ route('admin.responses.day') }}" class="btn btn-primary btn-massive btn-link-fix">Responses by Day</a>
    </div>

    <div class="col-12 col-md-6">
      <a href="{{ route('admin.employees') }}" class="btn btn-primary btn-massive btn-link-fix">Employees</a>
    </div>

  </div>

  <div class="row mt-md-4">

    <div class="col-12 col-md-6">
      <a href="{{ route('admin.configure') }}" class="btn btn-primary btn-massive btn-link-fix">Configure App</a>
    </div>

  </div>
</div>
@endsection
