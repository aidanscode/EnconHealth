@extends('layouts.app')

@section('content')
<div class="container">
  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  <h3>By selecting "{{ $positiveType->name }}" you agree that...</h3>
  <h4>
    {{ $agreementText }}
  </h4>

  <div class="row text-center mt-5">
    <div class="col-12 col-md-6 mt-3">
      <button type="button" class="btn btn-success btn-massive" data-toggle="modal" data-target="#positiveModal">{{ $positiveType->name }}</button>
    </div>

    <div class="col-12 col-md-6 mt-3">
      <button type="button" class="btn btn-danger btn-massive" data-toggle="modal" data-target="#negativeModal">{{ $negativeType->name }}</button>
    </div>
  </div>
</div>

<!-- Positive Modal -->

<div class="modal fade" id="positiveModal" tabindex="-1" role="dialog" aria-labelledby="positiveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please confirm your selection before submitting!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="{{ route('response.submit') }}" method="POST">
          @csrf
          <input type="hidden" name="response" value="{{ $positiveType->id }}" />
          <button type="submit" class="btn btn-success">Confirm "{{ $positiveType->name }}"</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- End Positive Modal -->

<!-- Negative Modal -->

<div class="modal fade" id="negativeModal" tabindex="-1" role="dialog" aria-labelledby="negativeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please confirm your selection before submitting!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="{{ route('response.submit') }}" method="POST">
          @csrf
          <input type="hidden" name="response" value="{{ $negativeType->id }}" />
          <button type="submit" class="btn btn-danger">Confirm "{{ $negativeType->name }}"</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- End Negative Modal -->
@endsection
