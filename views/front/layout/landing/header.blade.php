    <div class="top-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="top-left-text">
                        Emergency towing services when you need them most
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/profile.php?id=100085467462410" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        </li>

                        <li>
                            <a href="https://www.instagram.com/jasper_realtors/?igshid=NmNmNjAwNzg%3D" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/company/jasper-real-estate/" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Linkedin"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <header class="sticky">
        <div class="container mt-2 mb-2">
            <div class="row">
                <div class="col-xl-3 col-md-2 col-sm-4 col-4">
                    
                    <div class="mt-1">
                        <a href="{{ url('/') }}">
                            <img class="logo-img" src="{{url('images/genral/'.$front_logo)}}" alt="min_logo">
                        </a>
                    </div>
                </div>
                <div class="col-xl-9 col-md-10 col-sm-8 col-8">
                    <div class="d-flex align-items-center justify-content-end">
                       
                        <div class="header-contact-info">
                            <a href="tel:++971521376412 ">
                            <div class="info-icon-box">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <div class="info-icon-text d-lg-block d-md-block d-none">
                            <p class="mb-0"><small>Call Us Now</small></p>
                            <h6>
                                <a href="tel:{{$genrals_settings->mobile}}" tiltle="Call Us Now">
                                    {{$genrals_settings->mobile}} 
                                </a>
                            </h6>
                            </div>
                            </a>
                        </div>
                        <div class="header-contact-info">
                            <a href="mailto:info@hire&fyre.com">
                            <div class="info-icon-box">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                            <div class="info-icon-text  d-lg-block d-md-block d-none">
                            <p class="mb-0"><small>Email Us Now</small></p>
                            <h6>
                                <a href="mailto:{{$genrals_settings->email}}" tiltle="E-Mail">
                                    {{$genrals_settings->email}}
                                </a>
                            </h6>
                            </div>
                        </a>
                        </div>
                        <button class="navbar-toggler drawer-hamburger d-block d-lg-none " type="button" data-toggle="collapse" data-target="#navmobileopen" aria-controls="navmobileopen" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="drawer-hamburger-icon"></span>
                            <!-- <i class="fa fa-align-justify" aria-hidden="true"></i> -->
                            <span class="sr-only">toggle navigation</span>
                        </button>
                    </div>
                </div>
            </div>
           
        </div>
        <div class="nav-outer">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="nav-overlay" data-toggle="collapse" data-target="#navmobileopen" aria-controls="navmobileopen" aria-expanded="false" aria-label="Toggle navigation" role="menubar"></div>
                        <div class="collapse navbar-collapse" id="navmobileopen">
                            <ul class="navbar-nav mr-auto" id="nav">
                                <li class="nav-item current">
                                    <a class="nav-link " href="index.html">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#">Hire a Recovery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#">Rent Equipments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#">Consultancy Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        </div>
    </header>