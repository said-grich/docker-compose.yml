<!-- Start Navbar -->
<div class="top-bar main-content" class="tb-text-white">
	<div class="container">
		<div class="row">          
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<div class="info">
					<ul class="list-unstyled list-inline">
						<li><span><i class="fa fa-map-marker-alt"></i></span>Marrakech - Maroc</li>
						<li><span><i class="fa fa-phone-alt"></i></span>+212 6 19 82 65 01</li>
					</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<p class="note">Livraison gratuite partout au Maroc à partir de 400 DH</p>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<span class="text-bar">Partagez sur :</span>
				<ul class="links">
					<li><a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=http://flouka.ma/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
					<li><a rel="nofollow" href="https://twitter.com/share?url=http://flouka.ma/" target="_blank"><i class="fab fa-twitter" title="Twitter"></i></a></li>
					<li><a rel="nofollow" href="https://plus.google.com/share?url=http://flouka.ma/" target="_blank" title="Google +"><i class="fab fa-google-plus-g"></i></a></li>
					<li><a rel="nofollow" href="https://pinterest.com/pin/create/button/?url=http://flouka.ma/&amp;media=http://flouka.ma/<? echo $img; ?>logo.png&amp;description=Espace+B%C3%A9b%C3%A9+Maroc+%26%238211%3B+Votre+Sp%C3%A9cialiste+de+la+pu%C3%A9riculture" target="_blank" title="Pinterest"><i class="fab fa-pinterest-p"></i></a></li>
					<li><a rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http://flouka.ma/" target="_blank" title="Linked In"><i class="fab fa-linkedin-in"></i></a></li>
					<li><a rel="nofollow" href="https://wa.me/?text=http://flouka.ma/" target="_blank" title="Whatsapp"><i class="fab fa-whatsapp"></i></a></li>
				</ul>
			</div>		
		</div>
	</div>
</div>

<header class="cd-main-header">
	<a class="cd-logo" href="#"><img src="assets/media/logos/logo-2.png" alt="Logo"></a>

	<ul class="cd-header-buttons">
		<li><a class="cd-search-trigger" href="#cd-search"><span></span></a></li>
		<li><a class="cd-cart-trigger" href="#cd-cart"><i class="fa fa-shopping-cart"></i></a></li>
		<li><a class="cd-nav-trigger" href="#cd-primary-nav"><span></span></a></li>
	</ul> <!-- cd-header-buttons -->
	<div id="cd-search" class="cd-search">
		<form>
			<input type="search" placeholder="Search For Some Things...">
		</form>
	</div>
</header>

<nav class="cd-nav">
	<ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
		<li><a href="{{ route('index') }}">Accueil</a></li>
		<li><a href="#">Poissons Frais</a></li>
		<li><a href="#">Poissons Congelés</a></li>
		{{-- <li class="has-children">
			<a href="#">Produits</a>
			<ul class="cd-secondary-nav is-hidden">
				<li class="go-back"><a href="#0">Menu</a></li>
				<li class="see-all"><a href="shop.php">All Categories</a></li>

				<li class="has-children">
					<a href="#">Accessories</a>

					<ul class="is-hidden">
						<li class="go-back"><a href="#0">Clothing</a></li>
						<li class="see-all"><a href="#">All Accessories</a></li>
						<li class="has-children">
							<a href="#0">Beanies</a>

							<ul class="is-hidden">
								<li class="go-back"><a href="#0">Accessories</a></li>
								<li class="see-all"><a href="#">All Benies</a></li>
								<li><a href="#">Caps &amp; Hats</a></li>
								<li><a href="#">Gifts</a></li>
								<li><a href="#">Scarves &amp; Snoods</a></li>
							</ul>
						</li>
						<li class="has-children">
							<a href="#0">Caps &amp; Hats</a>

							<ul class="is-hidden">
								<li class="go-back"><a href="#0">Accessories</a></li>
								<li class="see-all"><a href="#">All Caps &amp; Hats</a></li>
								<li><a href="#">Beanies</a></li>
								<li><a href="#">Caps</a></li>
								<li><a href="#">Hats</a></li>
							</ul>
						</li>
						<li><a href="#">Glasses</a></li>
						<li><a href="#">Gloves</a></li>
						<li><a href="#">Jewellery</a></li>
						<li><a href="#">Scarves</a></li>
						<li><a href="#">Wallets</a></li>
						<li><a href="#">Watches</a></li>
					</ul>
				</li>

				<li class="has-children">
					<a href="#">Jackets</a>

					<ul class="is-hidden">
						<li class="go-back"><a href="#0">Clothing</a></li>
						<li class="see-all"><a href="#">All Jackets</a></li>
						<li><a href="#">Blazers</a></li>
						<li><a href="#">Bomber jackets</a></li>
						<li><a href="#">Denim Jackets</a></li>
						<li><a href="#">Duffle Coats</a></li>
						<li><a href="#">Leather Jackets</a></li>
						<li><a href="#">Parkas</a></li>
					</ul>
				</li>

				<li class="has-children">
					<a href="#">Tops</a>

					<ul class="is-hidden">
						<li class="go-back"><a href="#0">Clothing</a></li>
						<li class="see-all"><a href="#">All Tops</a></li>
						<li><a href="#">Cardigans</a></li>
						<li><a href="#">Coats</a></li>
						<li><a href="#">Hoodies &amp; Sweatshirts</a></li>
						<li><a href="#">Jumpers</a></li>
						<li><a href="#">Polo Shirts</a></li>
						<li><a href="#">Shirts</a></li>
						<li class="has-children">
							<a href="#0">T-Shirts</a>

							<ul class="is-hidden">
								<li class="go-back"><a href="#0">Tops</a></li>
								<li class="see-all"><a href="#">All T-shirts</a></li>
								<li><a href="#">Plain</a></li>
								<li><a href="#">Print</a></li>
								<li><a href="#">Striped</a></li>
								<li><a href="#">Long sleeved</a></li>
							</ul>
						</li>
						<li><a href="#">Vests</a></li>
					</ul>
				</li>
			</ul>
		</li> --}}
		<li><a href="#">Blog</a></li>
		<li><a href="#">À Propos</a></li>
		<li><a href="{{ route('contact') }}">Contact</a></li>
	</ul> <!-- primary-nav -->
</nav> <!-- cd-nav -->

<div class="cd-overlay"></div>
<!-- End Navbar -->
