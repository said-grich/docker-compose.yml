<div>
    <div>


        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>


        <div class="flex flex-col flex-1 max-h-full pl-2 pr-2 rounded-md xl:pr-4">
            <!-- Main Content -->
            <!-- Placeholder Cards -->

            <div class="grid grid-cols-1 gap-12 mt-4 md:grid-cols-1">

                <div class="flex flex-col flex-1 items-left justify-left w-full max-h-full bg-gray-100 rounded-md shadow-md p-6">


                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="code_comptable" value="{{ __('Code comptable') }}" />
                        <x-jet-input id="code_comptable" type="text" class="mt-1 block w-full" wire:model="code_comptable" autocomplete="code_comptable" />
                        <x-jet-input-error for="code_comptable" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Nom fournisseur') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name" autocomplete="name" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="ice" value="{{ __('ICE') }}" />
                        <x-jet-input id="ice" type="text" class="mt-1 block w-full" wire:model="ice" autocomplete="ice" />
                        <x-jet-input-error for="ice" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="idFiscal" value="{{ __('Identifiant fiscal') }}" />
                        <x-jet-input id="idFiscal" type="text" class="mt-1 block w-full" wire:model="idFiscal" autocomplete="idFiscal" />
                        <x-jet-input-error for="idFiscal" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="designation" value="{{ __('Désignation') }}" />
                        <x-jet-input id="designation" type="text" class="mt-1 block w-full" wire:model="designation" autocomplete="designation" />
                        <x-jet-input-error for="designation" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="adresse" value="{{ __('Adresse') }}" />
                        <textarea wire:model="adresse" id="adresse" class="w-full h-40 px-5 py-3 border border-gray-300 rounded-lg outline-none focus:shadow-outline" rows="4" ></textarea>
                    </div>


                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="code_postal" value="{{ __('Code postal') }}" />
                        <x-jet-input id="code_postal" type="text" class="mt-1 block w-full" wire:model="code_postal" autocomplete="code_postal" />
                        <x-jet-input-error for="code_postal" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="ville" value="{{ __('Ville') }}" />
                        <x-jet-input id="ville" type="text" class="mt-1 block w-full" wire:model="ville" autocomplete="ville" />
                        <x-jet-input-error for="ville" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="pays" value="{{ __('Pays') }}" />
                            <select id="pays" wire:model="pays" autocomplete="pays"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                                <option > Choisir </option>
                                <option > Maroc</option>
                                <option > </option>
                            </select>
                        <x-jet-input-error for="pays" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="canton" value="{{ __('Région') }}" />
                            <select id="canton" wire:model="canton" autocomplete="canton"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                                <option > Choisir </option>
                                <option >Préfecture de Marrakech </option>
                                <option > </option>
                            </select>
                        <x-jet-input-error for="canton" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="phone" value="{{ __('Téléphone') }}" />
                        <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model="phone" autocomplete="phone" />
                        <x-jet-input-error for="phone" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="telephone_fixe" value="{{ __('Téléphone fixe') }}" />
                        <x-jet-input id="telephone_fixe" type="text" class="mt-1 block w-full" wire:model="telephone_fixe" autocomplete="telephone_fixe" />
                        <x-jet-input-error for="telephone_fixe" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="fax" value="{{ __('Fax') }}" />
                        <x-jet-input id="fax" type="text" class="mt-1 block w-full" wire:model="fax" autocomplete="fax" />
                        <x-jet-input-error for="fax" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model="email" autocomplete="email" />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label class="block">
                            <span class="text-gray-700">Mode de paiement</span>
                            <select  wire:model.lazy="modePaiementId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="0"> Choisir un Mode</option>
                                    @foreach ($list_paiements as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} | {{ $item->modalites_paiement }}  </option>
                                    @endforeach
                            </select>
                        </label>
                    </div>

                </div>

            </div>

            <!-- Main Footer -->
        </div>
        {{-- """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""" --}}

        <div class="text-right pt-3 pr-4">
            <button type="button" wire:click.prevent="createFournisseur"
                class="nline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25">
                Enregistrer
            </button>
        </div>
    </div>
</div>
