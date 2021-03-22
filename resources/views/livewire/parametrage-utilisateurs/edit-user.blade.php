
<div class="p-5">


    <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Utilisateurs') }}
            </h2>
        </x-slot>

        <x-jet-form-section submit="editUser">
            <x-slot name="title">
                {{ __('Modification utilisateur') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Tous les champs sont obligatoires.') }}
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
                    <x-jet-label for="name" value="{{ __('Nom') }}" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.defer="email" autocomplete="email" />
                    <x-jet-input-error for="email" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">

                    <label class="block">
                        <x-jet-label for="role" value="{{ __('Role') }}" />

                        <select wire:model.defer="role"
                            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="0"> Choisir un role</option>
                        @foreach ($list_roles as $item)
                            <option value="{{ $item->id }}">{{ $item->display_name }} </option>
                        @endforeach
                    </select>
                    @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
                </label>

                   {{--  @foreach ($listPermissions as $key=>$value)

                        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">

                            @php

                            @endphp
                            <input
                                type="checkbox"
                                wire.model="listPermissions.{{$value->id}}"
                                class="form-checkbox h-4 w-4"
                                name="selectedPermissions[]"
                                value="{{$value->id}}"
                                {{ $value->assigned ? 'checked' : '' }}
                            >
                            <span class="ml-2">{{$value->display_name ?? $value->name}}</span>
                        </label>
                    @endforeach --}}

                    <div class="block my-5">
                        <span class="text-gray-700">Gestion utilisateurs</span>
                        <div class="mt-2 grid grid-cols-3 gap-2">
                        @foreach ($user_permissions as $permission)
                            <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox"
                                class="form-checkbox"
                                name="selectedPermissions[]"
                                wire.model="listPermissions.{{$permission->id}}"
                                value="{{$permission->id}}" {{ $permission->assigned ? 'checked' : '' }}/>
                                <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                            </label>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="block my-5">
                        <span class="text-gray-700">Departement achat</span>
                        <div class="mt-2 grid grid-cols-3 gap-2">
                        @foreach ($da_permissions as $permission)
                            <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox"
                                class="form-checkbox"
                                name="selectedPermissions[]"
                                wire.model="listPermissions"
                                value="{{$permission->id}}" {{ $permission->assigned ? 'checked' : '' }} />


                                <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                            </label>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="block my-5">
                        <span class="text-gray-700">Departement vente</span>
                        <div class="mt-2 grid grid-cols-3 gap-2">
                        @foreach ($dv_permissions as $permission)
                            <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox"
                                class="form-checkbox"
                                name="selectedPermissions[]"
                                wire.model="listPermissions.{{$permission->id}}"
                                value="{{$permission->id}}" {{ $permission->assigned ? 'checked' : '' }} />


                                <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                            </label>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="block my-5">
                        <span class="text-gray-700">Comptabilité / finance</span>
                        <div class="mt-2 grid grid-cols-3 gap-2">
                        @foreach ($compta_permissions as $permission)
                            <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox"
                                class="form-checkbox"
                                name="selectedPermissions[]"
                                wire.model="listPermissions.{{$permission->id}}"
                                value="{{$permission->id}}" {{ $permission->assigned ? 'checked' : '' }} />
                                <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                            </label>
                            </div>
                        @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700">Site propriétaire</span>
                        <select  wire:model.defer="site_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0"> Choisir un site</option>
                            @foreach ($list_sites as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700">Depot</span>
                        <select  wire:model.lazy="depot_id" wire:change="sitesAutorises" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0"> Choisir un depot</option>
                            @foreach ($list_depots as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                        @error('depotId') <span class="text-red-600">{{ $message }}</span> @enderror

                    </label>
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700"> Autres dépôts autorisés  </span>
                        <select  wire:model.lazy="autoriser_autres_depots" wire:change="sitesAutorises" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple>
                            <option value="0"> Choisir un depot</option>
                            @foreach ($list_depots_autorises as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                        @error('depotId') <span class="text-red-600">{{ $message }}</span> @enderror

                    </label>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700"> Autres sites autorisés</span>
                        <select  wire:model.defer="sites_autorise"  class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple>
                            <option value="0"> Choisir un site</option>
                            @foreach ($list_autres_sites as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
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
