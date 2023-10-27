<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>Bienvenue | EH WHLIN MI ASSURANCE</title>

    <!--====== Favicon Icon ======-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="assets/css/slick.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="assets/css/animate.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="assets/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">

    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

</head>

<body>

    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== NAVBAR PART START ======-->

    <section class="header-area">
        <div class="navbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand text-center" href="#">
                                <img src="assets/images/logo-nsia-mms.png" style="width: 70px; height : 70px;" alt="Logo">
                                <p style="color : black">EH WHLIN MI</p>
                            </a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarEight" aria-controls="navbarEight" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                <ul class="navbar-nav ml-auto text-black" style="color : white">
                                    <li class="nav-item">
                                        <a style="color: black;" class="page-scroll" href="/">ACCEUIL</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a style="color: black;" class="page-scroll" href="{{route('home.marchands')}}">MARCHANDS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a style="color: black;" class="page-scroll" href="/#contact">CONTACT</a>
                                    </li>
                                    <li class="nav-item">
                                        @if (Route::has('login'))
                                            @auth
                                                <a style="color: black;" href="{{ route('dash.index') }}">MON COMPTE</a>
                                            @else
                                                <a style="color: black;" href="{{ route('login') }}">CONNEXION</a>
                                            @endauth
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="navbar-btn d-none mt-15 d-lg-inline-block">
                                <a class="menu-bar" href="#side-menu-right"><i class="lni-menu"></i></a>
                            </div>
                        </nav>
                        <!-- navbar -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- navbar area -->

        <div id="home" class="slider-area">
            <div class="bd-example">
            </div>
            <!-- bd-example -->
        </div>

    </section>

    <!--====== NAVBAR PART ENDS ======-->

    <!--====== SAIDEBAR PART START ======-->

    <div class="sidebar-right">
        <div class="sidebar-close">
            <a class="close" href="#close"><i class="lni-close"></i></a>
        </div>
        <div class="sidebar-content">
            <div class="sidebar-logo text-center">
                <a href="#"><img src="assets/images/logo-nsia-mms.png" style="width: 75px; height : 75px;" alt="Logo"></a>
            </div>
            <!-- logo -->
            <div class="sidebar-menu">
                <ul>
                    <li class="nav-item">
                        <a class="page-scroll" href="/">ACCEUIL</a>
                    </li>
                    <li class="nav-item active">
                        <a class="page-scroll" href="{{ route('home.marchands') }}">MARCHANDS</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="/#contact">CONTACT</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('dash.index') }}">MON COMPTE</a>
                            @else
                                <a href="{{ route('login') }}">CONNEXION</a>
                            @endauth
                        @endif
                    </li>

                </ul>
            </div>
            <!-- menu -->
            <!--div class="sidebar-social d-flex align-items-center justify-content-center">
                <span>FOLLOW US</span>
                <ul>
                    <li><a href="#"><i class="lni-twitter-original"></i></a></li>
                    <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                </ul>
            </div-->
            <!-- sidebar social -->
        </div>
        <!-- content -->
    </div>
    <div class="overlay-right"></div>

    <!--====== SAIDEBAR PART ENDS ======-->

    <!--====== TESTIMONIAL THREE PART START ======-->

    <section id="testimonial" class="testimonial-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center pb-10">
                        <h4>Rechercher un marchand:</h4>
                        <hr class="my-3"></hr>
                        <form autocomplete="off" action="{{ route('home.search')}}" method="POST">
                            @csrf
                            <label>Sélectionnez ici votre commune afin de trouver un de nos marchands</label>
                            <select required class="form-control select2bs4" style="width: 100%" name="commune_id">
                                <option value="" selected disabled>Choisissez votre commune</option>
                                @foreach($communes as $c)
                                    <option value="{{$c->id}}">{{$c->departement->nom}} - {{$c->nom}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary" id="searchUserBtn">Rechercher</button>
                        </form>

                        <div id="ajaxInputMarchand-results" class="row">
                            @if($marchands)
                                @forelse($marchands as $u)
                                    <div class="card mt-2 col-md-3 col-lg-4" >
                                        <div class="card-body">{{$u->shortFullname}} - {{$u->telephone}}</div>
                                    </div>
                                @empty
                                <div class="card mt-2 col-12" >
                                    <div class="card-body">Nous n'avons pas encore de marchand dans cette commune.</div>
                                </div>
                                @endforelse
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container -->
    </section>

    <!--====== TESTIMONIAL THREE PART ENDS ======-->

    <!--====== FOOTER FOUR PART START ======-->

    <footer id="footer" class="footer-area">
        <div class="footer-copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="copyright text-center text-lg-left mt-10">
                            <p class="text">&copy; 2020 <a style="color: #38f9d7" rel="nofollow" href="#">EH WHLIN MI</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--====== FOOTER FOUR PART ENDS ======-->

    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->

    <!--====== jquery js ======-->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>

    <!--====== Slick js ======-->
    <script src="assets/js/slick.min.js"></script>

    <!--====== Isotope js ======-->
    <script src="assets/js/isotope.pkgd.min.js"></script>

    <!--====== Images Loaded js ======-->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>

    <!--====== Magnific Popup js ======-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>

    <!--====== Scrolling js ======-->
    <script src="assets/js/scrolling-nav.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>

    <!--====== wow js ======-->
    <script src="assets/js/wow.min.js"></script>

    <script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
    <script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>

    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>


</body>

</html>
