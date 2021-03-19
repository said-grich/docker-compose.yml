@section('title', 'Règlement fournisseur')
@section('header_title', 'Saisir un règlement fournisseur')
<div class="p-5" x-data="{ openTab: 2}">
    <ul class="flex border-b">
        <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-indigo-700' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                Nouveau règlement
            </a>
        </li>
        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-indigo-700' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                Liste règlement
            </a>
        </li>
        {{--<li @click="openTab = 3" :class="{ '-mb-px': openTab === 3 }" class="mr-1">
            <a :class="openTab === 3 ? 'border-l border-t border-r rounded-t text-indigo-700' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                Liste règlement impayé
            </a>
        </li>--}}

    </ul>
    <div x-show="openTab === 1">
        <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                   Saisir un règlement fournisseur
                </h2>
            </x-slot>

        <x-jet-form-section submit="createReglementFournisseur" style="padding-bottom: 45px;">
            <x-slot name="title">
                {{ __('Règlement fournisseur') }}
            </x-slot>

            <x-slot name="description">

            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700">Site</span>
                        <select  wire:model.lazy="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0"> Choisir un site</option>
                            @foreach ($list_sites as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="col-span-6 sm:col-span-4" >
                    <label class="block" >
                        <span class="text-gray-700">Compte débiteur</span>
                        <select  wire:model.lazy="CompteDebiteurId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0"> Choisir </option>
                            @foreach ($list_comptes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach

                        </select>
                    </label>

                </div>
                <div  x-data="" class="col-span-6 sm:col-span-4" >
                    <div class="col-span-6 sm:col-span-4">
                        <label class="block">
                            <span class="text-gray-700">Fournisseur</span>
                            <select  wire:model.lazy="fournisseurId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="0"> Choisir un fournisseur</option>
                                @foreach ($list_fournisseurs as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                                @endforeach
                            </select>
                            @error('fournisseurId') <span class="text-red-600">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <table  x-show="$wire.fournisseurId" class="mb-3 min-w-full divide-y divide-gray-200" style="margin-top: 23px;">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider"></th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Référence</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Montant</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if (!empty($list_bon_reception))
                                @foreach($list_bon_reception as $item)
                                    <tr class="bg-grey">
                                        <td class=" text-center"> <input type="checkbox" /> </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->ref }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->total_ttc }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div x-show="$wire.showCompteCrediteur" class="col-span-6 sm:col-span-4" >
                        <label class="block">
                            <span class="text-gray-700">Compte créditeur</span>
                            <select  wire:model.lazy="CompteCrediteurId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="0"> Choisir </option>
                                @foreach ($list_comptes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                                @endforeach

                            </select>
                        </label>
                    </div>
                </div>



                {{-- <div class="col-span-6 sm:col-span-4" x-data="{ 'showCompteCrediteur': @entangle('showCompteCrediteur')}">
                    <label class="block"  x-show="showCompteCrediteur">
                        <span class="text-gray-700">Compte créditeur</span>
                        <select  wire:model.lazy="CompteCrediteurId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0"> Choisir </option>
                            @foreach ($list_comptes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach

                        </select>
                    </label>
                </div> --}}


                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="montant" value="{{ __('Montant') }}" />
                    <x-jet-input id="montant" type="text" class="mt-1 block w-full" wire:model.defer="montant" autocomplete="montant" />
                    <x-jet-input-error for="montant" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="remise" value="{{ __('Remise') }}" />
                    <x-jet-input id="remise" type="text" class="mt-1 block w-full" wire:model.defer="remise" autocomplete="remise" />
                    <x-jet-input-error for="remise" class="mt-2" />
                </div>
                <div x-data="{ open: false }" class="col-span-6 sm:col-span-4">
                    <div class="col-span-6 sm:col-span-4">
                            <label class="block">
                                <span class="text-gray-700">Mode de paiement</span>
                                <select  wire:model.lazy="modePaiementId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option @click="open = 0" value="0" > Choisir un Mode</option>
                                    @foreach ($list_paiements as $item)
                                        <option @click="open = {{ $item->id }}" value="{{ $item->id }}">{{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </label>
                    </div>
                    <div x-show="open === 3 || open === 2" class="col-span-6 sm:col-span-4">
                        <x-jet-label for="ref" value="{{ __('Réf') }}" />
                        <x-jet-input id="ref" type="text" class="mt-1 block w-full" wire:model.defer="ref" autocomplete="ref" />
                        <x-jet-input-error for="ref" class="mt-2" />
                    </div>
                    <div x-show="open === 3 || open === 2" class="col-span-6 sm:col-span-4">
                        <label class="block">
                            <span class="text-gray-700">Date échéance</span>
                            <input wire:model="dateEcheance"  type="date" class="block w-full mt-1 form-input">
                        </label>
                    </div>
                    <div x-show="open === 2 " class="col-span-6 sm:col-span-4">
                        <label class="block">
                            <span class="text-gray-700">Date d'entrée en portefeuille</span>
                            <input wire:model="dateEntreeFeuille" type="date" class="block w-full mt-1 form-input" >
                        </label>
                    </div>
                    <div x-show=" open === 2 " class="col-span-6 sm:col-span-4">
                        <label class="block">
                            <span class="text-gray-700">Date remise en banque</span>
                            <input type="date" wire:model="datemiseBanque" class="block w-full mt-1 form-input"  >
                        </label>
                    </div>
                    <div x-show="open === 1" class="col-span-6 sm:col-span-4">
                        <label class="block">
                            <span class="text-gray-700">Date encaissement</span>
                            <input wire:model="dateEncaissement"  type="date" class="block w-full mt-1 form-input" >
                        </label>
                    </div>
                    <div x-show="open === 1" class="col-span-6 sm:col-span-4">
                        <label class="block">
                            <span class="text-gray-700">Caisse</span>
                            <select  wire:model.lazy="caisse_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="0"> Choisir </option>
                                @foreach ($list_caisses as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                                @endforeach

                            </select>
                        </label>
                    </div>
                    <div x-show="open === 3 || open === 2"  class="col-span-6 sm:col-span-4">
                        <div x-data="{ open: false }" class="col-span-6 sm:col-span-4">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="ValidationPaiement" value="{{ __('Validation paiement') }}" />
                                <select id="ValidationPaiement" wire:model="ValidationPaiement" autocomplete="ValidationPaiement"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                                    <option @click="open = 1"> Choisir </option>
                                    <option @click="open = 2"> Payé </option>
                                    <option @click="open = 3"> Impayé</option>
                                </select>
                                <x-jet-input-error for="ValidationPaiement" class="mt-2" />
                            </div>
                            <div x-show="open === 2" class="col-span-6 sm:col-span-4">
                                <label class="block">
                                    <span class="text-gray-700">Date encaissement</span>
                                    <input wire:model="dateEncaissement"  type="date" class="block w-full mt-1 form-input" >
                                </label>
                            </div>
                            <div x-show="open === 3" class="col-span-6 sm:col-span-4">
                                <label class="block">
                                    <span class="text-gray-700">Date Impayé</span>
                                    <input wire:model="dateImpaye" type="date" class="block w-full mt-1 form-input" >
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div x-data="" class="col-span-6 sm:col-span-4">
                    <div class="col-span-6 sm:col-span-4">
                        <label for="activer" class="flex items-center">
                            <input
                            wire:model="impaye"
                            id="impaye"
                            type="checkbox" class="form-checkbox" name="impaye" >
                            <span class="ml-2 text-sm text-gray-600">{{ __('Impayé') }}</span>
                        </label>
                    </div>

                    <div x-show="$wire.impaye" class="col-span-6 sm:col-span-4">
                        <label class="block">
                            <span class="text-gray-700">Date Impayé</span>
                            <input wire:model.lazy="dateImpaye" id="dateImpaye" type="text" class="block w-full mt-1 form-input" id="dateImpaye" autocomplete="dateImpaye">
                        </label>
                    </div>
                </div> --}}
                <x-slot name="actions">
                    <x-jet-action-message class="mr-3" on="saved">
                        {{ __('Saved.') }}
                    </x-jet-action-message>

                    <x-jet-button>
                        {{ __('Enregistrer') }}
                    </x-jet-button>
                </x-slot>
            </x-slot>

        </x-jet-form-section>
       {{-- @livewire('create-etat-reglement' --}}
    </div>
    </div>
    <div x-show="openTab === 2">
        @livewire('achat.liste-reglement-fournisseur')
    </div>
    {{-- <div x-show="openTab === 3">
        @livewire('reglement-impaye')
    </div> --}}
</div>

