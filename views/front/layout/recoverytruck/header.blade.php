<div id="loader-wrapper">
    <!-- <div id="loader1"> <img src="images/loader.gif" alt="" class="img img-responsive" /> </div> -->
</div>
<div class="sidebar">
    <b>Welcome!</b>
    <br/>
    <ul class="list-nav">
        <li>
            <a href="{{route('recoverytruck.vehicleinfo')}}">
                <span class="material-symbols-outlined"> Book_Online </span> Book Now
            </a>
        </li>
        <li>
            <a href="{{route('recoverytruck.history')}}">
                <span class="material-symbols-outlined"> Overview </span> Booking History
            </a>
        </li>
        <li>
            <a href="{{route('recoverytruck.logout')}}">
                <span class="material-symbols-outlined"> logout</span> Logout
            </a>
        </li>
    </ul>
</div>
<div class="header-top">
    <div class="container-fluid">
        <div class="row">

            <div class="col d-flex align-items-center">
                <div class="nav-toggle-outer" >
                    <a href="javascript:void(0)" id="navToggle">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 45 45"
                            enable-background="new 0 0 45 45" xml:space="preserve">
                            <g>
                                <path fill="#" d="M1.485,9.205c0-2.203,1.786-3.988,3.989-3.988h34.565c2.203,0,3.989,1.785,3.989,3.988
                                s-1.786,3.989-3.989,3.989H5.474C3.271,13.193,1.485,11.408,1.485,9.205L1.485,9.205z M40.039,18.512H5.475
                                c-2.203,0-3.989,1.785-3.989,3.988s1.786,3.988,3.989,3.988h34.564c2.203,0,3.988-1.785,3.988-3.988S42.242,18.512,40.039,18.512
                                L40.039,18.512z M40.039,31.807H5.475c-2.203,0-3.989,1.784-3.989,3.987s1.786,3.989,3.989,3.989h34.564
                                c2.204,0,3.989-1.786,3.989-3.989S42.242,31.807,40.039,31.807L40.039,31.807z" />
                            </g>
                        </svg>
                    </a>
                </div>
                <div id="logo">
                    <a href="{{url('/')}}" title="{{$title}}"> 
                        <img src="{{url('images/genral/'.$front_logo)}}" alt="logo"> 
                    </a> 
                </div>
            </div>

        </div>
    </div>
</div>
