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
            @if(!empty($tag->tag))
                <a class="tag is-dark" href="{{ route('tag',['tag' => str_slug($tag->tag)]) }}">
                    {{ $tag->tag }}
                <a/>&nbsp;
            @else
                <small>No Tags</small>
            @endif
        @endforeach
    </p>
    @endif
</div>
@foreach($title->posts as $post)
<a name="post-{{ $post->id }}"></a>
<div class="card">
 <header class="card-header">
    <div class="card-header-title">
       <article class="media">
          <figure class="media-left">
            <p class="image is-64x64">
              <img src="{{ $post->user->getAvatar(128) }}" />
            </p>
          </figure>
          <div class="media-content content">
              
            <p>
                By <a href="{{ route('profile.view', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a></em>
                <br/>
                <small>{{ printDate($post->created_at) }}</small>
            </p>
            
          </div>
        </article>
    </div>
    <a class="card-header-icon">
      @if((Auth::check() && Auth::user()->id == $post->user_id) || 
            (Auth::check() && Auth::user()->can_moderate))
            <a href="{{ route('edit', ['id' => $post->id]) }}" class="button is-primary is-outlined">
                <span class="icon">
                    <i class="fa fa-pencil fa-fw"></i>
                </span>
            </a>
        @endif
        @if(Auth::check() && Auth::user()->can_moderate)
            <a class="button is-danger is-outlined" href="{{ route('delete', ['id' => $post->id, 'type' => 'post']) }}" @click="confirmDelete">
                <span class="icon">
                    <i class="fa fa-trash fa-fw"></i>
                </span>
            </a>
        @endif
    </a>
  </header>    
  <div class="card-content content">
       {!! $post->body !!}
  </div>
</div>
@endforeach
@if(Auth::check())
<br/>
<div class="columns">
    <div class="column is-half is-offset-one-quarter content">
        <h2>Reply</h2>
        {!! Form::open(['route' => 'doReply']) !!}
        
        {!! Form::hidden('title_id', $title->id) !!}
        
        <div class="field">
            <p class="help"><a href="http://commonmark.org/help/" target="_blank">Text formating help</a></p>
            <p class="control">
                <textarea class="textarea" name="body" placeholder="Enter the body of your text" :value="message" @keyup="saveText"></textarea>
                @if($errors->has('body'))
                    {!! $errors->first('body', '<p class="help is-danger">:message</p>') !!}
                @endif
            </p>
        </div>
        
        <div class="field is-grouped">
          <p class="control">
            <button type="submit" class="button is-primary" @click="setClear">Submit</button>
          </p>
          <p class="control">
            <button type="reset" class="button is-link" @click="setClear">Cancel</button>
          </p>
        </div>
        
        {!! Form::close() !!}
    </div>
</div>
@endif
@endsection