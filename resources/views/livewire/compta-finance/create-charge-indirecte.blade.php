<div class="p-5 bg-white" x-data="{ openTab: 1 }">
    <ul class="flex border-b mx-5">
        <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-white bg-indigo-700' : 'text-gray-700 hover:text-gray-800'"
                class="bg-white inline-block py-2 px-4 font-sm" href="#">
                Nouvelle charge indirecte
            </a>
        </li>

        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-white bg-indigo-700' : 'text-gray-700 hover:text-gray-800'"
                class="bg-white inline-block py-2 px-4 font-sm" href="#">
                Liste des charges indirectes
            </a>
        </li>

    </ul>

    <div x-show="openTab === 1">
        <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Création charges indirectes') }}
                </h2>
            </x-slot>
            @if (session()->has('message'))
                <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                    <span class="inline-block align-middle mr-8">
                        {{ session('message') }}
                    </span>
                </div>
            @endif

        <form wire:submit.prevent="saveChargeDirecte">

            <div class="grid grid-cols-6 gap-4 p-4 mb-8">

                <label class="block">
                    <span class="text-gray-700">Ref.</span>
                    <input type="text" wire:model.lazy="refCharge" class="block w-full mt-1 form-input" placeholder="">
                </label>

                <label class="block">
                    <span class="text-gray-700">Site</span>
                    <select wire:model="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="0"> Choisir un site</option>
                            @foreach ($list_sites as $item)
                                <option value="{{ $item->id }}">{{ $item->code }} | {{ $item->name}} </option>
                            @endforeach
                    </select>
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

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Fournisseur
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Code comptable
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Num facture
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Libellé opération
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

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Libellé Compte HT
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Compte TVA
                                        </th>


                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="p-2 border border-gray-200">
                                            <input type="date" wire:model="date.0" />
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <select wire:model.lazy.defer="fournisseurId.0" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:change="updateData(0)">
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
                                            <input wire:model.defer="montant.0" class="w-full py-1" type="text" wire:change="updateData(0)" />
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <select wire:model.defer="tauxTva.0" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:change="updateData(0)">
                                                <option value="0"> Choisir un taux de TVA</option>
                                                    <option value="0">0% </option>
                                                    <option value="7">7% </option>
                                                    <option value="10">10% </option>
                                                    <option value="14">14% </option>
                                                    <option value="20">20% </option>
                                            </select>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            @isset($ventilation[0])
                                                {{$ventilation[0]}}
                                            @endisset
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            @isset($montant[0])
                                                {{ number_format($montantTva[0], 2, ',', ' ') }}
                                            @endisset
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            @isset($montant[0])
                                                {{ number_format($montantTtc[0], 2, ',', ' ') }}
                                            @endisset
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <select wire:model.lazy.defer="compteComptableHT.0" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:change="updateData(0)">
                                                <option value="0"> Choisir compte comptable</option>
                                                    @foreach ($comptes_comptable_HT  as $item)
                                                        <option value="{{ $item->id }}">{{ $item->code }} </option>
                                                    @endforeach
                                            </select>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            @isset($libelleCompteComptableHT[0])
                                                {{$libelleCompteComptableHT[0]}}
                                            @endisset
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <select wire:model.lazy.defer="compteComptableTVA.0" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="0"> Choisir compte comptable</option>
                                                    @foreach ($comptes_comptable_TVA  as $item)
                                                        <option value="{{ $item->id }}">{{ $item->code }} </option>
                                                    @endforeach
                                            </select>
                                        </td>

                                    </tr>
                                    @foreach ($inputs as $key)
                                        @php
                                            $value = $loop->index + 1;
                                        @endphp
                                        <tr>
                                            <td class="p-2 border border-gray-200">
                                                <input type="date" wire:model="date.{{$value}}" />
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <select wire:model.lazy.defer="fournisseurId.{{$value}}" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:change="updateData(.{{$value}})">
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
                                                <input wire:model.defer="montant.{{$value}}" class="w-full py-1" type="text" wire:change="updateData({{$value}})" />
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <select wire:model.lazy.defer="tauxTva.{{$value}}" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:change="updateData({{$value}})">
                                                    <option value="0"> Choisir un taux de TVA</option>
                                                        <option value="0">0% </option>
                                                        <option value="7">7% </option>
                                                        <option value="10">10% </option>
                                                        <option value="14">14% </option>
                                                        <option value="20">20% </option>
                                                </select>
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                @isset($ventilation[$value])
                                                    {{$ventilation[$value]}}
                                                @endisset
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                @isset($montant[$value])
                                                    {{ number_format($montantTva[$value], 2, ',', ' ') }}
                                                @endisset
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                @isset($montant[$value])
                                                    {{ number_format($montantTtc[$value], 2, ',', ' ') }}
                                                @endisset
                                            </td>

                                            <td class="p-2 border border-gray-200">
                                                <select wire:model.lazy.defer="compteComptableHT.{{$value}}" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:change="updateData({{$value}})">
                                                    <option value="0"> Choisir compte comptable</option>
                                                        @foreach ($comptes_comptable_HT  as $item)
                                                            <option value="{{ $item->id }}">{{ $item->code }} </option>
                                                        @endforeach
                                                </select>
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                @isset($libelleCompteComptableHT[$value])
                                                    {{$libelleCompteComptableHT[$value]}}
                                                @endisset
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <select wire:model.lazy.defer="compteComptableTVA.{{$value}}" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option value="0"> Choisir compte comptable</option>
                                                        @foreach ($comptes_comptable_TVA  as $item)
                                                            <option value="{{ $item->id }}">{{ $item->code }} </option>
                                                        @endforeach
                                                </select>
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
                                                    ligne</button>
                                            </td>
                                        </tr>
                                    </tfoot>
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
                            @if(!@empty($listVentilation))
                                <section class="flex flex-wrap p-4 h-full items-center" x-data="{ 'showModal': @entangle('showlistVentilation')}" @keydown.escape="showModal = false">

                                    <!--Overlay-->
                                    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
                                        <!--Dialog-->
                                        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90">

                                            <!--Title-->
                                            <div class="flex justify-between items-center pb-3">
                                                <p class="text-2xl font-bold">VENTILLATION DES DEDUCTIONS</p>
                                                <div class="cursor-pointer z-50" @click="showModal = false">
                                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- content -->
                                            @if(!@empty($listVentilation))
                                                <div x-show="open">
                                                    @foreach ($listVentilation as $key => $value)
                                                        <div class="mt-4">
                                                        @foreach ($value as $ke => $val)
                                                            <span class="text-gray-700">{{$ke}}</span>
                                                            <div class="mt-2">
                                                            @foreach ($val as $k => $v)
                                                                <label class="inline-flex items-center">
                                                                    <input wire:model="codeVentilation" type="radio" class="form-radio" name="codeVentilation" value="{{$k}}">
                                                                    <span class="ml-2">{{$v}}</span>
                                                                </label>
                                                            @endforeach
                                                            </div>
                                                        @endforeach
                                                        </div>

                                                    @endforeach

                                                </div>
                                            @endif

                                        </div>
                                        <!--/Dialog -->
                                    </div><!-- /Overlay -->

                                </section>
                            @endif
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
