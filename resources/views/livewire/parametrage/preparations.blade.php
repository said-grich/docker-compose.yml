@section('title', 'Préparations')
@section('header_title', 'Préparations')

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
                        <h3 class="card-title">{{ __('Liste Préparations') }}</h3>
                    </div>
                    <div class="card-body">

                        <!--begin::Alerts-->
                        @include('layouts.partials.alerts')
                        <!--end::Alerts-->

                        <!--Button trigger modal-->
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#mode-preparation">
                            <i class="flaticon-plus"></i> {{ __('Ajouter Mode Préparation') }}
                        </button>
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#preparation">
                            <i class="flaticon-plus"></i> {{ __('Ajouter sous mode de préparation') }}
                        </button>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="mode-preparation" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="mode-preparation" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="preparation" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="preparation" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau mode de préparation') }}</h5>
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
                        <!--Table-->
                        <div class="mt-5">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#mode-preparation-tab">
                                        <span class="nav-text">Mode préparation</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#preparation-tab">
                                        <span class="nav-text">Sous mode de préparations</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5">
                                <div class="tab-pane fade active show" id="mode-preparation-tab" role="tabpanel">
                                    @livewire('parametrage.liste-mode-preparation')
                                </div>
                                <div class="tab-pane fade" id="preparation-tab" role="tabpanel">
                                    @livewire('parametrage.liste-preparation')
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
