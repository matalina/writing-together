@extends('master')

@section('content')

<div class="columns">
    <div class="column is-half is-offset-one-quarter content">
        <h2>Reply</h2>
        {!! Form::open(['route' => 'doEditPost']) !!}
        
        {!! Form::hidden('id', $post->id) !!}
        
        <div class="field">
            <p class="help"><a href="http://commonmark.org/help/" target="_blank">Text formating help</a></p>
            <p class="control">
                <textarea class="textarea" name="body">{{ $post->text }}</textarea>
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

@endsection