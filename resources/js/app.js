const { default: axios } = require('axios');

require('./bootstrap');



/********************************************************************************************************************************
 ********************************************************************************************************************************
 *               Message
 ********************************************************************************************************************************
 ********************************************************************************************************************************/

 
//var user = {{ json_encode((array)auth()->user()) }};
const message_input = document.getElementById("chatText");
const message_form = document.getElementById("message_form");
const message_content = document.getElementById("chat-content");
const selected_user = document.getElementById("selectedUser");
const message_url = document.getElementById("message—url").value;
const schedule_url = document.getElementById("schedule-url").value;
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
            <small class="text-dark">Now ...</small><br>
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






/********************************************************************************************************************************
 ********************************************************************************************************************************
 *
 *               Schedule
 * 
 ********************************************************************************************************************************
 ********************************************************************************************************************************/

// Add event
$("#submit-event").click(function(e) {
    e.preventDefault();
    //$("#dayDialog").hide();
    is_group = $("#assigned_to").find(':selected').attr('is_group');
    //alert();
    $.ajax({
        url: "schedules",
        type: "POST",
        data: {
            //_token: "{{ csrf_token() }}",
            scheduleType: $("#schedule-type").val(),
            title: $("#title").val(),
            start: $("#start").val(),
            end: $("#end").val(),
            allDay: $("#allDay").val(),
            description: $("#description").val(),
            assigned_to: $("#assigned_to").val(),
            is_group: is_group,
            color: $("#color").val(),
            textColor: $("#textColor").val(),
            id: $("#id").val(),
        },
        success: function(data) {
            $("#dayDialog").dialog('close');

            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Event added or updated successfully',

                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            $('#calendar').fullCalendar('refetchEvents');

        },
        error: function(result) {
            //$("#dayDialog").hide();
            alert("Error: " + result);
            console.log(result);

        },
    });
});

// Listen schedule chanlle
window.Echo.channel('schedule')
    .listen('.schedule', (e) => {
        console.log(e);
        if(user.value == e.user){
            Swal.fire({
                toast: true,
                icon: 'info',
                title: '<a href="' + schedule_url + '?day=' + e.day + '">You have a new Schedule</a>',
                position: 'top-right',
                showConfirmButton: false,
                timer: 6000,
            });
        }

        // if (user.value == e.user) {
        //     if (selected_user != null && selected_user.value == e.sender) {
        //         message_content.innerHTML += `
        // <div class="chat-box col-md-10 d-flex ">
        //     <div class="chat-bubble chat-bubble--blue  chat-bubble--left">
        // ` + e.message + `
        //     </div>
        // </div>
        // `
        //         message_input.value = "";
        //         updateScroll();
        //     } else {

        //         // url = {!!str_replace("'", "\'", json_encode(url("messages"))) !!};// "<?php echo url('messages') ?>"
        //         //url = {!!str_replace("'", "\'", json_encode($users)) !!};
        //         console.log("Url: " + message_url);
        //         Swal.fire({
        //             toast: true,
        //             icon: 'info',
        //             title: '<a href="' + message_url + '/chat?selectedUser=' + e.sender + '">You have a new Message</a>',
        //             position: 'top-right',
        //             showConfirmButton: false,
        //             timer: 6000,
        //         });
        //     }
        // }
    });


/********************************************************************************************************************************
 ********************************************************************************************************************************
 *
 *               File
 * 
 ********************************************************************************************************************************
 ********************************************************************************************************************************/

    $('#shared_to').change(function(){
        $('#is_group').val($('#shared_to').find(':selected').attr('is_group'));
        console.log($('#is_group').val());
    });

    $("#file").on('change', function(e){
                let size = this.files[0].size;
                if(size > 2097152){  // If more than 2MB
                    alert('File zise must be less than 2MB ');
                    //toast('Your Post as been submited!','success');

                    e.preventDefault();
                    $("#file").val('');
                    //$("#uploadForm").reset;
                }
                
    });

/********************************************************************************************************************************
 ********************************************************************************************************************************
 *
 *               User
 * 
 ********************************************************************************************************************************
 ********************************************************************************************************************************/
 const buttons = document.getElementsByClassName("change-group-name");
 const inputs = document.getElementsByClassName("group-name-input");
 

for (i = 0; i < buttons.length; i++){
    buttons[i].onclick = function(e){
        e.preventDefault();
        
        groupName = 'Hello'; // inputs[0].value();
        groupId = this.getAttribute('group_id');
        groupName = document.getElementById(groupId).value;

        const options = {
            method: "PUT",
            url: "../../groups/" + groupId,
            data: {
                id: groupId,
                name: groupName,
            }
        };
        axios(options);
    }
}

$('#close_modal').click(function(){
    location.reload();
});