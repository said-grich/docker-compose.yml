<div>
    @section('title', 'Réglements')
    @section('header_title', 'Réglements')
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
                            <h3 class="card-title">{{ __('Réglements') }}</h3>
                        </div>
                        <div class="card-body">

                            <!--begin::Alerts-->
                            @include('layouts.partials.alerts')
                            <!--end::Alerts-->

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
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Commande ref @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Date @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Client @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Montant total @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Livreur @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Etat commande @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
                                                <th class="pl-0" wire:click="sortBy('commande_id')" style="cursor: pointer;">Etat réglement @include('layouts.partials._sort-icon',['field'=>'commande_id'])</th>
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
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->commande->ref }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->commande->date }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->commande->client->nom }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->commande->total }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->livreur->nom }} | {{ $item->livreur->type }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->commande->etat }}</a>
                                                </td>
                                                <td class="pl-0">
                                                    <span class="label {{ $item->valide == true ? 'label-primary' : 'label-danger' }} label-pill label-inline mr-2">{{ $item->valide == true ? 'Validée' : 'Non validée' }} </span>
                                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"></a>
                                                </td>

                                                <td class="pr-0 text-right">
                                                    <button wire:click="valider('{{ $item->commande_id }}','{{ $item->livreur_id }}')" class="btn btn-light-primary font-weight-bold mr-2" {{ $item->valide == true ? 'disabled' : '' }}>{{ $item->valide == false ? 'Valider' : 'Validée' }}</button>
                                                </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $items->links('layouts.partials.custom-pagination') }}

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

</div>
