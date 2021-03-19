
<div class="p-5">


<div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Commercial') }}
        </h2>
    </x-slot>

    <x-jet-form-section submit="editCommerciale">
        <x-slot name="title">
            {{ __('Modification Commercial') }}
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
                <x-jet-label for="name" value="{{ __('Nom Commercial') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.defer="email" autocomplete="email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="phone" value="{{ __('Téléphone') }}" />
                <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="phone" autocomplete="phone" />
                <x-jet-input-error for="phone" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <label class="block">
                    <span class="text-gray-700">Site</span>
                    <select  wire:model.lazy="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple>
                        <option value="0"> Choisir un site</option>
                        @foreach ($list_sites as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <label for="active_id" class="flex items-center">
                    <input id="active_id" type="checkbox" class="form-checkbox" name="active">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Activer') }}</span>
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

