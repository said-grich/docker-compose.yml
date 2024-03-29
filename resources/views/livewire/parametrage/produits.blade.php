@section('title', 'Produits')
@section('header_title', 'Produits')

@push('styles')
    <link rel="stylesheet" href="assets/plugins/custom/uppy/uppy.bundle.css"/>
    <link rel="stylesheet" href="assets/plugins/custom/upload/fancy-file-uploader/fancy_fileupload.css"/>
@endpush

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
                        <div wire:ignore.self class="modal fade" id="produit" data-backdrop="static" tabindex="-1"
                             role="dialog" aria-labelledby="produit" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau Produit') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="produit-form" class="form row" wire:submit.prevent="createProduit" enctype="multipart/form-data">
                                            <div class="form-group col-md-4">
                                                <label><b>{{ __('Nom Produit') }}</b></label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-box-open icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder="Nom Produit" wire:model.defer="nom"/>
                                                </div>
                                                @error('nom')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- <div wire:ignore class="form-group col-md-6">
                                                <label><b>{{ __('Catégorie') }}</b></label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fa fa-sitemap icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker"
                                                            wire:model.defer="categorie">
                                                        <option>{{ __('Choisir une catégorie') }}</option>
                                                        @foreach ($list_categories as $item)
                                                            <option value="{{$item->id}}">{{$item->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal"
                                                         data-target="#categorie">
                                                        <button class="btn btn-primary" type="button"
                                                                data-toggle="tooltip" data-theme="dark"
                                                                title="Ajouter Sous Categorie"><i
                                                                class="fa fa-plus-circle"></i></button>
                                                    </div>
                                                </div>
                                                @error('sous_categorie')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                            {{-- <div wire:ignore class="form-group col-md-6">
                                                <label><b>{{ __('Sous Catégorie') }}</b></label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fa fa-sitemap icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker"
                                                            wire:model.defer="sous_categorie">
                                                        <option>{{ __('Choisir un sous catégorie') }}</option>
                                                        @foreach ($list_sous_categories as $item)
                                                            <option value="{{$item->id}}">{{$item->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal"
                                                         data-target="#sous-categorie">
                                                        <button class="btn btn-primary" type="button"
                                                                data-toggle="tooltip" data-theme="dark"
                                                                title="Ajouter Sous Categorie"><i
                                                                class="fa fa-plus-circle"></i></button>
                                                    </div>
                                                </div>
                                                @error('sous_categorie')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                            <div class="form-group col-md-4">
                                                <label><b>{{ __('Famille') }}</b></label>
                                                <div wire:ignore class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sitemap icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model.defer="famille">
                                                        <option>{{ __('Choisir une famille') }}</option>
                                                        @foreach ($list_familles as $item)
                                                            <option value="{{$item->id}}">{{$item->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#famille">
                                                        <button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter une famille">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @error('famille')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label><b>{{ __('Unité Affichée') }}</b></label>
                                                <div wire:ignore class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model="unite">
                                                        <option>{{ __('Choisir une unité') }}</option>
                                                        @foreach ($list_unite as $item)
                                                            <option value="{{$item->id}}">{{$item->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#unites">
                                                        <button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark"
                                                                title="Ajouter Unite"><i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @error('unite')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label><b>{{ __('Mode Vente') }}</b></label>
                                                <div wire:ignore class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-check-alt icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model="mode_vente">
                                                        <option>{{ __('Mode Vente') }}</option>
                                                        @foreach ($list_modes_vente as $item)
                                                            <option value="{{$item->id}}">{{$item->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#mode-vente">
                                                        <button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Mode Vente">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @error('mode_vente')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label><b>{{ __('Tranches') }}</b></label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model="tranches" multiple>
                                                        {{-- <option>{{ __('Choisir une tranche') }}</option> --}}
                                                        @foreach ($list_tranches as $tranche)
                                                            <option value="{{$tranche->uid}}">{{$tranche->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal"
                                                         data-target="#tranches">
                                                        <button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Tranche">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @error('tranches')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                 <label><b>{{ __('Mode Cuisine ') }}</b></label>
                                                 <div wire:ignore class="input-group input-group-prepend">
                                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tools icon-lg"></i></span></div>
                                                     <select class="form-control " wire:model="mode_cuisine" multiple>
                                                        {{-- <option>{{ __('Choisir un mode de préparation') }}</option> --}}
                                                        @foreach ($list_cuisine as $mode)
                                                            <option value="{{$mode->id}}">{{$mode->nom}}</option>
                                                        @endforeach
                                                     </select>
                                                     <div class="input-group-append" data-toggle="modal" data-target="#mode-preparation">
                                                         <button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Mode Préparation">
                                                             <i class="fa fa-plus-circle"></i>
                                                         </button>
                                                     </div>
                                                 </div>
                                                 @error('mode_cuisine')
                                                     <span class="form-text text-danger">{{ $message }}</span>
                                                 @enderror
                                             </div>
                                             <div class="form-group col-md-6">
                                                <label><b>{{ __('Mode Nettoyage ') }}</b></label>
                                                <div wire:ignore class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tools icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model="mode_nettoyage" multiple>
                                                        {{-- <option>{{ __('Choisir un mode de préparation') }}</option> --}}
                                                        @foreach ($list_nettoyage as $mode)
                                                            <option value="{{$mode->id}}">{{$mode->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#mode-preparation-n"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Mode Préparation"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('mode_nettoyage')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group col-md-12">
                                                <label><b>{{ __('Modes Préparation') }}</b></label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fa fa-tools icon-lg"></i></span></div>

                                                    @foreach ($list_modes_preparation as $mode)
                                                        <div x-data="{ isShowing{{$mode->id}}: false }">
                                                            <input wire:click="ShowModePreparations({{$mode->id}})"
                                                                   type="checkbox"
                                                                   @click="isShowing{{$mode->id}} = !isShowing{{$mode->id}}"
                                                                   value="{{$mode->id}}"
                                                                   wire:model="mode_cuisine"/>
                                                            <label>{{ $mode->nom }}</label>
                                                            <select x-show="isShowing{{$mode->id}}"
                                                                    class="form-control "
                                                                    wire:model="mode_nettoyage" multiple>
                                                                <option>{{ __('Choisir une préparation') }}</option>
                                                                @if($mode_active !== $mode->id)
                                                                    @foreach ($list_preparations as $item)
                                                                        <option
                                                                            value="{{$item->id}}">{{$item->nom}}</option>
                                                                    @endforeach
                                                                @elseif($mode_active === $mode->id)
                                                                    @foreach ($list_preparations as $item)
                                                                        <option wire:ignore
                                                                                value="{{$item->id}}">{{$item->nom}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    @endforeach

                                                    <div class="input-group-append" data-toggle="modal"
                                                         data-target="#mode-preparation">
                                                        <button class="btn btn-primary" type="button"
                                                                data-toggle="tooltip" data-theme="dark"
                                                                title="Ajouter Mode Préparation"><i
                                                                class="fa fa-plus-circle"></i></button>
                                                    </div>
                                                </div>
                                                @error('mode_preparation')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}


                                            <div class="form-group col-md-6">
                                                <label><b>{{ __('Code Comptable') }}</b></label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calculator icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder="Code Comptable" wire:model.defer="code_comptable"/>
                                                </div>
                                                @error('code-comptable')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><b>{{ __('Code Analytique') }}</b></label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-chart-pie icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder="Code Analytique" wire:model.defer="code_analytique"/>
                                                </div>
                                                @error('code-analytique')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><b>{{ __('Photo Principale') }}</b></label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="col-12">
                                                        <input id="uploader-photo"type="file" name="photo" accept=".jpg, .png, image/jpeg, image/png" wire:model.defer="photo_principale">
                                                    </div>

                                               {{-- <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-image icon-lg"></i></span></div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile" wire:model.defer="photo_principale"/>
                                                        <label class="custom-file-label" for="customFile">Produit Photo Principal</label>
                                                    </div> --}}
                                                </div>
                                                @error('photo_principale')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><b>{{ __('Autres Photos') }}</b></label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="col-12">
                                                        <input id="uploader"type="file" name="photos" accept=".jpg, .png, image/jpeg, image/png">
                                                    </div>
                                                </div>
                                                {{-- <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-images icon-lg"></i></span></div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile" *wire:model.defer="photos" multiple/>
                                                        <label class="custom-file-label" for="customFile">Produit Photos</label>
                                                    </div>
                                                </div> --}}
                                                @error('photos')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 row">
                                                <label class="col-8 col-form-label">{{ __('Activé / Désactivé le produit') }}</label>
                                                <div class="col-4">
                                                    <span class="switch switch-outline switch-icon switch-primary">
                                                        <label>
                                                        <input type="checkbox" checked="checked" wire:model.defer="active" name="active"/>
                                                        <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group col-md-6 row">
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
                                            </div> --}}
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="produit-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Modal-Tranches-->

                        <div class="modal secondary fade" id="tranches" data-backdrop="static" tabindex="-1"
                             role="dialog" aria-labelledby="tranches" aria-hidden="true">
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
                                                {{-- <div class="mb-6">
                                                    <div class="radio-inline">
                                                        @foreach ($list_modes_vente as $mode)
                                                            <label class="radio radio-primary">
                                                                <input type="radio" name="type" wire:model.defer="type"
                                                                       value="{{$mode->id}}"
                                                                       @click="open = {{$mode->id}}"/>
                                                                <span></span>
                                                                {{$mode->nom}}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div> --}}
                                                <div x-data="{'showPoids': @entangle('showPoids')}">
                                                    <div class="row" x-show="showPoids">

                                                        <div class="form-group col-md-6">
                                                            <div class="input-group input-group-prepend">
                                                                <div class="input-group-prepend"><span
                                                                        class="input-group-text"><i
                                                                            class="fa fa-sliders-h icon-lg"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder=" "
                                                                        wire:model.defer="minPoids"/>
                                                                <label>{{ __('Poids Minimal') }}</label>
                                                            </div>
                                                            @error('minPoids')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <div class="input-group input-group-prepend">
                                                                <div class="input-group-prepend"><span
                                                                        class="input-group-text"><i
                                                                            class="fa fa-sliders-h icon-lg"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder=" "
                                                                        wire:model.defer="maxPoids"/>
                                                                <label>{{ __('Poids Maximal') }}</label>
                                                            </div>
                                                            @error('maxPoids')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div x-data="{'showKgPiece': @entangle('showKgPiece')}">
                                                    <div x-show="showKgPiece">
                                                        {{-- <label>{{ __('Kg/Pièce') }}</label> --}}
                                                        <div class="form-group">
                                                            <div class="input-group input-group-prepend">
                                                                <div class="input-group-prepend"><span
                                                                        class="input-group-text"><i
                                                                            class="fa fa-weight-hanging icon-lg"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control" placeholder=" "
                                                                    wire:model.defer="nomTranche"/>
                                                                <label>{{ __('Kg/Pièce') }}</label>
                                                            </div>
                                                            @error('nom')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                                data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold"
                                                form="tranches-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Modal-Unité-->

                        <div wire:ignore.self class="modal secondary fade" id="unites"data-backdrop="static"tabindex="-1" role="dialog" aria-labelledby="unite" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('Nouvelle Unité') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="unite-form" class="form" wire:submit.prevent="createUnites">
                                                <div class="form-group">
                                                    <label><b>{{ __('Nom') }}</b></label>
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                                    class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" Nom " wire:model.defer="nomUnite"/>

                                                    </div>
                                                    @error('nom')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                                    data-dismiss="modal">{{ __('Fermer') }}</button>
                                            <button type="submit" {{-- wire:click="createUnite()" --}} class="btn btn-primary font-weight-bold"
                                                    form="unite-form">{{ __('Enregistrer') }}</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!--Modal-famille-->
                        <div wire:ignore.self class="modal secondary fade" id="famille"data-backdrop="static"tabindex="-1" role="dialog" aria-labelledby="famille" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouvelle Famille') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="famille-form" class="form" wire:submit.prevent="createFamilles">
                                            <div class="form-group">
                                                <label><b>{{ __('Nom') }}</b></label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" Nom " wire:model.defer="nomFamille"/>

                                                </div>
                                                @error('nomFamille')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                                data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold"
                                                form="famille-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Modal-Mode-Vente-->
                        <div wire:ignore.self class="modal secondary fade" id="mode-vente" data-backdrop="static" tabindex="-1" role="dialog"
                        aria-labelledby="mode-vente" aria-hidden="true">
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
                                            <label><b>{{ __('Nom') }}</b></label>
                                            <div class="input-group input-group-prepend">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-money-check-alt icon-lg"></i></span></div>
                                                <input type="text" class="form-control" placeholder="Nom " wire:model.defer="mode_vente_name"/>

                                            </div>
                                            @error('mode_vente_name')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                            data-dismiss="modal">{{ __('Fermer') }}</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold"
                                            form="mode-vente-form">{{ __('Enregistrer') }}</button>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!--Modal-Mode-Préparation Cuisine -->
                        <div wire:ignore.self class="modal secondary fade" id="mode-preparation" data-backdrop="static" tabindex="-1"
                        role="dialog" aria-labelledby="mode-preparation" aria-hidden="true">
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
                                            <label><b>{{ __('Nom') }}</b></label>
                                            <div class="input-group input-group-prepend">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-tools icon-lg"></i></span></div>
                                                <input type="text" class="form-control" placeholder="Nom"
                                                        wire:model.defer="preparation_nom_c"/>

                                            </div>
                                            @error('preparation_nom_c')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group ">
                                            <label class="col-3 col-form-label">Active</label>
                                            <div class="col-3">
                                                <span class="switch switch-outline switch-icon switch-primary">
                                                    <label>
                                                    <input type="checkbox" checked="checked" wire:model.defer="sousmodeprepa_isActive" name="sousmodeprepa_isActive"/>
                                                    <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div> --}}
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                            data-dismiss="modal">{{ __('Fermer') }}</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold"
                                            form="mode-preparation-form">{{ __('Enregistrer') }}</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!--Modal-Mode-Préparation Nettoyage -->
                        <div wire:ignore.self class="modal secondary fade" id="mode-preparation-n" data-backdrop="static" tabindex="-1"
                        role="dialog" aria-labelledby="mode-preparation-n" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('Nouveau Mode Préparation') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="mode-preparation-n-form" class="form" wire:submit.prevent="createModePreparationN">
                                        <div class="form-group">
                                            <label><b>{{ __('Nom') }}</b></label>
                                            <div class="input-group input-group-prepend">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fa fa-tools icon-lg"></i></span></div>
                                                <input type="text" class="form-control" placeholder="Nom"
                                                        wire:model.defer="preparation_nom_n"/>

                                            </div>
                                            @error('preparation_nom_c')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group ">
                                            <label class="col-3 col-form-label">Active</label>
                                            <div class="col-3">
                                                <span class="switch switch-outline switch-icon switch-primary">
                                                    <label>
                                                    <input type="checkbox" checked="checked" wire:model.defer="sousmodeprepa_isActive" name="sousmodeprepa_isActive"/>
                                                    <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div> --}}
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                            data-dismiss="modal">{{ __('Fermer') }}</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold"
                                            form="mode-preparation-n-form">{{ __('Enregistrer') }}</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!--Table-->
                        <div class="mt-5">
                            @livewire('parametrage.liste-produits')
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

<!--Modal-Sous-Catégorie--->
<div wire:ignore.self class="modal secondary fade" id="sous-categorie" data-backdrop="static" tabindex="-1"
     role="dialog" aria-labelledby="sous-categorie" aria-hidden="true">
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
                        {{-- <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="fa fa-sitemap icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" "
                                   wire:model.defer="sous_categorie_name"/>
                            <label>{{ __('Nom') }}</label>
                        </div> --}}
                        @error('sous_categorie_name')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div wire:ignore class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="fa fa-sitemap icon-lg"></i></span></div>
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
                    </div> --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">{{ __('Fermer') }}</button>
                <button type="submit" class="btn btn-primary font-weight-bold"
                        form="sous-categorie-form">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div>






<!--Modal-Préparation-->
{{-- <div wire:ignore.self class="modal secondary fade" id="preparation" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="preparation" aria-hidden="true">
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
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="fa fa-tools icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="preparation_nom"/>
                            <label>{{ __('Nom') }}</label>
                        </div>
                        @error('preparation_nom')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div wire:ignore class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="fa fa-tools icon-lg"></i></span></div>
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
                <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">{{ __('Fermer') }}</button>
                <button type="submit" class="btn btn-primary font-weight-bold"
                        form="preparation-form">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div> --}}

@push('scripts')
    <script src="assets/plugins/custom/uppy/uppy.bundle.js"></script>
    <script src="assets/js/pages/crud/file-upload/uppy.js"></script>
    <script src="assets\plugins\custom\upload\fancy-file-uploader\jquery.js"></script>
    <script src="assets\plugins\custom\upload\fancy-file-uploader\jquery.ui.widget.js"></script>
    <script src="assets\plugins\custom\upload\fancy-file-uploader\jquery.fileupload.js"></script>
    <script src="assets\plugins\custom\upload\fancy-file-uploader\jquery.iframe-transport.js"></script>
    <script src="assets\plugins\custom\upload\fancy-file-uploader\jquery.fancy-fileupload.js"></script>
    <script>
 $('#uploader').FancyFileUpload({
  params : {
    action : 'fileuploader'
  },
  maxfilesize : 1000000,
  'url' :'',


});

$('#uploader-photo').FancyFileUpload({
  params : {
    action : 'fileuploader'
  },
  maxfilesize : 1000000
});
    </script>
    {{-- <script>
        var uppy = Uppy.Core()
        .use(Uppy.Dashboard, {
          inline: true,
          target: '#drag-drop-area'
        })
        .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

      uppy.on('complete', (result) => {
        console.log('Upload complete! We’ve uploaded these files:', result.successful)
      })
    </script> --}}
@endpush
