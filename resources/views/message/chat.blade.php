@extends('message.messages_layout')
@extends('layouts.app')

@section('selected-user')
    {{ $selectedUser->first_name }} {{ $selectedUser->last_name }}
@stop

@section('content')
    @section('message-content')
    
    <div class="conteiner chat-area">
        <div class="chat-content" id="chat-content">
            @foreach($chatLines as $chatLine)
                <div class="row">
                    <div class="chat-box {{ $chatLine->sender_id == Auth::id() ? 'chat-box--right' : '' }}">
                        <div class="chat-bubble {{ $chatLine->sender_id == Auth::id() ? 'chat-bubble--blue' : '' }} chat-bubble--{{ $chatLine->sender_id == Auth::id() ? 'right' : 'left' }}">
                            {{ $chatLine->line_text }}
                        </div>
                    </div>    
                </div>
            @endforeach


        </div>
        <footer class="footer fixed">
            <div class="container-footer">
                <form method="post" action="{{ action([\App\Http\Controllers\MessageController::class, 'store'], ['receiver' => $selectedUser->id]) }}">
                    @csrf
                    <div class="input-group">
                        <label for=""></label>
                        <div class="chatboxdiv mx-auto pr-0">
                            <input class="chatbox" name="chatText" type="text" required/>
                        </div>
                        <button class="btn btn-link pl-0 ml-0" >
                            <span class="material-icons">
                                sentiment_satisfied_alt
                            </span>
                        </button>
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

    .input-group{
        display: flex;
        align-items: baseline;
    }
    .chat-area {
        width:80%;
        margin: auto;
    }

    .chat-content {
        margin-bottom: 70px;
    }

    .chat-box--right{
        display: flex;
        align-items: flex-end;
        flex-direction: row-reverse;
        width: 100%;
    }
    .chat-bubble {
        max-width:60%;
        padding: 10px 14px;
        background: #eee;
        margin: 10px 30px;
        border-radius: 9px;
        position: relative;
        animation: fadeIn 1s ease-in;

        &:after {
            content: '';
            position: absolute;
            top: 50%;
            width: 0;
            height: 0;
            border: 20px solid transparent;
            border-bottom: 0;
            margin-top: -10px;
        }

        &--left {
            &:after {
                left: 0;
                border-right-color: #eee;
                border-left: 0;
                margin-left: -20px;
            }
        }
    }

    .chat-bubble--blue{
        background: #147BFC;
        color: #fff;
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
    .chat-bubble--left:after{
        left: 0;
        border-right-color: #eee;
        border-left: 0;
        margin-left: -20px;       
    }
    .chat-bubble--right:after{
        right: 0;
        border-left-color: #147BFC;
        border-right: 0;
        margin-right: -20px;       
    }

    html {
        position: retaltive;
        min-height: 100%;
    }
    textarea{
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

    .chatboxdiv{
        width: 85%;
        margin: auto;
    }

    .chatbox{
        border-radius: 20px;
        width: 100%;
        padding: 10px 20px;
    }
    .material-icons{
        padding: 10px 5px;
    }


</style>

<script>
    window.onload = function(){
        updateScroll();
        //$("#chat-content").scrollTop($("#chat-content")[0].scrollHeight);
    }

    //setInterval(updateScroll,3000);

    function updateScroll(){
        var myDiv = document.getElementById("chat-scroll-area");
        if(myDiv){
            myDiv.scrollTop = myDiv.scrollHeight;
            console.log("Element finded");
        } else {
            console.log("Cannot find element")
        }
    }
    
    
</script>