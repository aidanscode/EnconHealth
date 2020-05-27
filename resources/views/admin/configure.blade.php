@extends('layouts.app')

@section('scripts')
<script>
  var emails = [
    @foreach($emailList as $email)
    "{{ $email }}",
    @endforeach
  ];
</script>

<script src="{{ asset('js/pages/configuration.js') }}" defer></script>
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

  <h1>App Configuration</h1>
  <br>

  <h3>Agreement Text</h3>
  <form action="{{ route('admin.configure.store') }}" method="POST">
    @csrf
    <input type="hidden" name="key" value="{{ $agreementTextKey }}" />
    <textarea name="value" class="form-control" rows="5">{{ $agreementText }}</textarea>

    <input type="submit" class="btn btn-primary mt-3" value="Save" />
  </form>

  <h3 class="mt-5">Send Daily Email</h3>
  <form action="{{ route('admin.configure.store') }}" method="POST">
    @csrf
    <input type="hidden" name="key" value="{{ $dailyEmailEnabledKey }}" />
    <label class="switch">
      <input type="checkbox" name="value" value="1" {{ $dailyEmailEnabled ? 'checked' : '' }}>
      <span class="slider"></span>
    </label>

    <input type="submit" class="btn btn-primary mt-3 d-block" value="Save" />
  </form>

  <h3 class="mt-5">Send Daily Email on Weekends</h3>
  <form action="{{ route('admin.configure.store') }}" method="POST">
    @csrf
    <input type="hidden" name="key" value="{{ $dailyEmailWeekendsEnabledKey }}" />
    <label class="switch">
      <input type="checkbox" name="value" value="1" {{ $dailyEmailWeekendsEnabled ? 'checked' : '' }}>
      <span class="slider"></span>
    </label>

    <input type="submit" class="btn btn-primary mt-3 d-block" value="Save" />
  </form>

  <h3 class="mt-5">Email List</h3>
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
</div>

<template id="email">
  <div class="input-group mb-3">
    <input type="email" name="emails[]" class="form-control" placeholder="Recipient's Email Address" aria-label="Recipient's Email Address" readonly>
    <div class="input-group-append">
      <button class="btn btn-danger remove-email-btn" type="button">-</button>
    </div>
  </div>
</template>
@endsection
