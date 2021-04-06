@php $cartTotal = request()->session()->get('cartTotal'); @endphp
@section('title', 'Panier('.$cartTotal.') - Flouka')
@section('header_title', 'Panier('.$cartTotal.') - Flouka')

{{-- Start Main --}}
<main class="main-content">

	<!-- Start Product -->
	<section class="product">
		<header class="header-product">
			<div class="overlay"></div>
			<div class="container">
				<h1 class="wow bounceInDown">Panier</h1>
			</div>
		</header>

		<section class="container">
            <section class="product-content">
				<header class="card-header card-header-lg">
					Panier
				</header>
				<div class="card-block">
					<div class="table-details">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Cost</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#</td>
                                    <td>Description</td>
                                    <td>Quantity</td>
                                    <td>Unit Cost</td>
                                    <td>Total</td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Description</td>
                                    <td>Quantity</td>
                                    <td>Unit Cost</td>
                                    <td>Total</td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Description</td>
                                    <td>Quantity</td>
                                    <td>Unit Cost</td>
                                    <td>Total</td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Description</td>
                                    <td>Quantity</td>
                                    <td>Unit Cost</td>
                                    <td>Total</td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Description</td>
                                    <td>Quantity</td>
                                    <td>Unit Cost</td>
                                    <td>Total</td>
                                </tr>
                            </tbody>
                        </table>
					</div>
					<div class="row">
						<div class="col-lg-5 clearfix">
							<div class="total-amount">
								<div>Sub - Total amount: <b>$4,800</b></div>
								<div>VAT: $35</div>
								<div>Grand Total: <span class="colored">$4,000</span></div>
								<div class="actions">
									<button class="btn btn-rounded btn-inline">Send</button>
									<button class="btn btn-inline btn-secondary btn-rounded">Print</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="product-content row">

			</section>
		</section>
	</section>
	<!-- End Product -->
</main>
<!-- End Main -->