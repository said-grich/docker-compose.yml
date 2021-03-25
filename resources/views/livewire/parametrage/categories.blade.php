@section('title', 'Catégories')
@section('header_title', 'Catégories')

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
                        <h3 class="card-title">{{ __('Liste Catégories') }}</h3>
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
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#categorie">
                            <i class="flaticon-plus"></i> {{ __('Ajouter catégorie') }}
                        </button>
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#sous-categorie">
                            <i class="flaticon-plus"></i> {{ __('Ajouter sous catégorie') }}
                        </button>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="categorie" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="categorie" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouvelle Catégorie') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="categorie-form" class="form" wire:submit.prevent="createCategorie">
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sitemap icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="categorie_name"/>
                                                    <label>{{ __('Nom') }}</label>
                                                </div>
                                                @error('categorie_name')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="categorie-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="sous-categorie" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="sous-categorie" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                        <!--Table-->
                        <div class="mt-5">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#categorie-tab">
                                        <span class="nav-text">Catégories</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#sous-categorie-tab">
                                        <span class="nav-text">Sous Catégories</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5">
                                <div class="tab-pane fade active show" id="categorie-tab" role="tabpanel">
                                    @livewire('parametrage.liste-categorie')
                                </div>
                                <div class="tab-pane fade" id="sous-categorie-tab" role="tabpanel">
                                    @livewire('parametrage.liste-sous-categorie')
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
