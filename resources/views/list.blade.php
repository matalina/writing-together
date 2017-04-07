@extends('master')

@section('content')
<div class="columns is-multiline is-mobile">
@forelse($titles as $title)
    <div class="column is-one-quarter">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    {{ $title->title }}
                </p>
                @if(Auth::user()->can_moderate)
                <a class="card-header-icon">
                    <a class="delete"></a>
                </a>
                @endif
            </header>
            <div class="card-content">
                <div class="content">
                    {{ $title->posts->last() }} 
			posted last {{ $title->last_post->diffForHumans() }}
                </div>
            </div>
            <footer class="card-footer">
                <p class="card-footer-item">
                  <span>
                    Started by {{ $title->user->name }}
                  </span>
                </p>
                <p class="card-footer-item">
                  <span>
                    Started on {{ $title->created_at->diffForHumans() }}
                  </span>
                </p>
            </footer>
        </div>    
    </div>
@empty
<div class="notification">
    There are no threads at this time.  Why don't you make the <a href="{{ route('new') }}">first one</a>.
</div>  
@endforelse
</div>
@endsection
