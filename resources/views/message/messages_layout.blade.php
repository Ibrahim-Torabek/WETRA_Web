
<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left vh-100">
        <div class="col-md-3 col-lg-3 sidebar-offcanvas h-100 overflow-auto bg-light pl-0" id="sidebar" role="navigation">
            <nav class="navbar sticky-top bg-light" style="z-index: 1025;">

                <ul class="pl-0">
                    <h2>Messages</h2>
                </ul>
                <ul >
                    <button type="button" class="btn btn-primary btn-lg " style="border-radius: 25px;">
                        <i class="material-icons">
                            message
                        </i>
                        Start Chat
                    </button>    
                </ul>

            </nav>
            <ul class="nav flex-column sticky-top pl-0 pt-2 mt-3">
                @for ($i=0; $i < 50; $i++)
                    <li class="nav-item">
                        <a class="nav-link" href="#">


                        <table>

                        <tr>
                            <td class="ml-2" rowspan="2">                               
                                <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50" height="50">
                                            <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green"/>
                                            <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"/>
                                            <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"/>
                                        </svg></td>
                            <td>FirstName LastName</td>
                        </tr>
                        <tr>
                            
                            <td>Message</td>
                        </tr>
                        </table>

                        </a>
                    </li>
                @endfor
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
        <main class="col main pt-5 mt-3 h-100 overflow-auto">
            <h1 class="display-4 d-none d-sm-block">
            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} (Selected user name goes here)
            </h1>
            <hr>
            @yield('message-content')
            

        </main>
        <!--/main col-->
    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <p>This is a dashboard layout for Bootstrap 4. This is an example of the Modal component which you can use to show content.
                Any content can be placed inside the modal and it can use the Bootstrap grid classes.</p>
                <p>
                    <a href="https://www.codeply.com/go/KrUO8QpyXP" target="_ext">Grab the code at Codeply</a>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary-outline" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    
    $('[data-toggle=offcanvas]').click(function() {
      $('.row-offcanvas').toggleClass('active');
    });
    
  });
</script>