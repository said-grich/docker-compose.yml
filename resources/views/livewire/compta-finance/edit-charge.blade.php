@section('title', "Modification charges directes")
@section('header_title', "Modification charges directes")
<div class="p-5 bg-white">

    <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Création charges directes') }}
            </h2>
        </x-slot>
        @if (session()->has('message'))
            <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                <span class="inline-block align-middle mr-8">
                    {{ session('message') }}
                </span>
            </div>
        @endif

        <form wire:submit.prevent="editCharge">

            <div class="grid grid-cols-6 gap-4 p-4 mb-8">


                <label class="block">
                    <span class="text-gray-700">Charge ref.</span>
                    <input type="text" wire:model.lazy="refCharge" class="block w-full mt-1 form-input" placeholder="" disabled>
                    @error('refCharge') <span class="text-red-500">{{ $message }}</span> @enderror

                </label>

                <label class="block">
                    <span class="text-gray-700">Site</span>
                    <select wire:model="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled>
                        <option value="0"> Choisir un site</option>
                            @foreach ($list_sites as $item)
                                <option value="{{ $item->id }}">{{ $item->code }} | {{ $item->name}} </option>
                            @endforeach
                    </select>
                    @error('siteId') <span class="text-red-500">{{ $message }}</span> @enderror

                </label>

                <label class="block">
                    <span class="text-gray-700">Bon de réception</span>
                    <select wire:model="bcRef" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled>
                        <option value="0"> Choisir un bon de réception</option>
                            @foreach ($list_bc as $item)
                                <option value="{{ $item->ref }}">{{ $item->ref }} | {{ $item->fournisseur->name}} </option>
                            @endforeach
                    </select>
                    @error('bcRef') <span class="text-red-500">{{ $message }}</span> @enderror

                </label>

                <label class="block">
                    <span class="text-white">Ajouter un fournisseur</span>
                    {{-- <div x-data="{ 'isDialogOpen': false }" @keydown.escape="isDialogOpen = false">
                        <button type="button" @click="isDialogOpen = true"
                            class="inline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25" ">Ajouter un fournisseur</button>

                        <div class=" overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="isDialogOpen" :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }">
                            <div class="bg-white shadow-2xl m-auto" x-show="isDialogOpen">

                                <div class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                    <h6 class="text-xl font-bold">Ajouter un fourniseur:  </h6>
                                    <button type="button" @click="isDialogOpen = false">✖</button>
                                </div>

                                <div class="p-2">
                                    @livewire('achat.show-fournisseur')
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </label>



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
                                            Date
                                        </th>

                                        <th scope="col" class="flex justify-between items-center px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Fournisseur

                                            <!--Button trigger modal-->
                                            <button type="button" class="btn btn-primary font-weight-light btn-pill" data-toggle="modal" data-target="#staticBackdrop">
                                                <i class="flaticon-plus"></i> {{ __('Nouveau FR') }}
                                            </button>
                                            <!--Modal-->
                                            <div wire:ignore.self class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Nouveau fournisseur') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @livewire('achat.show-fournisseur')
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div x-data="{ 'isDialogOpen': false }" @keydown.escape="isDialogOpen = false">
                                                <button type="button" @click="isDialogOpen = true"
                                                    class="inline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25" ">Nouveau FR</button>

                                                <div class=" overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="isDialogOpen" :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }">
                                                    <div class="bg-white shadow-2xl m-auto" x-show="isDialogOpen">

                                                        <div class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                                            <h6 class="text-xl font-bold">Ajouter un fourniseur:  </h6>
                                                            <button type="button" @click="isDialogOpen = false">✖</button>
                                                        </div>

                                                        <div class="p-2">
                                                            @livewire('achat.show-fournisseur')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Code comptable
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Num facture
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Libellé opération
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Montant TTC
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    {{-- <tr>
                                        <td class="p-2 border border-gray-200">
                                            <input type="date" wire:model="date.0" />
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <select wire:model="fournisseurId.0" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                                                <option value="0"> Choisir fournisseur</option>
                                                    @foreach ($list_fournisseurs as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                    @endforeach
                                            </select>

                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            @isset($compteComptableFournisseur[0])
                                                {{$compteComptableFournisseur[0]}}
                                            @endisset
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input wire:model="numFacture.0" class="w-full py-1" type="text" />
                                        </td>

                                        <td class="p-2 border border-gray-200">
                                            <input wire:model="libelle.0" class="w-full py-1" type="text" />
                                        </td>

                                        <td class="p-2 border border-gray-200">
                                            <label class="block">
                                                <input type="text"
                                                    class="block w-full mt-1 form-input"
                                                    wire:model="mt.0" />
                                                    <select wire:model="selectedTaux.0" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" {>
                                                        <option value="0"> Choisir un taux de TVA</option>
                                                        <option value="0">0% </option>
                                                        <option value="7">7% </option>
                                                        <option value="10">10% </option>
                                                        <option value="14">14% </option>
                                                        <option value="20">20% </option>
                                                </select>
                                            </label>
                                        </td>

                                    </tr> --}}
                                    @foreach ($inputs as $key)
                                        @php
                                            $value = $loop->index;
                                        @endphp
                                        <tr>

                                            <td class="p-2 border border-gray-200">
                                                <input type="date" wire:model="date.{{$value}}" />
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <select wire:model="fournisseurId.{{$value}}" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" {{-- wire:change="updateData({{$value}})" --}}>
                                                    <option value="0"> Choisir fournisseur</option>
                                                        @foreach ($list_fournisseurs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                        @endforeach
                                                </select>

                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                @isset($compteComptableFournisseur[$value])
                                                    {{$compteComptableFournisseur[$value]}}
                                                @endisset
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <input wire:model="numFacture.{{$value}}" class="w-full py-1" type="text" />
                                            </td>

                                            <td class="p-2 border border-gray-200">
                                                <input wire:model="libelle.{{$value}}" class="w-full py-1" type="text" />
                                            </td>

                                            <td class="p-2 border border-gray-200">
                                                <label class="block">
                                                    <input type="text"
                                                        class="block w-full mt-1 form-input"
                                                        wire:model="mt.{{$value}}"
                                                        {{-- wire:change="updateData(0)" --}}/>

                                                        <select wire:model="selectedTaux.{{$value}}" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" {{-- wire:change="updateData(0)" --}}>
                                                            <option value="0"> Choisir un taux de TVA</option>
                                                            <option value="0">0% </option>
                                                            <option value="7">7% </option>
                                                            <option value="10">10% </option>
                                                            <option value="14">14% </option>
                                                            <option value="20">20% </option>
                                                    </select>
                                                </label>
                                                <div class="mt-2 grid grid-cols-5 gap-2">


                                                {{--  @foreach ($listTauxTva as $k =>$v)
                                                    <div>
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox"
                                                        class="form-checkbox"
                                                        wire:model="selectedTaux.{{$value}}"
                                                        value="{{$v}}"  wire:change="updateData({{$value}})"/>
                                                        <span class="ml-2">{{$v}}%</span>
                                                    </label>
                                                    </div>
                                                @endforeach --}}
                                                </div>


                                                        {{-- <select wire:model="selectedTaux.0" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                                                        <option value="0"> Choisir un taux de TVA</option>
                                                        <option value="0">0% </option>
                                                        <option value="7">7% </option>
                                                        <option value="10">10% </option>
                                                        <option value="14">14% </option>
                                                        <option value="20">20% </option>
                                                    </select> --}}

                                            </td>

                                            <td>
                                                <button type="button" class="w-7 rounded-md text-white bg-red-700"
                                                    wire:click="remove({{ $loop->index + 1 }})">X</button>

                                            </td>

                                        </tr>

                                    @endforeach

                                    <tfoot>
                                        <tr>
                                            <td class="text-left pt-3" style="padding-bottom: 12px;">
                                                <button
                                                    class="inline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25"
                                                    wire:click.prevent="add()">Ajouter une
                                                    facture</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </tbody>

                            </table>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Facture
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            MONTANT HT
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            TVA
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Ventilation des déductions
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            MONTANT TVA
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            MONTANT TTC
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Compte HT
                                        </th>

                                        {{-- <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Libellé Compte HT
                                        </th> --}}

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Compte TVA
                                        </th>


                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">

                                    @foreach ($facturedetails as $key=>$value)
                                        @php
                                        //dd($loop)
                                            $index = $loop->index;
                                        @endphp
                                        <tr>
                                            <td class="p-2 border border-gray-200">
                                                <input type="hidden" wire:model="numFactureLine.{{$index}}" class="block w-full mt-1 form-input" placeholder="">
                                                {{$value["facture"]}}
                                                {{-- @isset($factureDetails[$value])
                                                {{$factureDetails[$value]}}
                                                @endisset --}}
                                            </td>

                                            <td class="p-2 border border-gray-200">
                                                <input type="hidden" wire:model="mtHt.{{$index}}" class="block w-full mt-1 form-input" placeholder="">
                                                @isset($value["montantHt"])
                                                    {{ number_format(floatval($value["montantHt"]), 2, ',', ' ') }}
                                                @endisset
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                {{$key}}
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <select wire:model="codeVentilation.{{$index}}" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm ">
                                                    @if (!empty($listVentilation[$index]))

                                                    <option value="0"> Choisir une ventilation</option>
                                                    @foreach ($listVentilation[$index] as $i => $line)
                                                        @foreach ($line as $ke => $val)
                                                            <optgroup label="{{$ke}}">
                                                                @foreach ($val as $k => $v)
                                                                    <option value="{{$k}}">{{$k}} | {{$key}}% {{$v}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <input type="hidden" wire:model="mtTva.{{$index}}" class="block w-full mt-1 form-input" placeholder="">
                                                @isset($value["montantTva"][$key])
                                                    {{ number_format(floatval($value["montantTva"][$key]), 2, ',', ' ') }}
                                                @endisset
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <input type="text" wire:model="mtTtc.{{$index}}" class="block w-full mt-1 form-input" placeholder="">
                                                {{-- @isset($value["montantTtc"][$key])
                                                    {{ number_format(floatval($value["montantTtc"][$key]), 2, ',', ' ') }}
                                                @endisset --}}
                                            </td>

                                            <td class="p-2 border border-gray-200">
                                                <input type="hidden" wire:model="compteHt.{{$index}}" class="block w-full mt-1 form-input" placeholder="">
                                                <select wire:model="compteHt.{{$index}}" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                                                    <option value="0"> Choisir compte comptable</option>
                                                        @foreach ($comptes_comptable_HT  as $item)
                                                            <option value="{{ $item->id }}">{{ $item->code }} | {{ $item->name }} </option>
                                                        @endforeach
                                                </select>
                                            </td>
                                            {{-- <td class="p-2 border border-gray-200">
                                                @isset($libelleCompteComptableHT[$index])
                                                    {{$libelleCompteComptableHT[$index]}}
                                                @endisset
                                            </td> --}}
                                            <td class="p-2 border border-gray-200">
                                                <select wire:model.lazy.defer="compteTva.{{$index}}" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option value="0"> Choisir compte comptable</option>
                                                        @foreach ($comptes_comptable_TVA  as $item)
                                                            <option value="{{ $item->id }}">{{ $item->code }} | {{ $item->name }}</option>
                                                        @endforeach
                                                </select>
                                                @error('compteComptableTVA') <span class="text-red-500">{{ $message }}</span> @enderror

                                            </td>
                                            <td>

                                            </td>

                                        </tr>

                                    @endforeach


                                </tbody>

                            </table>
                            <div class="flex  justify-between">

                                <table>
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                TVA
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                Total HT
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
                                                    {{ number_format($totalHts[$key], 2, ',', ' ') }}
                                                </td>

                                                <td class="p-2 border border-gray-200">
                                                    {{ number_format($value, 2, ',', ' ') }}
                                                </td>

                                                <td class="p-2 border border-gray-200">
                                                    {{ number_format($totalTtcs[$key], 2, ',', ' ') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                                    <table>
                                    <tr>
                                        <th
                                            class="px-6 py-3 bg-gray-200 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Total HT
                                        </th>
                                        <td class="p-2 border border-gray-200">
                                            {{ number_format($totalHt , 2, ',', ' ') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th
                                            class="px-6 py-3 bg-gray-200 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Total TVA
                                        </th>
                                        <td class="p-2 border border-gray-200">
                                            {{ number_format($totalTva, 2, ',', ' ') }}
                                        </td>

                                    </tr>
                                    <tr>
                                        <th
                                            class="px-6 py-3 bg-gray-200 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Total TTC
                                        </th>
                                        <td class="p-2 border border-gray-200">
                                            {{ number_format($totalTtc, 2, ',', ' ') }}
                                        </td>

                                    </tr>
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
            </div>

        </form>
    </div>


</div>

