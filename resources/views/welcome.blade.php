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
                                    <li class="nav-item active">
                                        <a style="color: black;" class="page-scroll" href="#home">ACCEUIL</a>
                                    </li>
                                    <li class="nav-item">
                                        <a style="color: black;" class="page-scroll" href="{{route('home.marchands')}}">MARCHANDS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a style="color: black;" class="page-scroll" href="#contact">CONTACT</a>
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
                <div id="carouselOne" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselOne" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselOne" data-slide-to="1"></li>
                        <li data-target="#carouselOne" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="carousel-item bg_cover active" style="background-image: url(assets/images/slider-1.jpeg)">
                            <div class="carousel-caption">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-7 col-sm-10">
                                            <h2 class="carousel-title">EH WHLIN MI ASSURANCE</h2>
                                            <!--ul class="carousel-btn rounded-buttons">
                                                <li><a class="main-btn rounded-three" href="#">GET STARTED</a></li>
                                                <li><a class="main-btn rounded-one" href="#">DOWNLOAD</a></li>
                                            </ul-->
                                        </div>
                                    </div>
                                    <!-- row -->
                                </div>
                                <!-- container -->
                            </div>
                            <!-- carousel caption -->
                        </div>
                        <!-- carousel-item -->

                        <div class="carousel-item bg_cover" style="background-image: url(assets/images/slider-2.jpeg)">
                            <div class="carousel-caption">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-7 col-sm-10">
                                            <h2 class="carousel-title">EH WHLIN MI ASSURANCE</h2>
                                            <!--ul class="carousel-btn rounded-buttons">
                                                <li><a class="main-btn rounded-three" href="#">GET STARTED</a></li>
                                                <li><a class="main-btn rounded-one" href="#">DOWNLOAD</a></li>
                                            </ul-->
                                        </div>
                                    </div>
                                    <!-- row -->
                                </div>
                                <!-- container -->
                            </div>
                            <!-- carousel caption -->
                        </div>
                        <!-- carousel-item -->

                        <div class="carousel-item bg_cover" style="background-image: url(assets/images/slider-2.jpeg)">
                            <div class="carousel-caption">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-7 col-sm-10">
                                            <h2 class="carousel-title">EH WHLIN MI ASSURANCE</h2>
                                            <!--ul class="carousel-btn rounded-buttons">
                                                <li><a class="main-btn rounded-three" href="#">GET STARTED</a></li>
                                                <li><a class="main-btn rounded-one" href="#">DOWNLOAD</a></li>
                                            </ul-->
                                        </div>
                                    </div>
                                    <!-- row -->
                                </div>
                                <!-- container -->
                            </div>
                            <!-- carousel caption -->
                        </div>
                        <!-- carousel-item -->
                    </div>
                    <!-- carousel-inner -->

                    <a class="carousel-control-prev" href="#carouselOne" role="button" data-slide="prev">
                        <i class="lni-arrow-left-circle"></i>
                    </a>

                    <a class="carousel-control-next" href="#carouselOne" role="button" data-slide="next">
                        <i class="lni-arrow-right-circle"></i>
                    </a>
                </div>
                <!-- carousel -->
            </div>
            <!-- bd-example -->
        </div>

    </section>

    <!--====== NAVBAR PART ENDS ======-->


    <!--====== ABOUT PART START ======-->

    <section id="about" class="about-area  text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <!--div class="about-image text-center wow fadeInUp" data-wow-duration="1.5s" data-wow-offset="100">
                        <img src="assets/images/services.png" alt="services">
                    </div-->
                    <div class="section-title mt-10 pb-40">
                        <h4 class="title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.6s">{{ config('app.name')}} ASSURANCES</h4>
                        <p class="text wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s"></p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
            <!-- row -->

            <div class="row mx-2 mb-0">
                <p class="text text-justify mb-4">
                Le produit EH WHLINMI est une initiative du Groupe MMS en partenariat avec NSIA Vie Assurance
                pour la promotion et la vente du produit Prévoyance Décès à la population béninoise.</p>
                
                <p class="text text-justify" >
                Le produit Prévoyance Décès de NSIA Vie est une assurance qui consiste à faire souscrire des personnes 
                proches pour qui l'on verse une cotisation mensuelle ou annuelle, afin qu'en  cas de décès de ces 
                derniers, qu'un capital conséquent vous soit versé pour une organisation plus facile des funérailles.</p>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!--====== ABOUT PART ENDS ======-->


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
                    <li class="nav-item active">
                        <a class="page-scroll" href="#home">ACCEUIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="{{ route('home.marchands') }}">MARCHANDS</a>
                    </li>
                    <li class="nav-item">
                        <a class="page-scroll" href="#contact">CONTACT</a>
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


    <!--====== ABOUT PART START ======-->

    <section id="about" class="about-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <!--div class="about-image text-center wow fadeInUp" data-wow-duration="1.5s" data-wow-offset="100">
                        <img src="assets/images/services.png" alt="services">
                    </div-->
                    <div class="section-title text-center mt-0 pb-40">
                        <h4 class="title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.6s">Les composants du produit</h4>
                        <p class="text wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s"></p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.2s">
                        <div class="about-icon align-content-xl-center">
                            <img src="assets/images/icon-1.png" class="ccpo" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title">L'Objet</h4>
                            <p class="text text-justify">L'assurance EH WHLIN MI a pour objet le versement d'un capital de 1.000.000 FCFA en cas de décès de l'assuré au contrat.</p>
                        </div>
                    </div>
                    <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.4s">
                        <div class="about-icon align-content-xl-center">
                            <img src="assets/images/icon-1.png" class="ccpo" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title">Conditions d'adhésion</h4>
                            <p class="text text-justify">Peut être assurée toute personne physique âgée de 18 à 74 ans à la souscription. Toutefois l'assuré ayant atteint l'âge limite de 75ans cesse d'être couvert par la garantie décès le jour de son 75ème anniversaire.</p>
                        </div>
                    </div>
                    <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.6s">
                        <div class="about-icon align-content-xl-center">
                            <img src="assets/images/icon-1.png" class="ccpo" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title">Les Garanties</h4>
                            <p class="text text-justify">EH WHLIN MI garantit le paiement d'un capital de 1.000.000 FCFA en cas de décès de l'assuré mentionné au contrat.</p>
                        </div>
                    </div>
                    <!-- single about -->
                </div>
                <div class="col-lg-6">
                    <div class="single-about d-sm-flex mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.8s">
                        <div class="about-icon align-content-xl-center">
                            <img src="assets/images/icon-1.png" class="ccpo" alt="Icon">
                        </div>
                        <div class="about-content media-body">
                            <h4 class="about-title">Les pièces à fournir</h4>
                            <p class="text">Une pièce d'identité du souscripteur, une pièce d'identité et un bulletion individuel d'adhésion pour l'assuré.</p>
                        </div>
                    </div>
                    <!-- single about -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!--====== ABOUT PART ENDS ======-->




    <!--====== CONTACT TWO PART START ======-->

    <section id="contact" class="contact-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">Contactez nous</h3>
                        <p class="text">Vous avez une préocupation?</p>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-10">
                        <div class="contact-form form-style-one mt-35 wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.5s">
                            <form autocomplete="off" id="contact-form" action="{{ route('home.contact') }}" method="post">
                                @csrf
                                <div class="form-input mt-15">
                                    <label>Nom Prenom</label>
                                    <div class="input-items default">
                                        <input required type="text" placeholder="Nom Prenom" name="name">
                                        <i class="lni-user"></i>
                                    </div>
                                </div>
                                <!-- form input -->
                                <div class="form-input mt-15">
                                    <label>Email</label>
                                    <div class="input-items default">
                                        <input required type="email" placeholder="Email" name="email">
                                        <i class="lni-envelope"></i>
                                    </div>
                                </div>
                                <!-- form input -->
                                <div class="form-input mt-15">
                                    <label>Telephone</label>
                                    <div class="input-items default">
                                        <input required type="phone" placeholder="Telephone" name="telephone">
                                        <i class="lni-phone"></i>
                                    </div>
                                </div>
                                <!-- form input -->
                                <div class="form-input mt-15">
                                    <label>Message</label>
                                    <div class="input-items default">
                                        <textarea required placeholder="Message" name="message"></textarea>
                                        <i class="lni-pencil-alt"></i>
                                    </div>
                                </div>
                                <!-- form input -->
                                <p class="form-message"></p>
                                <div class="form-input rounded-buttons mt-20">
                                    <button type="submit" class="main-btn rounded-three">Envoyer</button>
                                </div>
                                <!-- form input -->
                            </form>
                        </div>
                    </div>
                    <!-- section title -->
                </div>
            </div>

            <div class="col-lg-6 text-center">

                <!-- contact form -->
            </div>
        </div>
        <!-- row -->
        </div>
        <!-- container -->
    </section>

    <!--====== CONTACT TWO PART ENDS ======-->


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

    <!--====== PART START ======-->

    <!--====== PART ENDS ======-->

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
