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
                <th class="pl-0" style="cursor: pointer;">Photo</th>
                <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Nom @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                {{-- <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Catégorie @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Sous catégorie @include('layouts.partials._sort-icon',['field'=>'nom'])</th> --}}
                <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Famille @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Mode de vente @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                <th class="pl-0" style="cursor: pointer;">Mode de préparation</th>
                <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Préparations @include('layouts.partials._sort-icon',['field'=>'nom'])</th>


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
                        <div class="symbol symbol-120 mr-3">
                            <img alt="Pic" src="{{ asset($item->photo_url) }}"/>
                        </div>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->nom }}</a>
                    </td>
                    {{-- <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->sousCategorie->categorie->nom }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->sousCategorie->nom }}</a>
                    </td> --}}
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->famille->nom }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->modeVente->nom }}</a>
                    </td>
                    {{-- <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->modePreparation->nom }}</a>
                    </td> --}}
                    <td class="pl-0">
                        {{-- <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#preparations">{{ __('Préparations') }}</button> --}}

                        <div x-data="{ 'isDialogOpen': false }" @keydown.escape="isDialogOpen = false">
                            <button class="btn btn-primary font-weight-bold btn-pill" @click="isDialogOpen = true">{{ __('Préparations') }}</button>
                            <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="isDialogOpen" :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }">
                                <div class="bg-white shadow-2xl m-auto w-7/12" x-show="isDialogOpen" @click.away="isDialogOpen = false">
                                    <div class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                        <h5 class="modal-title">{{ __('Préparations associés au produit') }} <span class="label label-primary label-lg label-inline mr-2">{{ $item->nom }}</span> </h5>
                                        <button type="button" @click="isDialogOpen = false">✖</button>
                                    </div>
                                    <div class="p-2 row">
                                        <div class="col-6">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Mode Cuisine</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @php
                                                    dd($item->preparations);
                                                    @endphp --}}
                                                    @foreach ($item->preparations as $key => $preparation)
                                                        <tr>
                                                            @if($item->preparations[$key]->preparation->mode_preparation_id == 1)
                                                                <td>{{$item->preparations[$key]->preparation->nom}}</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Mode Nettoyage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @php
                                                    dd($item->preparations);
                                                    @endphp --}}
                                                    @foreach ($item->preparations as $key => $preparation)
                                                        <tr>
                                                            @if($item->preparations[$key]->preparation->mode_preparation_id == 2)
                                                                <td>{{$item->preparations[$key]->preparation->nom}}</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Modal-->
                        {{-- <div class="modal fade" id="preparations" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="preparations" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Préparations associés au produit') }} <span class="label label-primary label-lg label-inline mr-2">{{ $item->nom }}</span> </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Préparation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($item->preparations as $key => $preparation)
                                                    <tr>
                                                        <td>{{$item->preparations[$key]->preparation->nom}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </td>

                    <td class="pr-0 text-right">
                        <a href="#" wire:click="edit({{$item->id}})" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#edit">
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
                        <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" wire:click="deleteProduit('{{ $item->id }}')">
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
    {{-- {{ $items->links('layouts.partials.custom-pagination') }} --}}
    <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Modification produit') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-form" class="form row">
                        <div class="form-group col-md-12">
                            <div class="input-group input-group-prepend">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-tag icon-lg"></i></span></div>
                                <input type="hidden" class="form-control" placeholder=" " wire:model.defer="categorie_id"/>
                                <input type="text" class="form-control" placeholder=" " wire:model.defer="nom"/>
                                <label>{{ __('Nom') }}</label>
                            </div>
                            @error('nom')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>{{ __('Famille') }}</b></label>
                            <div wire:ignore class="input-group input-group-prepend">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sitemap icon-lg"></i></span></div>
                                {{-- @livewire('multi-select', ['selectId' => 'testselect', 'selectTitle' => '', 'selectType' => '', 'selected' => $famille, 'selectOptions' => $list_familles]) --}}
                                <select  class="form-control "
                                        wire:model="famille">
                                    <option>{{ __('Choisir une famille') }}</option>
                                    @foreach ($list_familles as $item)
                                        <option value="{{$item->id}}" @if($famille == $item->id) {{'selected'}} @endif>{{$item->nom}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append" data-toggle="modal"
                                     data-target="#famille">
                                    <button class="btn btn-primary" type="button"
                                            data-toggle="tooltip" data-theme="dark"
                                            title="Ajouter une famille"><i
                                            class="fa fa-plus-circle"></i></button>
                                </div>
                            </div>
                            @error('famille')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div  class="form-group col-md-6">
                            <label><b>{{ __('Unité Affichée') }}</b></label>
                            <div class="input-group input-group-prepend">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="fa fa-weight-hanging icon-lg"></i></span></div>
                                            {{-- @livewire('multi-select', ['selectId' => 'testselect', 'selectTitle' => '', 'selectType' => '', 'selected' => $unite, 'selectOptions' => $list_unite]) --}}
                                <select class="form-control " wire:model.defer="unite">
                                    <option>{{ __('Choisir une unité') }}</option>
                                    @foreach ($list_unite as $item)
                                        <option value="{{$item->id}}" @if($unite == $item->id) {{'selected'}} @endif>{{$item->nom}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append" data-toggle="modal"
                                     data-target="#unite">
                                    <button class="btn btn-primary" type="button"
                                            data-toggle="tooltip" data-theme="dark"
                                            title="Ajouter Unite"><i class="fa fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            @error('unite')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div wire:ignore class="form-group col-md-6">
                            <label><b>{{ __('Mode Vente') }}</b></label>
                            <div class="input-group input-group-prepend">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="fa fa-money-check-alt icon-lg"></i></span></div>
                                            {{-- @livewire('multi-select', ['selectId' => 'testselect', 'selectTitle' => '', 'selectType' => '', 'selected' => $mode_vente, 'selectOptions' => $list_modes_vente]) --}}
                                <select class="form-control " wire:model="mode_vente">
                                    <option>{{ __('Mode Vente') }}</option>
                                    @foreach ($list_modes_vente as $item)
                                        <option value="{{$item->id}}" @if($mode_vente == $item->id) {{'selected'}} @endif>{{$item->nom}}</option>
                                    @endforeach
                                </select>

                                <div class="input-group-append" data-toggle="modal"
                                     data-target="#mode-vente">
                                    <button class="btn btn-primary" type="button"
                                            data-toggle="tooltip" data-theme="dark"
                                            title="Ajouter Mode Vente"><i
                                            class="fa fa-plus-circle"></i></button>
                                </div>
                            </div>
                            @error('mode_vente')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div  class="form-group col-md-6">
                            <label><b>{{ __('Tranches') }}</b></label>
                            <div class="input-group input-group-prepend">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="fa fa-sliders-h icon-lg"></i></span></div>
                                <select class="form-control" wire:model="tranches" multiple>
                                    <option>{{ __('Choisir une tranche') }}</option>
                                    @foreach ($list_tranches as  $tranche)
                                        <option value="{{$tranche->uid}}">{{$tranche->nom}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append" data-toggle="modal"
                                     data-target="#tranchese">
                                    <button class="btn btn-primary" type="button"
                                            data-toggle="tooltip" data-theme="dark"
                                            title="Ajouter Tranche"><i
                                            class="fa fa-plus-circle"></i></button>
                                </div>
                            </div>
                            @error('tranches')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div wire:ignore class="form-group col-md-6">
                            <label><b>{{ __('Mode Cuisine ') }}</b></label>
                            <div class="input-group input-group-prepend">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tools icon-lg"></i></span></div>
                                {{-- @livewire('multi-select', ['selectId' => 'testselect', 'selectTitle' => '', 'selectType' => '', 'selected' => $mode_cuisine, 'selectOptions' => $list_cuisine]) --}}
                                <select class="form-control " wire:model="mode_cuisine" multiple>
                                    <option>{{ __('Choisir un mode de préparation') }}</option>
                                        @foreach ($list_cuisine as $mode)
                                            <option value="{{$mode->id}}" {{-- @if($mode_cuisine == $item->id) {{'selected'}} @endif --}}>{{$mode->nom}}</option>
                                        @endforeach
                                </select>
                                <div class="input-group-append" data-toggle="modal" data-target="#mode-preparation"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Mode Préparation"><i class="fa fa-plus-circle"></i></button></div>
                            </div>
                            @error('mode_preparation')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div wire:ignore.self class="form-group col-md-6">
                           <label><b>{{ __('Mode Nettoyage ') }}</b></label>
                           <div class="input-group input-group-prepend">
                               <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tools icon-lg"></i></span></div>
                               <select class="form-control " wire:model="mode_nettoyage" multiple>
                                   <option>{{ __('Choisir un mode de préparation') }}</option>
                                       @foreach ($list_nettoyage as $mode)
                                           <option value="{{$mode->id}}" {{-- @if($mode_nettoyage == $item->id) {{'selected'}} @endif --}}>{{$mode->nom}}</option>
                                       @endforeach
                               </select>
                               <div class="input-group-append" data-toggle="modal" data-target="#mode-preparation"><button class="btn btn-primary" type="button" data-toggle="tooltip" data-theme="dark" title="Ajouter Mode Préparation"><i class="fa fa-plus-circle"></i></button></div>
                           </div>
                           @error('mode_preparation')
                               <span class="form-text text-danger">{{ $message }}</span>
                           @enderror
                       </div>
                        <div class="form-group col-md-6">
                            <div class="input-group input-group-prepend">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="fa fa-calculator icon-lg"></i></span></div>
                                <input type="text" class="form-control" placeholder=" "
                                       wire:model.defer="code_comptable"/>
                                <label>{{ __('Code Comptable') }}</label>
                            </div>
                            @error('code-comptable')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group input-group-prepend">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="fa fa-chart-pie icon-lg"></i></span></div>
                                <input type="text" class="form-control" placeholder=" "
                                       wire:model.defer="code_analytique"/>
                                <label>{{ __('Code Analytique') }}</label>
                            </div>
                            @error('code-analytique')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>{{ __('Photo Principale') }}</b></label>
                            <div class="input-group input-group-prepend">
                                <input type="file" wire:model="photo_principale"/>
                                <img style="max-width: 10%;" alt="Pic" src="{{ Storage::url($photo_principalea)}}"/>

                            </div>
                            @error('photo') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group col-md-6" >
                            <label><b>{{ __('Autres Photos') }}</b></label>
                            <div class="input-group input-group-prepend">
                                <input type="file" wire:model="photos" multiple/>
                                @foreach ($iteme as $key => $item)
                                {{-- @php dd($item->photos) @endphp --}}
                                <img style="max-width: 10%;" alt="Pic" src="{{ Storage::url($item->photo) }}"/>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group col-md-6 row">
                            <label
                                class="col-8 col-form-label">{{ __('Activé / Désactivé le produit') }}</label>
                            <div class="col-4">
                                <span class="switch switch-outline switch-icon switch-primary">
                                    <label>
                                    <input type="checkbox" checked="checked"
                                           wire:model.defer="active" name="active"/>
                                    <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                        <button type="submit" wire:click="editProduit" class="btn btn-primary font-weight-bold" form="edit-form" >{{ __('Enregistrer') }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--Modal-Tranches-->

    <div class="modal secondary fade" id="tranchese" data-backdrop="static" tabindex="-1"
    role="dialog" aria-labelledby="tranches" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Nouvelle tranche') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="tranchess-form" class="form" wire:submit.prevent="createTranches">
                        <div x-data="{ open: false }">
                            <div x-data="{'showPoids': @entangle('showPoids')}">
                                <div class="row" x-show="showPoids">

                                    <div class="form-group col-md-6">
                                        <div class="input-group input-group-prepend">
                                            <div class="input-group-prepend"><span
                                                    class="input-group-text"><i
                                                        class="fa fa-sliders-h icon-lg"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder=" "
                                                    wire:model.defer="minPoids"/>
                                            <label>{{ __('Poids Minimal') }}</label>
                                        </div>
                                        @error('minPoids')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="input-group input-group-prepend">
                                            <div class="input-group-prepend"><span
                                                    class="input-group-text"><i
                                                        class="fa fa-sliders-h icon-lg"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder=" "
                                                    wire:model.defer="maxPoids"/>
                                            <label>{{ __('Poids Maximal') }}</label>
                                        </div>
                                        @error('maxPoids')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div x-data="{'showKgPiece': @entangle('showKgPiece')}">
                                <div x-show="showKgPiece">
                                    <div class="form-group">
                                        <div class="input-group input-group-prepend">
                                            <div class="input-group-prepend"><span
                                                    class="input-group-text"><i
                                                        class="fa fa-weight-hanging icon-lg"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder=" "
                                                wire:model.defer="nomTranche"/>
                                            <label>{{ __('Kg/Pièce') }}</label>
                                        </div>
                                        @error('nomTranche')
                                        <span class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold"
                            data-dismiss="modal">{{ __('Fermer') }}</button>
                    <button type="submit" class="btn btn-primary font-weight-bold"
                            form="tranchess-form">{{ __('Enregistrer') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
