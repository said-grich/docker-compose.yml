@section('title', 'Livreurs')
@section('header_title', 'Livreurs')

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
                        <h3 class="card-title">{{ __('Liste Livreurs') }}</h3>
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
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#livreur">
                            <i class="flaticon-plus"></i> {{ __('Ajouter Livreur') }}
                        </button>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="livreur" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="livreur" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau Livreur') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="livreur-form" class="form row" wire:submit.prevent="createLivreur">
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tag icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="nom"/>
                                                    <label>{{ __('Nom') }}</label>
                                                </div>
                                                @error('nom')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-id-card icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="cin"/>
                                                    <label>{{ __('CIN') }}</label>
                                                </div>
                                                @error('cin')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="phone"/>
                                                    <label>{{ __('Téléphone') }}</label>
                                                </div>
                                                @error('phone')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-people-carry icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model.defer="type">
                                                        <option>{{ __('Type') }}</option>
                                                        <option value="interne">Interne</option>
                                                        <option value="externe">Externe</option>
                                                    </select>
                                                </div>
                                                @error('type')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker-alt icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model.defer="ville_id">
                                                        <option>{{ __('Ville') }}</option>
                                                        @foreach ($list_villes as $ville)
                                                            <option value="{{$ville->id}}">{{$ville->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('ville')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 row">
                                                <label class="col-3 col-form-label">Active</label>
                                                <div class="col-3">
                                                    <span class="switch switch-outline switch-icon switch-primary">
                                                        <label>
                                                        <input type="checkbox" checked="checked" wire:model.defer="isActive" name="isActive"/>
                                                        <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="livreur-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Table-->
                        <div class="mt-5">
                            @livewire('parametrage.liste-livreurs')
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
