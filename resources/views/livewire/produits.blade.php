@section('title', 'Produits')
@section('header_title', 'Produits')

<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-xl-12">
                <!--begin::Card-->
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Liste Produits') }}</h3>
                    </div>
                    <div class="card-body">

                        <!--begin::Alerts-->
                        @include('layouts.partials.alerts')
                        <!--end::Alerts-->

                        <!--Button trigger modal-->
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#produit">
                            <i class="flaticon-plus"></i> {{ __('Ajouter Produit') }}
                        </button>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="produit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="produit" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau Produit') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="produit-form" class="form row" wire:submit.prevent="createProduit">
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-box-open icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="nom"/>
                                                    <label>{{ __('Nom') }}</label>
                                                </div>
                                                @error('nom')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sitemap icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model.defer="sous-categorie">
                                                        <option>{{ __('Sous Categorie') }}</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                    <div class="input-group-append"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Sous Categorie"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('sous-categorie')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-check-alt icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model.defer="mode-vente">
                                                        <option>{{ __('Mode Vente') }}</option>
                                                        <option value="1">{{ __('Kg') }}</option>
                                                        <option value="2">{{ __('Pièce') }}</option>
                                                        <option value="3">{{ __('Poids Par Pièce') }}</option>
                                                    </select>
                                                    <div class="input-group-append"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Mode Vente"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('mode-vente')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model.defer="tranches">
                                                        <option>{{ __('Tranches') }}</option>
                                                        <option value="1">0.5 - 1.5 Kg</option>
                                                        <option value="2">2.0 - 3.5 Kg</option>
                                                        <option value="3">3.6 - 5 Kg</option>
                                                    </select>
                                                    <div class="input-group-append"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Tranche"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('tranches')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tools icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model.defer="mode-preparation">
                                                        <option>{{ __('Mode Préparation') }}</option>
                                                        <option value="1">{{ __('Nettoyage') }}</option>
                                                        <option value="2">{{ __('Cuisine') }}</option>
                                                    </select>
                                                    <div class="input-group-append"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Mode Préparation"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('mode-preparation')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tools icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model.defer="preparations">
                                                        <option>{{ __('Préparations') }}</option>
                                                        <option value="1">Anneaux</option>
                                                        <option value="2">Brochette</option>
                                                        <option value="3">Darne</option>
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#preparation"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Préparation"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('preparations')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-12">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model.defer="unites">
                                                        <option>{{ __('Unites') }}</option>
                                                        <option value="1">Kg</option>
                                                        <option value="2">Bande</option>
                                                        <option value="3">Bloc</option>
                                                    </select>
                                                    <div class="input-group-append"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Unite"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('unites')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calculator icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="code-comptable"/>
                                                    <label>{{ __('Code Comptable') }}</label>
                                                </div>
                                                @error('code-comptable')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-chart-pie icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="code-analytique"/>
                                                    <label>{{ __('Code Analytique') }}</label>
                                                </div>
                                                @error('code-analytique')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-image icon-lg"></i></span></div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"/>
                                                        <label class="custom-file-label" for="customFile">Produit Photo Principal</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-images icon-lg"></i></span></div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile" multiple/>
                                                        <label class="custom-file-label" for="customFile">Produit Photos</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 row">
                                                <label class="col-4 col-form-label">{{ __('Active Produit :') }}</label>
                                                <div class="col-8 col-form-label">
                                                    <div class="radio-inline">
                                                        <label class="radio radio-primary">
                                                            <input type="radio" name="active" wire:model.defer="active" checked="checked"/>
                                                            <span></span>
                                                            {{ __('Oui') }}
                                                        </label>
                                                        <label class="radio radio-primary">
                                                            <input type="radio" name="active" wire:model.defer="active"/>
                                                            <span></span>
                                                            {{ __('Non') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="produit-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Table-->
                        <div class="mt-5">
                            {{-- @livewire('parametrage....') --}}
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>

<!--Modal-Préparation-->
<div wire:ignore.self class="modal secondary fade" id="preparation" tabindex="-1" role="dialog" aria-labelledby="preparation" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Nouvelle Préparation') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="preparation-form" class="form" wire:submit.prevent="createPreparation">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tools icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="preparation_nom"/>
                            <label>{{ __('Nom') }}</label>
                        </div>
                        @error('preparation_nom')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div wire:ignore class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tools icon-lg"></i></span></div>
                            <select class="form-control selectpicker" wire:model="mode_preparation_id">

                                <option>{{ __('Mode Préparation') }}</option>
                                @foreach ($list_mode_preparations as $mode)
                                    <option value="{{$mode->id}}">{{$mode->nom}}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('mode_preparation_id')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                <button type="submit" class="btn btn-primary font-weight-bold" form="preparation-form">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div>
</div>