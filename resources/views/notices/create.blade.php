@extends('app')

@section('content')
<h1 class="page-heading">create notice</h1>

        @include('errors.list')

    {!! Form::open([ 'method' => 'GET', 'action' => 'NoticesController@confirm' ]) !!}

        <div class="form-group">
            {!! Form::label('provider_id', 'Who are we sending this to?') !!}
            {!! Form::select('provider_id', [], null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('infringing_title', 'Title of content being infringement upon') !!}
            {!! Form::text('infringing_title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('infringing_link', 'Link to the content being infringed ') !!}
            {!! Form::text('infringing_link', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('original_link', 'Link to original content on your server ') !!}
            {!! Form::text('original_link', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('original_description', 'Finally provide some more information about the DMCA notice ') !!}
            {!! Form::textarea('original_description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!!Form::submit('Preview Notice', ['class' => 'btn btn-primary form-control']) !!}
        </div>

    {!! Form::close() !!}



    @stop