@extends('layouts.app')

@section('scripts')
<script>
  var employeeEndpoint = '{{ route('admin.employees.ajax') }}';
  var adminEndpoint = '{{ route('admin.employees.admin') }}';
  var responseTypes = {
    {{ $positiveType->id }}: "{{ $positiveType->name }}",
    {{ $negativeType->id }}: "{{ $negativeType->name }}"
  };
</script>

<script src="{{ asset('js/pages/employees.js') }}" defer></script>
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

  <h1>Employees</h1>
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

  <div id="admin_status" style="display: none;">
    <form action="{{ route('admin.configure.store') }}" method="POST">
      @csrf
      <input type="hidden" name="user_id" id="user_id" value="" />
      <h5>This user is<span id="is_admin_text"></span>an admin. <span class="can_change_group">Click below to change.</span></h5>
      <label class="switch can_change_group">
        <input type="checkbox" id="is_admin_checkbox" name="value" value="1">
        <span class="slider"></span>
      </label>
    </form>
  </div>

  <div id="response-list" class="mt-3"></div>
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
