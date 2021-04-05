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
                                    <tr class="text-left">
                                        <th class="pl-0" style="width: 30px">
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
                                                    <a href="#" wire:click="show({{$item->ref}})" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#show">
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

                                                    <a href="#" wire:click="edit({{$item->ref}})" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#edit">
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
                                        <h5 class="modal-title">{{ __('Entrée de stock') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="ajout-bl-form" class="form row" wire:submit.prevent="createStock" {{-- wire:submit.prevent="createLots" --}}>
                                            <div class="form-group col">
                                                <label>{{ __('Réf. bon de livraison') }}</label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="ref_bl"/>
                                               </div>
                                                @error('ref_bl')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col">
                                                <label>{{ __('Client') }}</label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                    <select class="form-control" wire:model="client">
                                                        <option>{{ __('Choisir un client') }}</option>
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
                                                <label>{{ __("Date") }}</label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-plus icon-lg"></i></span></div>
                                                    <input id="date" type="text" class="form-control datepicker" placeholder=" " wire:model.defer="date" autocomplete="off"/>
                                                </div>
                                                @error('date')
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

                                            <div class="form-group col">
                                                <label>{{ __('Rechercher un produit') }}</label>
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model="recherche_produit"/>
                                               </div>
                                                @error('recherche_produit')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <table class="table table-vertical-center" id="kt_advance_table_widget_4">
                                                <thead>
                                                    <tr class="text-left">
                                                        <th class="pl-0">Article</th>
                                                        {{-- <th class="pl-0">Catégorie</th>
                                                        <th class="pl-0">Sous catégorie</th>
                                                        <th class="pl-0">Quantité</th>
                                                        <th class="pl-0">Unité</th>
                                                        <th class="pl-0">Prix Achat</th>
                                                        <th class="pl-0">Lot</th>
                                                        <th class="pl-0">Qualité</th>
                                                        <th class="pl-0">Pas</th> --}}
                                                        <th class="pl-0">Tranches</th>
                                                        <th class="pl-0">Détails</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($list_produits) > 0)
                                                        @foreach ($list_produits as $i => $item)
                                                            {{-- @php
                                                                dd($i,$item);
                                                            @endphp --}}
                                                            <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-{{$i}}" aria-expanded="false" aria-controls="group-of-rows-{{$i}}">

                                                                <td class="pl-0">{{$nom_produit[$i]}} </td>

                                                                <td class="pl-0">
                                                                    @foreach ($item as $tranche_uid => $produits)
                                                                        <span class="label label-primary label-inline mr-2">{{$nom_tranche[$i][$tranche_uid]}} | {{$nbr_piece[$i][$tranche_uid]}}</span>
                                                                    @endforeach
                                                                    </td>
                                                                <td class="pl-0">
                                                                    <button type="button">
                                                                        <i class="flaticon-plus text-primary"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>

                                                </tbody>
                                                <tbody id="group-of-rows-{{$i}}" class="collapse">
                                                    <tr>
                                                        {{-- <th>Tranche</th> --}}
                                                        <th>Catégorie</th>
                                                        <th>Sous catégorie</th>
                                                        <th>Code</th>
                                                        <th>Poids</th>
                                                        {{-- <th>Quantité</th> --}}
                                                        <th>Unité</th>
                                                        <th>Prix Achat</th>
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
                                                        <th>Qualité</th>
                                                        <th>Pas</th>
                                                        <th></th>
                                                    </tr>
                                                    @foreach ($item as $tranche_uid => $produits)
                                                        <tr class="text-center">
                                                            <th colspan="15">{{$nom_tranche[$i][$tranche_uid]}} | {{$nbr_piece[$i][$tranche_uid]}}</th>
                                                        </tr>
                                                        @foreach ( $produits as $key => $produit)
                                                            <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-{{$tranche_uid}}" aria-expanded="false" aria-controls="group-of-rows-{{$tranche_uid}}">
                                                                {{-- <td>{{$nom_tranche[$i][$tranche_uid]}}</td> --}}
                                                                @php
                                                                    switch ($profile) {
                                                                        case "Normal":
                                                                            $prix = $produit->prix_n;
                                                                            break;
                                                                        case "Fidèle":
                                                                            $prix = $produit->prix_f;
                                                                            break;
                                                                        case "Business":
                                                                             $prix = $produit->prix_p;
                                                                            break;
                                                                    }

                                                                @endphp
                                                                <td>{{$produit->categorie->nom}}</td>
                                                                <td>{{$produit->sousCategorie->nom}}</td>
                                                                <td>{{$produit->code}}</td>
                                                                <td>{{$produit->poids}}</td>
                                                                {{-- <td>{{$produit->qte}}</td> --}}
                                                                <td>{{$produit->unite->nom}}</td>
                                                                <td>{{$produit->prix_achat}}</td>
                                                                {{-- <td>{{$produit->prix_n}}</td>
                                                                <td>{{$produit->prix_f}}</td>
                                                                <td>{{$produit->prix_p}}</td>  --}}
                                                                @if($profile === "Normal")
                                                                    <td>{{$produit->prix_n}}</td>
                                                                @endif
                                                                @if($profile == "Fidèle")
                                                                    <td>{{$produit->prix_f}}</td>
                                                                @endif
                                                                @if($profile == "Business")
                                                                    <td>{{$produit->prix_p}}</td>
                                                                @endif
                                                                <td>{{$produit->lot_num}}</td>
                                                                <td>
                                                                    @isset($produit->qualite->nom)
                                                                        {{$produit->qualite->nom}}
                                                                    @endisset
                                                                    @isset($produit->lot->qualite->nom)
                                                                        {{$produit->lot->qualite->nom}}
                                                                    @endisset
                                                                </td>
                                                                <td>{{$produit->pas}}</td>
                                                                <td>
                                                                    <div x-data="{ 'isDialogOpen': false, qte: null,tranche:'{{$tranche_uid}}',code:'{{$produit->code}}', prix:{{$prix}},lot:'{{$produit->lot_num}}', qmax:{{$nbr_piece[$i][$tranche_uid]}} }"
                                                                        @keydown.escape="isDialogOpen = false">
                                                                            <button type="button" @click="isDialogOpen = true" class="btn btn-outline-primary">Ajouter</button>

                                                                            <div class=" overflow-auto"
                                                                            style="background-color: rgba(0,0,0,0.5)"
                                                                            x-show="isDialogOpen"
                                                                            :class="{ 'fixed inset-0 z-10 flex items-start justify-center': isDialogOpen }">

                                                                            <div class="bg-white shadow-2xl m-auto"
                                                                                x-show="isDialogOpen">

                                                                                <div
                                                                                    class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                                                                    <h6 class="text-xl font-bold">Entrer La quantité:
                                                                                    </h6>
                                                                                    <button type="button"
                                                                                        @click="isDialogOpen = false">✖</button>
                                                                                </div>

                                                                                <div class="pl-0">
                                                                                    <div>
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
                                                                                                        {{$nbr_piece[$i][$tranche_uid]}}</span>
                                                                                                </label>

                                                                                            </div>
                                                                                            <div class="text-right pt-3 pr-4" x-show="qte>0 && qte<=qmax">
                                                                                                <button type="button"
                                                                                                    class=""
                                                                                                    @click="$wire.add({{ $loop->index }},{{$i}},qte,prix,lot,code,tranche);isDialogOpen = false">Valider</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @endforeach

                                                    @endforeach
                                                </tbody>
                                                @endforeach
                                                @endif
                                            </table>

                                            @if (count($produitId) > 0)

                                            <table class="table table-vertical-center" id="kt_advance_table_widget_4">
                                                <thead>
                                                    <tr class="text-left">
                                                        <th class="pl-0">Article</th>
                                                        {{-- <th class="pl-0">Tranches</th> --}}
                                                        <th class="pl-0">Code</th>
                                                        <th class="pl-0">Poids</th>
                                                        <th class="pl-0">Quantité à livrée</th>
                                                        <th class="pl-0">Prix</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($produitId as $key => $val)
                                                        <tr>

                                                            <td class="pl-0">
                                                                @isset($produitNom[$key])
                                                                    {{ $produitNom[$key] }}
                                                                @endisset
                                                            </td>
                                                            <td class="pl-0">
                                                                @isset($code[$key])
                                                                    {{ $code[$key] }}
                                                                @endisset
                                                            </td>
                                                            <td class="pl-0">
                                                                @isset($poids[$key])
                                                                    {{ $poids[$key] }}
                                                                @endisset
                                                            </td>
                                                            <td class="pl-0">
                                                                @isset($qte[$key])
                                                                    {{ $qte[$key] }}
                                                                @endisset
                                                            </td>
                                                            <td class="pl-0">
                                                                @isset($prix_vente[$key])
                                                                    {{ $prix_vente[$key] }}
                                                                @endisset
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>


                                            </table>

                                            <table class="table table-vertical-center" id="kt_advance_table_widget_4">
                                            <tbody>
                                                <tr>
                                                    <th class="pl-0" colspan="6">
                                                        Total
                                                    </th>
                                                    <td class="pl-0">
                                                        {{ number_format($totalMt, 2, ',', ' ') }}
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                        @endif
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
        window.addEventListener('contentChanged', event => {
            $('.selectpicker').selectpicker();
        });
    </script>

    <script>
        $('.datepicker').on('change', function (e) {
            @this.set(e.target.id, e.target.value);
        });
    </script>

@endpush


