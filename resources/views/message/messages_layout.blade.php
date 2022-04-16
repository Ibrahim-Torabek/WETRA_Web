
<div class="container-fluid" id="main" >
    <div class="row row-offcanvas row-offcanvas-left vh-100">
        <div class="left-sidebar col-md-3 col-lg-3 sidebar-offcanvas h-100 overflow-auto bg-light pl-0" id="sidebar" role="navigation">
            <nav class="navbar sticky-top bg-light" style="z-index: 1025;">

                <ul class="pl-0 pb-0"  style="width: 100%;">
                    <h2>Messages</h2>
                </ul>
                <ul class="pl-0 pt-0">
                    <a type="button" class="btn btn-primary btn-lg " style="border-radius: 25px;" 
                        href="{{ action([App\Http\Controllers\MessageController::class, 'create']) }}"
                    >
                        <i class="material-icons">
                            message
                        </i>
                        Start Chat
                    </a>    
                </ul>

            </nav>
            <ul class="nav flex-column sticky-top pl-0 pt-2 mt-3">
                @foreach(App\Http\Controllers\MessageController::getChatedUsers() as $user)
                    <li class="nav-item @if(!empty($user['un_read'])) font-weight-bold @endif">
                        <a class="nav-link" href="{{ action([App\Http\Controllers\MessageController::class, 'chat'], ['selectedUser' => $user]) }}">


                        <table>

                        <tr>
                            <td class="ml-2" rowspan="2">                               
                                <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50" height="50">
                                            <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="{{ $user->background }}"/>
                                            <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"/>
                                            <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"/>
                                        </svg></td>
                            <td><span>{{ $user->first_name}} {{ $user->last_name}}</span></td>
                        </tr>
                        <tr>
                            
                            <td><spam class="d-inline-block text-truncate text-uppercase" style="max-width: 200px;"> {{ $user['message'] }}</spam></td>
                        </tr>
                        </table>

                        </a>
                    </li>
                @endforeach
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Reports▾</a>
                    <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
                       <li class="nav-item"><a class="nav-link" href="">Report 1</a></li>
                       <li class="nav-item"><a class="nav-link" href="">Report 2</a></li>
                    </ul>
                </li> -->
 

            </ul>
        </div>
        <!--/col-->
        <main class="col main pt-0 mt-0 h-100 overflow-auto chat-main" id="chat-scroll-area">
            <nav class="nav navvar sticky-top bg-white border-bottom" style="z-index: 1025;box-shadow: 0 2px 2px -2px gray;">
                <h3 class="pt-3 pb-3">
                    @yield('selected-user')
                </h3>
            </nav>

            @yield('message-content')
            

        </main>
        <!--/main col-->
    </div>

</div>

<style>
.chat-main{
    position: relative;
    min-height: 80%;
    max-height: calc(100% - 100px);
    width: 90%;
    margin: auto;
}

.left-sidebar{
    max-height:95%;
    background-color: red;
}

body{
  overflow: hidden;
  height: 100%;
}
</style>



