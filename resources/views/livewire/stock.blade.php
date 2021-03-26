@section('title', 'Stock')
@section('header_title', 'Stock')

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
                        <h3 class="card-title">{{ __('Stock') }}</h3>
                    </div>
                    <div class="card-body">

                        <!--begin::Alerts-->
                        @include('layouts.partials.alerts')
                        <!--end::Alerts-->

                        <!--Button trigger modal-->
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#lot">
                            <i class="flaticon-plus"></i> {{ __('Ajouter Lot') }}
                        </button>
                       {{--  <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#stock">
                            <i class="flaticon-plus"></i> {{ __('Ajouter Stock') }}
                        </button> --}}
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="lot" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="lot" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau Lot') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="lot-form" class="form row" wire:submit.prevent="createLot">
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num"/>
                                                    <label>{{ __('Numéro') }}</label>
                                                </div>
                                                @error('lot_num')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-alt icon-lg"></i></span></div>
                                                    <input id="date_capture" type="text" class="form-control datepicker" placeholder=" " wire:model.defer="date_capture"/>
                                                    <label>{{ __('Date Capture') }}</label>
                                                </div>
                                                @error('date_capture')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-plus icon-lg"></i></span></div>
                                                    <input id="date_entree" type="text" class="form-control datepicker" placeholder=" " wire:model.defer="date_entree"/>
                                                    <label>{{ __('Date Entree') }}</label>
                                                </div>
                                                @error('date_entree')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-times icon-lg"></i></span></div>
                                                    <input id="date_preemption" type="text" class="form-control datepicker" placeholder=" " wire:model.defer="date_preemption"/>
                                                    <label>{{ __('Date Préemption') }}</label>
                                                </div>
                                                @error('date_preemption')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model="fournisseur">
                                                        <option>{{ __('Fournisseur') }}</option>
                                                        @foreach ($list_fournisseurs as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach

                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#fournisseur"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Fournisseur"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('fournisseur')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-award icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model="qualite">
                                                        <option>{{ __('Qualite') }}</option>
                                                        @foreach ($list_qualites as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#qualite"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Qualite"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('qualite')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-box-open icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model.defer="produit">
                                                        <option>{{ __('Produit') }}</option>
                                                        @foreach ($list_produits as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#produit"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Produit"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('produit')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="pas"/>
                                                    <label>{{ __('Pas') }}</label>
                                                </div>
                                                @error('pas')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 row">
                                                <label class="col-8 col-form-label">{{ __('Activé / Désactivé le lot') }}</label>
                                                <div class="col-4">
                                                    <span class="switch switch-outline switch-icon switch-primary">
                                                        <label>
                                                        <input type="checkbox" checked="checked" wire:model.defer="active" name="active"/>
                                                        <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="lot-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Modal-->
                        {{-- <div wire:ignore.self class="modal fade" id="stock" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="stock" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau Stock') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="stock-form" class="form row" wire:submit.prevent="createStock">
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model="lot_id">
                                                        <option>{{ __('Lot') }}</option>
                                                        @foreach ($list_lots as $item)
                                                            <option value="{{$item->lot_num}}">{{$item->lot_num}} | {{$item->produit->nom}} | {{$item->produit->modeVente->nom}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                @error('lot_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model="tranches" multiple>
                                                        <option>{{ __('Tranches') }}</option>
                                                        @foreach ($list_tranches as $key => $item)
                                                            <option value="{{$item[0]['uid']}}">{{$item[0]['nom']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('tranches')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-warehouse icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model.defer="depot">
                                                        <option>{{ __('Dépot') }}</option>
                                                        @foreach ($list_depots as $item)
                                                            <option value="{{$item->id}}">{{$item->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('depot')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice-dollar icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="prix_achat"/>
                                                    <label>{{ __('Prix Achat') }}</label>
                                                </div>
                                                @error('prix_achat')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-balance-scale-left icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="qte"/>
                                                    <label>{{ __('Quantité') }}</label>
                                                </div>
                                                @error('qte')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-warehouse icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="cr"/>
                                                    <label>{{ __('CR') }}</label>
                                                </div>
                                                @error('cr')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice-dollar icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="prix_vente_normal"/>
                                                    <label>{{ __('Prix Vente Normal') }}</label>
                                                </div>
                                                @error('prix_vente_normal')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice-dollar icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="prix_vente_fidele"/>
                                                    <label>{{ __('Prix Vente Fidèle') }}</label>
                                                </div>
                                                @error('prix_vente_fidele')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice-dollar icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="prix_vente_business"/>
                                                    <label>{{ __('Prix Vente Business') }}</label>
                                                </div>
                                                @error('prix_vente_business')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 row">
                                                <label class="col-8 col-form-label">{{ __('Activé') }}</label>
                                                <div class="col-4">
                                                    <span class="switch switch-outline switch-icon switch-primary">
                                                        <label>
                                                        <input type="checkbox" checked="checked" wire:model.defer="active_stock" name="active_stock"/>
                                                        <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="stock-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!--Table-->
                        <div class="mt-5">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#encours-tab">
                                        <span class="nav-text">Lots en cours</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#archive-tab">
                                        <span class="nav-text">Lots archivés</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5">
                                <div class="tab-pane fade active show" id="encours-tab" role="tabpanel">
                                    @livewire('parametrage.liste-lots')
                                </div>
                                <div class="tab-pane fade" id="archive-tab" role="tabpanel">
{{--                                     @livewire('parametrage.liste-sous-categorie')
 --}}                                </div>
                            </div>
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

{{-- <!--Modal-Sous-Catégorie--->
<div wire:ignore.self class="modal secondary fade" id="sous-categorie" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="sous-categorie" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Nouvelle Sous Catégorie') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="sous-categorie-form" class="form" wire:submit.prevent="createSousCategorie">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sitemap icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="sous_categorie_name"/>
                            <label>{{ __('Nom') }}</label>
                        </div>
                        @error('sous_categorie_name')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div wire:ignore class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sitemap icon-lg"></i></span></div>
                            <select class="form-control selectpicker" wire:model="categorie_id">
                                <option>{{ __('Catégorie') }}</option>
                                @foreach ($list_categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('categorie_id')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                <button type="submit" class="btn btn-primary font-weight-bold" form="sous-categorie-form">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div>

<!--Modal-Mode-Vente-->
<div wire:ignore.self class="modal secondary fade" id="mode-vente" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="mode-vente" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Nouveau mode de vente') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="mode-vente-form" class="form" wire:submit.prevent="createModeVente">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-check-alt icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="mode_vente_name"/>
                            <label>{{ __('Nom') }}</label>
                        </div>
                        @error('mode_vente_name')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                <button type="submit" class="btn btn-primary font-weight-bold" form="mode-vente-form">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div>

<!--Modal-Tranches-->
<div wire:ignore.self class="modal secondary fade" id="tranches" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tranches" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Nouvelle tranche') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="tranches-form" class="form" wire:submit.prevent="createTranche">
                    <div x-data="{ open: false }">
                        <div class="mb-6">
                            <div class="radio-inline">
                                @foreach ($list_modes_vente as $mode)
                                    <label class="radio radio-primary">
                                        <input type="radio" name="type" wire:model.defer="type" value="{{$mode->id}}" @click="open = {{$mode->id}}"/>
                                        <span></span>
                                        {{$mode->nom}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="row" x-show="open === 1">
                            <div class="form-group col-md-6">
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="minPoids"/>
                                    <label>{{ __('Poids Minimal') }}</label>
                                </div>
                                @error('minPoids')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="maxPoids"/>
                                    <label>{{ __('Poids Maximal') }}</label>
                                </div>
                                @error('maxPoids')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div x-show="open > 1">
                            <div class="form-group">
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="nom"/>
                                    <label>{{ __('Nom') }}</label>
                                </div>
                                @error('nom')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                <button type="submit" class="btn btn-primary font-weight-bold" form="tranches-form">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div>

<!--Modal-Mode-Préparation-->
<div wire:ignore.self class="modal secondary fade" id="mode-preparation" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="mode-preparation" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Nouveau Mode Préparation') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="mode-preparation-form" class="form" wire:submit.prevent="createModePreparation">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tools icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="mode_preparation_nom"/>
                            <label>{{ __('Nom') }}</label>
                        </div>
                        @error('mode_preparation_nom')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                <button type="submit" class="btn btn-primary font-weight-bold" form="mode-preparation-form">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div>

<!--Modal-Préparation-->
<div wire:ignore.self class="modal secondary fade" id="preparation" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="preparation" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
                                @foreach ($list_modes_preparation as $mode)
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

<!--Modal-Unite-->
<div wire:ignore.self class="modal secondary fade" id="unite" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="unite" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Nouvelle Unité') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="unite-form" class="form" wire:submit.prevent="createUnite">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="nom"/>
                            <label>{{ __('Nom') }}</label>
                        </div>
                        @error('nom')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                <button type="submit" class="btn btn-primary font-weight-bold" form="unite-form">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div> --}}




@push('scripts')

    <script>
        window.addEventListener('contentChanged', event => {
            $('.selectpicker').selectpicker();
        });
    </script>

    <script>
        $('.datepicker').on('change', function (e) {
            @this.set(e.target.id, e.target.value);
        });
    </script>

@endpush
