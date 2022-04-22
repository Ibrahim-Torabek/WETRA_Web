@extends('message.messages_layout')
@extends('layouts.app')

@section('selected-user')
{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
@stop

@section('content')
@section('message-content')
<h2 class="text"> <i> Click "Start Chat" to begin a NEW chat</i></h2>
<div class="container ml-5 mt-5">
    @if(!empty($messages))
    <h4 class="">New Messages</h4>
    @foreach($messages as $message)
    <li class="list-group-item text-truncate">
        <a href="messages/chat?selectedUser={{ $message->sender->id }}">
            {{ $message->sender->first_name }}:
        </a> {{ $message->line_text }}</span>
    </li>
    @endforeach
    @endif
</div>

@stop
@stop