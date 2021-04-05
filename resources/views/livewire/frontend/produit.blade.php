@section('title', 'Produit - Flouka')
@section('header_title', 'Produit - Flouka')

@push('styles')
    <link rel="stylesheet" href="css/add-to-cart.css"/>
@endpush

{{-- Start Main --}}
<main class="main-content">

	<!-- Start Product -->
	<section class="product">
		<header class="header-product">
			<div class="overlay"></div>
			<div class="container">
				<h1 class="wow bounceInDown">{{ $items[0]->produit->nom }}</h1>
			</div>
		</header>

		<section class="container">
			<section class="product-content row">
				<div class="product-pic col-md-6">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
                                <img src="{{ asset(Storage::url($items[0]->produit->photo_principale)) }}" class="d-block w-100" alt="Preview Image">
							</div>
                            @foreach ($produit_photos as $key => $photo)
                                <div class="carousel-item">
                                    <img src="{{ asset(Storage::url($photo->photo)) }}" class="d-block w-100" alt="Preview Image">
                                </div>
                            @endforeach
							<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
								<img src="{{ asset(Storage::url($items[0]->produit->photo_principale)) }}" alt="Preview Image">
							</li>
                            @foreach ($produit_photos as $key => $photo)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key+1 }}">
                                    <img src="{{ asset(Storage::url($photo->photo)) }}" alt="Preview Image">
                                </li>
                            @endforeach
						</ol>
					</div>
				</div>
				<div class="col-md-6">
					<h2 class="title">{{ $items[0]->produit->nom }}</h2>
					<div class="divider"></div>
					{{-- <section class="typical-section">
						<div class="price">
							<span class="new-price">110 DH</span></span>
							<span class="discount">25% OFF)</span>
							<span class="old-price">150 DH</span>
						</div>
					</section> --}}
					<section class="typical-section">
						<div class="row">
							<p class="description col-12">Lorem ipsum dolor ut sit ame dolore adipiscing elit, sed sit nonumy nibh sed euismod laoreet dolore magna aliquarm erat sit volutpat Nostrud duis molestie at dolore. Lorem ipsum dolor ut sit ame dolore adipiscing elit, sed sit nonumy nibh sed euismod laoreet dolore magna aliquarm erat sit volutpat Nostrud duis molestie at dolore. Lorem ipsum dolor ut sit ame dolore adipiscing elit, sed sit nonumy nibh sed euismod laoreet dolore magna aliquarm erat sit volutpat Nostrud duis molestie at dolore.</p>
						</div>
					</section>
					<section class="typical-section">
							<div class="form-group">
								<label class="form-label" for="product-size"><i class="fa fa-ruler"></i>Tranches</label>
                                @foreach ($items as $key => $item)
                                {{-- @for ($inc = 0; $inc < $key; $inc++)
                                    @php $count_rows += $inc @endphp
                                @endfor --}}
                                    <div class="tranche-info">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="tranche"><span>{{ $item->tranche->min_poids }} kg</span> - <span>{{ $item->tranche->max_poids }} kg</span></div>
                                                <div class="tranche-prix"><span class="prix">{{ $item->prix_n }}</span> Dh/{{ $item->produit->unite->nom }}</div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group">
                                                    <span class="input-group-btn"><button class="btn btn-default-outline" type="button">-</button></span>
                                                    <input {{--wire:click="add()"--}} class="form-control" type="test" placeholder="Qte" wire:model="qte.{{$key}}">
                                                    <span class="input-group-btn"></span>
                                                    <span class="input-group-btn"><button class="btn btn-default-outline" type="button">+</button></span>
                                                </div>
                                                {{-- <div class="tranche-total-poid">{{ $item->poids }} kg</div>
                                                <div class="tranche-total-prix"><span class="prix">{{ $item->poids*$item->prix_n }}</span> Dh</div> --}}
                                            </div>
                                        </div>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Qte</th>
                                                    <th>Montant</th>
                                                    <th>Préparation</th>
                                                </tr>
                                            </thead>
                                            @php $rows = !empty($count_rows[$key]) ? $count_rows[$key] : 0; @endphp
                                            @for ($i = 0; $i < $rows; $i++)
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $item->poids }} kg</td>
                                                        <td>{{ $item->poids*$item->prix_n }} DH</td>
                                                        <td>
                                                            <div x-data="{ open{{$key}}:false }">
                                                                <div class="d-flex">
                                                                    <div class="radio">
                                                                        <input @click="open{{$key}} = 1" type="radio" name="mode{{$key}}-{{$i}}" id="radio-1-{{$key}}-{{$i}}" value="option1">
                                                                        <label for="radio-1-{{$key}}-{{$i}}">Mode Cuisine</label>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <input @click="open{{$key}} = 2" type="radio" name="mode{{$key}}-{{$i}}" id="radio-2-{{$key}}-{{$i}}" value="option2">
                                                                        <label for="radio-2-{{$key}}-{{$i}}">Mode Nettoyage</label>
                                                                    </div>
                                                                </div>
                                                                <select x-show="open{{$key}} == 1" class="form-control">
                                                                    <option>Mode Cuisine</option>
                                                                    <option>Four</option>
                                                                    <option>Friture</option>
                                                                    <option>Grillade</option>
                                                                    <option>Plancha</option>
                                                                    <option>Tajine</option>
                                                                </select>
                                                                <select x-show="open{{$key}} == 2" class="form-control" multiple>
                                                                    <option>Mode Nettoyage</option>
                                                                    @foreach ( $item->produit->preparations as $preparations )
                                                                        <option>{{ $preparations->preparation->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endfor
                                        </table>
                                    </div>
                                @endforeach
                                {{-- <div class="poids-total">Poids Total : <span>{{ $poids_total }} kg</span></div> --}}
                                <div class="prix-total">Prix Total <span>{{ !empty($prix_total) ? $prix_total : 0 }} DH</span></div>
							</div>
					</section>
					<section class="typical-section">
						<a class="add-to-cart cd-add-to-cart js-cd-add-to-cart" data-id="" data-title="" data-price="" data-pic="" data-color="" data-size="">
							<em>Ajouter au Panier</em>
							<svg x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32">
								<path stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11" style="stroke-dashoffset: 19.79;"></path>
							</svg>
						</a>
					</section>
					<section class="typical-section">
						<div class="notes">
							<p>Temps de Traitement : <span>Votre article sera expédié dans les 3 jours ouvrables.</span></p>
							{{-- <p>Shipping : <span>Free standard shipping on orders over 400 DH.</span></p> --}}
						</div>
						<div class="social-media">
							<ul class="links">
								<li><a rel="nofollow" href="https://facebook.com/sharer/sharer.php?u=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
								<li><a rel="nofollow" href="https://twitter.com/share?url=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank"><i class="fab fa-twitter" title="Twitter"></i></a></li>
								<li><a rel="nofollow" href="https://plus.google.com/share?url=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank" title="Google +"><i class="fab fa-google-plus-g"></i></a></li>
								<li><a rel="nofollow" href="https://pinterest.com/pin/create/button/?url=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>&amp;media=http://espace-bebe.ma/data/uploads/<? echo array_key_first($product_colors); ?>&amp;description=<? echo $product->description; ?>" target="_blank" title="Pinterest"><i class="fab fa-pinterest-p"></i></a></li>
								<li><a rel="nofollow" href="https://linkedin.com/shareArticle?mini=true&amp;url=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank" title="Linked In"><i class="fab fa-linkedin-in"></i></a></li>
								<li><a rel="nofollow" href="https://digg.com/submit?url=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>&amp;title=<? echo $product->name; ?>" target="_blank" title="Digg"><i class="fab fa-digg"></i></a></li>
								<li><a rel="nofollow" href="https://reddit.com/submit?url=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>&amp;title=<? echo $product->name; ?>" target="_blank" title="Reddit"><i class="fab fa-reddit-alien"></i></a></li>
								<li><a rel="nofollow" href="https://tumblr.com/share?v=3&amp;u=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>&amp;t=<? echo $product->name; ?>" target="_blank" title="Tumblr"><i class="fab fa-tumblr"></i></a></li>
								<li><a rel="nofollow" href="https://wa.me/?text=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank" title="Whatsapp"><i class="fab fa-whatsapp"></i></a></li>
							</ul>
						</div>
					</section>
				</div>
			</section>
		</section>
	</section>
	<!-- End Product -->
</main>
<!-- End Main -->

@push('scripts')
    <script src="js/jquery.bootstrap-touchspin.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.carousel-item').zoom({url: $('.carousel-item img').attr('data-BigImgSrc')});
            $("input[name='qte']").TouchSpin({
                min: 0,
                max: 100,
                step: 1,
                decimals: 0,
                boostat: 5,
                maxboostedstep: 10,
                buttondown_class: "btn btn-default-outline",
                buttonup_class: "btn btn-default-outline"
            });
        });
    </script>
@endpush
