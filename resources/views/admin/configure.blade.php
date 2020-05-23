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

  <h1>App Configuration</h1>
  <br>

  <h3>Agreement Text</h3>
  <form action="{{ route('admin.configure.store') }}" method="POST">
    @csrf
    <input type="hidden" name="key" value="{{ $agreementTextKey }}" />
    <textarea name="value" class="form-control" rows="5">{{ $agreementText }}</textarea>

    <input type="submit" class="btn btn-primary mt-3" value="Save" />
  </form>

  <h3 class="mt-5">Daily Email Enabled</h3>
  <form action="{{ route('admin.configure.store') }}" method="POST">
    @csrf
    <input type="hidden" name="key" value="{{ $dailyEmailEnabledKey }}" />
    <label class="switch">
      <input type="checkbox" name="value" value="1" {{ $dailyEmailEnabled ? 'checked' : '' }}>
      <span class="slider"></span>
    </label>

    <input type="submit" class="btn btn-primary mt-3 d-block" value="Save" />
  </form>

  <h3 class="mt-5">Email List</h3>
  <h3>todo...</h3>
</div>
@endsection
