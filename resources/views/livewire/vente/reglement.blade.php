<div>
    @section('title', 'Réglements')
    @section('header_title', 'Réglements')
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
                            <h3 class="card-title">{{ __('Réglements') }}</h3>
                        </div>
                        <div class="card-body">

                            <!--begin::Alerts-->
                            @include('layouts.partials.alerts')
                            <!--end::Alerts-->

                            <div class="table-responsive">
                                <div class="d-flex flex-row-reverse">
                                    <div class="input-icon">
                                        <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Recherche...">
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                                        <thead>
                                            <tr class="text-left">
                                                <th class="pl-0" style="width: 30px">
                                                    <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                                        <input type="checkbox" value="1" />
                                                        <span></span>
                                                    </label>
                                                </th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Commande ref @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Date @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Client @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Montant total @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Livreur @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Etat commande @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Etat réglement @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Mode de paiement @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($items as $item)
                                            <tr @if($loop->even)class="bg-grey"@endif>
                                                <td class="pl-0 py-6">
                                                    <label class="checkbox checkbox-lg checkbox-inline">
                                                        <input type="checkbox" value="1" />
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->commande->ref }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->commande->date }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->commande->client->nom }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->commande->total }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->livreur->nom }} | {{ $item->livreur->type }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->commande->etat }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <span class="label {{ $item->valide == true ? 'label-primary' : 'label-danger' }} label-pill label-inline mr-2">{{ $item->valide == true ? 'Validée' : 'Non validée' }} </span>
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"></a>
                                                </td>

                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ isset($item->mode_paiement->nom) ? $item->mode_paiement->nom : 'Non réglée' }}</a>
                                                </td>

                                                <td class="pr-0 text-right">
                                                    <button data-toggle="modal" data-target="#valider" wire:click="valider('{{ $item->commande_id }}','{{ $item->livreur_id }}')" class="btn btn-light-primary font-weight-bold mr-2" {{ $item->valide == true ? 'disabled' : '' }}>{{ $item->valide == false ? 'Valider' : 'Validée' }}</button>
                                                </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $items->links('layouts.partials.custom-pagination') }}

                            </div>

                            <div wire:ignore.self class="modal fade" id="valider" tabindex="-1" role="dialog" aria-labelledby="valider" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('Validation réglement commande N°') }} {{$commande_ref}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div wire:ignore class="modal-body">
                                            <form id="edit-livreur-form" class="form row">

                                                <div  class="form-group col-md-12">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-money-check-alt icon-lg"></i></span></div>
                                                        <select class="form-control" wire:model.defer="mode_paiement_id">
                                                            <option>{{ __('Choisir un mode de paiement') }}</option>
                                                            @foreach ($mode_paiement as $item)
                                                                <option value="{{$item->id}}">{{$item->nom}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('mode_paiement_id')
                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </form>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                                <button type="submit" wire:click="saveReglement()" class="btn btn-primary font-weight-bold" form="edit-livreur-form" >{{ __('Enregistrer') }}</button>
                                            </div>
                                        </div>

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

</div>
