@extends('master')

@section('content')
<div class="columns">
    <div class="column is-three-quarters">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                {{ $titles->links() }}
            </div>
        </div>
        <table class="table is-striped">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Title</th>
                    <th>Created by</th>
                    <th>Created on</th>
                    <th>Last Post</th>
                    @if(Auth::check() && Auth::user()->can_moderate)
                    <th>&nbsp;</th>
                    @endif
                </tr>
            </thead>
            <tbody>
        @forelse($titles as $title)
            <tr>
                <td>
                    
                </td>
                <td>
                    <a href="{{ route('view', ['id' => $title->id]) }}">{{ $title->title }}</a></td>
                <td>
                    <a href="{{ route('profile.view', ['id' => $title->user_id]) }}">{{ $title->user->name }}</a>
                </td>
                <td>
                    {{ printDate($title->created_at) }}
                </td>
                <td>
                    by <a href="{{ route('profile.view', ['id' => $title->getLastPost()->user_id]) }}">
                        {{ $title->getLastPost()->user->name }} 
                    </a>
                    @if($title->getLastPost()->created_at->lt(Carbon\Carbon::now()->subDays(1))) 
                        on {{ printDate($title->getLastPost()->created_at) }}
                    @else 
                        {{ printDate($title->getLastPost()->created_at, true) }}
                    @endif 
                    
                </td>
                <td>
                    @if(Auth::check() && Auth::user()->can_moderate)
                        <a class="delete" href="{{ route('delete', ['id' => $title->id, 'type' => 'title']) }}"></a>
                    @endif
                </td>
            </tr>
        @empty
        <div class="column">
            <br/>
            <div class="notification is-warning">
                There are no threads at this time.  Why don't you make the <a href="{{ route('new') }}">first one</a>.
            </div>  
            <br/>
        </div>
        @endforelse
        </tbody>
        </table>
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                {{ $titles->links() }}
            </div>
        </div>
    </div>
    <div class="column content">
        <h3>
            Tags
            <small>(<a href="{{ route('home') }}">all</a>)</small>
        </h3>
        @foreach($tags as $tag)
            @if(!empty($tag->tag))
                <span class="tag is-white">
                    <a href="{{ route('tag', ['tag' => str_slug($tag->tag)]) }}">
                    <span class="icon">
                        <i class="fa fa-tag fa-fw" aria-hidden="true"></i> 
                    </span>
                    {{ $tag->tag }}</a>
                </span>
            @endif    
        @endforeach
    </div>
</div>
@endsection
