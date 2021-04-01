@section('title', 'Boutique - Flouka')
@section('header_title', 'Boutique - Flouka')

@push('styles')
    <link rel="stylesheet" href="css/slidershow.css"/>
    <link rel="stylesheet" href="css/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="css/ribbons.min.css"/>
    <link rel="stylesheet" href="css/test.css"/>
@endpush

{{-- Start Main --}}
<main wire:ignore class="main-content">
    <div class="overlay-layer"></div>
	
    <!-- Start Shop -->
	<section class="shop">
		<header class="header-shop">
			<div class="overlay"></div>
			<div class="container">
				<h1 class="wow bounceInDown">test</h1>
			</div>
		</header>

		<section class="cd-main-content-gallery fixed shop-content">
			<div class="cd-tab-filter-wrapper">
				<div class="cd-tab-filter">
					<ul class="cd-filters">
						<li class="placeholder"> 
							<a data-type="all" href="#0">All</a> <!-- selected option on mobile -->
						</li> 
						<li class="filter"><a class="selected" href="#0" data-type="all">All</a></li>
						<li class="filter" data-filter=".blue"><a href="#0" data-type="color-blue">Color Blue</a></li>
						<li class="filter" data-filter=".pink"><a href="#0" data-type="color-pink">Color Pink</a></li>
						<li class="filter" data-filter=".yellow"><a href="#0" data-type="color-yellow">Color Yellow</a></li>
						<li class="filter" data-filter=".new"><a href="#0" data-type="new">New</a></li>
						<li class="filter" data-filter=".sold"><a href="#0" data-type="sold">Sold</a></li>
						<li class="filter" data-filter=".old"><a href="#0" data-type="old">Old</a></li>
					</ul> <!-- cd-filters -->
				</div> <!-- cd-tab-filter -->
			</div> <!-- cd-tab-filter-wrapper -->

			<section class="container-fluid products">
			<section class="cd-gallery">
				<h2>Nos Produits</h2>
				<div class="divider"></div>
				<ul class="products cd-items cd-container row">
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
                    @foreach ($items as $item)
                        <li class="mix col-sm-6 col-md-4 col-lg-3 cd-item">
                            <div class="ribbon left-top">
								Frais
							</div>
                            <img src="{{ asset(Storage::url($item->produit->photo_principale)) }}" alt="Item Preview">
                            <a wire:click="produit('{{ $item->id }}', '1')" href="#0" class="cd-trigger">{{ $item->produit->nom }}</a>
                        </li> <!-- cd-item -->
                    @endforeach
				</ul>
			</section> <!-- cd-gallery -->
			</section>


            <div class="cd-quick-view">
                <div class="cd-slider-wrapper">
                    <ul class="cd-slider">
                        <li class="selected"><img src="img/produits/crevette-royale/crevette-royal-flouka3.jpg" alt="Product 1"></li>
                        <li><img src="img/produits/crevette-royale/crevette-royal-flouka1.jpg" alt="Product 2"></li>
                        <li><img src="img/produits/crevette-royale/crevette-royal-flouka4.jpeg" alt="Product 3"></li>
                    </ul> <!-- cd-slider -->
        
                    <ul class="cd-slider-navigation">
                        <li><a class="cd-next" href="#0">Prev</a></li>
                        <li><a class="cd-prev" href="#0">Next</a></li>
                    </ul> <!-- cd-slider-navigation -->
                </div> <!-- cd-slider-wrapper -->

                <div class="cd-item-info">
                    <h2>
                        {{-- @if (!empty($produit))
                            {{ $produit->lot->produit->nom }}
                        @endif --}}
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, omnis illo iste ratione. Numquam eveniet quo, ullam itaque expedita impedit. Eveniet, asperiores amet iste repellendus similique reiciendis, maxime laborum praesentium.</p>
        
                    <ul class="cd-item-action">
                        <li><button class="add-to-cart">Ajouter au panier</button></li>
                    </ul> <!-- cd-item-action -->
                </div> <!-- cd-item-info -->=
                <a href="#0" class="cd-close">Close</a>
            </div> <!-- cd-quick-view -->


			<div class="cd-filter">
				<form>
					<div class="cd-filter-block">
						<h4>Search</h4>
						
						<div class="cd-filter-content">
							<input type="search" placeholder="Try some things...">
						</div> <!-- cd-filter-content -->
					</div> <!-- cd-filter-block -->

					<div class="cd-filter-block">
						<h4>Colors</h4>
						<ul class="cd-filter-content cd-filters list">
							<li>
								<input class="filter" data-filter=".blue" type="checkbox" id="color-blue">
								<label class="checkbox-label" for="color-blue">Blue</label>
							</li>
							<li>
								<input class="filter" data-filter=".pink" type="checkbox" id="color-pink">
								<label class="checkbox-label" for="color-pink">Pink</label>
							</li>
							<li>
								<input class="filter" data-filter=".yellow" type="checkbox" id="color-yellow">
								<label class="checkbox-label" for="color-yellow">Yellow</label>
							</li>
						</ul> <!-- cd-filter-content -->
					</div> <!-- cd-filter-block -->

					<div class="cd-filter-block">
						<h4>Sizes</h4>
						<ul class="cd-filter-content cd-filters list row">
							<div class="col-6">
								<li>
									<input class="filter" data-filter=".2XS" type="checkbox" id="size-2xs">
									<label class="checkbox-label" for="size-2xs">2XS</label>
								</li>
								<li>
									<input class="filter" data-filter=".XS" type="checkbox" id="size-xs">
									<label class="checkbox-label" for="size-xs">XS</label>
								</li>
								<li>
									<input class="filter" data-filter=".S" type="checkbox" id="size-s">
									<label class="checkbox-label" for="size-s">S</label>
								</li>
								<li>
									<input class="filter" data-filter=".M" type="checkbox" id="size-m">
									<label class="checkbox-label" for="size-m">M</label>
								</li>
							</div>
							<div class="col-6">
								<li>
									<input class="filter" data-filter=".L" type="checkbox" id="size-l">
									<label class="checkbox-label" for="size-l">L</label>
								</li>
								<li>
									<input class="filter" data-filter=".XL" type="checkbox" id="size-xl">
									<label class="checkbox-label" for="size-xl">XL</label>
								</li>
								<li>
									<input class="filter" data-filter=".2XL" type="checkbox" id="size-2xl">
									<label class="checkbox-label" for="size-2xl">2XL</label>
								</li>
								<li>
									<input class="filter" data-filter=".3XL" type="checkbox" id="size-3xl">
									<label class="checkbox-label" for="size-3xl">3XL</label>
								</li>
							</div>
						</ul> <!-- cd-filter-content -->
					</div> <!-- cd-filter-block -->

					<div class="cd-filter-block">
						<h4>Select</h4>
						
						<div class="cd-filter-content">
							<div class="cd-select cd-filters">
								<select class="filter" name="selectThis" id="selectThis">
									<option value="">Choose an option</option>
									<option value=".option1">Option 1</option>
									<option value=".option2">Option 2</option>
									<option value=".option3">Option 3</option>
									<option value=".option4">Option 4</option>
								</select>
							</div> <!-- cd-select -->
						</div> <!-- cd-filter-content -->
					</div> <!-- cd-filter-block -->

					<div class="cd-filter-block">
						<h4>Status</h4>
						<ul class="cd-filter-content cd-filters list">
							<li>
								<input class="filter" data-filter="" type="radio" name="radioButton" id="radio1" checked>
								<label class="radio-label" for="radio1">All</label>
							</li>
							<li>
								<input class="filter" data-filter=".new" type="radio" name="radioButton" id="radio2">
								<label class="radio-label" for="radio2">New</label>
							</li>
							<li>
								<input class="filter" data-filter=".old" type="radio" name="radioButton" id="radio3">
								<label class="radio-label" for="radio3">Old</label>
							</li>
							<li>
								<input class="filter" data-filter=".sold" type="radio" name="radioButton" id="radio4">
								<label class="radio-label" for="radio4">Sold</label>
							</li>
						</ul> <!-- cd-filter-content -->
					</div> <!-- cd-filter-block -->
				</form>

				<a href="#0" class="cd-filter-close">Close</a>
			</div> <!-- cd-filter -->

			<a href="#0" class="cd-filter-trigger">Filters</a>
		</section> <!-- cd-main-content -->
	</section>
	<!-- End Shop -->

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
</main>
<!-- End Main -->

@push('scripts')
    <script src="js/slidershow.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/filter.js"></script>
    <script src="js/velocity.min.js"></script>
    <script src="js/test.js"></script>
@endpush

