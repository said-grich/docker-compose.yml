@section('title', 'Etat stock')
@section('header_title', 'Etat stock')

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
                        <h3 class="card-title">{{ __('Etat stock') }}</h3>
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



                        <!--Table-->
                        <div class="mt-5">
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
                                            <th class="pl-0" wire:click="sortBy('produit_id')" style="cursor: pointer;">Produit @include('layouts.partials._sort-icon',['field'=>'produit_id'])</th>
                                            <th class="pl-0" wire:click="sortBy('lot_num')" style="cursor: pointer;">Numéro de lot @include('layouts.partials._sort-icon',['field'=>'lot_num'])</th>
                                            <th class="pl-0" wire:click="sortBy('tranche_id')" style="cursor: pointer;">Tranche @include('layouts.partials._sort-icon',['field'=>'tranche_id'])</th>
                                            <th class="pl-0" wire:click="sortBy('created_at')" style="cursor: pointer;">Date d'entrée @include('layouts.partials._sort-icon',['field'=>'created_at'])</th>
                                            <th class="pl-0" wire:click="sortBy('code')" style="cursor: pointer;">Code @include('layouts.partials._sort-icon',['field'=>'code'])</th>
                                            <th class="pl-0" wire:click="sortBy('poids')" style="cursor: pointer;">Poids @include('layouts.partials._sort-icon',['field'=>'poids'])</th>
                                            <th class="pl-0" wire:click="sortBy('qte')" style="cursor: pointer;">Quantité initiale @include('layouts.partials._sort-icon',['field'=>'qte'])</th>
                                            <th class="pl-0" wire:click="sortBy('qte_vendue')" style="cursor: pointer;">Quantité vendue @include('layouts.partials._sort-icon',['field'=>'qte_vendue'])</th>
                                            <th class="pl-0" wire:click="sortBy('qte_restante')" style="cursor: pointer;">Quantité restante @include('layouts.partials._sort-icon',['field'=>'qte_restante'])</th>
                                            <th class="pl-0" wire:click="sortBy('prix_achat')" style="cursor: pointer;">Prix d'achat @include('layouts.partials._sort-icon',['field'=>'prix_achat'])</th>
                                            <th class="pl-0" wire:click="sortBy('cr')" style="cursor: pointer;">CR @include('layouts.partials._sort-icon',['field'=>'cr'])</th>
                                            <th class="pl-0" wire:click="sortBy('prix_n')" style="cursor: pointer;">Prix client normal @include('layouts.partials._sort-icon',['field'=>'prix_n'])</th>
                                            <th class="pl-0" wire:click="sortBy('prix_f')" style="cursor: pointer;">Prix client fidèle @include('layouts.partials._sort-icon',['field'=>'prix_f'])</th>
                                            <th class="pl-0" wire:click="sortBy('prix_p')" style="cursor: pointer;">Prix client business @include('layouts.partials._sort-icon',['field'=>'prix_p'])</th>
                                            <th class="pl-0" wire:click="sortBy('depot_id')" style="cursor: pointer;">Dépôt @include('layouts.partials._sort-icon',['field'=>'depot_id'])</th>
                                            <th class="pl-0" wire:click="sortBy('br_num')" style="cursor: pointer;">Numéro BR @include('layouts.partials._sort-icon',['field'=>'br_num'])</th>
                                            {{-- <th class="pr-0 text-right" style="min-width: 160px">Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                                <td class="pl-0 py-6">
                                                    <label class="checkbox checkbox-lg checkbox-inline">
                                                        <input type="checkbox" value="1" />
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->lot_num }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->lot->produit->nom }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->tranche->nom }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->created_at->format('d-m-Y') }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">
                                                        @if(isset($item->code))
                                                            {{ $item->code }}
                                                        @else
                                                            -
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">
                                                        @if(isset($item->poids))
                                                            {{ $item->poids }}
                                                        @else
                                                            -
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->qte }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->qte_vendue }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->qte_restante }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->prix_achat }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->cr }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->prix_n }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->prix_f }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->prix_p}}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->depot->nom}}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->br_num}}</a>
                                                </td>
                                                {{-- <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->produit->nom }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->date_capture }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->date_entree }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->date_preemption }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->qualite->nom }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->pas }}</a>
                                                </td> --}}

                                                
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $items->links('layouts.partials.custom-pagination') }}

                                    {{-- Edit Modal --}}
                                    {{-- <div wire:ignore.self class="modal fade" id="exampleModalSizeSm" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Modification livreur') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="edit-livreur-form" class="form row">
                                                        <div class="form-group col-md-6">
                                                            <div class="input-group input-group-prepend">
                                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tag icon-lg"></i></span></div>
                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="livreur_id"/>
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
                                                                <select class="form-control" wire:model.defer="type">
                                                                    <option>{{ __('Choisir un type') }}</option>
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
                                                                <select class="form-control " wire:model.defer="ville_id">
                                                                    <option>{{ __('Choisir une ville') }}</option>
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
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                                        <button type="submit" wire:click="editLivreur" class="btn btn-primary font-weight-bold" form="edit-livreur-form" >{{ __('Enregistrer') }}</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- Edit Modal --}}



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
