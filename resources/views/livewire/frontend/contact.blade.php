@section('title', 'Contact - Flouka')
@section('header_title', 'Contact - Flouka')

@push('styles')
    <link rel="stylesheet" href="css/slidershow.css"/>
    <link rel="stylesheet" href="css/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="css/ribbons.min.css"/>
@endpush

{{-- Start::Main --}}
<main class="contact main-content">
	<section class="contact-content">
		<header class="header-contact">
			<div class="overlay"></div>
			<div class="container">
				<h1 class="wow bounceInDown">Prenez Contact Avec Nous</h1>
			</div>
		</header>

		<div class="container contact-main">
			<div class="row">
				<div class="col-md-7">
					<section class="contact-form">
						<h3 class="wow bounceIn">Laissez un Message</h3>
						<div class="divider wow fadeInUp"></div>
						<form id="contact-form" class="row" action="" method="POST">
							<div class="form-group col-md-6">
								<div class="form-control-wrapper">
									<input class="form-control form-control-lg wow bounceIn" name="name" type="text" placeholder="Nom Et Prénom" data-validation="[NAME]" data-validation-message="Nom Et Prénom ne doit pas être vide.<br>Pas de caractères spéciaux ni de chiffres autorisés." data-validation-regex="/^((?!admin).)*$/i" data-validation-regex-message="The word &quot;Admin&quot; is not allowed in the Name">
								</div>
							</div>
							<div class="form-group col-md-6">
								<div class="form-control-wrapper">
									<input class="form-control form-control-lg wow bounceIn" name="email" type="email" placeholder="E-Mail" data-validation="[EMAIL]" data-validation-message="E-Mail n'est pas valide.">
								</div>
							</div>
							<div class="form-group col-md-12">
								<div class="form-control-wrapper">
									<input class="form-control form-control-lg wow bounceIn" name="subject" type="text" placeholder="Sujette" data-validation="[NOTEMPTY]" data-validation-message="Sujette ne doit pas être vide.">
								</div>
							</div>
							<div class="form-group col-md-12">
								<div class="form-control-wrapper">
									<textarea rows="3" class="form-control form-control-lg wow bounceIn" name="message" placeholder="Message" data-validation="[NOTEMPTY]" data-validation-message="Message ne doit pas être vide."></textarea>
								</div>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-lg btn-block btn-rounded btn-primary-outline wow bounceIn"><i class="fa fa-paper-plane"></i></button>
							</div>
						</form>
					</section>
				</div>
				<div class="col-md-5">
					<section class="contact-info">
						<h3 class="wow bounceIn">Contact Info</h3>
						<div class="divider wow fadeInUp"></div>
						<div class="info">
							<ul>
								<li class="wow fadeInDown"><i class="fa fa-map-marker-alt"></i>Marrakech - Morocco</li>
								<li class="wow fadeInDown" data-wow-delay="200ms"><i class="fa fa-phone-alt"></i>+212 6 19 82 65 01</li>
								<li class="wow fadeInDown" data-wow-delay="400ms"><i class="fab fa-whatsapp"></i>+212 6 19 82 65 01</li>
								<li class="wow fadeInDown" data-wow-delay="600ms"><i class="fa fa-envelope"></i><a href="mailto:contact@flouka.ma">contact@flouka.ma</a></li>
							</ul>
						</div>
						<div class="social-media">
							<ul>
								<li class="wow pulse"><a href="http://facebook.com/flouka.ma" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<li class="wow pulse" data-wow-delay="200ms"><a href="http://twitter.com/flouka.ma" target="_blank"><i class="fab fa-twitter"></i></a></li>
								<li class="wow pulse" data-wow-delay="400ms"><a href="http://plus.google.com/flouka.ma" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
								<li class="wow pulse" data-wow-delay="600ms"><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
								<li class="wow pulse" data-wow-delay="800ms"><a href="#" target="_blank"><i class="fab fa-youtube"></i></a></li>
							</ul>
						</div>
					</section>
				</div>
			</div>
		</div>
	</section>
</main>
{{-- End::Main --}}

@push('scripts')
    <script src="js/jquery.validation.min.js"></script>
@endpush
