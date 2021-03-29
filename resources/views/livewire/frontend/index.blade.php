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

				<div class="cd-hero__content cd-hero__content--bg-video js-cd-bg-video" data-video="video/video">
					<!-- video element will be loaded using JavaScript -->
				</div> <!-- .cd-hero__content -->
			</li>
		</ul> <!-- .cd-hero__slider -->

		<div class="cd-hero__nav js-cd-nav">
			<nav>
				<span class="cd-hero__marker cd-hero__marker--item-1 js-cd-marker"></span>
				
				<ul>
					<li class="cd-selected"><a href="#0">Intro</a></li>
					<li><a href="#">Fish 1</a></li>
					<li><a href="#">Fish 2</a></li>
					<li><a href="#">Fish 3</a></li>
					<li><a href="#">Video</a></li>
				</ul>
			</nav> 
		</div> <!-- .cd-hero__nav -->
	</section> <!-- .cd-hero -->
	<!-- End Slidershow -->

	<!-- Start Shop -->
	<section class="shop">
		<section class="cd-main-content-gallery no-fixed shop-content">
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

			<section class="container-fluid">
			<section class="cd-gallery">
				<ul class="products row">
<?
function products(){
	global $connect;

	$select_products=mysqli_query($connect,"SELECT * FROM products WHERE visible='1' ORDER BY id DESC");

	if(mysqli_num_rows($select_products) > 0){
		while($products=mysqli_fetch_object($select_products)){
			$product_colors=[];
			$select_pics=mysqli_query($connect,"SELECT * FROM products_pics WHERE product_id='$products->id'");
			if(mysqli_num_rows($select_pics) > 0){
				while($pics=mysqli_fetch_object($select_pics)){
					$product_colors = $product_colors+["$pics->pic" => "$pics->color"];
				}
			}
			if($products->discount != "0"){
				$product_price=round($products->price-($products->price*$products->discount/100));
			}else{
				$product_price=round($products->price);
			}
?>
					<li class="mix col-sm-6 col-md-4 col-lg-3 <? echo $products->status." ".$products->tags." ".str_replace(",", " ", $products->size)." ".implode(" ", $product_colors); ?>">
						<div class="cd-single-item product">
							<a href="#">
								<ul class="cd-slider-wrapper">
									<? if($products->discount != "0"){ ?>
									<div class="discount">Save <? echo round($products->discount); ?>%</div>
									<? } ?>
									<div class="ribbon right-top">
										<i class="fa fa-heart"></i>
									</div>
									<? foreach($product_colors as $pic => $color){ ?>
										<li <? if(array_key_first($product_colors)===$pic){echo 'class="selected"';} ?>><a href="data/uploads/<? echo $pic; ?>" data-caption="Product &quot;<? echo $products->name; ?>&quot;<br/> Color <? echo $color; ?>." data-fancybox="images-<? echo $products->id; ?>"><img src="data/uploads/<? echo $pic; ?>" alt="Preview Image"></a></li>
									<? } ?>
								</ul>
							</a>
							<div class="cd-customization">
								<div class="color" data-type="select">
									<ul>
										<? foreach($product_colors as $pic => $color){ ?>
											<li class="color-<? echo $color; if(array_key_first($product_colors)===$pic){echo " active";} ?>"><? echo $color; ?></li>
										<? } ?>
									</ul>
								</div>
								<div class="size" data-type="select">
									<ul>
										<?
										$product_sizes=explode(",", $products->size);
										for($i=0; $i < count($product_sizes); $i++){ 
										?> 
											<li class="<? echo $product_sizes[$i]; if($i === 0){echo " active";} ?>"><? echo $product_sizes[$i]; ?></li>
										<? } ?>
									</ul>
								</div>
								<a class="add-to-cart cd-add-to-cart js-cd-add-to-cart" data-id="<? echo $products->id; ?>" data-title="<? echo $products->name; ?>" data-price="<? echo $product_price; ?>" data-pic="data/uploads/<? echo array_key_first($product_colors); ?>" data-color="<? echo $product_colors[array_key_first($product_colors)]; ?>" data-size="<? echo $product_sizes[0]; ?>">
									<em>Add to Cart</em>
									<svg x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32">
										<path stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"/>
									</svg>
								</a>
							</div> <!-- .cd-customization -->
							<button class="cd-customization-trigger">Customize</button>
						</div> <!-- .cd-single-item -->
						<div class="cd-item-info product-info">
							<a href="product.php?id=<? echo $products->id; ?>"><p class="title"><? echo $products->name; ?></p></a>
							<div class="price">
								<span class="new-price"><? echo $product_price; ?> <span>DH</span></span>
								<? if($products->discount != "0"){ ?>
								<span class="old-price"><? echo round($products->price); ?> DH</span>
								<? } ?>
							</div>
						</div> <!-- cd-item-info -->
					</li>
<?
		}
	}
}
products();
?>
				</ul>
				<div class="cd-fail-message">No results found</div>
			</section> <!-- cd-gallery -->
			</section>

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

				<a href="#0" class="cd-close">Close</a>
			</div> <!-- cd-filter -->

			<a href="#0" class="cd-filter-trigger">Filters</a>
		</section> <!-- cd-main-content -->
	</section>
	<!-- End Shop -->

	<!-- Start Testimonials  -->
	<section class="testimonials">
		<div class="overlay"></div>
		<div class="container">
			<h2>What Our Clients Say</h2>
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
	<!-- End Testimonials -->

	<!-- Start Features -->
	<section class="features" id="features">
		<div class="container">
			<h2 class="wow bounceIn">Some Features</h2>
			<div class="divider wow fadeInUp"></div>
			<div class="row">
				<div class="col-sm-6 col-md-3 item wow fadeInDown">
					<i class="fa fa-shipping-fast"></i>
					<h3>Livraison Gratuite</h3>
					<div class="divider"></div>
					<p>Partout au Maroc à partir de 400 DH</p>
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
					<p>Nous serons ravis de vous assister</p>
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

	<!-- Start Contact Us -->
	<section class="contact-us">
		<div class="overlay"></div>
		<div class="container">
			<h2 class="wow bounceInLeft">Keep in Touch</h2>
			<a href="contact.php"><button type="button" class="btn btn-lg btn-rounded btn-inline btn-primary-outline wow bounceInRight">Contact Us</button></a>
		</div>
	</section>
	<!-- End Contact Us -->

	<!-- Start Partners -->
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
	<!-- End Partners -->
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
