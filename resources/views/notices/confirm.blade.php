@extends('app')

@section('content')
    <h1 class="page-heading">Confirm</h1>

    {!! Form::open([ 'action' => 'NoticesController@store' ]) !!}
    <!-- Template Form input -->
            <div class="form-group">
                {!! Form::textarea('template', $template,['class' => 'form-control']) !!}
            </div>
            <!--  Form input -->
            <div class="form-group">
                {!!Form::submit('Deliver', ['class' => 'btn btn-primary form-control']) !!}
            </div>
    {!! Form::close() !!}
    @stop