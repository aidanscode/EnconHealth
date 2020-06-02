Breakdown of Responses for {{ $date }}

No Responses
@foreach($users['no_response'] as $user)
 - {{ $user->full_name }} <{{ $user->email }}>
@endforeach


{{ $negativeType->name }} Responses
@foreach($users['negative'] as $user)
 - {{ $user->full_name }} <{{ $user->email }}> at {{ $user->response->getFriendlyCreatedAtTime() }}
@endforeach


{{ $positiveType->name }} Responses
@foreach($users['positive'] as $user)
 - {{ $user->full_name }} <{{ $user->email }}> at {{ $user->response->getFriendlyCreatedAtTime() }}
@endforeach
