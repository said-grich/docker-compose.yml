@section('title', 'Contrôle qualité')
@section('header_title', 'Contrôle qualité')

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
                                        <th class="pl-0" wire:click="sortBy('lot_num')" style="cursor: pointer;">Numéro de lot @include('layouts.partials._sort-icon',['field'=>'lot_num'])</th>
                                        {{-- <th class="pl-0" wire:click="sortBy('lot_num')" style="cursor: pointer;">date d'entrée @include('layouts.partials._sort-icon',['field'=>'lot_num'])</th>
                                        <th class="pl-0" wire:click="sortBy('date_capture')" style="cursor: pointer;">Statut @include('layouts.partials._sort-icon',['field'=>'date_capture'])</th>
                                        <th class="pl-0" wire:click="sortBy('date_entree')" style="cursor: pointer;">Qualité @include('layouts.partials._sort-icon',['field'=>'date_entree'])</th> --}}

                                        <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <table class="table">
                                        @foreach ($items as $lot => $lots_list)
                                        @php
                                                                                    dd($lots_list);

                                        @endphp
                                            <tr>
                                                <td class="pl-0 py-6">
                                                    <label class="checkbox checkbox-lg checkbox-inline">
                                                        <input type="checkbox" value="1" />
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $lot }}: {{ $lots_list->count() }} produits</a>
                                                </td>
                                                <td class="pr-0 text-right">
                                                    <a href="#" wire:click="show({{$lot}})" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#stock">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                                                            </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </a>
                                                    <a href="#" wire:click="edit({{$lot}})" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#exampleModalSizeSm">
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

                                                </td>
                                            </tr>

                                            {{-- @foreach ($lots_list as $item)
                                                <tr>
                                                    <td class="pl-0 py-6">
                                                    <label class="checkbox checkbox-lg checkbox-inline">
                                                        <input type="checkbox" value="1" />
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $day }}: {{ $lots_list->count() }} produits</a>
                                                </td>
                                                    <td class="pl-0">
                                                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->date_entree }}</a>
                                                    </td>
                                                    <td class="pl-0">
                                                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->active ? "Activé" : "Désactivé" }}</a>
                                                    </td>
                                                    <td class="pl-0">
                                                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->qualite->nom }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                        @endforeach
                                    </table>


                                </tbody>
                            </table>
                            {{-- {{ $items->links('layouts.partials.custom-pagination') }} --}}

                            {{-- Stock Modal --}}


                            {{-- Edit Modal --}}
                            <div wire:ignore.self class="modal fade" id="stock" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="stock" aria-hidden="true">
                                <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('Contrôle qualité réf ') }} - {{$ref_br}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="stock-form" class="form row" wire:submit.prevent="affecterPrix">
                                                    <div class="form-group col">
                                                        <label>{{ __('Réf. bon de réception') }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hashtag icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model.defer="ref_br" disabled/>
                                                       </div>

                                                    </div>
                                                    <div class="form-group col">
                                                        <label>{{ __('Fournisseur') }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model.defer="fournisseur" disabled/>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col">
                                                        <label>{{ __("Date d'entrée") }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-plus icon-lg"></i></span></div>
                                                            <input id="date_entree" type="text" class="form-control datepicker" placeholder=" " wire:model.defer="date_entree" autocomplete="off" disabled/>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col">
                                                        <label>{{ __("Dépôt") }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model.defer="depot" disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>{{ __("Qualité globale") }}</label>
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tie icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model.defer="qualite" disabled/>
                                                        </div>
                                                    </div>

                                                    <table class="table table-vertical-center" id="kt_advance_table_widget_4">
                                                        <thead>
                                                            <tr class="text-left">
                                                                <th class="pl-0">Article</th>
                                                                <th class="pl-0">Quantité</th>
                                                                <th class="pl-0">Prix Achat</th>
                                                                <th class="pl-0">Montant</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($br_lignes as $ligne)
                                                                <tr>
                                                                    <td class="pl-0">{{$ligne->produit->nom}}</td>
                                                                    <td class="pl-0">{{$ligne->qte}}</td>
                                                                    <td class="pl-0">{{$ligne->prix_achat}}</td>
                                                                    <td class="pl-0">{{$ligne->montant}}</td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>



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

