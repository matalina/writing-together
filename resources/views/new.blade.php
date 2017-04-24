@extends('master')

@section('content')
<div class="columns">
    <div class="column is-half is-offset-one-quarter content">
        <h1>New Thread</h1>
        {!! Form::open(['route' => 'doNew']) !!}
        
        <div class="field">
            <label class="label">Title</label>
            <p class="control">
                <input class="input" type="text" name="title" placeholder="Enter a Title for your Work" required>
            </p>
            @if($errors->has('title'))
                {!! $errors->first('title', '<p class="help is-danger">:message</p>') !!}
            @endif      
        </div>
        
        <div class="field">
            <label class="label">Body</label>
            <p class="help"><a href="http://commonmark.org/help/" target="_blank">Text formating help</a></p>
            <p class="control">
                <textarea class="textarea" name="body" placeholder="Enter the body of your text" :value='message' @keyup="saveText" required></textarea>
                @if($errors->has('body'))
                    {!! $errors->first('body', '<p class="help is-danger">:message</p>') !!}
                @endif
            </p>
        </div>
        
        
        <div class="field">
          <label class="label">Tags</label>
          <p class="control">
            <input class="input" type="text" name="tags" placeholder="Tags are optional, separate with commas">
            @if($errors->has('tags'))
                {!! $errors->first('tags', '<p class="help is-danger">:message</p>') !!}
            @endif
          </p>
        </div>
        
        <div class="field">
          <p class="control">
            <label class="checkbox">
              <input type="checkbox" name="private" value="1">
                  Make Private (logged in users only)
            </label>
          </p>
        </div>
        
        <div class="field">
          <p class="control">
              Rating: 
            @foreach($ratings as $rate)
            <label class="radio" title="{{ $rate->description }}">
              <input type="radio" name="rating" value="{{ $rate->id }}" {{ $rate->id === 1?'checked=checked':'' }}>
              {{ $rate->rating }}
            </label>
            @endforeach
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

@endsection