const { default: axios } = require('axios');

require('./bootstrap');


//var user = {{ json_encode((array)auth()->user()) }};
const message_input = document.getElementById("chatText");
const message_form = document.getElementById("message_form");
const message_content = document.getElementById("chat-content");
const selected_user = document.getElementById("selectedUser");
const message_url = document.getElementById("messageUrl").value;
const user = document.getElementById("user");


if (message_form != null) {
    message_form.addEventListener('submit', function (e) {

        e.preventDefault();


        let has_errors = false;

        if (has_errors) {
            return;
        }


        if (document.getElementById("selectedUser") != null) {
            const options = {
                method: "POST",
                url: "../messages",
                data: {
                    chatText: message_input.value,
                    receiver: parseInt(document.getElementById("selectedUser").value),
                }
            };
            axios(options);
            console.log("Selected User");
        } else {
            const options = {
                method: "POST",
                url: "../messages",
                data: {
                    chatText: message_input.value,
                    group: parseInt(document.getElementById("selectedGroup").value),
                }
            };
            axios(options);
            console.log("Selected Group");
        }

        //console.log(options);

        // message_content.innerHTML += '<div class="chat-box col-md-10 d-flex justify-content-end">';
        // message_content.innerHTML += '<div class="chat-bubble chat-bubble--blue bg-primary text-light chat-bubble--right">';
        // message_content.innerHTML += message_input.value;
        // message_content.innerHTML += '</div></div>';
        message_content.innerHTML += `
        <div class="chat-box col-md-10 d-flex justify-content-end">
            <div class="chat-bubble chat-bubble--blue bg-primary text-light chat-bubble--right">
        ` + message_input.value + `
            </div>
        </div>
        `
        message_input.value = "";
        updateScroll();

    });
}

window.Echo.channel('chat')
    .listen('.message', (e) => {
        //console.log(e);
        console.log("User: " + user.value);
        if (user.value == e.user) {
            if (selected_user != null && selected_user.value == e.sender) {
                message_content.innerHTML += `
        <div class="chat-box col-md-10 d-flex ">
            <div class="chat-bubble chat-bubble--blue  chat-bubble--left">
        ` + e.message + `
            </div>
        </div>
        `
                message_input.value = "";
                updateScroll();
            } else {

                // url = {!!str_replace("'", "\'", json_encode(url("messages"))) !!};// "<?php echo url('messages') ?>"
                //url = {!!str_replace("'", "\'", json_encode($users)) !!};
                console.log("Url: " + message_url);
                Swal.fire({
                    toast: true,
                    icon: 'info',
                    title: '<a href="' + message_url + '/chat?selectedUser=' + e.sender + '">You have a new Message</a>',
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 6000,
                });
            }
        }
    });

