@extends('message.messages_layout')
@extends('layouts.app')

@section('selected-user')
@if(!empty($selectedUser))
{{ $selectedUser->first_name }} {{ $selectedUser->last_name }}
@endif
@if(!empty($selectedGroup))
{{ $selectedGroup->name }}
@endif

@stop

@section('content')
@section('message-content')

<div class="conteiner chat-area">
    <div class="chat-content" id="chat-content">
        @if(!empty($selectedUser))
        @foreach($chatLines as $chatLine)
        <div class="row">
            <div class="chat-box col-md-10 d-flex {{ $chatLine->sender_id == Auth::id() ? 'justify-content-end' : '' }}">
                <div class="chat-bubble {{ $chatLine->sender_id == Auth::id() ? 'chat-bubble--blue bg-primary text-light' : '' }} chat-bubble--{{ $chatLine->sender_id == Auth::id() ? 'right' : 'left' }}">
                    <small class="text-dark">{{ $chatLine->created_at }}</small><br>
                    {{ $chatLine->line_text }}
                </div>
            </div>
        </div>
        @endforeach
        @endif


    </div>
    <footer class="footer fixed">
        <div class="container-footer">

            <form id="message_form">
                @csrf
                <div class="input-group">
                    <label for=""></label>
                    <div class="chatboxdiv mx-auto pr-0">
                        <input class="chatbox" id="chatText" name="chatText" type="text" required />
                        @if(!empty($selectedUser))
                        <input type="hidden" name="selectedUser" id="selectedUser" value="{{ $selectedUser->id }}" />
                        @endif
                        @if(!empty($selectedGroup))
                        <input type="hidden" name="selectedGroup" id="selectedGroup" value="{{ $selectedGroup->id }}" />
                        <input type="hidden" name="isGroup" id="isGroup" value="1">
                        @endif
                        <input type="hidden" name="user" id="user" value="{{ Auth::id() }}" />
                    </div>
                    <!-- <button class="btn btn-link pl-0 ml-0">
                        <span class="material-icons">
                            sentiment_satisfied_alt
                        </span>
                    </button> -->
                    <button type="submit" class="btn btn-link pl-0 ml-0">
                        <i class="material-icons">
                            send
                        </i>
                    </button>
                </div>
            </form>
        </div>
    </footer>
</div>


@stop
@stop



<style>
    /* .chat-area{
        display:flex;
        min-height: 85%;
        flex-direction: column-reverse;
    } */

    .nav-link {
        color: #0d6efd;
        }

    .chat-bubble {
        max-width: 60%;
        padding: 10px 14px;
        background: #eee;
        margin: 10px 30px;
        border-radius: 9px;
        position: relative;
        animation: fadeIn 1s ease-in;

    }


    .chat-bubble:after {
        content: '';
        position: absolute;
        top: 50%;
        width: 0;
        height: 0;
        border: 20px solid transparent;
        border-bottom: 0;
        margin-top: -10px;
    }

    .chat-bubble--left:after {
        left: 0;
        border-right-color: #eee;
        border-left: 0;
        margin-left: -20px;
    }

    textarea {
        border-radius: 5px;
    }

    .footer {

        padding-bottom: 5px;
        position: fixed;
        bottom: 0;
        height: 60px;
        width: 60%;
        background: #fff;
        align-items: baseline;
    }

    .chatboxdiv {
        width: 85%;
        margin: auto;
    }

    .chatbox {
        border-radius: 20px;
        width: 100%;
        padding: 10px 20px;
    }

    .material-icons {
        padding: 10px 5px;
    }

    .chat-bubble:after {
        content: "";
        position: absolute;
        top: 50%;
        width: 0;
        height: 0;
        border: 20px solid transparent;
        border-bottom: 0;
        margin-top: -10px;
    }

    .chat-bubble--left:after {
        left: 0;
        border-right-color: #eee;
        border-left: 0;
        margin-left: -20px;
    }
</style>

<script>
    window.onload = function() {
        updateScroll();
        //$("#chat-content").scrollTop($("#chat-content")[0].scrollHeight);
    }

    //setInterval(updateScroll,3000);

    function updateScroll() {
        var myDiv = document.getElementById("chat-scroll-area");
        if (myDiv) {
            myDiv.scrollTop = myDiv.scrollHeight;
        } else {
            console.log("Cannot find element")
    }
}

    
</script>