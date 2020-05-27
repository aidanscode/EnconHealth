@extends('layouts.app')

@section('scripts')
<script>
  var endpoint = '{{ route('admin.responses.employee.ajax') }}';
  var responseTypes = {
    {{ $positiveType->id }}: "{{ $positiveType->name }}",
    {{ $negativeType->id }}: "{{ $negativeType->name }}"
  };
</script>

<script src="{{ asset('js/pages/responses_by_employee.js') }}" defer></script>
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

  <h1>Responses by Employee</h1>
  <br>

  <form class="form-inline mb-3">
    <select class="form-control select2" id="employee-select">
      <option value="" selected disabled>Select an Employee</option>
      @foreach($users as $user)
      <option value="{{ $user->id }}">{{ $user->full_name }}</option>
      @endforeach
    </select>
    <button type="button" id="filter-submit-btn" class="btn btn-primary ml-3">
      <span id="filter-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
      Search
    </button>
  </form>

  <div id="result-list"></div>

</div>

<template id="response-item">
  <div class="card mb-5">
    <div class="card-header">
      <span class="date"></span>
    </div>
    <div class="card-body">
      <span class="choice"></span>
    </div>
  </div>
</template>

@endsection
