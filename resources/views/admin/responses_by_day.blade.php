@extends('layouts.app')

@section('scripts')
<script>
  var endpoint = '{{ route('admin.responses.day.ajax') }}';
</script>

<script src="{{ asset('js/pages/responses_by_day.js') }}" defer></script>
@endsection

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

  <h1>Responses by Day</h1>
  <br>

  <form class="form-inline mb-3">
    <input type="text" id="date-selection" class="form-control datepicker mr-3" placeholder="Date Selection" />

    <button type="button" id="filter-submit-btn" class="btn btn-primary">
      <span id="filter-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
      Search
    </button>
  </form>

  <div class="row">

    <!-- No Responses -->
    <div class="col-12 col-md-4">
    <h4 class="font-weight-bold text-center text-primary">No Responses</h4>
      <ul class="list-group result-list mb-5" id="no-response-list"></ul>
    </div>

    <!-- Unhealthy Responses -->
    <div class="col-12 col-md-4">
      <h4 class="font-weight-bold text-center text-danger">{{ $negativeType->name }} Responses</h4>
      <ul class="list-group result-list mb-5" id="unhealthy-list"></ul>
    </div>

    <!-- Healthy Responses -->
    <div class="col-12 col-md-4">
      <h4 class="font-weight-bold text-center text-success">{{ $positiveType->name }} Responses</h4>
      <ul class="list-group result-list mb-5" id="healthy-list"></ul>
    </div>
  </div>

</div>

<template id="response-template">
<li class="list-group-item">
  <p>
    <span class="name"></span> &lt;<span class="email"></span>&gt;
  </p>
  <p>Submitted At: <span class="timestamp"></spam></p>
</li>
</template>

<template id="no-response-template">
<li class="list-group-item">
  <p>
    <span class="name"></span> &lt;<span class="email"></span>&gt;
  </p>
</li>
</template>

@endsection
