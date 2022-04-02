<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WETRA') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/af.min.js" integrity="sha512-lnYINW0FnmQ7QKM2C5b94J7Ev9xp80zvVPs5qY2dImqaUVAyPiGUtZdSks9UsKixpl0G+Vee3Aps3XqOGm4LDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" integrity="sha512-o0rWIsZigOfRAgBxl4puyd0t6YKzeAw9em/29Ag7lhCQfaaua/mDwnpE2PVzwqJ08N7/wqrgdjc2E0mwdSY2Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="{{ asset('js/fullcalendar.js') }}" defer></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ asset('css/CardHeader.css') }}" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" integrity="sha512-KXkS7cFeWpYwcoXxyfOumLyRGXMp7BTMTjwrgjMg0+hls4thG2JGzRgQtRfnAuKTn2KWTDZX4UdPg+xTs8k80Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> -->
    <style>
        /*
i wish this required CSS was better documented :(
https://github.com/FezVrasta/popper.js/issues/674
derived from this CSS on this page: https://popper.js.org/tooltip-examples.html
*/

        .popper,
        .tooltip {
            position: absolute;
            z-index: 9999;
            background: #FFC107;
            color: black;
            width: 150px;
            border-radius: 3px;
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
            padding: 10px;
            text-align: center;
        }

        .style5 .tooltip {
            background: #1E252B;
            color: #FFFFFF;
            max-width: 200px;
            width: auto;
            font-size: .8rem;
            padding: .5em 1em;
        }

        .popper .popper__arrow,
        .tooltip .tooltip-arrow {
            width: 0;
            height: 0;
            border-style: solid;
            position: absolute;
            margin: 5px;
        }

        .tooltip .tooltip-arrow,
        .popper .popper__arrow {
            border-color: #FFC107;
        }

        .style5 .tooltip .tooltip-arrow {
            border-color: #1E252B;
        }

        .popper[x-placement^="top"],
        .tooltip[x-placement^="top"] {
            margin-bottom: 5px;
        }

        .popper[x-placement^="top"] .popper__arrow,
        .tooltip[x-placement^="top"] .tooltip-arrow {
            border-width: 5px 5px 0 5px;
            border-left-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            bottom: -5px;
            left: calc(50% - 5px);
            margin-top: 0;
            margin-bottom: 0;
        }

        .popper[x-placement^="bottom"],
        .tooltip[x-placement^="bottom"] {
            margin-top: 5px;
        }

        .tooltip[x-placement^="bottom"] .tooltip-arrow,
        .popper[x-placement^="bottom"] .popper__arrow {
            border-width: 0 5px 5px 5px;
            border-left-color: transparent;
            border-right-color: transparent;
            border-top-color: transparent;
            top: -5px;
            left: calc(50% - 5px);
            margin-top: 0;
            margin-bottom: 0;
        }

        .tooltip[x-placement^="right"],
        .popper[x-placement^="right"] {
            margin-left: 5px;
        }

        .popper[x-placement^="right"] .popper__arrow,
        .tooltip[x-placement^="right"] .tooltip-arrow {
            border-width: 5px 5px 5px 0;
            border-left-color: transparent;
            border-top-color: transparent;
            border-bottom-color: transparent;
            left: -5px;
            top: calc(50% - 5px);
            margin-left: 0;
            margin-right: 0;
        }

        .popper[x-placement^="left"],
        .tooltip[x-placement^="left"] {
            margin-right: 5px;
        }

        .popper[x-placement^="left"] .popper__arrow,
        .tooltip[x-placement^="left"] .tooltip-arrow {
            border-width: 5px 0 5px 5px;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            right: -5px;
            top: calc(50% - 5px);
            margin-left: 0;
            margin-right: 0;
        }
    </style>
    <script>
        //@yield('script')
        $(document).ready(function() {

            $('.multiple_select').select2({
                placeholder: "Select a group or a person",
                allowClear: true,
                dropdownParent: $('#dayDialog')
            });

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // $("#submit").click(function(e) {
            //     //e.preventDefault();
            //     //$("#dayDialog").hide();
            //     $.ajax({
            //         url: "schedules/store",
            //         type: "POST",
            //         data: {
            //             _token: "{{ csrf_token() }}",
            //             _method: "POST",
            //             title: $("#title").val(),
            //             start: $("#start").val(),
            //             end: $("#end").val(),
            //             allDay: $("#allDay").val(),
            //             assigned_to: $("#assigned_to").val(),
            //             color: $("#color").val(),
            //             textColor: $("#textColor").val(),
            //             id: $("#id").val(),
            //         },
            //         success: function(data) {
            //             calendar.fullCalendar('fetchEvents');
            //             alert("Event Created Successfully");
            //         }
            //     })
            // });

            // function convert(str){
            //     const d = new Date(str);
            //     let month = '' + (d.getMonth() + 1);
            //     let day = '' + (d.getDate());
            //     let year = '' + d.getFullYear();
            //     if(month.length < 2) month = '0' + month;
            //     if(day.length < 2) day = '0' + day;

            //     let hour = '' + d.getHours();
            //     let minute = '' + d.getMinutes();
            //     let second = '' + d.getSeconds();
            //     if(hour.length < 2) hour = '0' + hour;
            //     if(minute.length < 2) minute = '0' + minute;
            //     if(second.length < 2) second = '0' + second;

            //     return [year,month,day].join('-') + ' ' + [hour,minute,second].join(':');
            // };
            //var view = $('#calendar').fullCalendar('getView');
            //console.log(view);

            var calendarEl = document.getElementById('calendar');

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'year,month,agendaWeek,agendaDay,listWeek'
                },
                height: 650,
                showNonCurrenDates: false,
                initialView: 'listWeek',
                //defaultView: 'listWeek',
                events: "{{ url('/schedules') }}",
                eventDidMount: function(info) {
                    var tooltip = new Tooltip(info.el, {
                        title: "Hello World", //info.event.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                    console.log(info);
                },

                @auth
                @if(Auth::user() -> is_admin == 1)
                selectable: true,
                dragabble: true,
                selectHelper: true,
                editable: true,
                dayClick: function(date, event, view) {
                    var date = $.fullCalendar.formatDate(date, 'Y-MM-DD HH:mm:ss');
                    $("#title").val("");
                    $("#start").val((date));
                    $("#end").val((date));
                    $("#delete").hide();
                    $("#submit").html('Add Event');
                    $('#dayDialog').dialog({
                        title: 'Add Schedule',
                        width: 600,
                        height: 720,
                        modal: true,
                        show: {
                            effect: 'clip',
                            duration: 350
                        },
                        hide: {
                            effect: 'clip',
                            duration: 250
                        },
                    });
                    //calendar.fullCalendar('renderEvent', event, true);
                },
                select: function(start, end) {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                    $('#start').val((start));
                    $('#end').val((end));
                    $("#delete").hide();
                    $("#submit").html('Add Event');
                    $('#dayDialog').dialog({
                        title: 'Add Schedule',
                        width: 600,
                        height: 720,
                        modal: true,
                        show: {
                            effect: 'clip',
                            duration: 350
                        },
                        hide: {
                            effect: 'clip',
                            duration: 250
                        },
                    })
                },
                eventClick: function(event) {
                    $("#title").val(event.title);
                    $("#start").val($.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss'));
                    $("#end").val($.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss'));
                    $("#allDay").val(event.allDay);
                    $("#assigned_to").val(event.assigned_to);
                    $("#color").val(event.color);
                    $("#textColor").val(event.textColor);
                    $("#id").val(event.id);
                    $("#submit").html('Update');
                    var url = "{{ url('schedules/deleteEvent') }}";
                    $("#delete").show().attr('href', url + '/' + event.id);
                    $('#dayDialog').dialog({
                        title: 'Edit Schedule',
                        width: 600,
                        height: 750,
                        modal: true,
                        show: {
                            effect: 'clip',
                            duration: 350
                        },
                        hide: {
                            effect: 'clip',
                            duration: 250
                        },
                    })
                },
                @endif
                @endauth

            });

            calendar.render();

            // calendar.fullCalendar('renderEvent', event, true);
        })
    </script>

</head>

<body>
    <div id="app">

        <nav class="navbar fixed-top navbar-expand-md navbar-dark p-0  shadow-sm" style="background-color:#800b37;">
            <div class="container">

                <!-- <a class="navbar-brand" href="{{ url('https://www.wetra.ca/') }}">
                    <h3>{{ config('app.name', 'Home') }}</h3>
                </a> -->
                <a class="navbar-brand" href="#">
                    <img src="/wetra/storage/logo-main-light-80H.png" alt="" width="60" height="45" style="margin-right:80px;">

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ (request()->routeIs('messages.*')) ? 'active' : '' }}">
                            <a class="navbar-brand" href="{{ url('/messages') }}" style="color:{{ (request()->is('messages/*') or request()->is('messages')) ? 'gray' : '' }};">
                                Messages
                            </a>


                        </li>
                        <li class=" {{ (request()->is('schedule')) ? 'active' : '' }}">
                            <a class="navbar-brand" href="{{ url('/schedules') }}" style="color:{{ (request()->is('schedules/*') or request()->is('schedules')) ? 'gray' : '' }};">
                                Schedules
                            </a>
                        </li>
                        <li class=" {{ (request()->is('file')) ? 'active' : '' }}">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                Files
                            </a>
                        </li>
                        @if(Auth::user()->is_admin == 1)
                        <li class=" {{ (request()->is('user')) ? 'active' : '' }}">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                Users
                            </a>
                        </li>
                        @endif
                    </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <!-- <img src="storage/avatar_icon.svg" alt="" width="30" height="30" class="Test1" > -->
                                <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green" />
                                    <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff" />
                                    <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff" />
                                </svg>
                                {{ Auth::user()->first_name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user/profile') }}">
                                    {{ __('Profile') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <!-- <div class="p-5">
                {{ request()->routeIs('messages.*') }}
            </div> -->
            @yield('content')
        </main>
    </div>

</body>

</html>