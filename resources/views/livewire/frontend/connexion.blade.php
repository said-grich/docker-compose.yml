@section('title', 'Connexion - Flouka')
@section('header_title', 'Connexion - Flouka')

{{-- Start Main --}}
<main class="main-content">

	<!-- Start Cart -->
	<section class="cart">
		<header class="header-cart">
			<div class="overlay"></div>
			<div class="container">
				<h1 class="wow bounceInDown">Connexion</h1>
			</div>
		</header>

		<section class="container">
            <section class="cart-content">
				<header class="card-header card-header-lg">
					Connexion
				</header>
				<div class="card-block">
                    {{-- Start Alert --}}
                    @include('layouts.frontend.partials.alerts')
                    {{-- End Alert --}}
                    <form class="form" wire:submit.prevent='submit'>
                        <div class="row">
                            <div class="form-group col-md-4 offset-md-4">
                                <div class="form-control-wrapper form-control-icon-right">
                                    <input type="email" class="form-control" id="email" placeholder="E-Mail ou Téléphone" wire:model.defer="form.email">
                                    <i class="fa fa-user-circle"></i>
                                </div>
                                @error('form.email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 offset-md-4">
                                <div class="form-control-wrapper form-control-icon-right">
                                    <input type="password" class="form-control" id="password" placeholder="Mot de Passe" wire:model.defer="form.password">
                                    <i class="fa fa-key"></i>
                                </div> 
                                @error('form.password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 offset-md-4 text-center">
                                <div class="form-control-wrapper">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-inline">Connexion</button>
                                    <button type="reset" class="btn btn-secondary btn-rounded btn-inline">Réinitialiser</button>
                                </div>
                            </div>
                        </div>
                    <form>
				</div>
			</section>
		</section>
	</section>
	<!-- End Cart -->
</main>
<!-- End Main -->