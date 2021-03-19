
<div class="p-5">


<div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modification Article') }}
        </h2>
    </x-slot>
    <x-jet-form-section submit="editArticle" style="padding-bottom: 45px;">
            <x-slot name="title">
                {{ __('Identification') }}
            </x-slot>

            <x-slot name="description">
            </x-slot>
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="code" value="{{ __('Code article') }}" />
                    <x-jet-input id="code" type="text" class="mt-1 block w-full" wire:model="code" autocomplete="code" />
                    <x-jet-input-error for="code" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="libelle" value="{{ __('Article') }}" />
                    <x-jet-input id="libelle" type="text" class="mt-1 block w-full" wire:model="libelle" autocomplete="libelle" />
                    <x-jet-input-error for="libelle" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="code_fournisseur" value="{{ __('Code fournisseur') }}" />
                    <x-jet-input id="code_fournisseur" type="text" class="mt-1 block w-full" wire:model="code_fournisseur" autocomplete="code_fournisseur" />
                    <x-jet-input-error for="code_fournisseur" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="marque" value="{{ __('Marque') }}" />
                    <x-jet-input id="marque" type="text" class="mt-1 block w-full" wire:model="marque" autocomplete="marque" />
                    <x-jet-input-error for="marque" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="famille" value="{{ __('Famille') }}" />
                    <select id="famille_id" wire:model.defer="famille_id" autocomplete="famille_id"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                        <option> Choisir une famille </option>
                        @foreach ($list_familles as $item)
                            <option value="{{ $item->id }}"> {{ $item->famille }} </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="famille_id" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700">Sous-famille</span>
                        <select  wire:model.lazy="sousFamilleId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0"> Choisir </option>
                            @foreach ($list_sous_familles as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700">Fournisseur  <!--{{ implode(' - ', $selection) }}--></span>
                        <select  wire:model.lazy="selection" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple>
                            <option value="0"> Choisir un fournisseur</option>
                            @foreach ($list_fournisseurs as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                    </label>
                </div>

            </x-slot>
        </x-jet-form-section>
        <x-jet-form-section submit="editArticle" style="padding-bottom: 45px;">
            <x-slot name="title">
                {{ __('Compta') }}
            </x-slot>

            <x-slot name="description">
            </x-slot>

            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="code_comptable" value="{{ __('Code comptable') }}" />
                    <x-jet-input id="code_comptable" type="text" class="mt-1 block w-full" wire:model="code_comptable" autocomplete="code_comptable" />
                    <x-jet-input-error for="code_comptable" class="mt-2" />
                </div>
                <div x-data="{ open: false }" class="col-span-6 sm:col-span-4">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="assujetti_tva" value="{{ __('Assujetti à la tva') }}" />
                        <select id="assujetti_tva" wire:model="assujetti_tva" autocomplete="assujetti_tva"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                            <option > Choisir </option>
                            <option @click="open = 1"> Oui </option>
                            <option  @click="open = 2"> Non</option>

                        </select>
                        <x-jet-input-error for="tva" class="mt-2" />
                    </div>
                    <div x-show="open === 1"class="col-span-6 sm:col-span-4">
                        <x-jet-label for="tva" value="{{ __('Tva') }}" />
                        <select id="tva" wire:model="tva" autocomplete="tva"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                            <option > Choisir </option>
                            <option > 7% </option>
                            <option > 10%</option>
                            <option > 20%</option>
                        </select>
                        <x-jet-input-error for="tva" class="mt-2" />
                    </div>
                </div>
            </x-slot>

        </x-jet-form-section>
        <x-jet-form-section submit="editArticle" style="padding-bottom: 45px;">
            <x-slot name="title">
                {{ __('Stock') }}
            </x-slot>

            <x-slot name="description">

            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="qte_minimum" value="{{ __('Qte minimum') }}" />
                        <x-jet-input id="qte_minimum" type="text" class="mt-1 block w-full" wire:model.defer="qte_minimum" autocomplete="qte_minimum" />
                        <x-jet-input-error for="qte_minimum" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="uniteAfficheeId" value="{{ __('Unité affichée') }}" />
                    <select  wire:model.lazy="uniteAfficheeId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="0"> Choisir</option>
                            @foreach ($list_unites as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                    </select>
                    <x-jet-input-error for="uniteAfficheeId" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="uniteAchatId" value="{{ __('Unité achat') }}" />
                        <select  wire:model.lazy="uniteAchatId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0"> Choisir</option>
                                @foreach ($list_unites as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                                @endforeach
                        </select>
                        <x-jet-input-error for="uniteAchatId" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="uniteVenteId" value="{{ __('Unité vente') }}" />
                    <select  wire:model.lazy="uniteVenteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="0"> Choisir</option>
                            @foreach ($list_unites as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                    </select>
                    <x-jet-input-error for="uniteVenteId" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="regle_sorties_stocks" value="{{ __('La régle sorties de stocks') }}" />
                    <select id="regle_sorties_stocks" wire:model="regle_sorties_stocks" autocomplete="regle_sorties_stocks"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                        <option > Choisir </option>
                        <option >FIFO</option>
                        <option >LIFO</option>
                    </select>
                    <x-jet-input-error for="regle_sorties_stocks" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="nature" value="{{ __(' Nature') }}" />
                    <select id="nature" wire:model="nature" autocomplete="nature"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                        <option > Choisir </option>
                        <option >Matière première </option>
                        <option >Produit fini </option>
                    </select>
                    <x-jet-input-error for="nature" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label for="accepter_stock_negatif" class="flex items-center">
                        <input id="accepter_stock_negatif" wire:model="accepter_stock_negatif" type="checkbox" class="form-checkbox" name="active">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Accepter le stock négatif') }}</span>
                    </label>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label for="interdire_achat" class="flex items-center">
                        <input id="interdire_achat" wire:model="interdire_achat" type="checkbox" class="form-checkbox" name="active">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Interdire l achat') }}</span>
                    </label>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label for="interdire_vente" class="flex items-center">
                        <input id="interdire_vente" wire:model="interdire_vente" type="checkbox" class="form-checkbox" name="active">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Interdire la vente') }}</span>
                    </label>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label for="montage" class="flex items-center">
                        <input id="montage" wire:model="montage" type="checkbox" class="form-checkbox" name="active">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Montage') }}</span>
                    </label>
                </div>
                <div x-data="" class="col-span-6 sm:col-span-4">
                    <div class="col-span-6 sm:col-span-4">
                        <label for="peremption" class="flex items-center">
                            <input
                            wire:model="peremption"
                            id="peremption"
                            type="checkbox" class="form-checkbox" name="peremption" >
                            <span class="ml-2 text-sm text-gray-600">{{ __('péremption') }}</span>
                        </label>
                    </div>
                    <div x-show="$wire.peremption" class="col-span-6 sm:col-span-4">
                        <label class="block">
                            <span class="text-gray-700">Date peremption</span>
                            <input wire:model="datePeremption"  type="date" class="block w-full mt-1 form-input" >
                        </label>
                    </div>
                </div>


            </x-slot>

        </x-jet-form-section>
        <x-jet-form-section submit="editArticle" style="padding-bottom: 45px;">
            <x-slot name="title">
                {{ __('Tarif') }}
            </x-slot>

            <x-slot name="description">

            </x-slot>

            <x-slot name="form">

                <div class="col-span-6 sm:col-span-4">
                    <label for="service" class="flex items-center">
                        <input id="service" wire:model="service" type="checkbox" class="form-checkbox" name="active">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Service') }}</span>
                    </label>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label for="cache" class="flex items-center">
                        <input id="cache" wire:model="cache" type="checkbox" class="form-checkbox" name="active">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Caché') }}</span>
                    </label>
                </div>


                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="type" value="{{ __('Type') }}" />
                    <select id="type" wire:model="type" autocomplete="type"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                        <option > Choisir </option>
                        <option >Local</option>
                        <option >Import</option>
                    </select>
                    <x-jet-input-error for="type" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="garantie_fournisseur" value="{{ __('Garantie fournisseur') }}" />
                    <x-jet-input id="garantie_fournisseur" type="text" class="mt-1 block w-full" wire:model.defer="garantie_fournisseur" autocomplete="garantie_fournisseur" />
                    <x-jet-input-error for="garantie_fournisseur" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="garantie_client" value="{{ __('Garantie client') }}" />
                    <x-jet-input id="garantie_client" type="text" class="mt-1 block w-full" wire:model.defer="garantie_client" autocomplete="garantie_client" />
                    <x-jet-input-error for="garantie_client" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="plafond_remise" value="{{ __('Plafond remise') }}" />
                    <x-jet-input id="plafond_remise" type="text" class="mt-1 block w-full" wire:model.defer="plafond_remise" autocomplete="plafond_remise" />
                    <x-jet-input-error for="plafond_remise" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="marge" value="{{ __('Marge') }}" />
                    <x-jet-input id="marge" type="text" class="mt-1 block w-full" wire:model.defer="marge" autocomplete="marge" />
                    <x-jet-input-error for="marge" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="pmp" value="{{ __('PMP') }}" />
                    <x-jet-input id="pmp" type="text" class="mt-1 block w-full" wire:model.defer="pmp" autocomplete="pmp" />
                    <x-jet-input-error for="pmp" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700">Taux d'assurance</span>
                        <input type="text" wire:model.lazy="taux_assurance" class="block w-full mt-1 form-input" placeholder="">
                        @error('taux_assurance') <span class="text-red-600">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="pmp" value="{{ __('frais de possession') }}" />
                    <x-jet-input id="pmp" type="text" class="mt-1 block w-full" wire:model.defer="pmp" autocomplete="pmp" />
                    <x-jet-input-error for="pmp" class="mt-2" />
                </div>


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

</div>

</div>

