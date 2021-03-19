<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Unknown Page')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap">
        <link rel="stylesheet" href="css/fontawesome.min.css">

        <!--begin::Page Vendors Styles(used by this page)-->
		<link rel="stylesheet" href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css"/>

		<!--end::Page Vendors Styles-->

		<!--begin::Global Theme Styles(used by all pages)-->
		<link rel="stylesheet" href="assets/plugins/global/plugins.bundle.css"/>
		<link rel="stylesheet" href="assets/plugins/custom/prismjs/prismjs.bundle.css"/>
		<link rel="stylesheet" href="assets/css/style.bundle.css"/>
        <link rel="stylesheet" href="css/style.css"/>

		<!--end::Global Theme Styles-->

		<!--begin::Layout Themes(used by all pages)-->

		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

        @livewireStyles
    </head>

    <!--begin::Body-->
	<body id="kt_body" class="page-loading-enabled page-loading header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed page-loading">

        <!--begin::Main-->

		<!--[html-partial:include:{"file":"partials/_header-mobile.html"}]/-->
		<div class="d-flex flex-column flex-root">

			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">

				@livewire('layouts.aside-bar')

				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

					@livewire('layouts.header')

					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

						<!--[html-partial:include:{"file":"partials/_subheader/subheader-v1.html"}]/-->
                        {{ $slot }}

					</div>
					<!--end::Content-->

					@livewire('layouts.footer')

				</div>
				<!--end::Wrapper-->

			</div>
			<!--end::Page-->

		</div>
		<!--end::Main-->

        @stack('modals')

		<!--[html-partial:include:{"file":"partials/_page-loader.html"}]/-->

		<!--[html-partial:include:{"file":"layout.html"}]/-->

		<!--[html-partial:include:{"file":"partials/_extras/offcanvas/quick-user.html"}]/-->

		<!--[html-partial:include:{"file":"partials/_extras/offcanvas/quick-cart.html"}]/-->

		<!--[html-partial:include:{"file":"partials/_extras/offcanvas/quick-panel.html"}]/-->

		<!--[html-partial:include:{"file":"partials/_extras/chat.html"}]/-->

		<!--[html-partial:include:{"file":"partials/_extras/scrolltop.html"}]/-->

		<!--[html-partial:include:{"file":"partials/_extras/toolbar.html"}]/-->

		<!--[html-partial:include:{"file":"partials/_extras/offcanvas/demo-panel.html"}]/-->

		@livewireScripts

		<!--begin::Global Config(global config for global JS scripts)-->
		<script>
			// Navbar Active Links
			var pathname = new URL(window.location.href).pathname.slice(1);
			if(pathname == "dashboard"){
				document.querySelector('a[href="http://127.0.0.1:8000/'+pathname+'"]').parentNode.classList.add("menu-item-active");
			}else{
				document.querySelector('a[href="http://127.0.0.1:8000/'+pathname+'"]').parentNode.parentNode.parentNode.parentNode.classList.add("menu-item-active");
			}
		</script>
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
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->

		<!--begin::Page Vendors(used by this page)-->
		<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
		<!--end::Page Vendors-->

		<!--begin::Page Scripts(used by this page)-->
		<script src="assets/js/pages/widgets.js"></script>

        {{-- <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/spruce@2.x.x/dist/spruce.umd.js"></script> --}}

        <script src="{{ mix('js/app.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script> --}}
		<!--end::Page Scripts-->
        @stack('scripts')
	</body>
	<!--end::Body-->

</html>
