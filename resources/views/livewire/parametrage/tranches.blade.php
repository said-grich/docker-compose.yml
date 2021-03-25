@section('title', 'Tranches')
@section('header_title', 'Tranches')

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
                        <h3 class="card-title">{{ __('Liste Tranches') }}</h3>
                    </div>
                    <div class="card-body">
                        <!--begin::Flash message-->
                        @if (session()->has('message'))
                            <div class="alert alert-custom alert-light-success shadow fade show mb-5" role="alert">
                                <div class="alert-icon"><i class="flaticon-interface-10"></i></div>
                                <div class="alert-text">{{ session('message') }}</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <!--end::Flash message-->


                        <!--Button trigger modal-->
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#mode_vente">
                            <i class="flaticon-plus"></i> {{ __('Ajouter mode de vente') }}
                        </button>
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#tranches">
                            <i class="flaticon-plus"></i> {{ __('Ajouter tranche') }}
                        </button>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="mode_vente" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="mode_vente" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sitemap icon-lg"></i></span></div>
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
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="tranches" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tranches" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                                                <div class="mt-4">
                                                    <div class="mt-2">
                                                        @foreach ($list_modes_vente as $mode)
                                                            <label class="inline-flex items-center">
                                                                <input type="radio" class="form-radio" name="type" wire:model.defer="type" value="{{$mode->id}}" @click="open = {{$mode->id}}">
                                                                <span class="ml-2">{{$mode->nom}}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div x-show="open === 1">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-boxes icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model.defer="minPoids"/>
                                                            <label>{{ __('Poids minimal') }}</label>
                                                        </div>
                                                        @error('minPoids')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
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
                                                </div>
                                                <div x-show="open === 2">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-boxes icon-lg"></i></span></div>
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
                        <!--Table-->
                        <div class="mt-5">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#mode-vente-tab">
                                        <span class="nav-text">Modes de vente</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tranches-tab">
                                        <span class="nav-text">Tranches</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5">
                                <div class="tab-pane fade active show" id="mode-vente-tab" role="tabpanel">
                                    @livewire('parametrage.liste-mode-vente')
                                </div>
                                <div class="tab-pane fade" id="tranches-tab" role="tabpanel">
                                     @livewire('parametrage.liste-tranches')
                                </div>
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
