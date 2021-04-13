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
                                            <th class="pl-0" wire:click="sortBy('lot_num')" style="cursor: pointer;">Numéro de lot @include('layouts.partials._sort-icon',['field'=>'lot_num'])</th>
                                            <th class="pl-0" wire:click="sortBy('produit_id')" style="cursor: pointer;">Produit @include('layouts.partials._sort-icon',['field'=>'produit_id'])</th>
                                            <th class="pl-0" wire:click="sortBy('tranche_id')" style="cursor: pointer;">Tranche @include('layouts.partials._sort-icon',['field'=>'tranche_id'])</th>
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
                                            <th class="pl-0" wire:click="sortBy('depot_id')" style="cursor: pointer;">Depot @include('layouts.partials._sort-icon',['field'=>'depot_id'])</th>
                                            <th class="pl-0" wire:click="sortBy('br_num')" style="cursor: pointer;">Numéro BR @include('layouts.partials._sort-icon',['field'=>'br_num'])</th>
                                            <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
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

                                                <td class="pr-0 text-right">

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
