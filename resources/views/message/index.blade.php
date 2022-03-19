
@extends('message.messages_layout')
@extends('layouts.app')

@section('selected-user')
    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 
@stop

@section('content')
    @section('message-content')
        <h2> Welcome to Message Page!!! Click "Start Chat"</h2> 
    @stop
@stop