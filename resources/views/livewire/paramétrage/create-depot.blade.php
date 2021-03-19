@section('title', 'Création dépôts')
@section('header_title', 'Création dépôts')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-xl-12">
                <!--begin::Card-->
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Liste dépôts') }}</h3>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#staticBackdrop">
                            <i class="flaticon-plus"></i> {{ __('Ajouter un nouveau dépôt') }}
                        </button>
                        <!--Modal-->
                       <div wire:ignore.self class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Nouveau dépôts') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="site-form" class="form" wire:submit.prevent="createDepot">
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sitemap icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="code"/>
                                                    <label>{{ __('Code dépôt') }}</label>
                                                </div>
                                                @error('code')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                                    <div class="form-group">
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-warehouse icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model.defer="name"/>
                                                            <label>{{ __('Nom') }}</label>
                                                        </div>
                                                        @error('name')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-building icon-lg"></i></span></div>
                                                            {{--<input type="text" class="form-control" placeholder=" " wire:model.defer="siteId"/>--}}

                                                            <select  class="form-control" placeholder=" " wire:model.lazy="siteId" >
                                                                <option value="0"> Choisir un site</option>
                                                                @foreach ($list_sites as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                                @endforeach
                                                            </select>
                                                            <label>{{ __('Site propriétaire') }}</label>
                                                        </div>
                                                        @error('siteId')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <textarea class="form-control" placeholder=" " wire:model.defer="adresse"></textarea>
                                                            <label>{{ __('Adresse') }}</label>
                                                        </div>
                                                        @error('adresse')
                                                        <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-city icon-lg"></i></span></div>
                                                            <input type="text" class="form-control" placeholder=" " wire:model.defer="ville"/>
                                                            <label>{{ __('ville') }}</label>
                                                        </div>
                                                        @error('ville')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-globe icon-lg"></i></span></div>
                                                            <select class="form-control" placeholder=" " wire:model.defer="pays">
                                                                <option > Choisir </option>
                                                                <option > Maroc</option>
                                                                <option > </option>
                                                            </select>
                                                            <label>{{ __('Pays') }}</label>
                                                        </div>
                                                        @error('pays')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                            <select class="form-control" id="mode_stockage" wire:model="mode_stockage" autocomplete="mode_stockage"  >
                                                                <option > Choisir </option>
                                                                <option >Rayonnage </option>
                                                                <option >Vrac </option>
                                                            </select>
                                                            <label>{{ __('Mode de stockage') }}</label>
                                                        </div>
                                                        @error('mode_stockage')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                            <select  class="form-control" wire:model.lazy="sites_locataires"  >
                                                                <option value="0"> Choisir un site</option>
                                                                @foreach ($list_sites_locataires as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                                @endforeach
                                                            </select>
                                                            <label>{{ __('Sites locataires') }}</label>
                                                        </div>
                                                        @error('sites_locataires')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group input-group-prepend">
                                                            <div class="input-group-prepend"><span class=""><i class=""></i></span></div>
                                                            <input id="mobile" wire:model="mobile" type="checkbox" class="form-checkbox" name="mobile">
                                                            <label>{{ __('Mobile') }}</label>
                                                        </div>
                                                        @error('mobile')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold" form="site-form">{{ __('Enregistrer') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @livewire('paramétrage.liste-depot')
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
{{--<div class="p-5" x-data="{ openTab: 2}">
    <ul class="flex border-b">
        <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-indigo-700' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
            Nouveau dépôt
            </a>
        </li>
        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-indigo-700' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                Liste dépôts
            </a>
        </li>

    </ul>
 <div x-show="openTab === 1">
        <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Création dépôts') }}
                </h2>
            </x-slot>

            <x-jet-form-section submit="createDepot">
                <x-slot name="title">
                    {{ __('Ajouter un nouveau dépôt') }}
                </x-slot>

                <x-slot name="description">

                </x-slot>

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

    <div x-show="openTab === 2">
        @livewire('paramétrage.liste-depot')
    </div>

</div>--}}
