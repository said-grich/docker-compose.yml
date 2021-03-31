@section('title', 'Flouka')
@section('header_title', 'Flouka')

@push('styles')
    <link rel="stylesheet" href="css/slidershow.css"/>
    <link rel="stylesheet" href="css/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="css/ribbons.min.css"/>
@endpush

{{-- Start Main --}}
<main class="main-content">

	<!-- Start Slidershow -->
	<section class="cd-hero js-cd-hero js-cd-autoplay"><!-- js-cd-autoplay -->
		<ul class="cd-hero__slider">
			<li class="cd-hero__slide cd-hero__slide--selected js-cd-slide">
				<div class="overlay"></div>
				<div class="cd-hero__content cd-hero__content--full-width">
					<h2>Flouka</h2>
					<p>A simple, responsive slideshow in CSS &amp; JavaScript.</p>
					<a href="contact.php" class="cd-hero__btn">Contact Us</a>
				</div> <!-- .cd-hero__content -->
			</li>

			<li class="cd-hero__slide js-cd-slide">
				<div class="overlay"></div>
				<div class="cd-hero__content cd-hero__content--half-width">
					<h2>Flouka</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In consequatur cumque natus!</p>
					<a href="#0" class="cd-hero__btn">Start</a>
					<a href="#0" class="cd-hero__btn cd-hero__btn--secondary">Learn More</a>
				</div> <!-- .cd-hero__content -->
				
				<div class="cd-hero__content cd-hero__content--half-width cd-hero__content--img">
					{{-- <img src="img/baby-pic-2.png" alt="baby 2"> --}}
				</div> <!-- .cd-hero__content -->
			</li>

			<li class="cd-hero__slide js-cd-slide">
				<div class="overlay"></div>
				<div class="cd-hero__content cd-hero__content--half-width cd-hero__content--img">
					{{-- <img src="img/baby-pic-1.png" alt="baby 2"> --}}
				</div> <!-- .cd-hero__content -->

				<div class="cd-hero__content cd-hero__content--half-width">
					<h2>Flouka</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In consequatur cumque natus!</p>
					<a href="#0" class="cd-hero__btn">Start</a>
					<a href="#0" class="cd-hero__btn cd-hero__btn--secondary">Learn More</a>
				</div> <!-- .cd-hero__content -->
			</li>

			<li class="cd-hero__slide js-cd-slide">
				<div class="overlay"></div>
				<div class="cd-hero__content cd-hero__content--full-width">
					<h2>Flouka</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, explicabo.</p>
					<a href="#0" class="cd-hero__btn">Start</a>
					<a href="#0" class="cd-hero__btn cd-hero__btn--secondary">Learn More</a>
				</div> <!-- .cd-hero__content -->
			</li>

			<li class="cd-hero__slide cd-hero__slide--video js-cd-slide">
				<div class="overlay"></div>
				<div class="cd-hero__content cd-hero__content--full-width">
					<h2>Flouka</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, explicabo.</p>
					<a href="#0" class="cd-hero__btn">Learn more</a>
				</div> <!-- .cd-hero__content -->

				<div class="cd-hero__content cd-hero__content--bg-video js-cd-bg-video" data-video="img/video/fugu">
					<!-- video element will be loaded using JavaScript -->
				</div> <!-- .cd-hero__content -->
			</li>
		</ul> <!-- .cd-hero__slider -->

		<div class="cd-hero__nav js-cd-nav">
			<nav>
				<span class="cd-hero__marker cd-hero__marker--item-1 js-cd-marker"></span>
				
				<ul>
					<li class="cd-selected"><a href="#">Slide 1</a></li>
					<li><a href="#">Slide 2</a></li>
					<li><a href="#">Slide 3</a></li>
					<li><a href="#">Slide 4</a></li>
					<li><a href="#">Slide 5</a></li>
				</ul>
			</nav> 
		</div> <!-- .cd-hero__nav -->
	</section> <!-- .cd-hero -->
	<!-- End Slidershow -->

					{{-- @foreach ($items as $item)
					<li class="mix col-sm-6 col-md-4 col-lg-3">
						<div class="cd-single-item product">
							<a href="#">
								<ul class="cd-slider-wrapper">
									<!-- <div class="discount">Promotion</div> -->
									<div class="ribbon right-top">
										<i class="fa fa-heart"></i>
									</div>
									<a href="{{ asset(Storage::url($item->lot->produit->photo_principale)) }}" data-caption="Product" data-fancybox="{{ asset($item->lot->produit->id) }}"><img src="{{ asset(Storage::url($item->lot->produit->photo_principale)) }}" alt="Preview Image"></a>
								</ul>
							</a>
							<div class="cd-customization">
								<a class="add-to-cart cd-add-to-cart js-cd-add-to-cart">
									<em>Add to Cart</em>
									<svg x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32">
										<path stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"/>
									</svg>
								</a>
							</div> <!-- .cd-customization -->
							<button class="cd-customization-trigger">Customize</button>
						</div> <!-- .cd-single-item -->
						<div class="cd-item-info product-info">
							<a href="product.php?id={{ $item->lot->produit->id }}"><p class="title">{{ $item->lot->produit->nom }}</p></a>
							<div class="price">
								<span class="new-price">{{ $item->prix }} <span>DH</span></span>
								<!-- <span class="old-price"> DH</span> -->
							</div>
						</div> <!-- cd-item-info -->
					</li>
					@endforeach --}}

	{{-- <!-- Start Testimonials  -->
	<section class="testimonials">
		<div class="overlay"></div>
		<div class="container">
			<h2>Ce Que Disent Nos Clients</h2>
			<div class="divider"></div>
			<div id="testimonials" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#testimonials" data-slide-to="0" class="active"></li>
					<li data-target="#testimonials" data-slide-to="1"></li>
					<li data-target="#testimonials" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<div class="carousel-caption d-none d-md-block">
							<h5>John Capone</h5>
							<div class="rates">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
							</div>
							<p>
								<i class="fa fa-quote-left"></i>
								Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.
								<i class="fa fa-quote-right"></i>
							</p>
						</div>
					</div>
					<div class="carousel-item">
						<div class="carousel-caption d-none d-md-block">
							<h5>Adam Smith</h5>
							<div class="rates">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
							<p>
								<i class="fa fa-quote-left"></i>
								Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
								<i class="fa fa-quote-right"></i>
							</p>
						</div>
					</div>
					<div class="carousel-item">
						<div class="carousel-caption d-none d-md-block">
							<h5>Martin Romak</h5>
							<div class="rates">
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
								<i class="fa fa-star active"></i>
							</div>
							<p>
								<i class="fa fa-quote-left"></i>
								Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
								<i class="fa fa-quote-right"></i>
							</p>
						</div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#testimonials" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#testimonials" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</section>
	<!-- End Testimonials --> --}}

	<!-- Start Categories -->
	<section class="categories">
		<div class="container">
			<h2>Catégories</h2>
			<div class="divider"></div>
			<div class="row">
				<div class="col-md-4">
					<a href="{{ route('boutique') }}">
						<div class="card">
							<div class="card-img">
								<img src="https://www.mareebleue.net/site/images/normal/20161018083953jpg_5921497513dcc.jpg" alt="Post"/>
							</div>
							<div class="ribbon left-top">
								Frais
							</div>
							<div class="card-body">
								<h4 class="card-title">Poissons Frais</h4>
								<div class="divider"></div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4">
					<a href="{{ route('boutique') }}">
						<div class="card">
							<div class="card-img">
								<img src="https://www.ice-shop.be/guide/wp-content/uploads/2016/02/Bouquet-de-poisson-congel-cru-sur-la-glace-Ice-shop.jpg" alt="Post"/>
							</div>
							<div class="card-body">
								<h4 class="card-title">Poissons Congelés</h4>
								<div class="divider"></div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4">
					<a href="{{ route('boutique') }}">
						<div class="card">
							<div class="card-img">
								<img src="img/epicerie-flouka1.jpg" alt="Post"/>
							</div>
							<div class="card-body">
								<h4 class="card-title">Épicerie</h4>
								<div class="divider"></div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>
	<!-- End Categories -->

	<!-- Start Latest Posts -->
	<section class="latest-posts">
		<div class="container">
			<h2>Derniers Articles</h2>
			<div class="divider"></div>
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="post-date">
							<span>Mar 27</span>
							<span>2021</span>
						</div>
						<div class="card-img">
							<img src="https://cdn.futura-sciences.com/buildsv6/images/wide1920/7/f/e/7feb33f212_50153147_poissons-fotolia.jpg" alt="Post"/>
						</div>
						<div class="card-body">
							<h4 class="card-title">Lorem ipsum dolor sit amet</h4>
							<div class="divider"></div>
							<p class="card-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
							<a href="#" class="card-link"><button type="button" class="btn btn-rounded btn-inline btn-primary">Lire la Suite</button></a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="post-date">
							<span>Mar 28</span>
							<span>2021</span>
						</div>
						<div class="card-img">
							<img src="https://cdn.futura-sciences.com/buildsv6/images/wide1920/6/d/b/6dbcafb537_50167731_poisson-e-talage.jpg" alt="Post"/>
						</div>
						<div class="card-body">
							<h4 class="card-title">Lorem ipsum dolor sit amet</h4>
							<div class="divider"></div>
							<p class="card-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
							<a href="#" class="card-link"><button type="button" class="btn btn-rounded btn-inline btn-primary">Lire la Suite</button></a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="post-date">
							<span>Mar 29</span>
							<span>2021</span>
						</div>
						<div class="card-img">
							<img src="https://www.medisite.fr/files/styles/pano_xxxl/public/images/article/4/0/5/4519504/5836571-inline.jpg" alt="Post"/>
						</div>
						<div class="card-body">
							<h4 class="card-title">Lorem ipsum dolor sit amet</h4>
							<div class="divider"></div>
							<p class="card-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
							<a href="#" class="card-link"><button type="button" class="btn btn-rounded btn-inline btn-primary">Lire la Suite</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Latest Posts -->

	{{-- <!-- Start Statistics -->
	<section class="statistics">
		<div class="overlay"></div>
		<div class="container">
			<h2>Quelques Faits Impressionnants</h2>
			<div class="divider"></div>
			<div class="row">
				<div class="col-sm-6 col-md-3 item">
					<i class="fa fa-cash-register"></i>
					<span>+2500</span>
					<p>Ventes</p>
					<div class="divider"></div>
				</div>
				<div class="col-sm-6 col-md-3 item">
					<i class="fa fa-id-card"></i>
					<span>+10</span>
					<p>Fournisseurs</p>
					<div class="divider"></div>
				</div>
				<div class="col-sm-6 col-md-3 item">
					<i class="fa fa-fish"></i>
					<span>43</span>
					<p>Type de Poisson</p>
					<div class="divider"></div>
				</div>
				<div class="col-sm-6 col-md-3 item">
					<i class="fa fa-smile-beam"></i>
					<span>92.5%</span>
					<p>Clients Satisfaits</p>
					<div class="divider"></div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Statistics --> --}}

	<!-- Start Features -->
	<section class="features" id="features">
		<div class="container">
			{{-- <h2 class="wow bounceIn">Some Features</h2>
			<div class="divider wow fadeInUp"></div> --}}
			<div class="row">
				<div class="col-sm-6 col-md-3 item wow fadeInDown">
					<i class="fa fa-snowflake"></i>
					<h3>Logistique Frigorifique</h3>
					<div class="divider"></div>
					<p>Transport fraicheur garanti</p>
				</div>
				<div class="col-sm-6 col-md-3 item wow fadeInDown" data-wow-delay="300ms">
					<i class="fa fa-award"></i>
					<h3>Satisfaction Garantie</h3>
					<div class="divider"></div>
					<p>Nos produits sont d’excellente qualité</p>
				</div>
				<div class="col-sm-6 col-md-3 item wow fadeInDown" data-wow-delay="600ms">
					<i class="fa fa-headset"></i>
					<h3>Assistance Client</h3>
					<div class="divider"></div>
					<p>Nous serons ravis de vous assister<br>+212 6 19 82 65 01</p>
				</div>
				<div class="col-sm-6 col-md-3 item wow fadeInDown" data-wow-delay="900ms">
					<i class="fa fa-donate"></i>
					<h3>Paiement Sécurisé</h3>
					<div class="divider"></div>
					<p>Payez à la livraison ou optez pour le retrait en magasin</p>
				</div>
			</div>
		</div>
	</section>
	<!-- End Features -->

	{{-- <!-- Start Contact Us -->
	<section class="contact-us">
		<div class="overlay"></div>
		<div class="container">
			<h2 class="wow bounceInLeft">Keep in Touch</h2>
			<a href="contact.php"><button type="button" class="btn btn-lg btn-rounded btn-inline btn-primary-outline wow bounceInRight">Contact Us</button></a>
		</div>
	</section>
	<!-- End Contact Us --> --}}

	{{-- <!-- Start Partners -->
	<section class="partners">
		<div class="container">
			<h2 class="wow bounceIn">Our Honorable Partners</h2>
			<div class="divider wow fadeInUp"></div>
			<div>
				<ul class="owl-carousel">
					<li class="wow fadeInLeft">
						<img src="img/partners/mustela.png" alt="Partner" title="Mustela"/>
					</li>
					<li class="wow fadeInLeft" data-wow-delay="200ms">
						<img src="img/partners/smoby.png" alt="Partner" title="Smoby"/>
					</li>
					<li class="wow fadeInLeft" data-wow-delay="400ms">
						<img src="img/partners/nania.png" alt="Partner" title="Nania"/>
					</li>
					<li class="wow fadeInLeft" data-wow-delay="600ms">
						<img src="img/partners/philips-avent.png" alt="Partner" title="Philips Avent"/>
					</li>
					<li class="wow fadeInLeft" data-wow-delay="800ms">
						<img src="img/partners/vtech.png" alt="Partner" title="V-tech"/>
					</li>
					<li class="wow fadeInLeft" data-wow-delay="1000ms">
						<img src="img/partners/vulli.png" alt="Partner" title="Vulli"/>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- End Partners --> --}}
</main>
<!-- End Main -->

@push('scripts')
    <script src="js/slidershow.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/filter.js"></script>
@endpush
