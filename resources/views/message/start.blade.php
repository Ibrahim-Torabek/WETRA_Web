@extends('message.messages_layout')
@extends('layouts.app')

@section('selected-user')
    New Conversation
@stop

@section('content')
    @section('message-content')
        <h4> Contacts </h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <table>
                        <tr>
                            <td class="ml-2" rowspan="2">                               
                                <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green"/>
                                    <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"/>
                                    <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"/>
                                </svg></td>
                        </tr>
                        <tr>                            
                            <td>All Users</td>
                        </tr>
                    </table>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <table>
                        <tr>
                            <td class="ml-2" rowspan="2">                               
                                <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green"/>
                                    <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"/>
                                    <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"/>
                                </svg></td>
                        </tr>
                        <tr>                            
                            <td>Admins</td>
                        </tr>
                    </table>
                </a>
            </li>
        </ul>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <table>
                        <tr>
                            <td class="ml-2" rowspan="2">                               
                                <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green"/>
                                    <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"/>
                                    <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"/>
                                </svg></td>
                        </tr>
                        <tr>                            
                            <td>Office Stuff</td>
                        </tr>
                    </table>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <table>
                        <tr>
                            <td class="ml-2" rowspan="2">                               
                                <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green"/>
                                    <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"/>
                                    <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"/>
                                </svg></td>
                        </tr>
                        <tr>                            
                            <td>Barn Stuff</td>
                        </tr>
                    </table>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <table>
                        <tr>
                            <td class="ml-2" rowspan="2">                               
                                <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green"/>
                                    <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"/>
                                    <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"/>
                                </svg></td>
                        </tr>
                        <tr>                            
                            <td>Volunteers</td>
                        </tr>
                    </table>
                </a>
            </li>
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <table>
                        <tr>
                            <td class="ml-2" rowspan="2">                               
                                <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
                                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green"/>
                                    <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"/>
                                    <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"/>
                                </svg></td>
                        </tr>
                        <tr>                            
                            <td>Instructors</td>
                        </tr>
                    </table>
                </a>
            </li>            
            <hr>
            @foreach($users as $user)
                <li class="nav-item">
                    <a class="nav-link" href="{{ action([App\Http\Controllers\MessageController::class, 'chat']) }}">
                        <table>
                            <tr>
                                <td class="ml-2" rowspan="2">                               
                                    <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
                                        <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green"/>
                                        <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"/>
                                        <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"/>
                                    </svg></td>
                            </tr>
                            <tr>                            
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            </tr>
                        </table>
                    </a>
                </li>
            @endforeach
        </ul>

        </ul>

    @stop
@stop