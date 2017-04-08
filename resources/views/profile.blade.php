@extends('master')

@section('content')
<div class="content">
    <h1>{{ $user->name }}</h1>
    
    @if(Auth::check() && Auth::user()->id === $user->id)
    <div class="has-text-right">
        <a href="{{ route('profile.update') }}" class="button is-primary">Edit Profile</a>
    </div>
    @endif
    
    <div class="columns">
        <div class="column">
            <h2>Threads I Started</h2>
            <ul>
            @foreach($user->titles as $title)
                <li>
                    <a href="{{ route('view', ['id' => $title->id]) }}">{{ $title->title }}</a> on {{ $title->created_at->format('m/d/Y \a\t g:i A') }}
                </li>
            @endforeach
            </ul>
        </div>
        <div class="column">
            <h2>Threads I'm In</h2>
            <ul>
            @foreach($user->titlesUserIsIn() as $post)
                <li>
                    <a href="{{ route('view', ['id' => $post->title->id]) }}">{{ $post->title->title }}</a> on {{ $post->title->created_at->format('m/d/Y \a\t g:i A') }}
                </li>
            @endforeach
            </ul>
        </div>
    </div>
</div>


@endsection