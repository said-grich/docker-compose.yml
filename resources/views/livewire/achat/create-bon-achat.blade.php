@section('title', 'Création bon réceptions')
@section('header_title', 'Création bon réceptions')
<div class="p-5 bg-white" x-data="{ openTab: 2 }">
    <ul class="flex border-b mx-5">
        <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-indigo-500  bg-indigo-700' : 'text-gray-700 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-sm" href="#">
                Nouveau bon de réception
            </a>
        </li>
        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-indigo-500 bg-indigo-700' : 'text-gray-700 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-sm" href="#">
                Liste bon de réceptions
            </a>
        </li>

    </ul>

    <div x-show="openTab === 1">
        <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Création bon réceptions') }}
                </h2>
            </x-slot>
            @if (session()->has('message'))
                <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                    <span class="inline-block align-middle mr-8">
                        {{ session('message') }}
                    </span>
                </div>
            @endif

            @if (session()->has('error-message'))
                <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500">
                    <span class="inline-block align-middle mr-8">
                        {{ session('error-message') }}
                    </span>
                </div>
            @endif

            <form wire:submit.prevent="saveBonAchat">

                <div class="grid grid-cols-4 gap-4 mb-8">
                    <label class="block">
                        <span class="text-gray-700">Date</span>
                        <input wire:model.lazy="date" id="datepicker" type="date" class="block w-full mt-1 form-input" id="date" autocomplete="date">
                        @error('date') <span class="text-red-600">{{ $message }}</span> @enderror

                    </label>
                    <label class="block">
                        <span class="text-gray-700">Bon reception Ref.</span>
                        <input type="text" wire:model.lazy="ref" class="block w-full mt-1 form-input" placeholder="">
                        @error('ref') <span class="text-red-600">{{ $message }}</span> @enderror

                    </label>
                    {{-- <label class="block">
                        <span class="text-gray-700">Lot num.</span>
                        <input type="text" wire:model.lazy="numLot" class="block w-full mt-1 form-input" placeholder="">
                        @error('numLot') <span class="text-red-600">{{ $message }}</span> @enderror

                    </label> --}}

                    <label class="block">
                        <span class="text-gray-700">Dépôt</span>
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

                    <label class="block">
                        <span class="text-gray-700">Date BL fournissuer</span>
                        <input wire:model.lazy="dateBlFournisseur" id="dateBlFournisseur" type="date" class="block w-full mt-1 form-input" autocomplete="date">
                        @error('dateBlFournisseur') <span class="text-red-600">{{ $message }}</span> @enderror

                    </label>

                    <label class="block">
                        <span class="text-gray-700">Fournisseur</span>
                        <select  wire:model.lazy="fournisseurId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0"> Choisir un fournisseur</option>
                            @foreach ($list_fournisseurs as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                        @error('fournisseurId') <span class="text-red-600">{{ $message }}</span> @enderror

                    </label>

                    @if(!@empty($listBC))
                    <section class="flex flex-wrap p-4 h-full items-center" x-data="{ 'showModal': false,  'showBtn': @entangle('showListBc')}" @keydown.escape="showModal = false">

                        <button type="button" class="bg-white hover:bg-grey border-indigo-700 text-indigo-700 font-bold py-2 px-4 rounded inline-flex items-center" x-show="showBtn" @click="showModal = true">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                            </svg>
                            <span>Lier à un bon commandes</span>
                        </button>

                        <!--Overlay-->
                        <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
                            <!--Dialog-->
                            <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90">

                                <!--Title-->
                                <div class="flex justify-between items-center pb-3">
                                    <p class="text-2xl font-bold">Lier à un bon de commande</p>
                                    <div class="cursor-pointer z-50" @click="showModal = false">
                                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                        </svg>
                                    </div>
                                </div>

                                <!-- content -->
                                <p>Liste bon commandes</p>
                                @if(!@empty($listBC))
                                    <div>
                                        <label class="block" x-show="open">
                                            <select  wire:model.lazy="bonCommandeId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="0"> Choisir un bon de commande</option>
                                                    @foreach ($listBC as $item)
                                                        <option value="{{ $item->ref }}">{{ $item->ref }} </option>
                                                    @endforeach
                                            </select>
                                        </label>
                                    </div>
                                @endif




                            </div>
                            <!--/Dialog -->
                        </div><!-- /Overlay -->

                    </section>
                    @endif


                </div>
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
                                        @role(['directeur_achats', 'admin'])
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider"> TVA </th>
                                        @endrole
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Num lot
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">QTE
                                        </th>
                                        @role(['directeur_achats', 'admin'])
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Prix Achat
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Montant
                                        </th>
                                        @endrole
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    {{--           @for ($i = 0; $i < 5; $i++)--}}
                                    @for($line=0; $line <=$lines_count; $line++)
                                    <tr  x-data="{ isOpen{{$line}}: false }">
                                        <td class="p-2 border border-gray-200">
                                            <input type="hidden" wire:model="articleId.{{$line}}" />
                                            <input wire:model="code.{{$line}}" x-on:keyup="isOpen{{$line}}=true" wire:keyup="showArticle({{$line}})"
                                                   class="w-full py-1" type="text"/>

                                            <ul x-show="isOpen{{$line}}" x-on:click.away="isOpen{{$line}}=false" class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                                @if (!empty($articles))
                                                    @foreach($articles as $item)
                                                        <li class="py-1" x-on:click="isOpen0 = !isOpen{{$line}}"
                                                            wire:click="getArticle('{{ $item->id }}','{{ $item->code }}', '{{ $item->libelle }}', {{ $item->famille }} , '{{ $item->tva }}') ">{{$item->code }} | {{$item->libelle}}</li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input wire:model="libelle.{{$line}}" class="w-full py-1" type="text"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input wire:model="famille.{{$line}}" class="w-full py-1" type="text"/>
                                        </td>
                                        @role(['directeur_achats', 'admin'])
                                        <td class="border bordergray600"">
                                            @isset($tva[$line])
                                                {{ $tva[$line] }}
                                            @endisset
                                        </td>
                                        @endrole
                                        <td class="p-2 border border-gray-200">
                                            <input class="w-full py-1" wire:model.defer="numLot.{{ $line }}"
                                                type="text"/>
                                        </td>

                                        <td class="p-2 border border-gray-200">
                                            <input class="w-full py-1" wire:model.defer="qte.{{ $line }}"
                                                type="text" wire:change="updateData({{ $line }})" />
                                        </td>
                                        @role(['directeur_achats', 'admin'])
                                        <td class="p-2 border border-gray-200">
                                            <input class="w-full py-1" wire:model.defer="prixAchat.{{ $line }}"
                                                type="text" wire:change="updateData({{ $line }})" />
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            @isset($montant[$line])
                                                {{ number_format( $montant[$line], 2 , ',' , ' ') }}
                                            @endisset

                                            {{-- <input x-model="$store.bon.montantshow[{{$value}}]" class="w-full py-1" type="text"/> --}}
                                        </td>
                                        @endrole

                                        {{-- <td class="p-2 border border-gray-200">
                                            <input x-model="$store.bon.qte[{{$line}}]"  wire:model.defer="qte.{{$line}}" class="w-full py-1" type="text" @keyup="$store.bon.total({{$line}})"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input x-model="$store.bon.prixAchat[{{$line}}]" wire:model.defer="prixAchat.{{$line}}" class="w-full py-1" type="text" @keyup="$store.bon.total({{$line}})"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input x-model="$store.bon.montant[{{$line}}]" wire:model.defer="montant.{{$line}}" class="w-full py-1" type="text"/>

                                        </td> --}}

                                        {{-- <td class="p-2 border border-gray-200">
                                            <input  wire:model.defer="qte.{{$line}}" class="w-full py-1" type="text"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input  wire:model.defer="prixAchat.{{$line}}" class="w-full py-1" type="text"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input wire:model.defer="montant.{{$line}}" class="w-full py-1" type="text"/>

                                        </td> --}}
                                    </tr>
                                    @endfor

                                    @foreach($inputs as $key => $value)
                                        <tr x-data="{ isOpen{{$value}}: false }" x-init="isOpen{{$value}}=false">
                                            <td class="p-2 border border-gray-200" >
                                                <input type="hidden" wire:model="articleId.{{$value}}" />
                                                <input wire:model="code.{{$value}}" x-on:keyup="isOpen{{$value}}=true" wire:keyup="showArticle({{$value}})"
                                                       class="w-full py-1" type="text"/>

                                                <ul x-show="isOpen{{$value}}" x-on:click.away="isOpen{{$value}}=false" class="absolute z-10 cursor-pointer bg-indigo-700 mt-2 text-white py-1 w-1/4">
                                                    @if (!empty($articles))
                                                        @foreach($articles as $item)
                                                            <li class="py-1" x-on:click="isOpen{{$value}} = !isOpen{{$value}}"
                                                                wire:click="getArticle('{{ $item->id }}','{{ $item->code }}', '{{ $item->libelle }}', {{ $item->famille }},'{{ $item->tva }}')">{{$item->code }} | {{$item->libelle}}</li>
                                                        @endforeach</ul>@endif
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <input wire:model="libelle.{{$value}}" class="w-full py-1" type="text"/>
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <input wire:model="famille.{{$value}}" class="w-full py-1" type="text"/>
                                            </td>
                                            @role(['directeur_achats', 'admin'])
                                                <td class="border bordergray600"">
                                                    @isset($tva[$value])
                                                        {{ $tva[$value] }}
                                                    @endisset
                                                </td>
                                            @endrole
                                            {{-- <td class="p-2 border border-gray-200">
                                                <input wire:model.defer="qte.[{{$value}}]" x-model="$store.bon.qte[{{$value}}]" class="w-full py-1" type="text" @keyup="$store.bon.total({{$value}})"/>
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <input wire:model.defer="prixAchat.[{{$value}}]" x-model="$store.bon.prixAchat[{{$value}}]" class="w-full py-1" type="text" @keyup="$store.bon.total({{$value}})"/>
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                <input wire:model.defer="montant.[{{$value}}]" x-model="$store.bon.montant[{{$value}}]" class="w-full py-1" type="text"/>
                                            </td>--}}

                                            <td class="p-2 border border-gray-200">
                                                <input class="w-full py-1" wire:model.defer="numLot.{{ $value }}"
                                                    type="text" />
                                            </td>

                                            <td class="p-2 border border-gray-200">
                                                <input class="w-full py-1" wire:model.defer="qte.{{ $value }}"
                                                    type="text" wire:change="updateData({{ $value }})" />
                                            </td>
                                            @role(['directeur_achats', 'admin'])
                                                <td class="p-2 border border-gray-200">
                                                    <input class="w-full py-1" wire:model.defer="prixAchat.{{ $value }}"
                                                        type="text" wire:change="updateData({{ $value }})" />
                                                </td>

                                                <td class="p-2 border border-gray-200">
                                                    @isset($montant[$value])
                                                        {{ number_format( $montant[$value], 2 , ',' , ' ') }}
                                                    @endisset

                                                </td>
                                            @endrole
                                            <td>
                                                <button type="button" class="w-7 rounded-md text-white bg-red-700"
                                                    wire:click="remove({{ $loop->index + 1 }})">X</button>

                                            </td>

                                            {{-- <td class="bg-transparent">
                                                <button class="w-7 rounded-md text-white bg-red-700" wire:click.prevent="remove({{$key}})">X</button>
                                            </td> --}}
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
                                @role(['directeur_achats', 'admin'])
                                <table>
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                TVA
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                Total
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                Total TVA
                                            </th>

                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                Total TTC
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($totalTvas as $key => $value)
                                            <tr>
                                                <td class="p-2 border border-gray-200">
                                                    {{ $key }} %
                                                </td>
                                                <td class="p-2 border border-gray-200">
                                                    {{ number_format($totalMts[$key], 2, ',', ' ') }}
                                                </td>

                                                <td class="p-2 border border-gray-200">
                                                    {{ number_format($value, 2, ',', ' ') }}
                                                </td>

                                                <td class="p-2 border border-gray-200">
                                                    {{ number_format($totalTtcs[$key], 2, ',', ' ') }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr class="bg-gray-300">
                                            <th
                                                class="px-6 py-3 bg-gray-400 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                                TOTaux
                                            </th>
                                            <td class="p-2 border border-gray-200">
                                                {{ number_format($totalMt, 2, ',', ' ') }}
                                            </td>
                                            <td class="p-2 border border-gray-200">
                                                {{ number_format($totalTva, 2, ',', ' ') }}
                                            </td>

                                            <td class="p-2 border border-gray-200">
                                                {{ number_format($totalTtc, 2, ',', ' ') }}
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                                @endrole
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
        @livewire('achat.liste-bon-achat')
    </div>
</div>

<script>

    /* Spruce.store('bon',{
        qte:[''],prixAchat:[''],montant:[''],totalHt:0, totalTva:0, totalTtc:0,

        total(index){
            this.montant[index] = this.prixAchat[index] > 0 ? this.qte[index] * this.prixAchat[index] : this.qte[index] * 0 ;
            this.totalHt = 0;
            this.totalG();
            this.totalTv();
            this.totalTc();
        },

        totalG(){

            for(i=0; i< this.montant.length; i++){
                this.totalHt += this.montant[i];
                this.totalHt = parseFloat(this.totalHt);
            }
            var element = document.getElementById('totalHt');
            element.dispatchEvent(new Event('input'));
        },

        totalTv(){

            this.totalTva = this.totalHt / 6;
            var element = document.getElementById('totalTva');
            element.dispatchEvent(new Event('input'));

            },

        totalTc(){

            this.totalTtc = this.totalHt * 1.2;
            var element = document.getElementById('totalTtc');
            element.dispatchEvent(new Event('input'));

            }

    }) */
    //Spruce.watch("bon.totalHt", value => console.log(value))

    function myFunc(){
        return {
            isOpen0:false,
        }
    }

</script>




