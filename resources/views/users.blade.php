@extends('master')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Creation Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ printDate($user->created_at) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection