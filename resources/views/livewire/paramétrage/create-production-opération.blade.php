@section('title', 'Création Opération')
@section('header_title', 'Création Opérations')
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Liste Opérations') }}</h3>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#staticBackdrop">
                            <i class="flaticon-plus"></i> {{ __('Ajouter un nouveau opération') }}
                        </button>
                        <div wire:ignore.self class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Nouvelle Opération') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="unite-form" class="form" wire:submit.prevent="createProductionOperation">
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-recycle icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="operation"/>
                                                    <label>{{ __('Opération') }}</label>
                                                </div>
                                                @error('operation')
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
                        </div>
                        @livewire('paramétrage.list-production-operation')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
