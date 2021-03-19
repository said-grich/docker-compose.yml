<div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8" x-data="{ openTab: 2 }">
    <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Création bon réception') }}
            </h2>
        </x-slot>

        <form wire:submit.prevent="transfertBonCommande">

            <div class="grid grid-cols-4 gap-4 mb-8">
                <label class="block">
                    <span class="text-gray-700">Date</span>
                    <input wire:model.lazy="date" id="datepicker" type="text" class="block w-full mt-1 form-input" id="date" autocomplete="date">
                </label>
                <label class="block">
                    <span class="text-gray-700">Bon reception Ref.</span>
                    <input type="text" wire:model.lazy="refBonReception" class="block w-full mt-1 form-input" placeholder="">
                </label>
                <label class="block">
                    <span class="text-gray-700">Lot Num.</span>
                    <input type="text" wire:model.lazy="numLot" class="block w-full mt-1 form-input" placeholder="">
                </label>

                <label class="block">
                    <span class="text-gray-700">Depot</span>
                    <select  wire:model.lazy="depotId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="0"> Choisir un depot</option>
                        @foreach ($list_depots as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-gray-700">Site</span>
                    <select  wire:model.lazy="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="0"> Choisir un site</option>
                        @foreach ($list_sites as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-gray-700">Date BL Fournissuer</span>
                    <input wire:model.lazy="dateBlFournisseur" id="dateBlFournisseur" type="text" class="block w-full mt-1 form-input" autocomplete="date">
                </label>

                <label class="block">
                    <span class="text-gray-700">Fournisseur</span>
                    <input type="hidden" wire:model="fournisseurId" />                    <input type="text" wire:model.lazy="fournisseur" class="block w-full mt-1 form-input bg-gray-300" placeholder="" readonly>
                </label>
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
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">QTE Commandée
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">QTE reçu
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Prix Achat
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Montant
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @for($line=1; $line <=$lines_count; $line++)
                                    <tr>
                                        <td class="p-2 border border-gray-200" x-data="{isOpen{{$line}}:false}">
                                            <input type="hidden" wire:model="articleId.{{$line}}" />
                                            <input wire:model="code.{{$line}}"
                                                   @keyup="isOpen{{$line}}=true" wire:keyup="showArticle({{$line}})"
                                                   class="w-full py-1" type="text"/>

                                            <ul x-show="isOpen{{$line}}"  @click.away="isOpen{{$line}}=false" class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                                @if (count($articles))
                                                    @foreach($articles as $item)
                                                        <li @click="isOpen{{$line}}= !isOpen{{$line}}" wire:click="getArticle('{{$item->id}}', '{{ $item->code }}', '{{ $item->libelle }}', '{{ $item->famille->famille }}')">{{$item->code }} | {{$item->libelle}}</li>
                                                    @endforeach</ul>@endif
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input wire:model="libelle.{{$line}}" class="w-full py-1"
                                                   type="text"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input wire:model="famille.{{$line}}" class="w-full py-1" type="text"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input wire:model.defer="qteCommandee.{{$line}}" class="w-full py-1" type="text" readonly/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input x-model="$store.bon.qte[{{$line}}]"  wire:model.defer="qteRecu.{{$line}}" class="w-full py-1" @keyup="$store.bon.total({{$line}})" type="number"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input x-model="$store.bon.prixAchat[{{$line}}]" wire:model.defer="prixAchat.{{$line}}" class="w-full py-1" @keyup="$store.bon.total({{$line}})" type="number"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input x-model="$store.bon.montant[{{$line}}]" wire:model.defer="montant.{{$line}}" class="w-full py-1" type="number"/>

                                        </td>
                                    </tr>
                                @endfor
                                @foreach($inputs as $key => $value)
                                    <tr x-data="{isOpen{{$value}}:false}">
                                        <td class="p-2 border border-gray-200" >
                                            <input type="hidden" wire:model="articleId.{{$value}}" />
                                            <input wire:model="code.{{$value}}" x-on:keyup="isOpen{{$value}}=true" wire:keyup="showArticle({{$value}})"
                                                   class="w-full py-1" type="text"/>

                                            <ul x-show="isOpen{{$value}}" x-on:click.away="isOpen{{$value}}=false" class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                                @if (!empty($articles))
                                                    @foreach($articles as $item)
                                                        <li class="py-1" x-on:click="isOpen{{$value}} = !isOpen{{$value}}" wire:click="getArticle('{{ $item->id }}','{{ $item->code }}', '{{ $item->libelle }}', '{{ $item->famille->famille }}')">{{$item->code }} | {{$item->libelle}}</li>
                                                    @endforeach</ul>@endif
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input wire:model="libelle.{{$value}}" class="w-full py-1" type="text"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input wire:model="famille.{{$value}}" class="w-full py-1" type="text"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input wire:model.defer="qteCommandee.{{$value}}" class="w-full py-1" type="text" readonly/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input x-model="$store.bon.qte[{{$value}}]"  wire:model="qteRecu.{{$value}}" class="w-full py-1" type="text" @keyup="$store.bon.total({{$value}})"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input x-model="$store.bon.prixAchat[{{$value}}]" wire:model="prixAchat.{{$value}}" class="w-full py-1" type="text" @keyup="$store.bon.total({{$value}})"/>
                                        </td>
                                        <td class="p-2 border border-gray-200">
                                            <input x-model="$store.bon.montant[{{$value}}]" wire:model="montant.{{$value}}" class="w-full py-1" type="text"/>
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
                                {{--<table>
                                    <tbody>
                                    <tr>
                                        <td colspan="4"></td>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-gray uppercase text-left">Total</th>
                                        <td>
                                            <input wire:model="total_ht" x-model="$store.bon.totalMt" class="w-full py-1" type="text"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-gray uppercase text-left">Total TVA</th>
                                        <td>
                                            <input wire:model="total_tva" x-model="$store.bon.totalTva"  class="w-full py-1" type="text"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-gray uppercase text-left">Total TTC</th>
                                        <td>
                                            <input wire:model="total_ttc" x-model="$store.bon.totalTtc"  class="w-full py-1" type="text"/></td>
                                    </tr>
                                    </tbody>
                                </table>--}}
                                </tfoot>
                                <br>
                                <table>
                                    <thead class="bg-gray-200">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Total
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Total TTC
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Total TVA
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <td class="p-2 border border-gray-200">
                                        <input x-model="$store.bon.totalMt" wire:model="totalHt" class="w-full py-1" type="text"/>
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input x-model="$store.bon.totalTtc" wire:model="totalTtc"  class="w-full py-1" type="text"/>
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input x-model="$store.bon.totalTva" wire:model="totalTva" class="w-full py-1" type="text"/>
                                    </td>

                                    </tbody>

                                </table>
                                </tbody>

                            </table>
                            <div class="text-right pt-3">
                                <button type="submit" class="nline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25" >
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    // You can get and set dates with moment objects
    var picker = new Pikaday(
        {
            field: document.getElementById('datepicker'),

        });

    picker.setMoment(moment());

    var picker1 = new Pikaday(
        {
            field: document.getElementById('dateBlFournisseur'),

        });

    picker1.setMoment(moment());

   Spruce.store('bon',{
        qte:[''],prixAchat:[''],montant:[''],totalMt:0, totalTva:0, totalTtc:0,

        total(index){
            this.montant[index] = parseFloat(this.prixAchat[index]) > 0 ? parseFloat(this.qte[index]) * parseFloat(this.prixAchat[index]) : parseFloat(this.qte[index]) * 0 ;
            this.montant[index] = parseFloat(this.montant[index]);
            this.totalMt = 0;
            this.totalG();
            this.totalTv();
            this.totalTc();
        },

        totalG(){

            for(i=0; i< this.montant.length; i++){
                this.totalMt += this.montant[i];
                this.totalMt = parseFloat(this.totalMt);
            }
        },

        totalTv(){

            this.totalTva = this.totalMt / 6;
            this.totalTva = parseFloat(this.totalTva);

        },

        totalTc(){

            this.totalTtc = this.totalMt * 1.2;
            this.totalTtc = parseFloat(this.totalTtc);

        },



    })

    //Spruce.watch("bon.totalMt", value => console.log(value))

</script>
