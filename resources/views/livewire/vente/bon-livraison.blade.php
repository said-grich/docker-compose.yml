@section('title', 'Bon de livraison')
@section('header_title', 'Bon de livraison')

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
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#ajout-bl">
                            <i class="flaticon-plus"></i> {{ __('Ajouter bon livraison') }}
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
                                    <tr class="pl-0" class="text-left">
                                        <th style="width: 30px">
                                            <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                                <input type="checkbox" value="1" />
                                                <span></span>
                                            </label>
                                        </th>
                                        <th class="pl-0" wire:click="sortBy('ref')" style="cursor: pointer;">Bon livraison num. @include('layouts.partials._sort-icon',['field'=>'ref'])</th>
                                        <th class="pl-0" wire:click="sortBy('date')" style="cursor: pointer;">date @include('layouts.partials._sort-icon',['field'=>'date'])</th>
                                        <th class="pl-0" wire:click="sortBy('client_id')" style="cursor: pointer;">Client @include('layouts.partials._sort-icon',['field'=>'client_id'])</th>
                                        <th class="pl-0" wire:click="sortBy('depot_id')" style="cursor: pointer;">Dépot @include('layouts.partials._sort-icon',['field'=>'depot_id'])</th>
                                        <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->client->nom }}</a>
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


                            <div wire:ignore.self class="modal fade" id="ajout-bl" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ajout-bl" aria-hidden="true">
                                <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('Bon de livraison') }} - {{$ref_bl}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="lot-form"  wire:submit.prevent="save">

                                                @if (session()->has('error-commande'))
                                                    <div class="alert alert-custom alert-light-danger shadow fade show mb-5" role="alert">
                                                        <div class="alert-icon"><i class="fa fa-times-circle"></i></div>
                                                        <div class="alert-text">{{ session('error-commande') }}</div>
                                                        <div class="alert-close">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="form row">
                                                    <div class="form-group col">
                                                        <label>{{ __("Date") }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text bg-gray-400"><i class="fa fa-calendar-plus icon-lg"></i></span></div>
                                                            <input id="date" type="text" class="form-control datepicker bg-gray-400" placeholder=" " wire:model.defer="date" autocomplete="off" disabled/>
                                                        </div>
                                                        @error('date')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col">
                                                        <label>{{ __('Client') }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                            <select class="form-control" wire:model="client">
                                                                <option value="">{{ __('Choisir un client') }}</option>
                                                                @foreach ($list_clients as $item)
                                                                    <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        @error('client')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col">
                                                        <label>{{ __("Région de livraison") }}</label>
                                                        <select class="form-control" wire:model="region_livraison">
                                                            <option value="">{{ __('Choisir la région de livraison') }}</option>
                                                            @foreach ($list_region as $item)
                                                                <option value="{{$item->id }}">{{$item->nom }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('region_livraison')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col">
                                                        <label>{{ __('Catégorie') }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                            <select class="form-control" wire:model="filter.categorie">
                                                                <option value="">{{ __('Choisir une catégorie') }}</option>
                                                                @foreach ($list_categorie as $item)
                                                                    <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        @error('categorie')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col">
                                                        <label>{{ __("Dépôt") }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                            <select class="form-control" wire:model="filter.depot">
                                                                <option value="">{{ __('Choisir un dépôt') }}</option>
                                                                @foreach ($list_depots as $item)
                                                                    <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        @error('depot')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col">
                                                        <label>{{ __('Rechercher un produit') }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model="filter.recherche_produit"/>
                                                    </div>
                                                        @error('recherche_produit')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                @if (count($list_produits) > 0)
                                                    <div>
                                                        <div class="card card-custom card-stretch gutter-b bl bg-primary-o-40">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Stock</h3>
                                                            </div>

                                                            <div class="card-body">
                                                                <table class="table table-striped">
                                                                    {{-- <thead class="bg-primary-o-40">
                                                                        <tr class="text-left">
                                                                            <th>Article</th>
                                                                            <th colspan="10">Tranches</th>
                                                                        </tr>
                                                                    </thead> --}}
                                                                    <tbody>
                                                                    @foreach ($list_produits as $i => $item)

                                                                        <thead class="bg-white">
                                                                            <th colspan="12">
                                                                                <span class="text-dark-75 font-weight-bolder font-size-lg pr-6">{{$nom_produit[$i]}}</span>
                                                                                <span class="text-muted font-weight-bold">
                                                                                    @foreach ($item as $tranche_uid => $produits)
                                                                                        <a class="btn btn-outline-primary" data-toggle="collapse" href="#{{$tranche_uid}}" role="button" aria-expanded="false" aria-controls="{{$tranche_uid}}">
                                                                                            <span class="label label-primary label-inline mr-2">{{$nom_tranche[$i][$tranche_uid]}}</span>
                                                                                            <span class="label label-primary mr-2">{{$nbr_piece[$i][$tranche_uid]}}</span>
                                                                                        </a>
                                                                                    @endforeach
                                                                                </span>
                                                                            </th>

                                                                        </thead>

                                                                        <thead style="padding-top: 20px">
                                                                            <th>Catégorie</th>
                                                                            {{-- <th>Sous catégorie</th> --}}
                                                                            <th>Code</th>
                                                                            <th>
                                                                                <span>Poids</span>
                                                                                <input type="number" class="form-control col-md-4" wire:model.debounce.1000ms="filter.poids">
                                                                            </th>
                                                                            <th>Unité</th>
                                                                            {{-- <th>Prix Achat</th> --}}
                                                                            @if($profile === "Normal")
                                                                                <th>Prix de vente normal</th>
                                                                            @endif
                                                                            @if($profile === 'Fidèle')
                                                                                <th>Prix de vente fidèle</th>
                                                                            @endif
                                                                            @if($profile === 'Business')
                                                                                <th>Prix de vente business</th>
                                                                            @endif
                                                                            <th>Lot</th>
                                                                            <th>Quantité</th>
                                                                            <th>Pas</th>
                                                                            <th>Dépôt</th>
                                                                            <th></th>
                                                                        </thead>
                                                                        @foreach ($item as $tranche_uid => $produits)
                                                                            @foreach ( $produits as $key => $produit)
                                                                                <tr class="collapse" id="{{$tranche_uid}}">
                                                                                    <td>{{$produit['categorie']['nom']}}</td>
                                                                                    {{-- <td>{{$produit['sous_categorie']['nom']}}</td> --}}
                                                                                    <td>
                                                                                        @if (isset($produit['code']))
                                                                                            {{$produit['code']}}
                                                                                        @else
                                                                                            -
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>
                                                                                        @if (isset($produit['poids']))
                                                                                            {{$produit['poids']}}
                                                                                        @else
                                                                                            -
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>
                                                                                        @isset($produit['unite']['nom'])
                                                                                            {{$produit['unite']['nom']}}
                                                                                        @endisset
                                                                                    </td>
                                                                                    {{-- <td>
                                                                                        @isset($produit['prix_achat'])
                                                                                            {{$produit['prix_achat']}}
                                                                                        @endisset
                                                                                    </td> --}}
                                                                                    <td>
                                                                                        @isset($prix[$key])
                                                                                            {{$prix[$key]}}
                                                                                        @endisset
                                                                                    </td>
                                                                                    <td>{{$produit['lot_num']}}</td>
                                                                                    <td>{{$produit['qte_restante']}}</td>
                                                                                    <td>{{$produit['pas']}}</td>
                                                                                    <td>
                                                                                        @isset($produit['depot']['nom'])
                                                                                            {{$produit['depot']['nom']}}
                                                                                        @endisset
                                                                                    </td>
                                                                                    <td>
                                                                                        <div x-data="{ 'isDialogOpen': false, qte: null,tranche:'{{$tranche_uid}}', prix:{{$prix[$key]}}, qmax:{{$produit['qte_restante']}},categorie:{{$produit['categorie']['id']}},pieceId:{{$produit['id']}} }" @keydown.escape="isDialogOpen = false">
                                                                                            @if (!isset($produit['code']))
                                                                                                <button type="button" x-on:click="isDialogOpen = true" class="btn btn-outline-primary">Ajouter</button>

                                                                                                <div class=" overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="isDialogOpen" :class="{ 'fixed inset-0 z-10 flex items-start justify-center': isDialogOpen }">
                                                                                                    <div class="bg-white shadow-2xl m-auto" x-show="isDialogOpen">
                                                                                                        <div class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                                                                                            <h6 class="text-xl font-bold">Entrer La quantité:
                                                                                                            </h6>
                                                                                                            <button type="button" x-on:click="isDialogOpen = false">✖</button>
                                                                                                        </div>
                                                                                                        <div>
                                                                                                            <div class="grid grid-cols-2 gap-4 p-4 mb-8">
                                                                                                                <label class="block">
                                                                                                                    <span class="text-gray-700">QTE</span><span
                                                                                                                        class="text-red-500">*</span>
                                                                                                                    <input type="number" x-model="qte"
                                                                                                                        class="block w-full mt-1 form-input"
                                                                                                                        placeholder="">
                                                                                                                    <span class="text-red-500"
                                                                                                                        x-show="qte>qmax">La quantité
                                                                                                                        doit être inférieure à
                                                                                                                        {{$produit['qte_restante']}}</span>
                                                                                                                </label>
                                                                                                            </div>
                                                                                                            <div class="text-right pt-3 pr-4" x-show="qte>0 && qte<=qmax">
                                                                                                                <button type="button" class="btn btn-outline-primary" x-on:click="$wire.add({{ $loop->index }},{{$i}},qte,prix,tranche,categorie,pieceId);isDialogOpen = false">Valider</button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                @else
                                                                                                <button type="button" class="btn btn-outline-primary" x-on:click="$wire.add({{ $loop->index }},{{$i}},1,prix,tranche,categorie,pieceId);isDialogOpen = false">Ajouter</button>
                                                                                            @endif
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endforeach
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- begin commande table --}}
                                                @if (count($produitId) > 0)
                                                    <div class="card card-custom card-stretch gutter-b bl bg-info-o-40">
                                                        <!--begin::Header-->
                                                        <div class="card-header">
                                                            <h3 class="card-title">Commande</h3>
                                                        </div>
                                                        <!--end::Header-->
                                                        <!--begin::Body-->
                                                        <div class="card-body">
                                                            <!--begin::Table-->
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr class="text-left">
                                                                            <th style="min-width: 120px">Article</th>
                                                                            <th style="min-width: 110px">Dépôt</th>
                                                                            <th style="min-width: 110px">Lot</th>
                                                                            <th style="min-width: 110px">Code</th>
                                                                            <th style="min-width: 120px">Poids</th>
                                                                            <th style="min-width: 120px">Quantité à livrer</th>
                                                                            <th style="min-width: 120px">Prix</th>
                                                                            <th style="min-width: 120px">Montant</th>
                                                                            <th style="min-width: 120px">Préparations</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($pieceId as $key => $val)

                                                                            <tr>
                                                                                <td>
                                                                                    @isset($produitNom[$key])
                                                                                        {{ $produitNom[$key] }}
                                                                                    @endisset
                                                                                </td>
                                                                                <td>
                                                                                    @isset($depotNom[$key])
                                                                                        {{ $depotNom[$key] }}
                                                                                    @endisset
                                                                                </td>
                                                                                <td>
                                                                                    @isset($pieceLot[$key])
                                                                                        {{ $pieceLot[$key] }}
                                                                                    @endisset
                                                                                </td>
                                                                                <td>
                                                                                    @isset($code[$key])
                                                                                        {{ $code[$key] }}
                                                                                    @endisset
                                                                                </td>
                                                                                <td>
                                                                                    @isset($poids[$key])
                                                                                        {{ $poids[$key] }}
                                                                                    @endisset
                                                                                </td>
                                                                                <td>
                                                                                    @isset($qte[$key])
                                                                                        {{ $qte[$key] }}
                                                                                    @endisset
                                                                                </td>
                                                                                <td>
                                                                                    @isset($prix_vente[$key])
                                                                                        {{ $prix_vente[$key] }}
                                                                                    @endisset
                                                                                </td>

                                                                                <td>
                                                                                    @isset($montant[$key])
                                                                                        {{ number_format($montant[$key], 2, ',', ' ') }}
                                                                                    @endisset
                                                                                </td>
                                                                                <td>

                                                                                    <div x-data="{ open{{$val}}: false }">

                                                                                        <div class="mt-4">
                                                                                           <div class="mt-2">
                                                                                              <label class="inline-flex items-center">
                                                                                                <input type="radio" class="form-radio" name="type" value="1" @click="open{{$val}} = 1">
                                                                                                <span class="ml-2">Cuisine</span>
                                                                                              </label>
                                                                                              <label class="inline-flex items-center ml-6">
                                                                                                <input type="radio" class="form-radio" name="type" value="2" @click="open{{$val}} = 2">
                                                                                                <span class="ml-2">Nettoyage</span>
                                                                                              </label>
                                                                                            </div>
                                                                                        </div>


                                                                                        <div class="w-full pt-4">
                                                                                            <div x-show="open{{$val}} === 1">
                                                                                                @isset($preparations_cuisine[$val])
                                                                                                    <select class="form-control" wire:model.defer="commande_preparations.{{$val}}">
                                                                                                        <option value="">{{ __('Choisir les préparations de la commande') }}</option>
                                                                                                        @foreach ($preparations_cuisine[$val] as  $item)
                                                                                                            <option value="{{$item['preparation']['nom'] }}">{{$item['preparation']['nom'] }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                @endisset

                                                                                            </div>
                                                                                            <div x-show="open{{$val}} === 2">
                                                                                                @isset($preparations_nettoyage[$val])
                                                                                                    <select class="form-control" wire:model.defer="commande_preparations.{{$val}}" multiple>
                                                                                                        <option value="">{{ __('Choisir les préparations cuisine') }}</option>
                                                                                                        @foreach ($preparations_nettoyage[$val] as  $item)
                                                                                                            <option value="{{$item['preparation']['nom'] }}">{{$item['preparation']['nom'] }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                @endisset
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    {{-- @isset($preparations_nettoyage[$val])
                                                                                        <select class="form-control" wire:model.defer="commande_preparation_nettoyage.{{$val}}" multiple>
                                                                                            <option value="">{{ __('Choisir les préparations cuisine') }}</option>
                                                                                            @foreach ($preparations_nettoyage[$val] as  $item)
                                                                                                <option value="{{$item['preparation_id'] }}">{{$item['preparation']['nom'] }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    @endisset --}}
                                                                                    {{--@isset($preparations_cuisine[$val])

                                                                                         <select class="selectpicker form-control" id="preparation" title="" data-live-search="true" data-hide-disabled="true" multiple>
                                                                                            @foreach($preparations_cuisine[$val] as $item)
                                                                                                <option value="{{$item['preparation_id']}}">{{$item['preparation']['nom'] }}</option>
                                                                                            @endforeach
                                                                                        </select>

                                                                                        <select class="form-control" wire:model.defer="commande_preparations.{{$val}}">
                                                                                            <option value="">{{ __('Choisir les préparations de la commande') }}</option>
                                                                                            @foreach ($preparations_cuisine[$val] as  $item)
                                                                                                <option value="{{$item['preparation_id'] }}">{{$item['preparation']['nom'] }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    @endisset--}}
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" class="btn font-weight-bold btn-danger btn-icon" wire:click="remove({{ $key }})"><i class="la la-remove"></i></button>
                                                                                </td>
                                                                                {{-- <td>
                                                                                    @isset($preparations_nettoyage[$val])
                                                                                        <select class="form-control" wire:model.defer="commande_preparation_nettoyage.{{$val}}" multiple>
                                                                                            <option value="">{{ __('Choisir les préparations cuisine') }}</option>
                                                                                            @foreach ($preparations_nettoyage[$val] as  $item)
                                                                                                <option value="{{$item['preparation_id'] }}">{{$item['preparation']['nom'] }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    @endisset
                                                                                </td> --}}
                                                                            </tr>
                                                                        @endforeach

                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th colspan="8">
                                                                                Total
                                                                            </th>
                                                                            <th>
                                                                                {{ number_format($totalMt, 2, ',', ' ') }}
                                                                            </th>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <!--end::Table-->
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>

                                                    <!--Info livraison-->
                                                    <div class="card card-custom card-stretch gutter-b bl bg-warning-o-40">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Info livraison</h3>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="card card-custom">
                                                                        <div class="card-header">
                                                                            <div class="card-title">
                                                                                <h3 class="card-label">Adresse de livraison</h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="form-group row mt-3">
                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Téléphone de livraison') }}</label>
                                                                                    <input type="text" class="form-control" placeholder="Téléphone de livraison" wire:model.defer="tel_livraison"/>
                                                                                    @error('tel_livraison')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Contact de livraison') }}</label>
                                                                                    <input type="text" class="form-control" placeholder="Contact de livraison" wire:model.defer="contact_livraison"/>
                                                                                    @error('contact_livraison')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Adresse de livraison') }}</label>
                                                                                    <input type="text" class="form-control" placeholder="Adresse de livraison" wire:model.defer="adresse_livraison"/>
                                                                                    @error('adresse_livraison')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Ville de livraison') }}</label>
                                                                                    <select class="form-control" wire:model="ville">
                                                                                        <option value="">{{ __('Choisir une ville de livraison') }}</option>
                                                                                        @foreach ($list_villes as $item)
                                                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('ville')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Ville zone') }}</label>
                                                                                    <select class="form-control" wire:model="ville_zone">
                                                                                        <option value="">{{ __('Choisir une zone') }}</option>
                                                                                        @foreach ($list_ville_zones as $item)
                                                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('ville_zone')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Quartier') }}</label>
                                                                                    <select class="form-control" wire:model="ville_quartie_id">
                                                                                        <option>{{ __('Choisir un quartier') }}</option>
                                                                                        @foreach ($list_quartiers as $item)
                                                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('ville_quartie_id')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="card card-custom">
                                                                        <div class="card-header">
                                                                            <div class="card-title">
                                                                                <h3 class="card-label">Réglement</h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="form-group row mt-3">
                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __("Dépôt de la livraison") }}</label>
                                                                                    <div class="input-group input-group-prepend">
                                                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                                                        <select class="form-control" wire:model.defer="depot_livraison">
                                                                                            <option>{{ __('Choisir un dépôt') }}</option>
                                                                                            @foreach ($list_depots as $item)
                                                                                                <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                                            @endforeach

                                                                                        </select>
                                                                                    </div>
                                                                                    @error('depot_livraison')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Mode de paiement') }}</label>
                                                                                    <select class="form-control" wire:model.defer="mode_paiement">
                                                                                        <option>{{ __('Choisir un mode de paiement') }}</option>
                                                                                        @foreach ($list_mode_paiement as $item)
                                                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('mode_paiement')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Mode de livraison') }}</label>
                                                                                    <select class="form-control" wire:model.defer="mode_livraison_id">
                                                                                        <option>{{ __('Choisir un mode de livraison') }}</option>
                                                                                        @foreach ($list_mode_livraison as $item)
                                                                                            <option value="{{$item->id }}">{{$item->nom }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('mode_livraison_id')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Frais de livraison') }}</label>
                                                                                    <input type="text" class="form-control" placeholder="Frais de livraison" wire:model.defer="frais_livraison" disabled/>
                                                                                    @error('frais_livraison')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Date de livraison') }}</label>
                                                                                    <div class="input-group input-group-prepend">
                                                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                                                        <select class="form-control" wire:model.defer="date_livraison">
                                                                                            <option value="">{{ __('Choisir une date') }}</option>
                                                                                            @foreach ($dates_livraison as $date)
                                                                                                <option value="{{$date }}">{{$date }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    @error('date_livraison')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror

                                                                                    {{-- <label>{{ __('Date de livraison') }}</label>
                                                                                    <input type="date" class="form-control" placeholder="Date de livraison" wire:model.defer="date_livraison"/>
                                                                                    @error('date_livraison')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror --}}
                                                                                </div>

                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Heure de livraison') }}</label>
                                                                                    <input type="text" class="form-control" placeholder="Contact de livraison" wire:model.defer="heure_livraison"/>
                                                                                    @error('heure_livraison')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror

                                                                                </div>

                                                                                <div class="col-lg-4 mb-6">
                                                                                    <label>{{ __('Livreur') }}</label>
                                                                                    <select class="form-control" wire:model.defer="livreur">
                                                                                        <option value="">{{ __('Choisir un livreur') }}</option>
                                                                                        @foreach ($list_livreurs as $item)
                                                                                            <option value="{{$item->id }}" {{$item->solde >= $item->plafond ? 'disabled' : ''}}>{{$item->nom }} | {{$item->solde == null ? 0 : $item->solde}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('livreur')
                                                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </div>

                                                    </div>
                                                    <!--end Info livraison-->
                                                @endif
                                                {{-- end commande table --}}

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                            <button type="submit" class="btn btn-primary font-weight-bold" form="lot-form">{{ __('Enregistrer') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- show bl Modal --}}
                            <div wire:ignore.self class="modal fade" id="show" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="show" aria-hidden="true">
                                <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('Bon réception réf ') }} - {{$ref_bl}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="show-form" class="form row">
                                                    <div class="form-group col-lg-4 mb-6">
                                                        <label>{{ __('Réf. bon de livraison') }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model.defer="ref_bl" disabled/>
                                                       </div>

                                                    </div>
                                                    <div class="form-group col">
                                                        <label>{{ __('Client') }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model.defer="client_bl" disabled/>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col">
                                                        <label>{{ __("Date") }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-plus icon-lg"></i></span></div>
                                                            <input id="date_entree" type="text" class="form-control datepicker" placeholder=" " wire:model.defer="date" autocomplete="off" disabled/>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col">
                                                        <label>{{ __("Dépôt") }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model.defer="depot" disabled/>
                                                        </div>
                                                    </div>

                                                    <table class="table table-vertical-center" id="kt_advance_table_widget_4">
                                                        <thead>
                                                            <tr class="text-left">
                                                                <th>Article</th>
                                                                <th>Quantité</th>
                                                                <th>Prix Achat</th>
                                                                <th>Montant</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($bl_lignes as $ligne)
                                                                <tr>
                                                                    <td>{{$ligne->piece->produit->nom}}</td>
                                                                    <td>{{$ligne->qte}}</td>
                                                                    <td>{{$ligne->prix_achat}}</td>
                                                                    <td>{{$ligne->montant}}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <th colspan="3">Total</th>
                                                                <td class="pl-0 text-left">{{$montant_total}}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>



                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                            <button type="submit" class="btn btn-primary font-weight-bold" form="show-form">{{ __('Enregistrer') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End show bl Modal --}}

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

    {{-- <script>
        window.addEventListener('contentChanged', event => {
            $('.selectpicker').selectpicker();
        });
    </script> --}}

    <script>
        $(document).ready(function(){
            $('.selectpicker#preparation').select2();
        });
    </script>

    <script>
        $('.datepicker').on('change', function (e) {
            @this.set(e.target.id, e.target.value);
        });
    </script>

@endpush


