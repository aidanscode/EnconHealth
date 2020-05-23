@extends('layouts.app')

@section('content')
<div class="container">
  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  <h2>You have submitted your response for today! Please check back tomorrow to submit again.</h2>
</div>
@endsection
