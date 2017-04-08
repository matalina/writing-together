@extends('master')

@section('content')
<div class="columns">
    <div class="column is-half is-offset-one-quarter content">
        <h1>Edit Profile</h1>
        {!! Form::open(['route' => 'profile.doUpdate']) !!}
        
        <div class="field">
            <label class="label">Name</label>
            <p class="control">
                <input class="input" type="text" name="name" value="{{ Request::old('name', $user->name) }}" required>
            </p>
            @if($errors->has('name'))
                {!! $errors->first('name', '<p class="help is-danger">:message</p>') !!}
            @endif      
        </div>
        
        <div class="field">
            <label class="label">Birth Date</label>
            <p class="control">
                <input class="input" type="date" name="birthdate" value="{{ Request::old('birthdate', $user->birth_date) }}">
            </p>
            @if($errors->has('name'))
                {!! $errors->first('name', '<p class="help is-danger">:message</p>') !!}
            @endif      
        </div>
        
        <div class="field">
            <label class="label">Email</label>
            <p class="control">
                <input class="input" type="email" name="email" value="{{ Request::old('email', $user->email) }}">
            </p>
            @if($errors->has('name'))
                {!! $errors->first('name', '<p class="help is-danger">:message</p>') !!}
            @endif      
        </div>
        
        <div class="field">
            <label class="label">Timezone</label>
            <p class="control">
                <span class="select">
                    {!! Form::select('timezone', timezoneList(), Request::old('timezone', $user->timezone) , ['placeholder' => 'Select Timezone']) !!}
                </span>
            </p>
            @if($errors->has('timezone'))
                {!! $errors->first('timezone', '<p class="help is-danger">:message</p>') !!}
            @endif      
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
@endsection