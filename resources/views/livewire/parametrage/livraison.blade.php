<div>
@section('title', 'Livraison')
@section('header_title', 'Livraison')

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
                        <h3 class="card-title">{{ __('Livraison') }}</h3>
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
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#livraison">
                            <i class="flaticon-plus"></i> {{ __('Ajouter livraison') }}
                        </button>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="livraison" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="livraison" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouvelle Livraison') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="livraison-form" class="form" wire:submit.prevent="createLivraison">
                                            <div class="form-group row">
                                                <div wire:ignore class="form-group col-md-6">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-people-carry icon-lg"></i></span></div>
                                                        <select class="form-control selectpicker" wire:model="ville">
                                                            <option>{{ __('Choisir une ville') }}</option>
                                                            @foreach ($liste_villes as $item)
                                                                <option value="{{$item->id}}">{{$item->nom}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    @error('ville')
                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                        <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-award icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="frais_livraison"/>
                                                        <label>{{ __('Frais de livraison') }}</label>
                                                    </div>
                                                    @error('frais_livraison')
                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group  col-md-6"">
                                                    <label>Jours de livraison</label>
                                                    <div class="checkbox-inline">

                                                    @foreach($jours as $key => $checkbox)
                                                        <label class="checkbox">
                                                            <input type="checkbox" value="{{ $checkbox  }}" wire:model="jour_livraison.{{ $key  }}"/>
                                                            <span></span>
                                                            {{ $checkbox }}
                                                        </label>
                                                            {{-- <div class="mt-1">
                                                                <label class="inline-flex items-center">
                                                                <input type="checkbox" value="{{ $checkbox  }}" wire:model="jour_livraison.{{ $key  }}" class="form-checkbox h-6 w-6">
                                                                    <span class="ml-3 text-sm">{{ $checkbox }}</span>
                                                                </label>
                                                            </div> --}}
                                                    @endforeach
                                                    </div>
                                                    {{-- <div class="checkbox-inline">
                                                        <label class="checkbox">
                                                            <input type="checkbox" checked="checked" name="Checkboxes3" wire:model="jours" wire:click="jourClicked"/>
                                                            <span></span>
                                                            Lundi
                                                        </label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="Checkboxes3" wire:model="jours" wire:click="jourClicked"/>
                                                            <span></span>
                                                            Mardi
                                                        </label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" checked="checked" name="Checkboxes3" wire:model="jours" wire:click="jourClicked"/>
                                                            <span></span>
                                                            Mercredi
                                                        </label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" checked="checked" name="Checkboxes3" wire:model="jours" wire:click="jourClicked"/>
                                                            <span></span>
                                                            Jeudi
                                                        </label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" checked="checked" name="Checkboxes3" wire:model="jours" wire:click="jourClicked"/>
                                                            <span></span>
                                                            Vendredi
                                                        </label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" checked="checked" name="Checkboxes3" wire:model="jours" wire:click="jourClicked"/>
                                                            <span></span>
                                                            Samedi
                                                        </label>
                                                        <label class="checkbox">
                                                            <input type="checkbox" checked="checked" name="Checkboxes3" wire:model="jours" wire:click="jourClicked"/>
                                                            <span></span>
                                                            Dimanche
                                                        </label>
                                                    </div> --}}
                                                </div>
                                                <div class="form-group col-md-6"">
                                                    <label class="col-form-label text-right col-lg-3 col-sm-12">Heure de livraison</label>
                                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <input class="form-control" id="kt_timepicker_1" readonly placeholder="Select time" type="text"/>
                                                    </div>
                                                </div>



                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="livraison-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Table-->
                        <div class="mt-5">
                            {{-- @livewire('parametrage.liste-qualites') --}}
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

</div>
