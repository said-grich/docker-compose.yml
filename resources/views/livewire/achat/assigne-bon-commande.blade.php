<div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8" x-data="{ openTab: 2 }">
    <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Création bon commande') }}
            </h2>
        </x-slot>

        @if (session()->has('error-message'))
            <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500">
        <span class="inline-block align-middle mr-8">
            {{ session('error-message') }}
        </span>
            </div>
        @endif

        <form wire:submit.prevent="assignBonCommande">

            <div class="grid grid-cols-6 gap-4 p-4 mb-8">
                <label class="flex items-center">
                    <span class="text-gray mr-2">Attaché à </span>
                    <span class="text-indigo-700"> {{$ref}}</span>
                    <input type="text" wire:model.defer="ref" hidden>
                </label>
                <label class="block">
                    <span class="text-gray">Date</span>
                    <input wire:model.lazy="date" id="datepicker" type="text" class="block w-full mt-1 form-input" id="date">
                    @error('date') <span class="text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="block">
                    <span class="text-gray">Bon commande Ref.</span>
                    <input type="text" wire:model.defer="refBonCommande" class="block w-full mt-1 form-input" placeholder="">
                    @error('refBonCommande') <span class="text-red-600">{{ $message }}</span> @enderror
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
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">QTE magasinier
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">QTE
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">prix
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">fournisseur
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
                                        <input wire:model="qteMagasinier.{{$line}}" class="w-full py-1" type="text" readonly/>
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model="qteACommander.{{$line}}" class="w-full py-1" type="text"/>
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model="prix.{{$line}}" class="w-full py-1" type="text"/>
                                    </td>

                                    <td class="p-2 border border-gray-200" x-data="{isOpen{{$line}}:false}">
                                        <input type="hidden" value="fournisseurId.{{$line}}" wire:model="fournisseurId.{{$line}}" />
                                        <input wire:model="name.{{$line}}"
                                               @keyup="isOpen{{$line}}=true" wire:keyup="showFournisseur({{$line}})" class="w-full py-1" type="text"/>

                                        <ul x-show="isOpen{{$line}}"  @click.away="isOpen{{$line}}=false" class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                            @if (!empty($fournisseurs))
                                                @foreach($fournisseurs as $item)
                                                    <input type="hidden" wire:model="fournisseurId.{{$item->id}}" />
                                                    <li @click="isOpen{{$line}}= !isOpen{{$line}}" wire:click="getFournisseur('{{$item->id}}', '{{ $item->name }}')">{{$item->name}}</li>
                                                @endforeach</ul>@endif
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
                                                    <li class="py-1" x-on:click="isOpen{{$value}} = !isOpen{{$value}}"
                                                        wire:click="getArticle('{{ $item->id }}','{{ $item->code }}', '{{ $item->libelle }}', '{{ $item->famille->famille }}')">{{$item->code }} | {{$item->libelle}}</li>
                                                @endforeach</ul>@endif
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model="libelle.{{$value}}" class="w-full py-1" type="text"/>
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model="famille.{{$value}}" class="w-full py-1" type="text"/>
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model="qteMagasinier.{{$value}}" class="w-full py-1" type="text"/>
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model="qteACommander.{{$value}}" class="w-full py-1" type="text"/>
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model="prix.{{$value}}" class="w-full py-1" type="text"/>
                                    </td>

                                    <td class="p-2 border border-gray-200" x-data="{isOpen{{$value}}:false}">
                                        <input type="hidden" value="fournisseurId.{{$value}}" wire:model="fournisseurId.{{$value}}" />
                                        <input wire:model="name.{{$value}}"
                                               @keyup="isOpen{{$value}}=true" wire:keyup="showFournisseur({{$value}})" class="w-full py-1" type="text"/>

                                        <ul x-show="isOpen{{$value}}"  @click.away="isOpen{{$value}}=false" class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                            @if (!empty($fournisseurs))
                                                @foreach($fournisseurs as $item)
                                                    <input type="hidden" wire:model="fournisseurId.{{$item->id}}" />
                                                    <li @click="isOpen{{$value}}= !isOpen{{$value}}" wire:click="getFournisseur('{{$item->id}}', '{{ $item->name }}')">{{$item->name}}</li>
                                                @endforeach</ul>@endif
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
    var picker = new Pikaday(
        {
            field: document.getElementById('datepicker'),
            firstDay: 1,
        });

    picker.setMoment(moment().dayOfYear(365));
</script>




