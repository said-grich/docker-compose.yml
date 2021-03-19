<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Utilisteurs') }}
    </h2>
</x-slot>

<div class="p-5">


    <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Création utilisateurs') }}
            </h2>
        </x-slot>

        <x-jet-form-section submit="saveUser">
            <x-slot name="title">
                {{ __('Creation des utilisateurs') }}
            </x-slot>

            <x-slot name="description">

            </x-slot>
            <div>
                @if (session()->has('message'))
                    <div class="bg-green-600 text-white">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="bg-red-600 text-white">
                        {{ session('error') }}
                    </div>

                @endif
            </div>

            <x-slot name="form">

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Nom') }}" />
                    <x-jet-input id="name" wire:model.defer="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                @error('name') <span class="error">{{ $message }}</span> @enderror

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="password" value="{{ __('Mot de passe') }}" />
                    <x-jet-input id="password" wire:model.defer="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>
                @error('password') <span class="error">{{ $message }}</span> @enderror


                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirmez le mot de passe') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" wire:model.defer="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>
                @error('email') <span class="error">{{ $message }}</span> @enderror

                {{--<div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="role" value="{{ __('Profil') }}" />
                    <select id="role_id" wire:model.defer="role_id" autocomplete="role_id"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                        <option> Choisir un profil </option>
                        @foreach ($list_roles as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="role_id" class="mt-2" />
                </div>--}}
                {{-- <div x-data="{ open: false }" class="col-span-6 sm:col-span-4">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="assujetti_tva" value="{{ __('Ajouter autres sites/dépôts') }}" />
                        <select id="assujetti_tva" wire:model="assujetti_tva" autocomplete="assujetti_tva"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                            <option > Choisir </option>
                            <option @click="open = 1"> Unique </option>
                            <option  @click="open = 2"> Multiple</option>

                        </select>
                        <x-jet-input-error for="tva" class="mt-2" />
                    </div>
                    <div x-data="" class="col-span-6 sm:col-span-4">
                    <div class="col-span-6 sm:col-span-4">
                        <label for="activer" class="flex items-center">
                            <input
                            wire:model="ajouter_aut_sites_depots"
                            id="ajouter_aut_sites_depots"
                            type="checkbox" class="form-checkbox" name="ajouter_aut_sites_depots" >
                            <span class="ml-2 text-sm text-gray-600">{{ __('Ajouter autres sites/dépôts') }}</span>
                        </label>
                    </div>

                    <div x-show="$wire.ajouter_aut_sites_depots" class="col-span-6 sm:col-span-4">
                        <label class="block">
                        <span class="text-gray-700"> Autres dépôts autorisés  </span>
                        <select  wire:model.lazy="autoriser_autres_depots" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple>
                            <option value="0"> Choisir un depot</option>
                            @foreach ($list_depots_autorises as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                        @error('depotId') <span class="text-red-600">{{ $message }}</span> @enderror

                    </label>
                    </div>
                </div>
                </div> --}}

                {{-- <div class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700">Dépôts </span>
                        <select  wire:model.lazy="depots_site" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple>
                            <option value="0"> Choisir un depot</option>
                            @foreach ($list_depots_site as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                        @error('depotId') <span class="text-red-600">{{ $message }}</span> @enderror

                    </label>
                </div> --}}

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="role" value="{{ __('Profil / Autorisation') }}" />
                    <div x-data="{ open: false }">

                            <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option> Veuillez choisir </option>
                                <option @click="open = 1">Profil</option>
                                <option @click="open = 2">Autorisations</option>
                            </select>

                        <div class="w-full pt-4">
                            <div x-show="open === 1">
                                <x-jet-label for="role" value="{{ __('Profil') }}" />
                                <select id="role_id" wire:model.defer="role_id" autocomplete="role_id"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                                    <option> Choisir un profil </option>
                                    @foreach ($list_roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->display_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div x-show="open === 2">
                                    {{--@foreach ($list_permissions as $permission)
                                        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                                            <input
                                                type="checkbox"
                                                class="form-checkbox h-4 w-4"
                                                name="selectedPermissions[]"
                                                wire:model="selectedPermissions"
                                                value="{{$permission->id}}"
                                            >
                                            <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                                        </label>
                                    @endforeach--}}

                                    <div class="block my-5">
                                        <span class="text-gray-700">Gestion utilisateurs</span>
                                        <div class="mt-2 grid grid-cols-3 gap-2">
                                        @foreach ($user_permissions as $permission)
                                            <div>
                                            <label class="inline-flex items-center">
                                                <input type="checkbox"
                                                class="form-checkbox"
                                                name="selectedPermissions[]"
                                                wire:model="selectedPermissions"
                                                value="{{$permission->id}}" />
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
                                                wire:model="selectedPermissions"
                                                value="{{$permission->id}}" />
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
                                                wire:model="selectedPermissions"
                                                value="{{$permission->id}}" />
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
                                                wire:model="selectedPermissions"
                                                value="{{$permission->id}}" />
                                                <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                                            </label>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>




                                   {{--  <ul class="checkbox-grid">
                                        <div>Departement achat</div>
                                        @foreach ($da_permissions as $permission)
                                        <li style="display: block;float: left;width: 25%;">
                                            <input type="checkbox"
                                                class="form-checkbox h-4 w-4"
                                                name="selectedPermissions[]"
                                                wire:model="selectedPermissions"
                                                value="{{$permission->id}}" />
                                            <label for="text1">{{$permission->display_name ?? $permission->name}}</label>
                                        </li>
                                        @endforeach

                                    </ul>





                                    <ul class="checkbox-grid">
                                        <div> Departement vente</div>
                                        @foreach ($dv_permissions as $permission)
                                        <li style="display: block;float: left;width: 25%;">
                                            <input type="checkbox"
                                                class="form-checkbox h-4 w-4"
                                                name="selectedPermissions[]"
                                                wire:model="selectedPermissions"
                                                value="{{$permission->id}}" />
                                            <label for="text1">{{$permission->display_name ?? $permission->name}}</label>
                                        </li>
                                        @endforeach

                                    </ul> --}}

                                    {{--@foreach ($da_permissions as $permission)
                                        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                                            <input
                                                type="checkbox"
                                                class="form-checkbox h-4 w-4"
                                                name="selectedPermissions[]"
                                                wire:model="selectedPermissions"
                                                value="{{$permission->id}}"
                                            >
                                            <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                                        </label>
                                    @endforeach
                                    Departement vente
                                    @foreach ($dv_permissions as $permission)
                                        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                                            <input
                                                type="checkbox"
                                                class="form-checkbox h-4 w-4"
                                                name="selectedPermissions[]"
                                                wire:model="selectedPermissions"
                                                value="{{$permission->id}}"
                                            >
                                            <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                                        </label>
                                    @endforeach--}}

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700">Site propriétaire</span>
                        <select  wire:model.lazy="site_id" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                        <select  wire:model.lazy="sites_autorise"  class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple>
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


<div class="p-5">
    @livewire('paramétrage-utilisateurs.liste-users')

</div>
