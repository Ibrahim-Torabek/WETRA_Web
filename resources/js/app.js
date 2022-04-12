const { default: axios } = require('axios');

require('./bootstrap');
//console.log("Hello World");

//var user = {{ json_encode((array)auth()->user()) }};
const message_input = document.getElementById("chatText");
const message_form = document.getElementById("message_form");
const message_content = document.getElementById("chat-content");
// if(document.getElementById("selectedUser") != null){
//     const receiver = document.getElementById("selectedUser");
// } else {
//     const receiver = document.getElementById("selectedGroup");
// }
const user = document.getElementById("user");


message_form.addEventListener('submit', function (e) {

    e.preventDefault();
    console.log("receiver");

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
        }
    } else {
        const options = {
            method: "POST",
            url: "../messages",
            data: {
                chatText: message_input.value,
                group: parseInt(document.getElementById("selectedUser").value),
            }
        }
    }

    //console.log(options);
    axios(options);
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

window.Echo.channel('chat')
    .listen('.message', (e) => {
        //console.log(e);

        if (user.value == e.user) {
            message_content.innerHTML += `
        <div class="chat-box col-md-10 d-flex ">
            <div class="chat-bubble chat-bubble--blue  chat-bubble--left">
        ` + e.message + `
            </div>
        </div>
        `
            message_input.value = "";
            updateScroll();
        }
    });

// Echo.channel('chat')
//   .listen('.message', (e) => {
//     // this.messages.push({
//     //   message: e.message.message,
//     //   user: e.user
//     // });
//     console.log(e);
//   });