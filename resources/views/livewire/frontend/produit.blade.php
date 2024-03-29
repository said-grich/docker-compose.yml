<?php use App\Models\Stock; ?>

@section('title', 'Produit - Flouka')
@section('header_title', 'Produit - Flouka')

@push('styles')
    <link rel="stylesheet" href="css/add-to-cart.css"/>
    <link rel="stylesheet" href="css/ribbons.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-select.css"/>
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
                    <div class="ribbon left-top">
                        {{ $items[0]->categorie->nom }} <i class="fa fa-fish"></i>
                    </div>
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
                                <img src="{{ asset(Storage::url($items[0]->produit->photo_principale)) }}" class="d-block w-100" alt="Preview Image">
							</div>
                            @foreach ($produit_photos as $tranche_id => $photo)
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
                            @foreach ($produit_photos as $tranche_id => $photo)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $tranche_id+1 }}">
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
                            {{-- <label class="form-label" for="product-size"><i class="fa fa-ruler"></i>Tranches</label> --}}
                            @foreach(Arr::sort($tranches) as $tranche_id => $tranche)
                                <div class="tranche-info">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="tranche"><span>{{ $tranche["nom"] }} KG</span></div>
                                            <div class="tranche-prix"><span class="prix">{{ $tranche["prix"] }}</span> DH/{{ $items[0]->produit->unite->nom }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-btn"><button wire:click="decrement('{{$tranche_id}}')" class="btn btn-default-outline" type="button">-</button></span>
                                                <input class="form-control" type="test" placeholder="Qte" value="{{ Session::has($produit_id.'-'.$tranche_id) ? count(Session::get($produit_id.'-'.$tranche_id)) : 0}}" readonly>
                                                <span class="input-group-addon">Pcs</span>
                                                <span class="input-group-btn"><button wire:click="increment('{{$tranche_id}}')" class="btn btn-default-outline" type="button">+</button></span>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tbody>
                                            @if(Session::has($produit_id.'-'.$tranche_id))
                                            @foreach(Session::get($produit_id.'-'.$tranche_id) as $i => $items)
                                            @php $items = Stock::select()->where('id', $items['id'])->get(); @endphp
                                            @foreach($items as $item)
                                            @php $prix_total += $item['prix_n']*$item['poids']; $pcs .= $item['id'].','; @endphp
                                                <tr>
                                                    <td>
                                                        <div class="pcs-poids">{{ $item['poids'] }} {{ $items[0]->produit->unite->nom }}</div>
                                                        {{-- {{ dd($item) }} --}}
                                                        <div class="pcs-prix">{{ $item['prix_n']*$item['poids'] }} DH</div>
                                                    </td>
                                                    <td>
                                                        <div x-data="{ open{{$tranche_id}}:false }">
                                                            <div class="d-flex mode-preparation">
                                                                <div class="radio">
                                                                    <input @click="open{{$tranche_id}} = 1" type="radio" name="mode{{$tranche_id}}-{{$i}}" id="radio-1-{{$tranche_id}}-{{$i}}" value="option1">
                                                                    <label for="radio-1-{{$tranche_id}}-{{$i}}">Cuisine</label>
                                                                </div>
                                                                <div class="radio">
                                                                    <input @click="open{{$tranche_id}} = 2" type="radio" name="mode{{$tranche_id}}-{{$i}}" id="radio-2-{{$tranche_id}}-{{$i}}" value="option2">
                                                                    <label for="radio-2-{{$tranche_id}}-{{$i}}">Nettoyage</label>
                                                                </div>
                                                            </div>
                                                            
                                                            <div x-show="open{{$tranche_id}} == 1" class="preparations">
                                                                @livewire('frontend.multi-select', ['selectId' => 'C_'.$tranche_id.'_'.$i, 'selectTitle' => 'Mode Cuisine', 'selectType' => '', 'selectOptions' => $item->produit->preparations, 'mode' => 1, 'key' => $produit_id.'-'.$tranche_id.'_'.$i], key('C-'.$tranche_id.'-'.$i))
                                                            </div>
                                                            <div x-show="open{{$tranche_id}} == 2" class="preparations">
                                                                @livewire('frontend.multi-select', ['selectId' => 'N_'.$tranche_id.'_'.$i, 'selectTitle' => 'Mode Nettoyage', 'selectType' => 'multiple', 'selectOptions' => $item->produit->preparations, 'mode' => 2, 'key' => $produit_id.'-'.$tranche_id.'_'.$i], key('N-'.$tranche_id.'-'.$i))
                                                            </div>
                                                            {{-- <select x-show="open{{$tranche_id}} == 1" class="preparations">
                                                                <option>Mode Cuisine</option>
                                                                <option>Four</option>
                                                                <option>Friture</option>
                                                                <option>Grillade</option>
                                                                <option>Plancha</option>
                                                                <option>Tajine</option>
                                                            </select> --}}
                                                            {{-- <select x-show="open{{$tranche_id}} == 2" id="select" class="preparations" multiple>
                                                                <option>Mode Nettoyage</option>
                                                                @foreach($item->produit->preparations as $preparations)
                                                                    <option>{{ $preparations->preparation->nom }}</option>
                                                                @endforeach
                                                            </select> --}}
                                                        </div>
                                                    </td>
                                                    <td><button wire:click="deletePcs('{{$tranche_id}}','{{$i}}')" type="button" class="tabledit-delete-button btn btn-sm btn-danger" title="Supprimer"><i class="fa fa-trash-alt"></i></button></td>
                                                </tr>
                                            @endforeach
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                            {{-- <div class="poids-total">Poids Total : <span>{{ $poids_total }} kg</span></div> --}}
                            <div class="prix-total">Total : <span>{{ !empty($prix_total) ? $prix_total : 0 }} DH</span></div>
                        </div>
					</section>
                    {{-- @php dd($pcs); @endphp --}}
					<section class="typical-section">
						<a wire:click="addToCart('{{$pcs}}')" class="add-to-cart cd-add-to-cart js-cd-add-to-cart" data-id="" data-title="" data-price="" data-pic="" data-color="" data-size="">
							<em>Ajouter au Panier</em>
							<svg x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32">
								<path stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11" style="stroke-dashoffset: 19.79;"></path>
							</svg>
						</a>
					</section>
					<section class="typical-section">
						{{-- <div class="notes">
							<p>Temps de Traitement : <span>Votre article sera expédié dans les 3 jours ouvrables.</span></p>
							<p>Shipping : <span>Free standard shipping on orders over 400 DH.</span></p>
						</div> --}}
						<div class="social-media">
                            <span>Partagé sur :</span>
							<ul class="links">
                                <li><a rel="nofollow" href="https://wa.me/?text=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank" title="Whatsapp"><i class="fab fa-whatsapp"></i></a></li>
								<li><a rel="nofollow" href="https://facebook.com/sharer/sharer.php?u=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a rel="nofollow" href="https://facebook.com/sharer/sharer.php?u=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
								<li><a rel="nofollow" href="https://linkedin.com/shareArticle?mini=true&amp;url=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank" title="Linked In"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a rel="nofollow" href="https://twitter.com/share?url=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank"><i class="fab fa-twitter" title="Twitter"></i></a></li>
                                <li><a rel="nofollow" href="https://plus.google.com/share?url=http://espace-bebe.ma/product.php?id=<? echo $product->id; ?>" target="_blank" title="Google +"><i class="fab fa-google-plus-g"></i></a></li>
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
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script>
        $(document).ready(function(){
            $('.carousel-item').zoom({url: $('.carousel-item img').attr('data-BigImgSrc')});
        });
    </script>
@endpush
