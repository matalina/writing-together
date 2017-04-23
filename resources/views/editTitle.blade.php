@extends('master')

@section('content')

<div class="columns">
    <div class="column is-half is-offset-one-quarter content">
        <h2>Reply</h2>
        {!! Form::open(['route' => 'doEditTitle']) !!}
        
        {!! Form::hidden('id', $title->id) !!}
        
        <div class="field">
            <label class="label">Title</label>
            <p class="control">
                <input class="input" type="text" name="title" placeholder="Enter a Title for your Work" value={{ $title->title }} />
            </p>
            @if($errors->has('title'))
                {!! $errors->first('title', '<p class="help is-danger">:message</p>') !!}
            @endif      
        </div>
        
        <div class="field">
          <label class="label">Tags</label>
          <p class="control">
            <input class="input" type="text" name="tags" placeholder="Tags are optional, separate with commas" value="{{ implode(',',($title->tags->pluck('tag'))->all()) }}">
            @if($errors->has('tags'))
                {!! $errors->first('tags', '<p class="help is-danger">:message</p>') !!}
            @endif
          </p>
        </div>
        
        <div class="field">
          <p class="control">
            <label class="checkbox">
              <input type="checkbox" name="private" value="1" {{ $title->private?'checked=checked':'' }}>
                  Make Private (logged in users only)
            </label>
          </p>
        </div>
        
        <div class="field">
          <p class="control">
              Rating: 
            @foreach($ratings as $rate)
            <label class="radio" title="{{ $rate->description }}">
              <input type="radio" name="rating" value="{{ $rate->id }}" {{ $rate->id == $title->rating?'checked=checked':' ' }}>
              {{ $rate->rating }}
            </label>
            @endforeach
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

@endsection