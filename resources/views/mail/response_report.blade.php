@extends('layouts.email')

@section('content')
  <h1>Breakdown of Responses for {{ $date }}</h1>

  <h3 style="margin-top: 5px;">No Responses:</h3>
  <ul>
    @foreach($users['no_response'] as $user)
    <li>
      {{ $user->full_name }} &lt;{{ $user->email }}&gt;
    </li>
    @endforeach
  </ul>

  <h3 style="margin-top: 5px;">{{ $negativeType->name }} Responses</h3>
  <ul>
    @foreach($users['negative'] as $user)
    <li>
      {{ $user->full_name }} &lt;{{ $user->email }}&gt; at {{ $user->response->getFriendlyCreatedAtTime() }}
    </li>
    @endforeach
  </ul>

  <h3 style="margin-top: 5px;">{{ $positiveType->name }} Responses</h3>
  <ul>
    @foreach($users['positive'] as $user)
    <li>
      {{ $user->full_name }} &lt;{{ $user->email }}&gt; at {{ $user->response->getFriendlyCreatedAtTime() }}
    </li>
    @endforeach
  </ul>
@endsection
