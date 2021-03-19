@section('title', 'Création bon de commande')
@section('header_title', 'Création bon de commande')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-xl-12">
                <!--begin::Card-->
                <div class="card card-custom card-stretch gutter-b">
                    {{-- <div class="card-header">
                        <h3 class="card-title">{{ __('Création devis') }}</h3>
                    </div> --}}
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line" style="margin-left: 30px;">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#lient_tab_1">
                                    <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                    <span class="nav-text">Nouveau bon de commande</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#lient_tab_2">
                                    <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                                    <span class="nav-text">Liste bon de commandes</span>
                                </a>
                            </li>
                        </ul>
                    </div>


                    <div class="card-body" style="margin-top: 25px;">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="lient_tab_1" role="tabpanel" aria-labelledby="lient_tab_1">
                                <div>
                                    <form wire:submit.prevent="saveBonCommandeVente" class="form">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <div class="input-group ">
                                                        <input type="date" class="form-control" placeholder=" " wire:model.defer="date"/>
                                                        <label>{{ __('Date') }}</label>
                                                    </div>
                                                    @error('date')
                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="ref"/>
                                                    <label>{{ __('Bon commande Ref.') }}</label>
                                                </div>
                                                @error('ref')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col" x-data="{ isOpen: false }">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" x-on:keyup="isOpen=true" wire:keyup="showCommercial()" placeholder=" " wire:model.defer="commercial"/>
                                                    <label>{{ __('Commercial') }}</label>
                                                    <ul x-show="isOpen" x-on:click.away="isOpen=false" class="absolute z-10 cursor-pointer bg-indigo-500 mt-13 text-white py-2 w-1/9">
                                                        @if (!empty($list_commercials))
                                                            @foreach ($list_commercials as $item)
                                                                <li class="py-1" x-on:click="isOpen= !isOpen"
                                                                    wire:click="getCommercial('{{ $item->id }}','{{ $item->name }}')">
                                                                    {{ $item->name }} </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                                @error('commercialId')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="client_ref"/>
                                                    <label>{{ __('Client Ref.') }}</label>
                                                </div>
                                                @error('ref')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col" x-data="{ isOpen: false }">
                                                <div class="input-group">
                                                    <input type="text" class=" form-control" wire:model="client" x-on:keyup="isOpen=true" wire:keyup="showClient()" placeholder=" " />
                                                    <label>{{ __('Client') }}</label>
                                                    <ul x-show="isOpen" x-on:click.away="isOpen=false" class="absolute z-10 cursor-pointer bg-indigo-500 mt-13 text-white py-3 w-1/9">
                                                        @if (!empty($list_clients))
                                                            @foreach ($list_clients as $item)
                                                                <li class="py-1" x-on:click="isOpen= !isOpen"
                                                                    wire:click="getClient('{{ $item->id }}','{{ $item->name }}')">
                                                                    {{ $item->name }} </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                                @error('clientId')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @if ($interne)
                                                <div x-data={} class="col">
                                                    <div class="input-group">
                                                        <select  class="form-control" placeholder=" " wire:model.lazy="clientDepotId" >
                                                            <option value="0">Choisir un Depot</option>
                                                            @foreach ($list_pedots as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                            @endforeach
                                                        </select>
                                                        <label>{{ __('Depot Client') }}</label>
                                                    </div>
                                                    @error('clientDepotId')
                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control" placeholder="Rechercher un Article" wire:model="search"/>
                                                    <div >
                                                        <span>
                                                            <i class="flaticon2-search-1 text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-vertical-center table-bordered">
                                                <thead >
                                                    <tr class="text-left">

                                                        <th class="">{{ __('Libellé') }}</th>

                                                        <th class="">{{ __('Depot') }}</th>

                                                        <th class="">{{ __('Site') }}</th>

                                                        <th class="">{{ __('Num lot.') }}</th>

                                                        <th class="">{{ __('Quantité') }}</th>

                                                        <th class="">{{ __('Prix d\' achat') }}</th>

                                                        <th class=""></th>

                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @if (count($listArticles) > 0)

                                                        @foreach ($listArticles as $i => $item)
                                                            <tr  @if ($loop->even) @endif>
                                                                <td class="p-2 border border-gray-200">
                                                                    {{ $item->article->libelle }}
                                                                </td>
                                                                <td class="p-2 border border-gray-200">
                                                                    {{ $item->depot->name }}
                                                                </td>

                                                                <td class="p-2 border border-gray-200">
                                                                    {{ $item->site->name }}
                                                                </td>
                                                                <td class="p-2 border border-gray-200">
                                                                    {{ $item->num_lot }}
                                                                </td>
                                                                <td class="p-2 border border-gray-200">
                                                                    {{ $item->qte }}
                                                                </td>
                                                                <td class="p-2 border border-gray-200">
                                                                    {{ $item->prix_achat }}
                                                                </td>
                                                                <td class="p-2 border border-gray-200">
                                                                    <div x-data="{ 'isDialogOpen': false, qte: null, prix: null,lot:null, qmax:{{ $item->qte }} }"
                                                                        @keydown.escape="isDialogOpen = false">
                                                                        <button type="button" @click="isDialogOpen = true"
                                                                        class="btn btn-primary font-weight-bold btn-pill">Ajouter</button>

                                                                            <div class=" overflow-auto"
                                                                            style="background-color: rgba(0,0,0,0.5)"
                                                                            x-show="isDialogOpen"
                                                                            :class="{ 'fixed inset-0 z-10 flex items-start justify-center': isDialogOpen }">

                                                                            <div class="bg-white shadow-2xl m-auto"
                                                                                x-show="isDialogOpen">

                                                                                <div
                                                                                    class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                                                                    <h6 class="text-xl font-bold">Entrer La quantité et
                                                                                        le prix:
                                                                                        <span
                                                                                            class="text-indigo-700">{{ $item->ref }}</span>
                                                                                    </h6>
                                                                                    <button type="button"
                                                                                        @click="isDialogOpen = false">✖</button>
                                                                                </div>

                                                                                <div class="p-2">
                                                                                    <div>
                                                                                        <div>

                                                                                            <div
                                                                                                class="grid grid-cols-{{$interne?3:2}} gap-4 p-4 mb-8">

                                                                                                <label class="block">
                                                                                                    <span
                                                                                                        class="text-gray-700">QTE</span><span
                                                                                                        class="text-red-500">*</span>
                                                                                                    <input type="number" x-model="qte"
                                                                                                        class="block w-full mt-1 form-input"
                                                                                                        placeholder="">
                                                                                                    <span class="text-red-500"
                                                                                                        x-show="qte>qmax">la quantité
                                                                                                        doit être inférieure à
                                                                                                        {{ $item->qte }}</span>
                                                                                                </label>

                                                                                                <label class="block">
                                                                                                    <span
                                                                                                        class="text-gray-700">Prix</span><span
                                                                                                        class="text-red-500">*</span>
                                                                                                    <input type="number" x-model="prix"
                                                                                                        class="block w-full mt-1 form-input"
                                                                                                        placeholder="">
                                                                                                </label>
                                                                                                @if ($interne)
                                                                                                    <label class="block">
                                                                                                        <span class="text-gray-700">BR
                                                                                                            Num Lot</span><span
                                                                                                            class="text-red-500">*</span>
                                                                                                        <input type="text" x-model="lot"
                                                                                                            class="block w-full mt-1 form-input"
                                                                                                            placeholder="">
                                                                                                    </label>
                                                                                                @endif

                                                                                            </div>
                                                                                            <div class="text-right pt-3 pr-4"
                                                                                                x-show="qte>0 && qte<=qmax && prix>0">
                                                                                                <button type="button"
                                                                                                    class="inline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25"
                                                                                                    @click="$wire.add({{ $loop->index }},qte,prix,lot);isDialogOpen = false">Valider</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center" colspan="10">
                                                                Aucun enregistrement à afficher
                                                            </td>
                                                        </tr>
                                                    @endif


                                                </tbody>

                                            </table>
                                        </div>

                                        <div class="table-responsive">
                                            <h1 class="order-b py-8 font-bold text-black text-center text-xl tracking-widest uppercase"></h1>

                                            <table class="table table-vertical-center table-bordered" id="kt_advance_table_widget_4">
                                                <thead>
                                                    <tr class="text-left">
                                                        <th class="pl-0">{{ __('CODE
                                                            ARTICLE') }}</th>
                                                        <th class="pl-0">{{ __('LIBELLE') }}</th>
                                                        <th class="pl-0">{{ __('Depot') }} </th>
                                                        <th class="pl-0">{{ __('Site') }}</th>
                                                        <th class="pl-0">{{ __('Num LOT') }}</th>
                                                        <th class="pl-0">{{ __('BR Num LOT') }}</th>
                                                        <th class="pl-0">{{ __('QTE') }}</th>
                                                        <th class="pl-0">{{ __('PRIX') }}</th>
                                                        <th class="pl-0">{{ __('MONTANT') }}</th>
                                                        <th class="pl-0">{{ __('TVA') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($code as $value => $item)
                                                        @php
                                                            // $produits[$value] = new Produit($produits[$value])
                                                        @endphp
                                                        <tr x-data="{isOpen{{ $value }}:false}">
                                                            <td class="pl-0">
                                                                @isset($code[$value])
                                                                    {{ $code[$value] }}
                                                                @endisset
                                                            </td>

                                                            <td class="pl-0">
                                                                @isset($libelle[$value])
                                                                    {{ $libelle[$value] }}
                                                                @endisset
                                                            </td>
                                                            <td class="pl-0">
                                                                @isset($produits[$value])
                                                                    {{ $produits[$value]->depot['name'] }}
                                                                @endisset

                                                            </td>
                                                            <td class="pl-0">
                                                                @isset($produits[$value])
                                                                    {{ $produits[$value]->site['name'] }}
                                                                @endisset

                                                            </td>
                                                            <td class="pl-0">
                                                                @isset($produits[$value])
                                                                    {{ $produits[$value]->num_lot }}
                                                                @endisset

                                                            </td>
                                                            <td class="pl-0">
                                                                @isset($numLot[$value])
                                                                    <input class="w-full py-1" wire:model.defer="numLot.{{ $value }}" type="text"/>
                                                                @endisset
                                                            </td>
                                                            <td class="pl-0">
                                                                <input class="w-full py-1" wire:model.defer="qte.{{ $value }}" type="text" wire:change="updateData({{ $value }})" />
                                                            </td>
                                                            <td class="pl-0">
                                                                <input class="w-full py-1" wire:model.defer="prix.{{ $value }}" type="text" wire:change="updateData({{ $value }})" />
                                                            </td>

                                                            <td class="pl-0">
                                                                @isset($montant[$value])
                                                                    {{ number_format($montant[$value], 2, ',', ' ') }}
                                                                @endisset
                                                            </td>
                                                            <td class="pl-0">
                                                                @isset($tva[$value])
                                                                    {{ $tva[$value] }}%
                                                                @endisset
                                                            </td>
                                                            <td class="pl-0">
                                                                <button type="button" class="w-7 rounded-md text-white bg-red-700" wire:click="remove({{ $value }})">X</button>

                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                </tbody>

                                            </table>
                                            <table class="table table-sm table-bordered  table-striped " style="width: 40%;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('TVA') }}</th>
                                                        <th scope="col">{{ __('Total ') }}</th>
                                                        <th scope="col">{{ __('Total TVA') }}</th>
                                                        <th scope="col">{{ __('Total TTC') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($totalTvas as $key => $value)
                                                        <tr>
                                                            <td class="p-2 border border-gray-200">
                                                                {{ $key }} %
                                                            </td>
                                                            <td class="p-2 border border-gray-200">
                                                                {{ number_format($totalMts[$key], 2, ',', ' ') }}
                                                            </td>

                                                            <td class="p-2 border border-gray-200">
                                                                {{ number_format($value, 2, ',', ' ') }}
                                                            </td>

                                                            <td class="p-2 border border-gray-200">
                                                                {{ number_format($totalTtcs[$key], 2, ',', ' ') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="bg-gray-300">
                                                        <th
                                                            class="px-6 py-3 bg-gray-400 text-left text-xs font-medium  uppercase tracking-wider">
                                                            TOTaux
                                                        </th>
                                                        <td class="p-2 border border-gray-200">
                                                            {{ number_format($totalMt, 2, ',', ' ') }}
                                                        </td>
                                                        <td class="p-2 border border-gray-200">
                                                            {{ number_format($totalTva, 2, ',', ' ') }}
                                                        </td>

                                                        <td class="p-2 border border-gray-200">
                                                            {{ number_format($totalTtc, 2, ',', ' ') }}
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>

                                            <div class="block text-right pt-3">
                                                <button type="submit" class="btn btn-primary font-weight-bold btn-pill">
                                                    <i class="far fa-save"></i> Enregistrer
                                                </button>
                                            </div>
                                        </div>


                                    </form>
                                </div>

                            </div>
                            <div class="tab-pane fade " id="lient_tab_2" role="tabpanel" aria-labelledby="lient_tab_2">
                                @livewire('vente.liste-bon-commande-vente')
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- <div class="p-5 bg-white" x-data="{ openTab: 2 }">
    <ul class="flex border-b mx-5">
        <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-indigo-700' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                Nouveau bon de commande
            </a>
        </li>
        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-indigo-700' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                Liste bon de commandes
            </a>
        </li>
    </ul>
    <div x-show="openTab === 1">
        <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __(' Création bon de commande') }}
                </h2>
            </x-slot>
            <form wire:submit.prevent="saveBonCommandeVente">
                <div class="grid grid-cols-6 gap-4 p-4 mb-8">
                    <label class="block">
                        <span class="text-gray-700">Date</span>
                        <input wire:model.lazy="date" id="datepicker" type="date" class="block w-full mt-1 form-input"
                            id="date" autocomplete="date">
                        @error('date') <span class="text-red-500">{{ $message }}</span> @enderror

                    </label>
                    <label class="block">
                        <span class="text-gray-700">Bon commande Ref.</span>
                        <input type="text" wire:model.lazy.defer="ref" class="block w-full mt-1 form-input"
                            placeholder="">
                        @error('ref') <span class="text-red-500">{{ $message }}</span> @enderror

                    </label>


                    <label class="block" x-data="{ isOpen: false }">
                        <span class="text-gray-700">Commercial</span>
                        <input wire:model="commercial" x-on:keyup="isOpen=true" wire:keyup="showCommercial()"
                            class="block w-full mt-1 form-input" type="text" />


                        <ul x-show="isOpen" x-on:click.away="isOpen=false"
                            class="absolute z-10 cursor-pointer bg-indigo-500 mt-2 text-white py-1 w-1/6">
                            @if (!empty($list_commercials))
                                @foreach ($list_commercials as $item)
                                    <li class="py-1" x-on:click="isOpen= !isOpen"
                                        wire:click="getCommercial('{{ $item->id }}','{{ $item->name }}')">
                                        {{ $item->name }} </li>
                                @endforeach
                            @endif
                        </ul>

                        @error('commercialId') <span class="text-red-500">{{ $message }}</span> @enderror
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Client Ref.</span>
                        <input type="text" wire:model.lazy.defer="client_ref" class="block w-full mt-1 form-input"
                            placeholder="">
                        @error('ref') <span class="text-red-500">{{ $message }}</span> @enderror

                    </label>
                    <label x-data="{ isOpen: false }" class="block">
                        <span class="text-gray-700">Client</span>
                        <input wire:model="client" x-on:keyup="isOpen=true" wire:keyup="showClient()"
                            class="block w-full mt-1 form-input" type="text" />


                        <ul x-show="isOpen" x-on:click.away="isOpen=false"
                            class="absolute z-10 cursor-pointer bg-indigo-500 mt-2 text-white py-1 w-1/6">
                            @if (!empty($list_clients))
                                @foreach ($list_clients as $item)
                                    <li class="py-1" x-on:click="isOpen= !isOpen"
                                        wire:click="getClient('{{ $item->id }}','{{ $item->name }}')">
                                        {{ $item->name }} </li>
                                @endforeach
                            @endif
                        </ul>
                        @error('clientId') <span class="text-red-500">{{ $message }}</span> @enderror
                    </label>
                    @if ($interne)
                        <label x-data={} class="block">
                            <span class="text-gray-700">Depot Client</span>
                            <select wire:model.lazy.defer="clientDepotId"
                                class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Choisir un Depot</option>
                                @foreach ($list_pedots as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                                @endforeach
                            </select>
                            @error('clientDepotId') <span class="text-red-500">{{ $message }}</span> @enderror
                        </label>

                    @endif
                </div>
                <div class="grid grid-cols-6 gap-4 p-4 mb-8">
                    <label class="block">
                        <span class="text-gray-700">Rechercher un Article</span>
                        <input type="text" wire:model="search" class="block w-full mt-1 form-input" placeholder="">

                    </label>
                </div>
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            libelle
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Depot
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Site
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Num lot.
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Quantité</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Prix d'achat</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if (count($listArticles) > 0)

                                        @foreach ($listArticles as $i => $item)
                                            <tr @if ($loop->even) class="bg-grey" @endif>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    {{ $item->article->libelle }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    {{ $item->depot->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    {{ $item->site->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->num_lot }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->qte }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    {{ $item->prix_achat }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">

                                                    <div x-data="{ 'isDialogOpen': false, qte: null, prix: null,lot:null, qmax:{{ $item->qte }} }"
                                                        @keydown.escape="isDialogOpen = false">
                                                        <button type="button" @click="isDialogOpen = true"
                                                            class="inline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25" ">Ajouter</button>

                                                            <div class=" overflow-auto"
                                                            style="background-color: rgba(0,0,0,0.5)"
                                                            x-show="isDialogOpen"
                                                            :class="{ 'fixed inset-0 z-10 flex items-start justify-center': isDialogOpen }">

                                                            <div class="bg-white shadow-2xl m-auto"
                                                                x-show="isDialogOpen">

                                                                <div
                                                                    class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                                                    <h6 class="text-xl font-bold">Entrer La quantité et
                                                                        le prix:
                                                                        <span
                                                                            class="text-indigo-700">{{ $item->ref }}</span>
                                                                    </h6>
                                                                    <button type="button"
                                                                        @click="isDialogOpen = false">✖</button>
                                                                </div>

                                                                <div class="p-2">
                                                                    <div>
                                                                        <div>

                                                                            <div
                                                                                class="grid grid-cols-{{$interne?3:2}} gap-4 p-4 mb-8">

                                                                                <label class="block">
                                                                                    <span
                                                                                        class="text-gray-700">QTE</span><span
                                                                                        class="text-red-500">*</span>
                                                                                    <input type="number" x-model="qte"
                                                                                        class="block w-full mt-1 form-input"
                                                                                        placeholder="">
                                                                                    <span class="text-red-500"
                                                                                        x-show="qte>qmax">la quantité
                                                                                        doit être inférieure à
                                                                                        {{ $item->qte }}</span>
                                                                                </label>

                                                                                <label class="block">
                                                                                    <span
                                                                                        class="text-gray-700">Prix</span><span
                                                                                        class="text-red-500">*</span>
                                                                                    <input type="number" x-model="prix"
                                                                                        class="block w-full mt-1 form-input"
                                                                                        placeholder="">
                                                                                </label>
                                                                                @if ($interne)
                                                                                    <label class="block">
                                                                                        <span class="text-gray-700">BR
                                                                                            Num Lot</span><span
                                                                                            class="text-red-500">*</span>
                                                                                        <input type="text" x-model="lot"
                                                                                            class="block w-full mt-1 form-input"
                                                                                            placeholder="">
                                                                                    </label>
                                                                                @endif

                                                                            </div>
                                                                            <div class="text-right pt-3 pr-4"
                                                                                x-show="qte>0 && qte<=qmax && prix>0">
                                                                                <button type="button"
                                                                                    class="inline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25"
                                                                                    @click="$wire.add({{ $loop->index }},qte,prix,lot);isDialogOpen = false">Valider</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center" colspan="10">
                                                Aucun enregistrement à afficher
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="i overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                CODE
                                                ARTICLE
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                LIBELLE
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                Depot
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                Site
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                Num LOT
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                BR Num LOT
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                QTE
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                PRIX
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                MONTANT
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                TVA
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">

                                        @foreach ($code as $value => $item)
                                            @php
                                                // $produits[$value] = new Produit($produits[$value])
                                            @endphp

                                            <tr x-data="{isOpen{{ $value }}:false}">
                                                <td class="p-2 border border-gray-200">
                                                    @isset($code[$value])
                                                        {{ $code[$value] }}
                                                    @endisset
                                                </td>
                                                <td class="p-2 border border-gray-200">
                                                    @isset($libelle[$value])
                                                        {{ $libelle[$value] }}
                                                    @endisset
                                                </td>
                                                <td class="p-2 border border-gray-200">

                                                    @isset($produits[$value])
                                                        {{ $produits[$value]->depot['name'] }}
                                                    @endisset
                                                </td>

                                                <td class="p-2 border border-gray-200">
                                                    @isset($produits[$value])
                                                        {{ $produits[$value]->site['name'] }}
                                                    @endisset

                                                </td>

                                                <td class="p-2 border border-gray-200">
                                                    @isset($produits[$value])
                                                        {{ $produits[$value]->num_lot }}
                                                    @endisset
                                                </td>

                                                <td class="p-2 border border-gray-200">
                                                    @isset($numLot[$value])
                                                    <input class="w-full py-1"
                                                        wire:model.defer="numLot.{{ $value }}" type="text"/>
                                                    @endisset
                                                </td>
                                                <td class="p-2 border border-gray-200">
                                                    <input class="w-full py-1"
                                                        wire:model.defer="qte.{{ $value }}" type="text"
                                                        wire:change="updateData({{ $value }})" />

                                                </td>
                                                <td class="p-2 border border-gray-200">
                                                    <input class="w-full py-1"
                                                        wire:model.defer="prix.{{ $value }}" type="text"
                                                        wire:change="updateData({{ $value }})" />
                                                </td>
                                                <td class="p-2 border border-gray-200">
                                                    @isset($montant[$value])
                                                        {{ number_format($montant[$value], 2, ',', ' ') }}
                                                    @endisset
                                                </td>
                                                <td class="p-2 border border-gray-200">
                                                    @isset($tva[$value])
                                                        {{ $tva[$value] }}%
                                                    @endisset
                                                </td>
                                                <td>
                                                    <button type="button" class="w-7 rounded-md text-white bg-red-700"
                                                        wire:click="remove({{ $value }})">X</button>

                                                </td>
                                            </tr>

                                        @endforeach

                                        <br>


                                        <table>
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                        TVA
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                        Total
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                        Total TVA
                                                    </th>

                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                        Total TTC
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($totalTvas as $key => $value)
                                                    <tr>
                                                        <td class="p-2 border border-gray-200">
                                                            {{ $key }} %
                                                        </td>
                                                        <td class="p-2 border border-gray-200">
                                                            {{ number_format($totalMts[$key], 2, ',', ' ') }}
                                                        </td>

                                                        <td class="p-2 border border-gray-200">
                                                            {{ number_format($value, 2, ',', ' ') }}
                                                        </td>

                                                        <td class="p-2 border border-gray-200">
                                                            {{ number_format($totalTtcs[$key], 2, ',', ' ') }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                <tr class="bg-gray-300">
                                                    <th
                                                        class="px-6 py-3 bg-gray-400 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                        TOTaux
                                                    </th>
                                                    <td class="p-2 border border-gray-200">
                                                        {{ number_format($totalMt, 2, ',', ' ') }}
                                                    </td>
                                                    <td class="p-2 border border-gray-200">
                                                        {{ number_format($totalTva, 2, ',', ' ') }}
                                                    </td>

                                                    <td class="p-2 border border-gray-200">
                                                        {{ number_format($totalTtc, 2, ',', ' ') }}
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right pt-3">
                    <button type="submit"
                        class="nline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25">
                        Enregistrer
                    </button>
                </div>

            </form>
        </div>
    </div>
    <div x-show="openTab === 2">
        @livewire('vente.liste-bon-commande-vente')
    </div>
</div> --}}
