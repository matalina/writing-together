@extends('master')

@section('content')
<div class="content">
    <h1>{{ $title->title }}</h1>
    @if(! $title->tags->isEmpty())
    <p>
        <span class="icon">
            <i class="fa fa-tags"></i>
        </span>
        <strong>Tags:</strong>
        @foreach($title->tags as $tag)
            <span class="tag is-dark">
                {{ $tag->tag }}
            </span>
        @endforeach
    </p>
    @endif
</div>
@foreach($title->posts as $post)
<a name="post-{{ $post->id }}"></a>
<article class="message">
  <div class="message-header">
    <p>
        by {{ $post->user->name }} on {{ printDate($post->created_at) }}
    </p>
    
    <div>
        @if((Auth::check() && Auth::user()->id == $post->user_id) || 
            (Auth::check() && Auth::user()->can_moderate))
            <a href="{{ route('edit', ['id' => $post->id]) }}" class="button is-primary">
                <span class="icon">
                    <i class="fa fa-pencil fa-fw"></i>
                </span>
            </a>
        @endif
        @if(Auth::check() && Auth::user()->can_moderate)
            <a class="button is-danger" href="{{ route('delete', ['id' => $post->id, 'type' => 'post']) }}">
                <span class="icon">
                    <i class="fa fa-trash fa-fw"></i>
                </span>
            </a>
        @endif
    </div>    
    
  </div>
  <div class="message-body content">
    {!! $post->body !!}
  </div>
</article>
@endforeach
@if(Auth::check())
<div class="columns">
    <div class="column is-half is-offset-one-quarter content">
        <h2>Reply</h2>
        {!! Form::open(['route' => 'doReply']) !!}
        
        {!! Form::hidden('title_id', $title->id) !!}
        
        <div class="field">
            <p class="help"><a href="http://commonmark.org/help/" target="_blank">Text formating help</a></p>
            <p class="control">
                <textarea class="textarea" name="body" placeholder="Enter the body of your text"></textarea>
                @if($errors->has('body'))
                    {!! $errors->first('body', '<p class="help is-danger">:message</p>') !!}
                @endif
            </p>
        </div>
        
        <div class="field is-grouped">
          <p class="control">
            <button type="submit" class="button is-primary">Submit</button>
          </p>
          <p class="control">
            <button type="reset" class="button is-link">Cancel</button>
          </p>
        </div>
        
        {!! Form::close() !!}
    </div>
</div>
@endif
@endsection