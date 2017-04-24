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
                    <figure class="image is-32x32">
                      <img src="{{ url('images/'.$title->ratings->rating.'.jpg') }}">
                    </figure>
                </td>
                <td>
                    <a href="{{ route('view', ['id' => $title->id]) }}" @click="setClear">{{ $title->title }}</a></td>
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
                    <a href="{{ route('view', ['id' => $title->id]) }}#post-{{ $title->getLastPost()->id }}" @click="setClear">
                        <span class="icon">
                            <i class="is-small fa fa-external-link" aria-hidden="true"></i>
                        </span>
                    </a>
                </td>
                <td>
                    @if(Auth::check() && Auth::user()->can_moderate)
                        <a class="button is-danger" href="{{ route('delete', ['id' => $title->id, 'type' => 'title']) }}" @click="confirmDelete">
                            <span class="icon">
                                <i class="fa fa-trash fa-fw"></i>
                            </span>
                        </a>
                        <a class="button is-warning" href="{{ route('edit', ['id' => $title->id, 'type' => 'title']) }}" @click="setClear">
                            <span class="icon">
                                <i class="fa fa-pencil fa-fw"></i>
                            </span>
                        </a>
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
        
        @if(Auth::check())
            <h3>
                Active Members
                <small>(<a href="{{ route('users') }}">all</a>)</small>
            </h3>
            @foreach($users as $user)
                @if(!empty($user->name))
                    <span class="tag is-white">
                        <a href="{{ route('profile.view', ['id' => $user->id]) }}">
                        <span class="icon">
                            <img src="{{ $user->getAvatar(32) }}"/>
                        </span>
                        {{ $user->name }}</a>
                    </span>
                @endif    
            @endforeach
        @endif
    </div>
</div>
@endsection
