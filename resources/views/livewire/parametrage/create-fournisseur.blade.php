@section('title', 'Création fournisseur')
@section('header_title', 'Création fournisseur')
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
                        <h3 class="card-title">{{ __('Liste Fournisseurs') }}</h3>
                    </div>
                    <div class="card-body">
                        <!--Button trigger modal-->
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#staticBackdrop">
                            <i class="flaticon-plus"></i> {{ __('Ajouter un nouveau fournisseur') }}
                        </button>
                        <div wire:ignore.self class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                              <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Nouvelle Fournisseur') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="unite-form" class="form" wire:submit.prevent="createFournisseur">
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="code_comptable"/>
                                                    <label>{{ __('Code comptable') }}</label>
                                                </div>
                                                @error('code_comptable')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="name"/>
                                                    <label>{{ __('Nom fournisseur') }}</label>
                                                </div>
                                                @error('name')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="ice"/>
                                                    <label>{{ __('ICE') }}</label>
                                                </div>
                                                @error('ice')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="idFiscal"/>
                                                    <label>{{ __('Identifiant fiscal') }}</label>
                                                </div>
                                                @error('idFiscal')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sitemap icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="designation"/>
                                                    <label>{{ __('Désignation') }}</label>
                                                </div>
                                                @error('designation')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker-alt icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="adresse"/>
                                                    <label>{{ __('Adresse') }}</label>
                                                </div>
                                                @error('adresse')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-mail-bulk icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="code_postal"/>
                                                    <label>{{ __('Code postal') }}</label>
                                                </div>
                                                @error('code_postal')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-city icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="ville"/>
                                                    <label>{{ __('Ville') }}</label>
                                                </div>
                                                @error('ville')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-globe icon-lg"></i></span></div>
                                                    <select  class="form-control" id="pays" wire:model="pays" autocomplete="pays"   >
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
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marked-alt icon-lg"></i></span></div>

                                                    <select  class="form-control" id="canton" wire:model="canton" autocomplete="canton"   >
                                                        <option > Choisir </option>
                                                        <option >Préfecture de Marrakech </option>
                                                        <option > </option>
                                                    </select>
                                                    <label>{{ __('Région') }}</label>
                                                </div>
                                                @error('canton')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone-alt icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="phone"/>
                                                    <label>{{ __('Téléphone') }}</label>
                                                </div>
                                                @error('phone')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-blender-phone icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="telephone_fixe"/>
                                                    <label>{{ __('Téléphone fixe') }}</label>
                                                </div>
                                                @error('telephone_fixe')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-fax icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="fax"/>
                                                    <label>{{ __('Fax') }}</label>
                                                </div>
                                                @error('fax')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-at icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="email"/>
                                                    <label>{{ __('Email') }}</label>
                                                </div>
                                                @error('email')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-check-alt icon-lg"></i></span></div>

                                                    <select  class="form-control" wire:model.lazy="modePaiementId">
                                                        <option value="0"> Choisir un Mode</option>
                                                            @foreach ($list_paiements as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }} | {{ $item->modalites_paiement }}  </option>
                                                            @endforeach
                                                    </select>
                                                    <label>{{ __('Mode de paiement') }}</label>
                                                </div>
                                                @error('modePaiementId')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="unite-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Table-->
                        @livewire('paramétrage.list-fournisseurs')
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
                Nouveau fournisseur
            </a>
        </li>
        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-indigo-700' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                Liste fournisseurs
            </a>
        </li>

    </ul>

    <div x-show="openTab === 1">
        <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        {{ __('Création fournisseur') }}
                    </h2>
                </x-slot>

            <x-jet-form-section submit="createFournisseur">
                <x-slot name="title">
                    {{ __('Ajouter un nouveau fournisseur') }}
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
    @livewire('paramétrage.list-fournisseurs')
    </div>
</div>--}}
