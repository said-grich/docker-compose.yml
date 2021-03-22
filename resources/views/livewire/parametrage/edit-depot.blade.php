
<div class="p-5">


<div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dépôt') }}
        </h2>
    </x-slot>

    <x-jet-form-section submit="editDepot">
        <x-slot name="title">
            {{ __('Modification dépôt') }}
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
                <x-jet-label for="code" value="{{ __('Code dépôt') }}" />
                <x-jet-input id="code" type="text" class="mt-1 block w-full" wire:model.defer="code" autocomplete="code" />
                <x-jet-input-error for="code" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Nom') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <label class="block">
                    <span class="text-gray-700">Site propriétaire</span>
                    <select  wire:model.lazy="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="0"> Choisir un site</option>
                        @foreach ($list_sites as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="adresse" value="{{ __('Adresse') }}" />
                <textarea wire:model="adresse" id="adresse" class="w-full h-40 px-5 py-3 border border-gray-300 rounded-lg outline-none focus:shadow-outline" rows="4" ></textarea>
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
                <x-jet-label for="mode_stockage" value="{{ __(' Mode de stockage') }}" />
                <select id="mode_stockage" wire:model="mode_stockage" autocomplete="mode_stockage"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                    <option > Choisir </option>
                    <option >Rayonnage </option>
                    <option >Vrac </option>
                </select>
                <x-jet-input-error for="mode_stockage" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <label class="block">
                    <span class="text-gray-700">Sites locataires </span>
                    <select  wire:model.lazy="sites_locataires" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple>
                        <option value="0"> Choisir un site</option>
                        @foreach ($list_sites_locataires as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <label for="mobile" class="flex items-center">
                    <input id="mobile" wire:model="mobile" type="checkbox" class="form-checkbox" name="mobile">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Mobile') }}</span>
                </label>
            </div>

        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Enregistrer') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>

</div>

