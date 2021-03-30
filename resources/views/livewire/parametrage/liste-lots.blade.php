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
                <th class="pl-0" wire:click="sortBy('lot_num')" style="cursor: pointer;">Bon de réception réf @include('layouts.partials._sort-icon',['field'=>'lot_num'])</th>
                <th class="pl-0" wire:click="sortBy('lot_num')" style="cursor: pointer;">date d'entrée @include('layouts.partials._sort-icon',['field'=>'lot_num'])</th>
                <th class="pl-0" wire:click="sortBy('date_capture')" style="cursor: pointer;">Dépot @include('layouts.partials._sort-icon',['field'=>'date_capture'])</th>
                <th class="pl-0" wire:click="sortBy('date_entree')" style="cursor: pointer;">Fournisseur @include('layouts.partials._sort-icon',['field'=>'date_entree'])</th>

                <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($items))

            @foreach ($items as $item)
            {{-- @php
                dd($item);
            @endphp --}}
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
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->fournisseur->nom }}</a>
                        </td>


                        <td class="pr-0 text-right">

                            {{-- <button wire:click="getStock({{$item->ref}})" class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#stock">
                                <i class="flaticon-plus"></i> {{ __('Ajouter Stock') }}
                            </button> --}}
                            <button wire:click="getLots({{$item->ref}})" class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#stock">
                                <i class="flaticon-plus"></i> {{ __('Désignation des prix') }}
                            </button>

                            <a href="#" wire:click="edit({{$item->id}})" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#exampleModalSizeSm">
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
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" wire:click="deleteLivreur('{{$item->id}}')">
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
                {{-- @foreach ($items as $item)
                    <tr>
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
                        </td>
                        <td class="pl-0">
                            <span class="label {{ $item->active == true ? 'label-primary' : 'label-danger' }} label-pill label-inline mr-2">{{ $item->active == true ? 'Activé' : 'Désactivé' }} </span>
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"></a>
                        </td>

                        <td class="pr-0 text-right">

                            <button wire:click="getStock({{$item->id}})" class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#stock">
                                <i class="flaticon-plus"></i> {{ __('Ajouter Stock') }}
                            </button>

                            <a href="#" wire:click="edit({{$item->id}})" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#exampleModalSizeSm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" wire:click="deleteLivreur('{{$item->id}}')">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                            </a>
                        </td>
                    </tr>
                @endforeach --}}
            @else
                <tr>
                    <td>Aucun enregistrement à afficher</td>
                </tr>
            @endif

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
        {{-- Stock Modal --}}


        {{-- Edit Modal --}}
        <div wire:ignore.self class="modal fade" id="stock" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="stock" aria-hidden="true">
            <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Désignation des prix') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="stock-form" class="form row" wire:submit.prevent="createStock">
                            <div class="form-group col-md-12">
                                <label>{{ __('Bon réception réf') }}</label>
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder="" value="" wire:model.defer="bon_reception_ref" disabled/>
                                </div>
                            </div>
                            @foreach ($liste_lots as $key => $lot )
                            {{-- @php
                                dd($lot);
                            @endphp --}}
                            <div class="form-group col-md-{{$showNbrPiece == true ?  "3" : "4"}}">
                                <label>{{ __('Lot') }}</label>
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder="" value="{{$lot->lot_num}}" wire:model.defer="lot_num.{{$key}}" disabled/>
                                </div>
                                @error('lot_id')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-{{$showNbrPiece == true ?  "3" : "4"}}"">
                                <label>{{ __('Produit') }}</label>
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-box-open icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="article" disabled/>
                                </div>
                                @error('article')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-{{$showNbrPiece == true ?  "3" : "4"}}"">
                                <label>{{ __('Mode Vente') }}</label>
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="mode_vente" disabled/>
                                </div>
                                @error('mode_vente')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-{{$showNbrPiece == true ?  "3" : "4"}}"" style="display:{{$showNbrPiece == true ?  "block" : "none"}}">
                                <label>{{ __('Nombre de pièces') }}</label>
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder=" " wire:model.debounce.1s="nombre_piece.{{$key}}"/>
                                </div>
                                @error('nombre_piece')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Produit</th>
                                        @if ($mode_vente_id != 1)
                                            <th scope="col">Tranches</th>
                                        @endif
                                        @if ($mode_vente_id == 1)
                                            <th scope="col">Code</th>
                                            <th scope="col">Poids</th>
                                        @endif
                                        <th scope="col">Quantité</th>
                                        <th scope="col">CR</th>
                                        <th scope="col">Dépot</th>
                                        <th scope="col">Prix Achat</th>
                                        <th scope="col">Prix Vente Normal</th>
                                        <th scope="col">Prix Vente Fidèle</th>
                                        <th scope="col">Prix Vente Business</th>
                                        <th scope="col">Numéro BR</th>
                                        <th scope="col">Promo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < $countInputs; $i++)
                                        <tr>
                                            <td>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-balance-scale-left"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="article" disabled/>
                                                </div>
                                            </td>
                                            @if ($mode_vente_id != 1)<td>{{$nom_tranche[$i]}}</td>@endif

                                            @if ($mode_vente_id == 1)
                                                <td>
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-balance-scale-left"></i></span></div>
                                                        <input type="text" class="form-control" placeholder="{{ __('Code') }}" wire:model.defer="code.{{$i}}"/>
                                                    </div>
                                                    @error('code')
                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-balance-scale-left"></i></span></div>
                                                        <input type="text" class="form-control" placeholder="{{ __('Poids') }}" wire:model.defer="poids.{{$i}}"/>
                                                    </div>
                                                    @error('poids')
                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            @endif
                                            <td>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-balance-scale-left"></i></span></div>
                                                    <input type="text" class="form-control" placeholder="{{ __('Quantité') }}" wire:model.defer="qte.{{$i}}"/>
                                                </div>
                                                @error('qte')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice-dollar"></i></span></div>
                                                    <input type="text" class="form-control" placeholder="{{ __('CR') }}" wire:model.defer="cr.{{$i}}"/>
                                                </div>
                                                @error('cr')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-warehouse"></i></span></div>
                                                    <select class="form-control" wire:model.defer="depot.{{$i}}">
                                                        <option>{{ __('Dépot') }}</option>
                                                        @foreach ($list_depots as $item)
                                                            <option value="{{$item->id}}">{{$item->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('depot')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-check-alt"></i></span></div>
                                                    <input type="text" class="form-control" placeholder="{{ __('Prix Achat') }}" wire:model.defer="prix_achat.{{$i}}"/>
                                                </div>
                                                @error('prix_achat')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-bill-wave"></i></span></div>
                                                    <input type="text" class="form-control" placeholder="{{ __('Prix Vente Normal') }}" wire:model.defer="prix_vente_normal.{{$i}}"/>
                                                </div>
                                                @error('prix_vente_normal')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-bill-wave"></i></span></div>
                                                    <input type="text" class="form-control" placeholder="{{ __('Prix Vente Fidèle') }}" wire:model.defer="prix_vente_fidele.{{$i}}"/>
                                                </div>
                                                @error('prix_vente_fidele')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-bill-wave"></i></span></div>
                                                    <input type="text" class="form-control" placeholder="{{ __('Prix Vente Business') }}" wire:model.defer="prix_vente_business.{{$i}}"/>
                                                </div>
                                                @error('prix_vente_business')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-clipboard-list"></i></span></div>
                                                    <input type="text" class="form-control" placeholder="{{ __('BR') }}" wire:model.defer="bon_reception.{{$i}}"/>
                                                </div>
                                                @error('bon_reception')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>

                            @endforeach

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                        <button type="submit" class="btn btn-primary font-weight-bold" form="stock-form">{{ __('Enregistrer') }}</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Stock Modal --}}

    </div>
