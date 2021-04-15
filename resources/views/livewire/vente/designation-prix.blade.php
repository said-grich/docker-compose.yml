@section('title', 'Désignation des prix')
@section('header_title', 'Désignation des prix')

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
                        <h3 class="card-title">{{ __('Liste des bons de réception') }}</h3>
                    </div>
                    <div class="card-body">
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
                                        <th class="pl-0" wire:click="sortBy('ref')" style="cursor: pointer;">Bon de réception réf @include('layouts.partials._sort-icon',['field'=>'ref'])</th>
                                        <th class="pl-0" wire:click="sortBy('date')" style="cursor: pointer;">date d'entrée @include('layouts.partials._sort-icon',['field'=>'date'])</th>
                                        <th class="pl-0" wire:click="sortBy('depot_id')" style="cursor: pointer;">Dépot @include('layouts.partials._sort-icon',['field'=>'depot_id'])</th>
                                        <th class="pl-0" wire:click="sortBy('fournisseur_id')" style="cursor: pointer;">Fournisseur @include('layouts.partials._sort-icon',['field'=>'fournisseur_id'])</th>
                                        <th class="pl-0" wire:click="sortBy('valide')" style="cursor: pointer;">Statut @include('layouts.partials._sort-icon',['field'=>'valite'])</th>

                                        <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($items))

                                        @foreach ($items as $item)
                                            <tr class="{{$item->valide == false ? 'bg-danger-o-50' : '' }}">
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
                                                <td class="pl-0">
                                                    <span class="label {{ $item->valide == true ? 'label-primary' : 'label-danger' }} label-pill label-inline mr-2">{{ $item->valide == true ? 'Validé' : 'Non validé' }} </span>
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"></a>
                                                </td>

                                                <td class="pr-0 text-right">
                                                    @if ($item->valide == false)
                                                        <button wire:click="designationPrix('{{$item->ref}}')" class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#designation-prix">
                                                            <i class="flaticon-plus"></i> {{ __('Désignation des prix') }}
                                                        </button>
                                                        @else
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

                                                    @endif


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
                                    @else
                                        <tr>
                                            <td>Aucun enregistrement à afficher</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $items->links('layouts.partials.custom-pagination') }}

                            {{-- Stock Modal --}}

                            {{-- Edit Modal --}}
                            <div wire:ignore.self class="modal fade" id="designation-prix" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="designation-prix" aria-hidden="true">
                                <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('Désignation des prix bon réception réf ') }} - {{$bon_reception_ref}}</h5>
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
                                            <form id="stock-form" class="form row" wire:submit.prevent="affecterPrix">
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
                                                                    @foreach ($liste_poids_pc as $key => $produits )
                                                                        @foreach ($produits as $lot => $produit )
                                                                        @php
                                                                            dd($produits);
                                                                        @endphp
                                                                            <table class="table table-striped table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Produit</th>
                                                                                        <th scope="col">Lot</th>
                                                                                        <th scope="col">Tranche</th>
                                                                                        <th scope="col">CR</th>
                                                                                        <th scope="col">Prix Vente Normal</th>
                                                                                        <th scope="col">Prix Vente Fidèle</th>
                                                                                        <th scope="col">Prix Vente Business</th>
                                                                                        <th scope="col">Promo</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="produit_id.{{$key}}" disabled/>
                                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="code.{{$key}}" disabled/>
                                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="article.{{$key}}" disabled/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num.{{$key}}" disabled/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="hidden" class="form-control" wire:model.defer="tranche_uid.{{$key}}" disabled/>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Tranche') }}" wire:model.defer="nom_tranche.{{$key}}" disabled/>
                                                                                            </td>
                                                                                            {{-- <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Tranche') }}" wire:model.defer="poids.{{$key}}" disabled/>
                                                                                            </td> --}}
                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('CR') }}" wire:model.defer="cr.{{$key}}"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Prix vente normale') }}" wire:model.defer="prix_vente_normal.{{$key}}"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Prix vente fidèle') }}" wire:model.defer="prix_vente_fidele.{{$key}}"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Prix vente business') }}" wire:model.defer="prix_vente_business.{{$key}}"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <a href="#" class="btn btn-icon btn-light-primary btn-outline-primary btn-primary">
                                                                                                    <i class="flaticon-price-tag"></i>
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        @endforeach

                                                                        {{-- <div class="form-group col-md-{{$showNbrPiece == true ?  "3" : "4"}}">
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
                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="article.{{$key}}" disabled/>
                                                                            </div>
                                                                            @error('article')
                                                                                <span class="form-text text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group col-md-{{$showNbrPiece == true ?  "3" : "4"}}"">
                                                                            <label>{{ __('Mode Vente') }}</label>
                                                                            <div class="input-group input-group-prepend">
                                                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="mode_vente.{{$key}}" disabled/>
                                                                            </div>
                                                                            @error('mode_vente')
                                                                                <span class="form-text text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div> --}}
                                                                        {{-- <div class="form-group col-md-{{$showNbrPiece == true ?  "3" : "4"}}"" style="display:{{$showNbrPiece == true ?  "block" : "none"}}">
                                                                            <label>{{ __('Nombre de pièces') }}</label>
                                                                            <div class="input-group input-group-prepend">
                                                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                                                                <input type="text" class="form-control" placeholder=" " wire:model.debounce.1s="nombre_piece.{{$key}}"/>
                                                                            </div>
                                                                            @error('nombre_piece')
                                                                                <span class="form-text text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div> --}}
                                                                        {{-- <table class="table table-striped table-bordered">
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
                                                                                    <th scope="col">CR</th>
                                                                                    <th scope="col">Prix Achat</th>
                                                                                    <th scope="col">Prix Vente Normal</th>
                                                                                    <th scope="col">Prix Vente Fidèle</th>
                                                                                    <th scope="col">Prix Vente Business</th>
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
                                                                        </table> --}}

                                                                    @endforeach

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
                                                                            <table class="table table-striped table-bordered">
                                                                                <thead>
                                                                                    <tr>

                                                                                        <th scope="col">Produit</th>
                                                                                        <th scope="col">Lot</th>
                                                                                        <th scope="col">Tranche</th>
                                                                                        {{-- <th scope="col">Code</th>
                                                                                        <th scope="col">Poids</th --}}
                                                                                        {{-- <th scope="col">Quantité</th> --}}
                                                                                        <th scope="col">CR</th>
                                                                                        {{-- <th scope="col">Dépot</th>
                                                                                        <th scope="col">Prix Achat</th> --}}
                                                                                        <th scope="col">Prix Vente Normal</th>
                                                                                        <th scope="col">Prix Vente Fidèle</th>
                                                                                        <th scope="col">Prix Vente Business</th>
                                                                                        {{-- <th scope="col">Numéro BR</th> --}}
                                                                                        <th scope="col">Promo</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                        @foreach ($liste_kg_pc as $key => $lot )

                                                                                        <tr>

                                                                                            <td>
                                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="produit_id_kg_pc.{{$key}}" disabled/>
                                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="uid_tranche_kg_pc.{{$key}}" disabled/>
                                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="id_kg_pc.{{$key}}" disabled/>
                                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="article_kg_pc.{{$key}}" disabled/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num_kg_pc.{{$key}}" disabled/>
                                                                                            </td>

                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Tranche') }}" wire:model.defer="nom_tranche_kg_pc.{{$key}}" disabled/>
                                                                                            </td>
                                                                                            {{-- <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Tranche') }}" wire:model.defer="poids.{{$key}}" disabled/>
                                                                                            </td> --}}
                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('CR') }}" wire:model.defer="cr_kg_pc.{{$key}}"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Prix vente normale') }}" wire:model.defer="prix_vente_normal_kg_pc.{{$key}}"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Prix vente fidèle') }}" wire:model.defer="prix_vente_fidele_kg_pc.{{$key}}"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Prix vente business') }}" wire:model.defer="prix_vente_business_kg_pc.{{$key}}"/>
                                                                                            </td>
                                                                                            <td>
                                                                                                <a href="#" class="btn btn-icon btn-light-primary btn-outline-primary btn-primary">
                                                                                                    <i class="flaticon-price-tag"></i>
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        @endforeach
                                                                                </tbody>
                                                                            </table>
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
                            </div>
                            {{-- End Stock Modal --}}


                            {{-- Edit shox --}}
                            <div wire:ignore.self class="modal fade" id="show" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="show" aria-hidden="true">
                                <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('Désignation des prix bon réception réf ') }} - {{$bon_reception_ref}}</h5>
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
                                            <form id="show-form" class="form row">
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
                                                                                        <th scope="col">Produit</th>
                                                                                        <th scope="col">Lot</th>
                                                                                        <th scope="col">Tranche</th>
                                                                                        <th scope="col">CR</th>
                                                                                        <th scope="col">Prix Vente Normal</th>
                                                                                        <th scope="col">Prix Vente Fidèle</th>
                                                                                        <th scope="col">Prix Vente Business</th>
                                                                                        <th scope="col">Promo</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($liste_poids_pc as $key => $lot )
                                                                                        <tr>

                                                                                            <td>
                                                                                                {{$article[$key]}}
                                                                                                {{-- <input type="hidden" class="form-control" placeholder=" " wire:model.defer="produit_id.{{$key}}" disabled/>
                                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="code.{{$key}}" disabled/>
                                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="article.{{$key}}" disabled/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{$lot_num[$key]}}
                                                                                                {{-- <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num.{{$key}}" disabled/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                 {{$nom_tranche[$key]}}
                                                                                                {{-- <input type="hidden" class="form-control" wire:model.defer="tranche_uid.{{$key}}" disabled/>
                                                                                                <input type="text" class="form-control" placeholder="{{ __('Tranche') }}" wire:model.defer="nom_tranche.{{$key}}" disabled/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                @isset($cr[$key])
                                                                                                    {{$cr[$key]}}
                                                                                                @endisset
                                                                                                {{-- <input type="text" class="form-control" placeholder="{{ __('CR') }}" wire:model.defer="cr.{{$key}}"/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                @isset($prix_vente_normal[$key])
                                                                                                    {{$prix_vente_normal[$key]}}
                                                                                                @endisset

                                                                                                {{-- <input type="text" class="form-control" placeholder="{{ __('Prix vente normale') }}" wire:model.defer="prix_vente_normal.{{$key}}"/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                @isset($prix_vente_fidele[$key])
                                                                                                    {{$prix_vente_fidele[$key]}}
                                                                                                @endisset
                                                                                                {{-- <input type="text" class="form-control" placeholder="{{ __('Prix vente fidèle') }}" wire:model.defer="prix_vente_fidele.{{$key}}"/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                @isset($prix_vente_business[$key])
                                                                                                    {{$prix_vente_business[$key]}}
                                                                                                @endisset
                                                                                                {{-- <input type="text" class="form-control" placeholder="{{ __('Prix vente business') }}" wire:model.defer="prix_vente_business.{{$key}}"/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                <a href="#" class="btn btn-icon btn-light-primary btn-outline-primary btn-primary">
                                                                                                    <i class="flaticon-price-tag"></i>
                                                                                                </a>
                                                                                                {{-- <input type="text" class="form-control" placeholder="{{ __('Promo') }}"/> --}}
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
                                                                            <table class="table table-striped table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Produit</th>
                                                                                        <th scope="col">Lot</th>
                                                                                        <th scope="col">Tranche</th>
                                                                                        <th scope="col">CR</th>
                                                                                        <th scope="col">Prix Vente Normal</th>
                                                                                        <th scope="col">Prix Vente Fidèle</th>
                                                                                        <th scope="col">Prix Vente Business</th>
                                                                                        <th scope="col">Promo</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($liste_kg_pc as $key => $lot )
                                                                                        <tr>
                                                                                            <td>
                                                                                                {{$article_kg_pc[$key]}}
                                                                                                {{-- <input type="hidden" class="form-control" placeholder=" " wire:model.defer="produit_id_kg_pc.{{$key}}" disabled/>
                                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="uid_tranche_kg_pc.{{$key}}" disabled/>
                                                                                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="id_kg_pc.{{$key}}" disabled/>
                                                                                                <input type="text" class="form-control" placeholder=" " wire:model.defer="article_kg_pc.{{$key}}" disabled/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{$lot_num_kg_pc[$key]}}
                                                                                                {{-- <input type="text" class="form-control" placeholder=" " wire:model.defer="lot_num_kg_pc.{{$key}}" disabled/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{$nom_tranche_kg_pc[$key]}}
                                                                                                {{-- <input type="text" class="form-control" placeholder="{{ __('Tranche') }}" wire:model.defer="nom_tranche_kg_pc.{{$key}}" disabled/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                @isset($cr_kg_pc[$key])
                                                                                                    {{$cr_kg_pc[$key]}}
                                                                                                @endisset
                                                                                                {{-- <input type="text" class="form-control" placeholder="{{ __('CR') }}" wire:model.defer="cr_kg_pc.{{$key}}"/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                @isset($prix_vente_normal_kg_pc[$key])
                                                                                                    {{$prix_vente_normal_kg_pc[$key]}}
                                                                                                @endisset
                                                                                                {{-- <input type="text" class="form-control" placeholder="{{ __('Prix vente normale') }}" wire:model.defer="prix_vente_normal_kg_pc.{{$key}}"/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                @isset($prix_vente_fidele_kg_pc[$key])
                                                                                                    {{$prix_vente_fidele_kg_pc[$key]}}
                                                                                                @endisset
                                                                                                {{-- <input type="text" class="form-control" placeholder="{{ __('Prix vente fidèle') }}" wire:model.defer="prix_vente_fidele_kg_pc.{{$key}}"/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                @isset($prix_vente_business_kg_pc[$key])
                                                                                                    {{$prix_vente_business_kg_pc[$key]}}
                                                                                                @endisset
                                                                                                {{-- <input type="text" class="form-control" placeholder="{{ __('Prix vente business') }}" wire:model.defer="prix_vente_business_kg_pc.{{$key}}"/> --}}
                                                                                            </td>
                                                                                            <td>
                                                                                                <a href="#" class="btn btn-icon btn-light-primary btn-outline-primary btn-primary">
                                                                                                    <i class="flaticon-price-tag"></i>
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
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
                            {{-- End show Modal --}}
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

