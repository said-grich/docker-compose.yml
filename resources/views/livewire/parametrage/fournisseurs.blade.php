@section('title', 'Fournisseurs')
@section('header_title', 'Fournisseurs')

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
                        <h3 class="card-title">{{ __('Liste Fournisseurs') }}</h3>
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
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#fournisseur">
                            <i class="flaticon-plus"></i> {{ __('Ajouter Fournisseur') }}
                        </button>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="fournisseur" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="fournisseur" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau Fournisseur') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="fournisseur-form" class="form" wire:submit.prevent="createFournisseur">
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="nom"/>
                                                    <label>{{ __('Nom') }}</label>
                                                </div>
                                                @error('nom')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone icon-lg"></i></span></div>
                                                    <input type="tel" class="form-control" placeholder=" " wire:model.defer="phone"/>
                                                    <label>{{ __('Téléphone') }}</label>
                                                </div>
                                                @error('phone')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div id="repeater">
                                                    <label>{{ __('Contact') }}</label>
                                                    <div class="form-group">
                                                        <div data-repeater-list="">
                                                            <div data-repeater-item class="form-group row">
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="las la-user-tie"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" class="form-control" wire:model="contact_nom.0" placeholder="Nom"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="las la-user-tie"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" class="form-control" wire:model="contact_fonction.0" placeholder="Fonction"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="la la-phone"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" class="form-control" wire:model="contact_phone.0" placeholder="Téléphone"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="la la-envelope"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" class="form-control" wire:model="contact_email.0" placeholder="Email"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                                                        <i class="la la-remove"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach($inputs as $key => $value)
                                                            <div data-repeater-list="">
                                                                <div data-repeater-item class="form-group row">
                                                                    <div class="col">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="las la-user-tie"></i>
                                                                                </span>
                                                                            </div>
                                                                            <input type="text" class="form-control" wire:model="contact_nom.{{$value}}" placeholder="Nom"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="las la-user-tie"></i>
                                                                                </span>
                                                                            </div>
                                                                            <input type="text" class="form-control" wire:model="contact_fonction.{{$value}}" placeholder="Fonction"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-phone"></i>
                                                                                </span>
                                                                            </div>
                                                                            <input type="text" class="form-control" wire:model="contact_phone.{{$value}}" placeholder="Téléphone"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-envelope"></i>
                                                                                </span>
                                                                            </div>
                                                                            <input type="text" class="form-control" wire:model="contact_email.{{$value}}" placeholder="Email"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <a wire:click="remove({{$value}})" href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                                                            <i class="la la-remove"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <button data-repeater-create="" class="btn font-weight-bold btn-primary" wire:click.prevent="add()">
                                                                <i class="la la-plus"></i> Ajouter un contact
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="fournisseur-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Table-->
                        <div class="mt-5">
                            @livewire('parametrage.liste-fournisseurs')
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
@push('scripts')
    <script>
        // Class definition
        var KTFormRepeater = function(){

            // Private functions
            var demo = function() {
                $('#repeater').repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function() {
                        $(this).slideDown();
                    },
                });
            }

            return {
                // public functions
                init: function() {
                    demo();
                }
            };
        }();

        jQuery(document).ready(function() {
        KTFormRepeater.init();
        });
    </script>
@endpush
