<div class="p-5" x-data="{ openTab: 1 }">
    <ul class="flex border-b">
        <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-blue-500' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                Nouveau Departement
            </a>
        </li>
        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-blue-500' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                Liste Departements
            </a>
        </li>

    </ul>

    <div x-show="openTab === 1">

<div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Departements') }}
        </h2>
    </x-slot>

    <x-jet-form-section submit="createDepartement">
        <x-slot name="title">
            {{ __('Ajouter un nouveau Departement') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Tous les champs sont obligatoires.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Code Departement') }}" />
                <x-jet-input id="code" type="text" class="mt-1 block w-full" wire:model.defer="code" autocomplete="code" />
                <x-jet-input-error for="code" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="departement" value="{{ __('Departement') }}" />
                <x-jet-input id="departement" type="text" class="mt-1 block w-full" wire:model.defer="departement" autocomplete="departement" />
                <x-jet-input-error for="famimlle" class="mt-2" />
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
    <div class="p-5" x-show="openTab === 2">
@livewire('liste-departement')
    </div></div>
