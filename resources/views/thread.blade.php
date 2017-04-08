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

    @foreach($title->posts as $post)
    <article class="message">
      <div class="message-header">
        <p>
            by {{ $post->user->name }} on {{ printDate($post->created_at) }}
        </p>
        @if(Auth::check() && Auth::user()->can_moderate)
        <a class="delete" href="{{ route('delete', ['id' => $post->id, 'type' => 'post']) }}"></a>
        @endif
      </div>
      <div class="message-body">
        {!! $post->body !!}
      </div>
    </article>
    @endforeach
</div>
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