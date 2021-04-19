@section('title', 'Entrée stock')
@section('header_title', 'Entrée stock')

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
                        <h3 class="card-title">{{ __('Entrée stock') }}</h3>
                    </div>
                    <div class="card-body">

                        <!--begin::Alerts-->
                        @include('layouts.partials.alerts')
                        <!--end::Alerts-->

                        <!--Button trigger modal-->
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#lot">
                            <i class="flaticon-plus"></i> {{ __('Entrée stock') }}
                        </button>

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
                                    <th class="pl-0" wire:click="sortBy('ref')" style="cursor: pointer;">Entrée numéro @include('layouts.partials._sort-icon',['field'=>'ref'])</th>
                                    <th class="pl-0" wire:click="sortBy('date')" style="cursor: pointer;">date @include('layouts.partials._sort-icon',['field'=>'date'])</th>
                                    <th class="pl-0" wire:click="sortBy('depot_id')" style="cursor: pointer;">Dépot @include('layouts.partials._sort-icon',['field'=>'depot_id'])</th>
                                    <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--<p>selected Item: {{$selectedItem}}</p>
                                <p>Action : {{ $action }}</p>--}}
                                @if (!empty($items))

                                    @foreach ($items as $item)
                                        <tr>
                                            <td class="pl-0 py-6">
                                                <label class="checkbox checkbox-lg checkbox-inline">
                                                    <input type="checkbox" value="1" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->ref }}</a>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->date }}</a>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->depot->nom }}</a>
                                            </td>

                                            <td class="pr-0 text-right">
                                                <a href="#" wire:click="show('{{$item->ref}}')" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#show">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        {{--begin::Svg Icon--}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                                                            </g>
                                                        </svg>
                                                        {{--end::Svg Icon--}}
                                                    </span>
                                                </a>

                                                <a href="#" wire:click="edit('{{$item->ref}}')" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#edit">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        {{--begin::Svg Icon--}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                            </g>
                                                        </svg>
                                                        {{--end::Svg Icon--}}
                                                    </span>
                                                </a>
                                                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" wire:click.prevent="confirmationRemove('{{$item->id}}')" data-toggle="modal" data-target="#confirmationRemove">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        {{--begin::Svg Icon--}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                                            </g>
                                                        </svg>
                                                        {{--end::Svg Icon--}}
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>Aucun enregistrement à afficher</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $items->links('layouts.partials.custom-pagination') }}
                         <!--Delete Modal-->
                        <div wire:ignore.self class="modal secondary fade" id="confirmationRemove" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="confirmationRemove" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Suppression d\'entrée stock réf') }} - {{$bon_reception_ref}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="delete-form" class="form row"  >
                                            <h3>Etes-vous sûr de vouloir supprimer ce {{$bon_reception_ref}}?</h3>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" wire:click.prevent = "delete()" class="btn btn-primary font-weight-bold" form="delete-form">{{ __('Supprimer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div wire:ignore.self class="modal fade" id="lot" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="lot" aria-hidden="true">
                            <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Entrée de stock') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        @if (session()->has('error-lot'))
                                            <div class="alert alert-custom alert-light-danger shadow fade show mb-5" role="alert">
                                                <div class="alert-icon"><i class="fa fa-times-circle"></i></div>
                                                <div class="alert-text">{{ session('error-lot') }}</div>
                                                <div class="alert-close">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <form id="lot-form" class="form row" wire:submit.prevent="createStock" {{-- wire:submit.prevent="createLots" --}}>
                                            <div class="form-group col">
                                                <label>{{ __('Réf. bon de réception') }}</label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                                    <input type="text" class="form-control bg-gray-300" placeholder=" " wire:model.defer="ref_br" disabled/>
                                               </div>
                                                @error('ref_br')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col">
                                                <label>{{ __('Fournisseur') }}</label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model.defer="fournisseur">
                                                        <option>{{ __('Choisir un fournisseur') }}</option>
                                                        @foreach ($list_fournisseurs as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                @error('fournisseur')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col">
                                                <label>{{ __("Date d'entrée") }}</label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-plus icon-lg"></i></span></div>
                                                    <input id="date_entree" type="text" class="form-control datepicker" placeholder=" " wire:model.defer="date_entree" autocomplete="off"/>
                                                </div>
                                                @error('date_entree')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col">
                                                <label>{{ __("Dépôt") }}</label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model.defer="depot">
                                                        <option>{{ __('Choisir un dépôt') }}</option>
                                                        @foreach ($list_depots as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                @error('depot')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>{{ __("Qualité globale") }}</label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model.defer="qualite_globale">
                                                        <option>{{ __('Choisir une qualité globale') }}</option>
                                                        @foreach ($list_qualites as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                @error('depot')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <table class="table table-vertical-center" id="kt_advance_table_widget_4" >
                                                <thead >
                                                    <tr class="text-left">
                                                        <th class="pl-0" >Article</th>
                                                        <th class="pl-0" >Catégorie</th>
                                                        <th class="pl-0" >Sous catégorie</th>
                                                        <th class="pl-0" >Quantité</th>
                                                        <th class="pl-0" >Unité</th>
                                                        <th class="pl-0" >Prix Achat</th>
                                                        <th class="pl-0" >Lot</th>
                                                        <th class="pl-0" >CR</th>
                                                        @if (isset($mode_vente_produit[0]) && $mode_vente_produit[0] == 2)
                                                            <th class="pl-0" >Qualité produit</th>
                                                        @endif
                                                        <th class="pl-0" >Pas</th>
                                                        <th class="pl-0" >Tranches</th>
                                                    </tr>
                                                </thead>
                                                <tbody >
                                                        <tr >
                                                            <td class="pl-0" style="width: 120px;">
                                                                <select class="form-control" wire:model="produit.0">
                                                                    <option>{{ __('Choisir un produit') }}</option>
                                                                    @foreach ($list_produits as $item)
                                                                        <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td class="pl-0" style="width: 120px;">
                                                                <select class="form-control" wire:model.defer="categorie.0">
                                                                    <option>{{ __('Choisir une catégorie') }}</option>
                                                                    @foreach ($list_categories as $item)
                                                                        <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td class="pl-0" style="width: 120px;">
                                                                <select class="form-control" wire:model.defer="sous_categorie.0">
                                                                    <option>{{ __('Choisir une sous catégorie') }}</option>
                                                                    @foreach ($list_sous_categories as $item)
                                                                        <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td class="pl-0" style="width: 90px;">
                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="qte.0"/>
                                                            </td></div>
                                                            <td class="pl-0" >
                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="unite.0" disabled/>
                                                            </td>

                                                            <td class="pl-0" >
                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="prix_achat.0"/>
                                                            </td>

                                                            <td class="pl-0" >
                                                                <input type="text" class="form-control" placeholder=" " wire:model="lot_num.0"/>
                                                            </td>
                                                            <td class="pl-0" >
                                                                <input type="text" class="form-control" placeholder=" " wire:model="cr.0"/>
                                                            </td>
                                                            @if (isset($mode_vente_produit[0]) && $mode_vente_produit[0] == 2)
                                                            <td class="pl-0" style="width: 150px;">
                                                                <select class="form-control" wire:model.defer="qualite.0">
                                                                    <option>{{ __('Choisir une qualite') }}</option>
                                                                    @foreach ($list_qualites as $item)
                                                                        <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            @endif
                                                            <td class="pl-0" style="width: 90px;" >
                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="pas.0"/>
                                                            </td>

                                                            <td class="pl-0" style="width: 120px;">
                                                                <select class="form-control" wire:model="tranches.0" {{isset($mode_vente_produit[0]) && $mode_vente_produit[0] == 1 ? 'multiple' :  '' }} >
                                                                    <option>{{ __('Choisir une tranche') }}</option>
                                                                    @if (!empty($list_tranches[0]))
                                                                        @foreach ($list_tranches[0] as $key => $item)
                                                                            <option value="{{$item[0]['uid']}}">{{$item[0]['nom']}}</option>
                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                            </td>
                                                            @if (isset($mode_vente_produit[0]) && $mode_vente_produit[0] == 1)
                                                                <td class="pl-0" >
                                                                    <div class="input-group input-group-prepend">

                                                                            <input type="text" class="form-control" placeholder="Nombre de pièce"  wire:model.defer="nbr_pc.0"  wire:change="setCodePoids(0)/>
                                                                        <div class="input-group-append" data-toggle="modal" data-target="#code-poids">

                                                                            <button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Code / poids" wire:click="setCodePoids(0)"><i class="far fa-eye"></i></button></div>
                                                                        </div>
                                                                        @error('nbr_pc')
                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    </div>
                                                                </td>
                                                            @endif

                                                            <td>
                                                                <button data-repeater-create="" class="btn font-weight-bold btn-primary" wire:click.prevent="add()">
                                                                    <i class="la la-plus"></i>
                                                                </button>
                                                            </td>

                                                        </tr>
                                                        @foreach($inputs as $key => $value)
                                                        <tr>
                                                            <td class="pl-0">
                                                                <select class="form-control" wire:model="produit.{{$value}}">
                                                                    <option>{{ __('Choisir un produit') }}</option>
                                                                    @foreach ($list_produits as $item)
                                                                        <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <<td class="pl-0">
                                                                <select class="form-control" wire:model.defer="categorie.{{$value}}">
                                                                    <option>{{ __('Choisir une catégorie') }}</option>
                                                                    @foreach ($list_categories as $item)
                                                                        <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td class="pl-0">
                                                                <select class="form-control" wire:model.defer="sous_categorie.{{$value}}">
                                                                    <option>{{ __('Choisir une sous catégorie') }}</option>
                                                                    @foreach ($list_sous_categories as $item)
                                                                        <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td class="pl-0" style="width: 90px;">
                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="qte.{{$value}}"/>
                                                            </td>
                                                            <td class="pl-0">
                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="unite.{{$value}}" disabled/>
                                                            </td>
                                                            <td class="pl-0">
                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="prix_achat.{{$value}}"/>
                                                            </td>
                                                            <td class="pl-0">
                                                                <input type="text" class="form-control" placeholder=" " wire:model="lot_num.{{$value}}"/>
                                                            </td>
                                                            <td class="pl-0">
                                                                <input type="text" class="form-control" placeholder=" " wire:model="cr.{{$value}}"/>
                                                            </td>
                                                            @if (isset($mode_vente_produit[$value]) && $mode_vente_produit[$value] == 2)
                                                            <td class="pl-0">
                                                                <select class="form-control" wire:model.defer="qualite.{{$value}}">
                                                                    <option>{{ __('Choisir une qualite') }}</option>
                                                                    @foreach ($list_qualites as $item)
                                                                        <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            @endif
                                                            <td class="pl-0" style="width: 90px;">
                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="pas.{{$value}}"/>
                                                            </td>
                                                            <td class="pl-0">
                                                                  <select class="form-control" wire:model="tranches.{{$value}}" multiple>
                                                                    <option>{{ __('Choisir une tranche') }}</option>

                                                                    @if (!empty($list_tranches[$value]))
                                                                         @foreach ($list_tranches[$value] as $key => $item)
                                                                            <option value="{{$item[0]['uid']}}">{{$item[0]['nom']}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </td>
                                                            @if (isset($mode_vente_produit[$value]) && $mode_vente_produit[$value] == 1)
                                                                <td class="pl-0">
                                                                    <div class="input-group input-group-prepend">
                                                                        <input type="text" class="form-control" placeholder="Nombre de pièce" wire:model="nbr_pc.{{$value}}"/>

                                                                        <div class="input-group-append" data-toggle="modal" data-target="#code-poids">
                                                                            <button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="code/poids" wire:click="setCodePoids({{$value}})"><i class="fa fa-plus-circle"></i></button></div>
                                                                        @error('nbr_pc')
                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    </div>
                                                                </td>
                                                            @endif
                                                            <td class="pl-0">
                                                                <select class="form-control" wire:model="tranches.{{$value}}" {{isset($mode_vente_produit[$value]) && $mode_vente_produit[$value] == 1 ? 'multiple' :  '' }} >
                                                                    <option>{{ __('Choisir une tranche') }}</option>
                                                                    @if (!empty($list_tranches[$value]))
                                                                        @foreach ($list_tranches[$value] as $key => $item)
                                                                            <option value="{{$item[0]['uid']}}">{{$item[0]['nom']}}</option>
                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                            </td>
                                                            @if (isset($mode_vente_produit[$value]) && $mode_vente_produit[$value] == 1)
                                                            <td class="pl-0">
                                                                <div class="input-group input-group-prepend">
                                                                    <div class="input-group-append" data-toggle="modal" data-target="#code-poids">
                                                                        <input type="text" class="form-control" placeholder="Nombre de pièce" wire:model="nbr_pc.{{$value}}"  wire:keydown="setCodePoids({{$value}})"/>


                                                                        {{--<button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Code / poids" wire:click="setCodePoids({{$value}})"><i class="fa fa-plus-circle"></i></button></div>--}}
                                                                    @error('nbr_pc')
                                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </td>
                                                            @endif

                                                            <td class="pl-0">
                                                                <div class="col-md-1">
                                                                    <div class="form-group">
                                                                        <button type="button" class="btn btn-outline-danger"  wire:click.prevent="remove({{$key}})">X</button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        @endforeach
                                                </tbody>
                                            </table>



                                            {{--<div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-award icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model="qualite">
                                                        <option>{{ __('Choisir une qualite') }}</option>
                                                        @foreach ($list_qualites as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#qualite"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Qualite"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('qualite')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-box-open icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model="produit">
                                                        <option>{{ __('Choisir un produit') }}</option>
                                                        @foreach ($list_produits as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#produit"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Produit"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('produit')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                             <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model="tranches" multiple>
                                                        <option>{{ __('Choisir une tranche') }}</option>
                                                        @foreach ($list_tranches as $key => $item)
                                                            <option value="{{$item[0]['uid']}}">{{$item[0]['nom']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('tranches')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="pas"/>
                                                    <label>{{ __('Pas') }}</label>
                                                </div>
                                                @error('pas')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 row">
                                                <label class="col-8 col-form-label">{{ __('Activé / Désactivé le lot') }}</label>
                                                <div class="col-4">
                                                    <span class="switch switch-outline switch-icon switch-primary">
                                                        <label>
                                                        <input type="checkbox" checked="checked" wire:model.defer="active" name="active"/>
                                                        <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div> --}}
                                            <!--Modal-->
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="lot-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Modal old version lot-->
                        {{-- <div wire:ignore.self class="modal fade" id="lot" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="lot" aria-hidden="true">
                            <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau Lot') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="lot-form" class="form row" wire:submit.prevent="createLot">
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                                    <input type="text" class="form-control bg-gray-300" placeholder=" " wire:model="lot_num" disabled/>
                                                    <label>{{ __('Numéro') }}</label>
                                                </div>
                                                @error('lot_num')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-alt icon-lg"></i></span></div>
                                                    <input id="date_capture" type="text" class="form-control datepicker" placeholder=" " wire:model.defer="date_capture" autocomplete="off"/>
                                                    <label>{{ __('Date capture') }}</label>
                                                </div>
                                                @error('date_capture')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-plus icon-lg"></i></span></div>
                                                    <input id="date_entree" type="text" class="form-control datepicker" placeholder=" " wire:model.defer="date_entree" autocomplete="off"/>
                                                    <label>{{ __("Date d'entrée") }}</label>
                                                </div>
                                                @error('date_entree')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-times icon-lg"></i></span></div>
                                                    <input id="date_preemption" type="text" class="form-control datepicker" placeholder=" " wire:model.defer="date_preemption" autocomplete="off"/>
                                                    <label>{{ __('Date Préemption') }}</label>
                                                </div>
                                                @error('date_preemption')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model="fournisseur">
                                                        <option>{{ __('Choisir un fournisseur') }}</option>
                                                        @foreach ($list_fournisseurs as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach

                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#fournisseur"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Fournisseur"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('fournisseur')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-award icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model="qualite">
                                                        <option>{{ __('Choisir une qualite') }}</option>
                                                        @foreach ($list_qualites as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#qualite"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Qualite"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('qualite')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div wire:ignore class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-box-open icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model="produit">
                                                        <option>{{ __('Choisir un produit') }}</option>
                                                        @foreach ($list_produits as $item)
                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" data-toggle="modal" data-target="#produit"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Produit"><i class="fa fa-plus-circle"></i></button></div>
                                                </div>
                                                @error('produit')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model="tranches" multiple>
                                                        <option>{{ __('Choisir une tranche') }}</option>
                                                        @foreach ($list_tranches as $key => $item)
                                                            <option value="{{$item[0]['uid']}}">{{$item[0]['nom']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('tranches')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="pas"/>
                                                    <label>{{ __('Pas') }}</label>
                                                    <div class="input-group-append"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Produit">test</button></div>
                                                </div>
                                                @error('pas')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 row">
                                                <label class="col-8 col-form-label">{{ __('Activé / Désactivé le lot') }}</label>
                                                <div class="col-4">
                                                    <span class="switch switch-outline switch-icon switch-primary">
                                                        <label>
                                                        <input type="checkbox" checked="checked" wire:model.defer="active" name="active"/>
                                                        <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="lot-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                        <!--Modal-->
                        {{-- <div wire:ignore.self class="modal fade" id="stock" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="stock" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau Stock') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="stock-form" class="form row" wire:submit.prevent="createStock">
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model="lot_id">
                                                        <option>{{ __('Lot') }}</option>
                                                        @foreach ($list_lots as $item)
                                                            <option value="{{$item->lot_num}}">{{$item->lot_num}} | {{$item->produit->nom}} | {{$item->produit->modeVente->nom}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                @error('lot_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                    <select class="form-control selectpicker" wire:model="tranches" multiple>
                                                        <option>{{ __('Tranches') }}</option>
                                                        @foreach ($list_tranches as $key => $item)
                                                            <option value="{{$item[0]['uid']}}">{{$item[0]['nom']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('tranches')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-warehouse icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model.defer="depot">
                                                        <option>{{ __('Dépot') }}</option>
                                                        @foreach ($list_depots as $item)
                                                            <option value="{{$item->id}}">{{$item->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('depot')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice-dollar icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="prix_achat"/>
                                                    <label>{{ __('Prix Achat') }}</label>
                                                </div>
                                                @error('prix_achat')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-balance-scale-left icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="qte"/>
                                                    <label>{{ __('Quantité') }}</label>
                                                </div>
                                                @error('qte')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-warehouse icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="cr"/>
                                                    <label>{{ __('CR') }}</label>
                                                </div>
                                                @error('cr')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice-dollar icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="prix_vente_normal"/>
                                                    <label>{{ __('Prix Vente Normal') }}</label>
                                                </div>
                                                @error('prix_vente_normal')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice-dollar icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="prix_vente_fidele"/>
                                                    <label>{{ __('Prix Vente Fidèle') }}</label>
                                                </div>
                                                @error('prix_vente_fidele')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice-dollar icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="prix_vente_business"/>
                                                    <label>{{ __('Prix Vente Business') }}</label>
                                                </div>
                                                @error('prix_vente_business')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 row">
                                                <label class="col-8 col-form-label">{{ __('Activé') }}</label>
                                                <div class="col-4">
                                                    <span class="switch switch-outline switch-icon switch-primary">
                                                        <label>
                                                        <input type="checkbox" checked="checked" wire:model.defer="active_stock" name="active_stock"/>
                                                        <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="stock-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!--Table-->
                        {{--<div class="mt-5">
                             <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#encours-tab">
                                        <span class="nav-text">BR en cours</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#archive-tab">
                                        <span class="nav-text">BR archivés</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#stock-poids-pc-tab">
                                        <span class="nav-text">Stock poids par piéce</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#stock-kg-pc-tab">
                                        <span class="nav-text">Stock Kg/Piéce</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5">
                                <div class="tab-pane fade active show" id="encours-tab" role="tabpanel">
                                    @livewire('parametrage.liste-lots')
                                </div>
                                <div class="tab-pane fade" id="archive-tab" role="tabpanel">
                                    @livewire('parametrage.liste-lots-archive')
                                </div>
                                <div class="tab-pane fade" id="stock-poids-pc-tab" role="tabpanel">
                                    @livewire('parametrage.liste-stock-poids-pc')
                                </div>
                                <div class="tab-pane fade" id="stock-kg-pc-tab" role="tabpanel">
                                    @livewire('parametrage.liste-stock-kg-pc')
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>



    <div wire:ignore.self class="modal secondary fade" id="code-poids" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="code-poids" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Désignation Code / poids') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session()->has('erreur'))
                        <div class="alert alert-custom alert-light-danger shadow fade show mb-5" role="alert">
                            <div class="alert-icon"><i class="flaticon-interface-10"></i></div>
                            <div class="alert-text">
                                @foreach (session('erreur') as $erreur)
                                {{ $erreur }}<br>
                                @endforeach
                            </div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                        @php session()->forget('erreur'); @endphp
                    @endif
                    <form id="poids-form" class="form" wire:submit.prevent="saveCodePoids">
                        {{--  <input type="text" class="form-control" placeholder=" " wire:model="details_index"/> --}}

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Poids</th>
                                    <th scope="col">Qualité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $count_rows; $i++)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="code.{{$i}}"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="poids.{{$i}}"/>
                                    </td>
                                    <td>
                                        <select class="form-control" wire:model.defer="qualite_piece.{{$i}}">
                                            <option>{{ __('Choisir une qualite') }}</option>
                                            @foreach ($list_qualites as $item)
                                                <option value="{{$item->id }}">{{$item->nom }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" class="form-control" placeholder=" " wire:model.defer="qualite_piece.{{$i}}"/> --}}
                                    </td>
                                </tr>
                                @endfor

                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                    <button type="submit" id="btnSave" class="btn btn-primary font-weight-bold" form="poids-form">{{ __('Enregistrer') }}</button>
                </div>
            </div>
        </div>
    </div>
        {{-- Show Modal --}}
        <div wire:ignore.self class="modal fade" id="show" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="show" aria-hidden="true">
            <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Entrée stock réf ') }} - {{$bon_reception_ref}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
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
                        <form id="show-form" class="form row" wire:submit.prevent="show">
                            <div class="form-group col-md-12">
                                <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                   @if (count($liste_poids_pc)>0)
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">
                                                Poids par pièce
                                            </div>
                                        </div>
                                        <div id="collapseOne1" class="collapse show" data-parent="#accordionExample1">
                                            <div class="card-body">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="pl-0">Lot</th>
                                                            <th class="pl-0">Article</th>
                                                            <th class="pl-0">Catégorie</th>
                                                            <th class="pl-0">Sous catégorie</th>
                                                            <th class="pl-0">Code</th>
                                                            <th class="pl-0">Poids</th>
                                                            <th class="pl-0">Tranches</th>
                                                            <th class="pl-0">Quantité</th>
                                                            <th class="pl-0">Unité</th>
                                                            <th class="pl-0">Prix Achat</th>
                                                            <th class="pl-0">Qualité</th>
                                                            <th class="pl-0">Pas</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($liste_poids_pc as $key => $lot )
                                                            <tr>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control" placeholder=" " wire:model.defer="produit_id.{{$key}}" disabled/>
                                                                    <input type="hidden" class="form-control" placeholder=" " wire:model.defer="code.{{$key}}" disabled/>
                                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="article.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="categorie.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="sous_categorie.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="code.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="poids.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="nom_tranche.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="qte.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="unite.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="prix_achat.{{$key}}" disabled/>
                                                                </td>

                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="qualite.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="pas.{{$key}}" disabled/>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if (count($liste_kg_pc)>0)

                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo1">
                                                    Kg / pièce
                                                </div>
                                            </div>
                                            <div id="collapseTwo1" class="collapse" data-parent="#accordionExample1">
                                                <div class="card-body">
                                                    <div class="card-body">
                                                        @foreach ($liste_kg_pc as $key => $lot )
                                                            <table class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="pl-0">Lot</th>
                                                                        <th class="pl-0">Article</th>
                                                                        <th class="pl-0">Catégorie</th>
                                                                        <th class="pl-0">Sous catégorie</th>
                                                                        <th class="pl-0">Tranches</th>
                                                                        <th class="pl-0">Quantité</th>
                                                                        <th class="pl-0">Unité</th>
                                                                        <th class="pl-0">Prix Achat</th>
                                                                        <th class="pl-0">Qualité</th>
                                                                        <th class="pl-0">Pas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="produit_id_kg_pc.{{$key}}" disabled/>
                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="uid_tranche_kg_pc.{{$key}}" disabled/>
                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="id_kg_pc.{{$key}}" disabled/>
                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="article_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="{{ __('CR') }}" wire:model.defer="categorie_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="{{ __('CR') }}" wire:model.defer="sous_categorie_kg_pc.{{$key}}" disabled/>
                                                                            </td>

                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="{{ __('Tranche') }}" wire:model.defer="nom_tranche_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="qte_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="unite_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="prix_achat_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="qualite_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="pas_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                        </tr>
                                                                </tbody>
                                                            </table>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Show Modal --}}

        {{-- Edit Modal --}}
        <div wire:ignore.self class="modal fade" id="edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Modification d\'entrée stock réf') }} - {{$bon_reception_ref}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
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
                        <form id="edit-form" class="form row" wire:submit.prevent="editStock()">
                            <div class="form-group col-md-12">
                                <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                    @if (count($liste_poids_pc)>0)
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">
                                                    Poids par pièce
                                                </div>
                                            </div>
                                            <div id="collapseOne1" class="collapse" data-parent="#accordionExample1">
                                                <div class="card-body">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>

                                                                <th class="pl-0">Article</th>

                                                                <th class="pl-0">Catégorie</th>
                                                                <th class="pl-0">Sous catégorie</th>
                                                                <th class="pl-0">Lot</th>
                                                                <th class="pl-0">Code</th>
                                                                <th class="pl-0">Poids</th>
                                                                <th class="pl-0">Tranches</th>
                                                                <th class="pl-0">Quantité</th>
                                                                <th class="pl-0">Unité</th>
                                                                <th class="pl-0">Prix Achat</th>
                                                                <th class="pl-0">Qualité</th>
                                                                <th class="pl-0">Pas</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($liste_poids_pc as $key => $lot )
                                                                @if (session()->has('update'))
                                                                    <div class="alert alert-custom alert-light-danger shadow fade show mb-5" role="alert">
                                                                        <div class="alert-icon"><i class="flaticon-interface-10"></i></div>
                                                                        <div class="alert-text">
                                                                            @foreach (session('update') as $erreur)
                                                                            {{ $erreur }}<br>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="alert-close">
                                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    @php session()->forget('update'); @endphp
                                                                @endif
                                                                <tr >

                                                                    <td>
                                                                        <input type="hidden" class="form-control" placeholder=" " wire:model.defer="produit_id.{{$key}}" />
                                                                        <input type="hidden" class="form-control" placeholder=" " wire:model.defer="code.{{$key}}" />
                                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="article.{{$key}}" disabled/>
                                                                        {{--<select class="form-control" wire:model.defer="article.{{$key}}">
                                                                            <option>{{ __('Choisir un produit') }}</option>
                                                                            @foreach ($list_produits as $item)
                                                                                <option value="{{$item->id }}" @if($produit_id == $item->id){{'selected'}}@endif>{{$item->nom }}</option>
                                                                            @endforeach
                                                                        </select>--}}
                                                                    </td>

                                                                    <td>
                                                                        <input type="text" class="form-control" placeholder="" wire:model.defer="categorie.{{$key}}" disabled/>
                                                                        {{--<select class="form-control" wire:model.defer="categorie.{{$key}}">
                                                                            <option>{{ __('Choisir une catégorie') }}</option>
                                                                            @foreach ($list_categories as $item)
                                                                                <option value="{{$item->id }}" @if($categorie == $item->id){{'selected'}}@endif>{{$item->nom }}</option>
                                                                            @endforeach
                                                                        </select>--}}
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" placeholder="" wire:model.defer="sous_categorie.{{$key}}" disabled/>
                                                                        {{--<select class="form-control" wire:model.defer="sous_categorie.{{$key}}">
                                                                            <option>{{ __('Choisir une sous catégorie') }}</option>
                                                                            @foreach ($list_sous_categories as $item)
                                                                                <option value="{{$item->id }}" @if($sous_categorie == $item->id){{'selected'}}@endif>{{$item->nom }}</option>
                                                                            @endforeach
                                                                        </select>--}}
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num.{{$key}}" />
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" placeholder="" wire:model.defer="code.{{$key}}" />
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" placeholder="" wire:model.defer="poids.{{$key}}" />
                                                                    </td>
                                                                    <td>
                                                                        {{--<input type="text" class="form-control" placeholder="" wire:model.defer="nom_tranche.{{$key}}" />--}}
                                                                        {{--<select class="form-control select2" id="kt_select2_1" name="param" wire:model.defer="uid_tranche.{{$key}}">--}}
                                                                        <select class="form-control" wire:model.defer="uid_tranche.{{$key}}">
                                                                            <option>{{ __('Choisir une tranche') }}</option>
                                                                            @foreach ($list_piece as $item)
                                                                                <option value="{{$item->uid }}" @if($uid_tranche == $item->uid){{'selected'}}@endif>{{$item->nom }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" placeholder="" wire:model.defer="qte.{{$key}}" />
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" placeholder="" wire:model.defer="unite.{{$key}}" disabled/>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" placeholder="" wire:model.defer="prix_achat.{{$key}}" />
                                                                    </td>

                                                                    <td>
                                                                        {{--<input type="text" class="form-control" placeholder="" wire:model.defer="qualite.{{$key}}" />--}}
                                                                        <select class="form-control" wire:model="qualite.{{$key}}">
                                                                            <option>{{ __('Choisir une qualite') }}</option>
                                                                            @foreach ($list_qualites as $item)
                                                                                <option value="{{$item->id }}" @if($qualite == $item->id){{'selected'}}@endif> {{$item->nom }} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" placeholder="" wire:model.defer="pas.{{$key}}" />
                                                                    </td>
                                                                    <td>
                                                                        <button type="submit" class="btn btn-outline-danger"  wire:click="supp('{{$lot->id}}')">X</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (count($liste_kg_pc)>0)

                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo1">
                                                    Kg / pièce
                                                </div>
                                            </div>
                                            <div id="collapseTwo1" class="collapse" data-parent="#accordionExample1">
                                                <div class="card-body">
                                                    <div class="card-body">
                                                        @foreach ($liste_kg_pc as $key => $lot )
                                                            <table class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>

                                                                        <th class="pl-0">Article</th>

                                                                        <th class="pl-0">Catégorie</th>
                                                                        <th class="pl-0">Sous catégorie</th>
                                                                        <th class="pl-0">Lot</th>
                                                                        <th class="pl-0">Tranches</th>
                                                                        <th class="pl-0">Quantité</th>
                                                                        <th class="pl-0">Unité</th>
                                                                        <th class="pl-0">Prix Achat</th>
                                                                        <th class="pl-0">Qualité</th>
                                                                        <th class="pl-0">Pas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                        <tr>

                                                                            <td>
                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="produit_id_kg_pc.{{$key}}" />
                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="uid_tranche_kg_pc.{{$key}}" />
                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="id_kg_pc.{{$key}}" />
                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="article_kg_pc.{{$key}}" disabled/>
                                                                                {{--<select class="form-control" wire:model.defer="article_kg_pc.{{$key}}">
                                                                                    <option>{{ __('Choisir un produit') }}</option>
                                                                                    @foreach ($list_produits as $item)
                                                                                        <option value="{{$item->id }}" @if($produit_id_kg_pc == $item->id){{'selected'}}@endif>{{$item->nom }}</option>
                                                                                    @endforeach
                                                                                </select>--}}
                                                                            </td>

                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="{{ __('CR') }}" wire:model.defer="categorie_kg_pc.{{$key}}" disabled/>
                                                                                {{--<select class="form-control" wire:model.defer="categorie_kg_pc.{{$key}}">
                                                                                    <option>{{ __('Choisir une catégorie') }}</option>
                                                                                    @foreach ($list_categories as $item)
                                                                                        <option value="{{$item->id }}" @if($categorie_kg_pc == $item->id){{'selected'}}@endif>{{$item->nom }}</option>
                                                                                    @endforeach
                                                                                </select>--}}
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="{{ __('CR') }}" wire:model.defer="sous_categorie_kg_pc.{{$key}}" disabled/>
                                                                                {{--<select class="form-control" wire:model.defer="sous_categorie_kg_pc.{{$key}}">
                                                                                    <option>{{ __('Choisir une sous catégorie') }}</option>
                                                                                    @foreach ($list_sous_categories as $item)
                                                                                        <option value="{{$item->id }}" @if($sous_categorie_kg_pc == $item->id){{'selected'}}@endif>{{$item->nom }}</option>
                                                                                    @endforeach
                                                                                </select>--}}
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num_kg_pc.{{$key}}" />
                                                                            </td>
                                                                            <td>
                                                                                {{--<input type="text" class="form-control" placeholder="{{ __('Tranche') }}" wire:model.defer="nom_tranche_kg_pc.{{$key}}" />--}}
                                                                                <select class="form-control" wire:model.defer="uid_tranche_kg_pc.{{$key}}" >
                                                                                    <option>{{ __('Choisir une tranche') }}</option>
                                                                                    @foreach ($list as $item)
                                                                                        <option value="{{$item->uid }}" @if($uid_tranche_kg_pc == $item->uid){{'selected'}}@endif>{{$item->nom }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="qte_kg_pc.{{$key}}" />
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="unite_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="prix_achat_kg_pc.{{$key}}" />
                                                                            </td>
                                                                            <td>
                                                                                {{--<input type="text" class="form-control" placeholder="" wire:model.defer="qualite_kg_pc.{{$key}}" />--}}
                                                                                <select class="form-control" wire:model="qualite_kg_pc.{{$key}}">
                                                                                    <option>{{ __('Choisir une qualite') }}</option>
                                                                                    @foreach ($list_qualites as $item)
                                                                                        <option value="{{$item->id }}" @if($qualite_kg_pc == $item->id){{'selected'}}@endif> {{$item->nom }} </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="pas_kg_pc.{{$key}}" />
                                                                            </td>
                                                                            <td>
                                                                                <button type="submit" class="btn btn-outline-danger"  wire:click="supp('{{$lot->id}}')">X</button>
                                                                            </td>
                                                                        </tr>
                                                                </tbody>
                                                            </table>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                        <button type="submit" class="btn btn-primary font-weight-bold" form="edit-form">{{ __('Enregistrer') }}</button>
                    </div>
                </div>
            </div>
        </div>
        {{--<div wire:ignore.self class="modal fade" id="edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __("Modification d'entrée stock réf ") }} - {{$bon_reception_ref}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
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
                        <form id="edit-form" class="form row" wire:submit.prevent="editStock">
                            <div class="form-group col-md-12">
                                <div class="accordion accordion-toggle-arrow" id="accordionExample1">
                                   @if (count($liste_poids_pc)>0)
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title" data-toggle="collapse" data-target="#collapseOne1">
                                                Poids par pièce
                                            </div>
                                        </div>
                                        <div id="collapseOne1" class="collapse" data-parent="#accordionExample1">
                                            <div class="card-body">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="pl-0">Lot</th>
                                                            <th class="pl-0">Article</th>
                                                            <th class="pl-0">Catégorie</th>
                                                            <th class="pl-0">Sous catégorie</th>
                                                            <th class="pl-0">Code</th>
                                                            <th class="pl-0">Poids</th>
                                                            <th class="pl-0">Tranches</th>
                                                            <th class="pl-0">Quantité</th>
                                                            <th class="pl-0">Unité</th>
                                                            <th class="pl-0">Prix Achat</th>
                                                            <th class="pl-0">Qualité</th>
                                                            <th class="pl-0">Pas</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($liste_poids_pc as $key => $lot )
                                                            <tr>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num.{{$key}}" />
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control" placeholder=" " wire:model.defer="produit_id.{{$key}}" />
                                                                    <input type="hidden" class="form-control" placeholder=" " wire:model.defer="code.{{$key}}" />
                                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="article.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="categorie.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="sous_categorie.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="code.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="poids.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="nom_tranche.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="qte.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="unite.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="prix_achat.{{$key}}" disabled/>
                                                                </td>

                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="qualite.{{$key}}" disabled/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" placeholder="" wire:model.defer="pas.{{$key}}" disabled/>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if (count($liste_kg_pc)>0)

                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo1">
                                                    Kg / pièce
                                                </div>
                                            </div>
                                            <div id="collapseTwo1" class="collapse" data-parent="#accordionExample1">
                                                <div class="card-body">
                                                    <div class="card-body">
                                                        @foreach ($liste_kg_pc as $key => $lot )
                                                            <table class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="pl-0">Lot</th>
                                                                        <th class="pl-0">Article</th>
                                                                        <th class="pl-0">Catégorie</th>
                                                                        <th class="pl-0">Sous catégorie</th>
                                                                        <th class="pl-0">Tranches</th>
                                                                        <th class="pl-0">Quantité</th>
                                                                        <th class="pl-0">Unité</th>
                                                                        <th class="pl-0">Prix Achat</th>
                                                                        <th class="pl-0">Qualité</th>
                                                                        <th class="pl-0">Pas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="produit_id_kg_pc.{{$key}}" disabled/>
                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="uid_tranche_kg_pc.{{$key}}" disabled/>
                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="id_kg_pc.{{$key}}" disabled/>
                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="article_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="{{ __('Catégorie') }}" wire:model.defer="categorie_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="{{ __('Sous catégorie') }}" wire:model.defer="sous_categorie_kg_pc.{{$key}}" disabled/>
                                                                            </td>

                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="{{ __('Tranche') }}" wire:model.defer="nom_tranche_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="qte_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="unite_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="prix_achat_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="qualite_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control" placeholder="" wire:model.defer="pas_kg_pc.{{$key}}" disabled/>
                                                                            </td>
                                                                        </tr>
                                                                </tbody>
                                                            </table>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                        <button type="submit" class="btn btn-primary font-weight-bold" form="stock-form">{{ __('Enregistrer') }}</button>
                    </div>
                </div>
            </div>
        </div>--}}
        {{-- End Stock Modal --}}

        </div>

    </div>
<!--end::Container-->
</div>

<style>
    table#kt_advance_table_widget_4 {
    width: 100%;
}

</style>

@push('scripts')
<script>
    window.addEventListener('contentChanged', event => {
        $('.selectpicker').selectpicker();
    });
</script>

<script>
    $('.datepicker').on('change', function (e) {
        @this.set(e.target.id, e.target.value);
    });
</script>

{{--<script>
    $('#btnSave').click(function() {
    $('#code-poids').modal('hide');
    });
</script>--}}
<script>
    Livewire.on('delete',stock=>{
        $('#confirmationRemove').modal('hide')
    });
</script>

{{--@push('scripts')
<script>
    Livewire.on('SavePoids',stock=>{
        $('#code-poids').modal('hide')
    });
</script>
@endpush--}}

<script>
    Livewire.on('update',stock=>{
        $('#edit').modal('hide')
    });
</script>
@endpush
