@php $cartTotal = request()->session()->get('cartTotal'); @endphp
@section('title', 'Panier('.$cartTotal.') - Flouka')
@section('header_title', 'Panier('.$cartTotal.') - Flouka')

{{-- Start Main --}}
<main class="main-content">

	<!-- Start Cart -->
	<section class="cart">
		<header class="header-cart">
			<div class="overlay"></div>
			<div class="container">
				<h1 class="wow bounceInDown">Panier</h1>
			</div>
		</header>

		<section class="container">
            <section class="cart-content">
				<header class="card-header card-header-lg">
					Panier
				</header>
				<div class="card-block">
					<div class="table-details">
                        <table class="table">
                            <thead>
                                <tr>
									<th>Photo</th>
									<th>Produit</th>
                                    <th>Poids</th>
                                    <th>Prix</th>
                                    <th>Total</th>
									<th>Preparations</th>
									<th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Cart::get()['products'] as $key => $item1)
								@foreach($item1 as $item2)
								@foreach($item2 as $item)
								@php $total += $item['prix_n']*$item['poids']; @endphp
                                <tr>
									<td class="table-photo"><img src="{{ asset(Storage::url($item->produit->photo_principale)) }}" alt="Preview Image"></td>
                                    <td>{{ $item->produit->nom }}</td>
                                    <td>{{ $item['poids'] }} {{ $item->produit->unite->nom }}</td>
                                    <td>{{ $item['prix_n'] }} DH/{{ $item->produit->unite->nom }}</td>
                                    <td>{{ $item['prix_n']*$item['poids'] }} DH</td>
									<td>
										@if(gettype($item2['preparations']) == "array")
											@foreach($item2['preparations'] as $pre)
												{{ $pre.', ' }}
											@endforeach
										@elseif(gettype($item2['preparations']) == "string")
											{{ $item2['preparations'] }}
										@endif
									</td>
									<td><button wire:click="removeFromCart('{{ $key }}')" type="button" class="tabledit-delete-button btn btn-sm btn-danger rounded-circle" title="Supprimer"><i class="fa fa-trash"></i></button></td>
                                </tr>
								@php break; @endphp
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
					</div>
					<div class="total-amount">
						{{-- <div>Sub - Total amount: <b>$4,800</b></div>
						<div>VAT: $35</div> --}}
						<div class="amount">Total : <span class="colored">{{ $total }} DH</span></div>
						<div class="actions">
							<a href="{{ route('sinscrire') }}"><button class="btn btn-inline btn-primary">Checkout</button>
							<button wire:click="clear()" class="btn btn-inline btn-primary">Clear</button></a>
							{{-- <button class="btn btn-inline btn-secondary btn-rounded">Print</button> --}}
						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
	<!-- End Cart -->
</main>
<!-- End Main -->