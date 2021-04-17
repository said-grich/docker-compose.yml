<div>
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

                <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
            </tr>
        </thead>
        <tbody>

            @if (!empty($items))
                @foreach ($items as $produit => $stock)
                    <tr>
                        <td class="pl-0 py-6">
                            <label class="checkbox checkbox-lg checkbox-inline">
                                <input type="checkbox" value="1" />
                                <span></span>
                            </label>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $stock[0]->produit->nom }}</a>
                        </td>

                        <td class="pl-0 text-right" style="min-width: 160px"">
                            {{-- <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#show-prix-{{$produit}}"><i class="fas fa-eye"></i></button> --}}
                            <span wire:click="modificationPrix({{$produit}})">
                                <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#modification-prix"><i class="fas fa-pencil-alt"></i>
                                </button>
                            </span>
                        </td>
                        {{-- <td>
                             show prices Modal
                            <div wire:ignore.self class="modal fade" id="show-prix-{{$produit}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="show-prix-{{$produit}}" aria-hidden="true">
                                <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('Prix') }} - {{ $stock[0]->produit->nom }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="modification-form" class="form row" wire:submit.prevent="modificationPrix">
                                                <div class="form-group col-md-12">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Tranche</th>
                                                                <th scope="col">Catégorie</th>
                                                                <th scope="col">Stock</th>
                                                                <th scope="col">Vendue</th>
                                                                <th scope="col">Prix Vente Normal</th>
                                                                <th scope="col">Prix Vente Fidèle</th>
                                                                <th scope="col">Prix Vente Business</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($stock as $item)
                                                                <tr>
                                                                    <td>{{$item->tranche->nom}}</td>
                                                                    <td>{{$item->categorie->nom}}</td>
                                                                    <td>{{$item->qte_restante}}</td>
                                                                    <td>{{$item->qte_vendue}}</td>
                                                                    <td>{{$item->prix_n}}</td>
                                                                    <td>{{$item->prix_f}}</td>
                                                                    <td>{{$item->prix_p}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End  show prices Modal
                        </td> --}}
                    </tr>


                @endforeach
            @else
                <tr>
                    <td>Aucun enregistrement à afficher</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- edit prices Modal --}}
    <div wire:ignore.self class="modal fade" id="modification-prix" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modification-prix" aria-hidden="true">
        <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Modification des prix') }} - {{ $nom_produit }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modification-{{$nom_produit}}-form" class="form row" wire:submit.prevent="edit">
                        <div class="form-group col-md-12">
                            <!--begin::Flash message-->
                            @if (session()->has('edit-price-message'))
                            <div class="alert alert-custom alert-light-success shadow fade show mb-5" role="alert">
                                <div class="alert-icon"><i class="flaticon-interface-10"></i></div>
                                <div class="alert-text">{{ session('edit-price-message') }}</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                    </button>
                                </div>
                            </div>
                            @endif

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Tranche</th>
                                        <th scope="col">Catégorie</th>
                                        <th scope="col">Sous catégorie</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Prix Vente Normal</th>
                                        <th scope="col">Prix Vente Fidèle</th>
                                        <th scope="col">Prix Vente Business</th>
                                        <th scope="col"></th>
                                    </tr>
                                    <tr>
                                        <th scope="col">
                                            <select class="form-control" wire:model="filter.tranche">
                                                <option value="">{{ __('Choisir une tranche') }}</option>
                                                @foreach ($liste_tranches as $item)
                                                    <option value="{{$item->uid}}">{{$item->nom}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="form-control" wire:model="filter.categorie">
                                                <option value="">{{ __('Choisir une catégorie') }}</option>
                                                @foreach ($liste_categories as $item)
                                                    <option value="{{$item->id}}">{{$item->nom}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <select class="form-control" wire:model="filter.sous_categorie">
                                                <option value="">{{ __('Choisir une sous catégorie') }}</option>
                                                @foreach ($liste_sous_categories as $item)
                                                    <option value="{{$item->id}}">{{$item->nom}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($liste_produits as $key => $value)
                                        <tr>
                                            <td>{{$value->tranche->nom}}</td>
                                            <td>{{$value->categorie->nom}}</td>
                                            <td>{{$value->sousCategorie->nom}}</td>
                                            <td>{{$value->qte_restante}}</td>

                                            <td>
                                                <input type="text" class="form-control {{$prix_n[$value->id] == 0 ? "is-invalid" : ''}}" wire:model="prix_n.{{$value->id}}"/>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control {{$prix_f[$value->id] == 0 ? "is-invalid" : ''}}" wire:model="prix_f.{{$value->id}}"/>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control {{$prix_p[$value->id] == 0 ? "is-invalid" : ''}}" wire:model="prix_p.{{$value->id}}"/>
                                            </td>
                                            <td>

                                                <a wire:click="edit({{$value->id}},'{{$value->produit_id}}','{{$value->tranche_id}}','{{$value->categorie_id}}','{{$value->categorie->nom}}','{{$nom_produit}}','{{$value->tranche->nom}}')" href="#" class="btn font-weight-bold mr-2">
                                                    <i class="far fa-save text-primary"></i>
                                                </a>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End edit prices Modal --}}

</div>
