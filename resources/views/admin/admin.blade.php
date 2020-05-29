@extends('layouts.app')

@section('content')
<div class="container">
  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        {{ $error }}
        @if(!$loop->first)
          <br>
        @endif
      @endforeach
    </div>
  @endif

  <h1>Site Admins</h1>
  <br>

  <form action="{{ route('admin.configure.emails') }}" method="POST">
    @csrf

    <div id="email-list"></div>

    <div class="input-group mb-3">
      <input type="email" id="add-email-input" class="form-control" placeholder="Recipient's Email Address" aria-label="Recipient's Email Address">
      <div class="input-group-append">
        <button class="btn btn-success" id="add-email-btn" type="button">+</button>
      </div>
    </div>

    <input type="submit" class="btn btn-primary mt-3 d-block" value="Save" />
  </form>

@endsection
