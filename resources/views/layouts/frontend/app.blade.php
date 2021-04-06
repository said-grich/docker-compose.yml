<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

		<!-- IE Compatibility Meta -->
	    <meta http-equiv="X-UA-Compatible" content="IE-edge"/>

		<!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Favicon -->
	    <link rel="icon" href="assets/media/logos/favicon.ico"/>
	    <link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>

		<!-- Title -->
        <title>@yield('title', 'Unknown Page')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap">
        <link rel="stylesheet" href="css/fontawesome.min.css">

        <!-- Styles -->
		<!--begin::Global Theme Styles(used by all pages)-->
		{{-- <link rel="stylesheet" href="assets/plugins/global/plugins.bundle.css"/>
		<link rel="stylesheet" href="assets/plugins/custom/prismjs/prismjs.bundle.css"/>
		<link rel="stylesheet" href="assets/css/style.bundle.css"/>
        <link rel="stylesheet" href="css/style.css"/> --}}
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
	    <link rel="stylesheet" href="css/reset.css"/>
	    <link rel="stylesheet" href="css/animate.css"/>
	    <link rel="stylesheet" href="css/owl.carousel.css"/>
		<link rel="stylesheet" href="css/main.css"/>
	    <link rel="stylesheet" href="css/frontend.css"/>
		<!--end::Global Theme Styles-->

        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

		@stack('styles')
    </head>

    <!--begin::Body-->
	<body>

        <!--begin::Main-->
		@livewire('frontend.nav-bar')

		<!--begin::Content-->
		<div>
			{{ $slot }}
		</div>
		<!--end::Content-->

		<!-- begin::Footer -->
		<footer class="footer cd-main-content">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="short-about">
							<img src="assets/media/logos/logo-footer.png" alt="Logo" class="wow rollIn"/>
							<p class="wow flipInY" data-wow-delay="200ms">La diversité de nos produits, l’expertise de nos poissonniers et notre respect de la chaine du froid et au règle sanitaire témoignent de l’attention que nous portons à l’expérience client. De plus, nous cherchons constamment à nous surpasser et nous nous efforçons d’assurer la valeur ajoutée et donner le meilleur service à la clientèle possible.</p>
						</div>
					</div>
					<div class="col-md-2">
						<div class="helpful-links">
							<h4 class="wow rollIn">Besoin d’aide</h4>
							<div class="row">
								<ul class="col wow fadeInLeft" data-wow-delay="200ms">
									<li><i class="fa fa-angle-right"></i><a href="#" class="underline" target="_blank">À propos</a></li>
									<li><i class="fa fa-angle-right"></i><a href="#" class="underline" target="_blank">Qui sommes-nous ?</a></li>
									<li><i class="fa fa-angle-right"></i><a href="#" class="underline" target="_blank">Contact</a></li>
									<li><i class="fa fa-angle-right"></i><a href="#" class="underline">Conditions Générales</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="contact">
							<h4 class="wow rollIn">Contact</h4>
							<ul>
								<li class="wow fadeInUp" data-wow-delay="200ms"><i class="fa fa-map-marker-alt"></i>Marrakech - Morocco</li>
								<li class="wow fadeInUp" data-wow-delay="300ms"><i class="fa fa-phone-alt"></i>+212 6 19 82 65 01</li>
								<li class="wow fadeInUp" data-wow-delay="400ms"><i class="fa fa-envelope"></i><a href="mailto:contact@flouka.ma">contact@flouka.ma</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3">
						<div class="paiements">
							<h4 class="wow rollIn">Modes de Paiement</h4>
							<ul class="row">
								<li class="wow fadeInUp col-3" data-wow-delay="200ms">
									<img src="img/paiements/cmi.png" alt="Cmi" class="wow rollIn"/>
								</li>
								<li class="wow fadeInUp col-3" data-wow-delay="200ms">
									<img src="img/paiements/visa.png" alt="Visa" class="wow rollIn"/>
								</li>
								<li class="wow fadeInUp col-3" data-wow-delay="200ms">
									<img src="img/paiements/mastercard.png" alt="MasterCard" class="wow rollIn"/>
								</li>
								<li class="wow fadeInUp col-3" data-wow-delay="200ms">
									<img src="img/paiements/maestro.png" alt="Maestro" class="wow rollIn"/>
								</li>
							</ul>
							<h4 class="wow rollIn">Paiement Sécurisé</h4>
							<ul class="row">
								<li class="wow fadeInUp col-3" data-wow-delay="200ms">
									<img src="img/paiements/visa-sec.png" alt="Visa Sec" class="wow rollIn"/>
								</li>
								<li class="wow fadeInUp col-3" data-wow-delay="200ms">
									<img src="img/paiements/mastercard-sec.png" alt="MasterCard Sec" class="wow rollIn"/>
								</li>
								<li class="wow fadeInUp col-3" data-wow-delay="200ms">
									<img src="img/paiements/paiement-sec.png" alt="Paiement Sec" class="wow rollIn"/>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="sub-footer">
				<div class="container">
					<div class="row">
						<div class="copyright col-md">
							<p class="wow fadeInLeft" data-wow-offset="50">Copyright &copy; 2021 | <a href="http://flouka.ma/" class="underline" target="_blank">FLOUKA.MA</a></p>
						</div>
						<div class="social-media col-md">
							<ul>
								<li class="wow bounceInRight" data-wow-delay="200ms" data-wow-offset="50"><a href="http://facebook.com/flouka.ma" target="_blank"><i class="fab fa-facebook-f facebook"></i></a></li>
								<li class="wow bounceInRight" data-wow-delay="300ms" data-wow-offset="50"><a href="http://twitter.com/flouka.ma" target="_blank"><i class="fab fa-twitter twitter"></i></a></li>
								<li class="wow bounceInRight" data-wow-delay="400ms" data-wow-offset="50"><a href="http://plus.google.com/flouka.ma" target="_blank"><i class="fab fa-google-plus-g google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer -->

		<!-- Start Scroll Top -->
		<div class="scroll-top">
			<i class="fa fa-angle-up"></i>
		</div>
		<!-- End Scroll Top -->

		<!-- Start Loading -->
		<div class="loading">
			<div class="load-dots">
				<div class="load-child load-dot1"></div>
				<div class="load-child load-dot2"></div>
			</div>
			<div class="load-text">LOADING</div>
		</div>
		<!-- End Loading -->
	
		@livewireScripts

		<!--begin::Global Config(global config for global JS scripts)-->
		<script>
			var KTAppSettings = {
				"breakpoints": {
					"sm": 576,
					"md": 768,
					"lg": 992,
					"xl": 1200,
					"xxl": 1400
				},
				"colors": {
					"theme": {
						"base": {
							"white": "#ffffff",
							"primary": "#3699FF",
							"secondary": "#E5EAEE",
							"success": "#1BC5BD",
							"info": "#8950FC",
							"warning": "#FFA800",
							"danger": "#F64E60",
							"light": "#E4E6EF",
							"dark": "#181C32"
						},
						"light": {
							"white": "#ffffff",
							"primary": "#E1F0FF",
							"secondary": "#EBEDF3",
							"success": "#C9F7F5",
							"info": "#EEE5FF",
							"warning": "#FFF4DE",
							"danger": "#FFE2E5",
							"light": "#F3F6F9",
							"dark": "#D6D6E0"
						},
						"inverse": {
							"white": "#ffffff",
							"primary": "#ffffff",
							"secondary": "#3F4254",
							"success": "#ffffff",
							"info": "#ffffff",
							"warning": "#ffffff",
							"danger": "#ffffff",
							"light": "#464E5F",
							"dark": "#ffffff"
						}
					},
					"gray": {
						"gray-100": "#F3F6F9",
						"gray-200": "#EBEDF3",
						"gray-300": "#E4E6EF",
						"gray-400": "#D1D3E0",
						"gray-500": "#B5B5C3",
						"gray-600": "#7E8299",
						"gray-700": "#5E6278",
						"gray-800": "#3F4254",
						"gray-900": "#181C32"
					}
				},
				"font-family": "Poppins"
			};
		</script>
		<!--end::Global Config-->

		<!--begin::Global Theme Bundle(used by all pages)-->
		{{-- <script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script> --}}
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.nicescroll.min.js"></script>
	    <script src="js/wow.js"></script>
	    <script src="js/owl.carousel.min.js"></script>
	    <script src="js/frontend.js"></script>
		<!--end::Global Theme Bundle-->

		<!--begin::Page Scripts(used by this page)-->
        {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
		<!--end::Page Scripts-->

        @stack('scripts')
		
	</body>
	<!--end::Body-->

</html>
