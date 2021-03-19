@section('title', 'Employés')
@section('header_title', 'Employés')

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
                        <h3 class="card-title">{{ __('Liste Employés') }}</h3>
                    </div>
                    <div class="card-body">
                        <!--Button trigger modal-->
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#staticBackdrop">
                            <i class="flaticon-plus"></i> {{ __('Ajouter un nouveau employe') }}
                        </button>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Nouveau Employé') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="unite-form" class="form row" wire:submit.prevent="createUnite">
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="prenom"/>
                                                    <label>{{ __('Prenom') }}</label>
                                                </div>
                                                @error('prenom') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="nom"/>
                                                    <label>{{ __('Nom') }}</label>
                                                </div>
                                                @error('nom') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>{{ __('Sexe') }}</label>
                                                <div class="radio-inline">
                                                    <label class="radio radio-success">
                                                        <input type="radio" name="sexe" value="h" wire:model.defer="sexe"/>
                                                        <span></span>
                                                        Homme
                                                    </label>
                                                    <label class="radio radio-success">
                                                        <input type="radio" name="sexe" value="f" wire:model.defer="sexe"/>
                                                        <span></span>
                                                        Femme
                                                    </label>
                                                </div>
                                                @error('sexe') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>{{ __('Situation Familiale') }}</label>
                                                <div class="radio-inline">
                                                    <label class="radio radio-success">
                                                        <input type="radio" name="situation_familiale" value="m" wire:model.defer="situation_familiale"/>
                                                        <span></span>
                                                        Marié(e)
                                                    </label>
                                                    <label class="radio radio-success">
                                                        <input type="radio" name="situation_familiale" value="c" wire:model.defer="situation_familiale"/>
                                                        <span></span>
                                                        Célibataire
                                                    </label>
                                                </div>
                                                @error('situation_familiale') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" id="kt_datepicker_1" placeholder=" " wire:model.defer="date_naissance"/>
                                                    <label>{{ __('Date de Naissance') }}</label>
                                                </div>
                                                @error('date_naissance') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" id="kt_datepicker_2" placeholder=" " wire:model.defer="date_embauche"/>
                                                    <label>{{ __('Date Embauche') }}</label>
                                                </div>
                                                @error('date_embauche') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-baby icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="nombre_enfant"/>
                                                    <label>{{ __('Nombre Enfant') }}</label>
                                                </div>
                                                @error('nombre_enfant') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="qualification"/>
                                                    <label>{{ __('Qualification') }}</label>
                                                </div>
                                                @error('qualification') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-injured icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="num_cnss"/>
                                                    <label>{{ __('Numéro CNSS') }}</label>
                                                </div>
                                                @error('num_cnss') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-archive icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="num_cimr"/>
                                                    <label>{{ __('Numéro CIMR') }}</label>
                                                </div>
                                                @error('num_cimr') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hand-holding-usd icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="credit_logement"/>
                                                    <div class="input-group-prepend"><span class="input-group-text">DH</span></div>
                                                    <label>{{ __('Crédit Logement') }}</label>
                                                </div>
                                                @error('credit_logement') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-business-time icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="jours_declare"/>
                                                    <label>{{ __('Jours Déclaré') }}</label>
                                                </div>
                                                @error('jours_declare') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-bill-wave icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="salaire_base"/>
                                                    <label>{{ __('Salaire de Base') }}</label>
                                                </div>
                                                @error('salaire_base') 
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                    <select class="form-control" id="exampleSelectd">
                                                        <option></option>
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="1">5</option>
                                                    </select>
                                                    <label>{{ __('Nom') }}</label>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="form-group">
                                                <div class="input-group">
                                                    <textarea class="form-control" placeholder=" "></textarea>
                                                    <label>{{ __('Test') }}</label>
                                                </div>
                                            </div> --}}
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="unite-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Table-->
                        {{-- @livewire('paramétrage.liste-unite') --}}
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
