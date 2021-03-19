<div class="p-5 bg-white" x-data="{ openTab: 2 }">
    <ul class="flex border-b mx-5">
        <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-indigo-500 bg-indigo-700' : 'text-gray-700 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-sm" href="#">
                Nouvelle demande d'achat
            </a>
        </li>
        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-indigo-500 bg-indigo-700' : 'text-gray-700 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-sm" href="#">
                Liste demande d'achats
            </a>
        </li>

    </ul>

    <div x-show="openTab === 1">
        <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Création demande d\'achats') }}
        </h2>
    </x-slot>

        @if (session()->has('message'))
            <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                <span class="inline-block align-middle mr-8">
                    {{ session('message') }}
                </span>
            </div>

        @elseif (session()->has('error-message'))
            <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500">
                <span class="inline-block align-middle mr-8">
                    {{ session('error-message') }}
                </span>
            </div>
        @endif

    <form wire:submit.prevent="saveDemandeAchat">

        <div data-repeater-list="" class="col-lg-12">
            <div data-repeater-item="" class="form-group row align-items-center">
                <div class="col-md-3">
                    <label>Date:</label>
                    <input wire:model="date" type="date" class="form-control" onchange="this.dispatchEvent(new InputEvent('input'))" id="kt_datepicker_3"/>
                    @error('date') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3">
                    <label> Demande ref. :</label>
                    <input type="text" wire:model="ref" type="text" class="form-control" placeholder="">
                    @error('ref') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3">
                    <label>Dépôt</label>
                    <select wire:model="depotId" class="form-control" id="kt_select2_1" onchange="this.dispatchEvent(new InputEvent('input'))" style="position: relative !important">
                        @foreach ($list_depots as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    {{-- <div wire:ignore class="w-full">
                        <select class="form-select select2" data-minimum-results-for-search="Infinity" data-placeholder="{{__('Select your option')}}" id="depotId">
                            <option></option>
                            @foreach ($list_depots as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                        </select>
                    </div> --}}
                    @error('depotId') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-3">
                    <label>Site</label>
                    {{-- <div wire:ignore class="w-full">
                        <select class="form-select select2" data-minimum-results-for-search="Infinity" data-placeholder="{{__('Select your option')}}" id="siteId">
                            <option></option>
                            @foreach ($list_sites as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <select wire:model="siteId" class="form-control" id="kt_select2_2" onchange="this.dispatchEvent(new InputEvent('input'))" style="position: relative !important">
                        @foreach ($list_sites as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('siteId') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- <div class="grid grid-cols-6 gap-4 p-4 mb-8">
            <label class="block">
                <span class="text-gray-700">Date</span>
                <input wire:model.lazy="date" id="datepicker" type="text" class="block w-full mt-1 form-input" id="date" autocomplete="date">

                <input wire:model="date" type="text" class="form-control" onchange="this.dispatchEvent(new InputEvent('input'))"   id="kt_datepicker_3"/>

                @error('date') <span class="text-red-600">{{ $message }}</span> @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Demande ref.</span>
                <input type="text" wire:model.lazy="ref" class="block w-full mt-1 form-input" placeholder="">
                @error('ref') <span class="text-red-600">{{ $message }}</span> @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Depot</span>
                <select  wire:model.lazy="depotId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="0"> Choisir un depot</option>
                    @foreach ($list_depots as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
                @error('depotId') <span class="text-red-600">{{ $message }}</span> @enderror
            </label>


            <label class="block">
                <span class="text-gray-700">Site</span>
                <select  wire:model.lazy="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="0"> Choisir un site</option>
                    @foreach ($list_sites as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
                @error('siteId') <span class="text-red-600">{{ $message }}</span> @enderror
            </label>
        </div> --}}


        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="i overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">CODE
                                    ARTICLE
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">LIBELLE
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">FAMILLE
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">TVA
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">QTE
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-gray">
                                <tr x-data="{isOpen0:false}">
                                    <td class="p-2 border border-gray-200" >
                                        <input type="hidden" wire:model="articleId.0" />
                                        <input wire:model="code.0" x-on:keyup="isOpen0=true" wire:keyup="showArticle(0)"
                                               class="w-full py-1" type="text"/>

                                        <ul x-show="isOpen0" x-on:click.away="isOpen0=false" class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                            @if (!empty($articles))
                                                @foreach($articles as $item)
                                                    <li class="py-1" x-on:click="isOpen0 = !isOpen0"
                                                        wire:click="getArticle('{{ $item->id }}','{{ $item->code }}', '{{ $item->libelle }}', {{ $item->famille }}, '{{ $item->tva }}')">{{$item->code }} | {{$item->libelle}}</li>
                                                @endforeach</ul>@endif
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model="libelle.0" class="w-full py-1" type="text"/>
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model="famille.0" class="w-full py-1" type="text"/>
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        @isset($tva[0])
                                        {{$tva[0]}}
                                        @endisset
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model="qte.0" class="w-full py-1" type="text"/>
                                    </td>
                                </tr>
                                @foreach($inputs as $key => $value)
                                    <tr x-data="{isOpen{{$value}}:false}">
                                            <td class="border border-gray-200" >
                                                <input type="hidden" wire:model="articleId.{{$value}}" />
                                                <input wire:model="code.{{$value}}" x-on:keyup="isOpen{{$value}}=true" wire:keyup="showArticle({{$value}})"
                                                       class="w-full py-1" type="text"/>

                                                <ul x-show="isOpen{{$value}}" x-on:click.away="isOpen{{$value}}=false" class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                                    @if (!empty($articles))
                                                        @foreach($articles as $item)
                                                            <li class="py-1" x-on:click="isOpen{{$value}} = !isOpen{{$value}}"
                                                                wire:click="getArticle('{{ $item->id }}','{{ $item->code }}', '{{ $item->libelle }}', {{ $item->famille }}, '{{ $item->tva }}')">{{$item->code }} | {{$item->libelle}}</li>
                                                        @endforeach</ul>@endif
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <input wire:model="libelle.{{$value}}" class="w-full py-1" type="text"/>
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <input wire:model="famille.{{$value}}" class="w-full py-1" type="text"/>
                                            </td>
                                            <td class="border border-gray-200"">
                                                @isset($tva[$value])
                                                    {{ $tva[$value] }}
                                                @endisset
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <input wire:model="qte.{{$value}}" class="w-full py-1" type="text"/>
                                            </td>
                                             <td>
                                                 <button class="w-7 rounded-md text-white bg-red-700" wire:click.prevent="remove({{$key}})">X</button>
                                             </td>
                                        </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="text-left pt-3">
                                    <button class="inline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25" wire:click.prevent="add({{$i}})">Ajouter une ligne</button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-right pt-3">
                <button type="submit" class="nline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25" >
                    Enregistrer
                </button>
            </div>
        </div>

    </form>
    </div>
    </div>

    <div x-show="openTab === 2">
        @livewire('achat.liste-demande-achat')
    </div>
</div>

@push('scripts')
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
<script src="assets/js/pages/crud/forms/widgets/select2.js"></script>
    <script>
        $(document).ready(function() {
            $('#kt_datepicker_3').datepicker({
                format: 'dd/mm/yyyy',
            });
            $('.select2').select2({
                placeholder: '{{__('Choisir une option')}}',
                allowClear: true
            });
            $('.select2').on('change', function (e) {
                let elementName = $(this).attr('id');
                var data = $(this).select2("val");
                @this.set(elementName, data);
            });
        });
    </script>

@endpush




