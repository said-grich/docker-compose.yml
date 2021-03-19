<div class="p-5 bg-white" x-data="{ openTab: 2 }">
    <ul class="flex border-b mx-5">
        <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-white bg-indigo-700' : 'text-gray-700 hover:text-gray-800'"
                class="bg-white inline-block py-2 px-4 font-sm" href="#">
                Nouveau devis
            </a>
        </li>
        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-white bg-indigo-700' : 'text-gray-700 hover:text-gray-800'"
                class="bg-white inline-block py-2 px-4 font-sm" href="#">
                Liste devis
            </a>
        </li>

    </ul>
    <div x-show="openTab === 1">
        <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Création devis') }}
                </h2>
            </x-slot>

            <form wire:submit.prevent="saveDevis">

                <div class="grid grid-cols-7 gap-4 p-4 mb-8">
                    <label class="block">
                        <span class="text-gray-700">Date</span><span class="text-red-500">*</span>
                        <input wire:model.lazy="date" id="datepicker" type="text" class="block w-full mt-1 form-input"
                            id="date" autocomplete="date">
                        @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Devis ref.</span><span class="text-red-500">*</span>
                        <input type="text" wire:model.lazy="ref" class="block w-full mt-1 form-input" placeholder="">
                        @error('ref') <span class="text-red-500">{{ $message }}</span> @enderror
                    </label>

                    <label class="block">
                        <span class="text-gray-700">Site</span><span class="text-red-500">*</span>
                        <select wire:model.lazy="siteId"
                            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option> Choisir un site</option>
                            @foreach ($list_sites as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                        @error('siteId') <span class="text-red-500">{{ $message }}</span> @enderror
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Délai liv en jours</span><span class="text-red-500">*</span>
                        <input type="text" wire:model.lazy="delai" class="block w-full mt-1 form-input" placeholder="">
                        @error('delai') <span class="text-red-500">{{ $message }}</span> @enderror
                    </label>
                    <label class="block">
                        <span class="text-gray-700">date d’expiration</span><span class="text-red-500">*</span>
                        <input wire:model.lazy="dateValidite" id="dateValidite" type="text"
                            class="block w-full mt-1 form-input" autocomplete="date">
                        @error('dateValidite') <span class="text-red-500">{{ $message }}</span> @enderror
                    </label>
                    <label class="block">
                        <span class="text-gray-700">Client</span><span class="text-red-500">*</span>
                        <select wire:model.lazy.defer="clientId"
                            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0"> Choisir un client</option>
                            @foreach ($list_clients as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                            @endforeach
                        </select>
                        @error('clientId') <span class="text-red-500">{{ $message }}</span> @enderror
                    </label>
                    <label class="block">

                        <div x-data="{ 'isDialogOpen': false }" @keydown.escape="isDialogOpen = false">
                            <button type="button" @click="isDialogOpen = true"
                                class="inline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25" ">Ajouter un Client</button>

                            <div class=" overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="isDialogOpen"
                                :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }">

                                <div class="bg-white shadow-2xl m-auto" x-show="isDialogOpen">

                                    <div class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                        <h6 class="text-xl font-bold">Ajouter un Client: <span
                                                class="text-indigo-700">{{ $item->ref }}</span> </h6>
                                        <button type="button" @click="isDialogOpen = false">✖</button>
                                    </div>

                                    <div class="p-2">
                                        @livewire('show-client')
                                    </div>
                                </div>
                        </div>

                </div>
                </label>
        </div>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="i overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        CODE
                                        ARTICLE
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        LIBELLE
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        QTE
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        PRIX
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        MONTANT
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        TVA
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        Remise
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                {{-- @for ($i = 0; $i < 5; $i++) --}}
                                <tr x-data="{isOpen0:false}">
                                    <td class="p-2 border border-gray-200">
                                        <input type="hidden" wire:model="articleId.0" />
                                        <input wire:model="code.0" x-on:keyup="isOpen0=true" wire:keyup="showArticle(0)"
                                            class="w-full py-1" type="text" />

                                        <ul x-show="isOpen0" x-on:click.away="isOpen0=false"
                                            class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                            @if (!empty($articles))
                                                @foreach ($articles as $item)
                                                    <li class="py-1" x-on:click="isOpen0 = !isOpen0"
                                                        wire:click="getArticle('{{ $item->id }}','{{ $item->code }}', '{{ $item->libelle }}', '{{ $item->tva }}')">
                                                        {{ $item->code }} | {{ $item->libelle }}</li>
                                                @endforeach
                                        </ul>
                                        @endif
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        @isset($libelle[0])
                                            {{ $libelle[0] }}
                                        @endisset
                                    </td>

                                    <td class="p-2 border border-gray-200">
                                        <input wire:model.defer="qte.0" class="w-full py-1" type="text"
                                            wire:change="updateData(0)" />
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        <input wire:model.defer="prix.0" class="w-full py-1" type="text"
                                            wire:change="updateData(0)" />
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        @isset($montant[0])
                                            {{ number_format($montant[0], 2, ',', ' ') }}
                                        @endisset
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        @isset($tva[0])
                                            {{ $tva[0] }}%
                                        @endisset
                                    </td>
                                    <td class="p-2 border border-gray-200">
                                        @isset($remise[0])
                                            <input wire:model.defer="remise.0" class="w-full py-1" type="text"
                                                wire:change="updateData(0)" />
                                        @endisset
                                    </td>
                                </tr>
                                @foreach ($inputs as $key)
                                    @php
                                        $value = $loop->index + 1;
                                    @endphp
                                    <tr x-data="{isOpen{{ $value }}:false}">
                                        <td class="p-2 border border-gray-200">
                                            <input type="hidden" wire:model="articleId.{{ $value }}" />
                                            <input wire:model="code.{{ $value }}"
                                                x-on:keyup="isOpen{{ $value }}=true"
                                                wire:keyup="showArticle({{ $value }})" class="w-full py-1"
                                                type="text" />

                                            <ul x-show="isOpen{{ $value }}"
                                                x-on:click.away="isOpen{{ $value }}=false"
                                                class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                                @if (!empty($articles))
                                                    @foreach ($articles as $item)
                                                        <li class="py-1"
                                                            x-on:click="isOpen{{ $value }} = !isOpen{{ $value }}"
                                                            wire:click="getArticle('{{ $item->id }}','{{ $item->code }}', '{{ $item->libelle }}', '{{ $item->tva }}')">
                                                            {{ $item->code }} | {{ $item->libelle }}</li>
                                                    @endforeach
                                            </ul>
                                @endif
                                </td>
                                <td class="p-2 border border-gray-200">
                                    @isset($libelle[$value])
                                        {{ $libelle[$value] }}
                                    @endisset
                                </td>

                                <td class="p-2 border border-gray-200">
                                    <input class="w-full py-1" wire:model.defer="qte.{{ $value }}" type="text"
                                        wire:change="updateData({{ $value }})" />
                                </td>
                                <td class="p-2 border border-gray-200">
                                    <input class="w-full py-1" wire:model.defer="prix.{{ $value }}" type="text"
                                        wire:change="updateData({{ $value }})" />
                                </td>
                                <td class="p-2 border border-gray-200">
                                    @isset($montant[$value])
                                        {{ number_format($montant[$value], 2, ',', ' ') }}
                                    @endisset
                                </td>
                                <td class="p-2 border border-gray-200">
                                    @isset($tva[$value])
                                        {{ $tva[$value] }}%
                                    @endisset
                                </td>
                                <td class="p-2 border border-gray-200">
                                    @isset($remise[$value])
                                        <input wire:model.defer="remise.{{ $value }}" class="w-sm py-1"
                                            type="number" wire:change="updateData({{ $value }})" />
                                    @endisset
                                </td>
                                <td>
                                    <button type="button" class="w-7 rounded-md text-white bg-red-700"
                                        wire:click="remove({{ $loop->index + 1 }})">X</button>

                                </td>
                                </tr>

                                @endforeach
                            <tfoot>
                                <tr>
                                    <td class="text-left pt-3" style="padding-bottom: 12px;">
                                        <button
                                            class="inline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25"
                                            wire:click.prevent="add()">Ajouter une
                                            ligne</button>
                                    </td>
                                </tr>
                            </tfoot>
                            <br>

                            </tbody>

                        </table>

                        <div class="flex  justify-between">

                            <table>
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            TVA
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                            Total HT
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
                                </tbody>

                            </table>

                            <table>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-200 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        Base HT
                                    </th>
                                    <td class="p-2 border border-gray-200">
                                        {{ number_format($totalMt, 2, ',', ' ') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-200 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        Remise Total
                                    </th>
                                    <td class="p-2 border border-gray-200">
                                        {{ number_format($totalRemise, 2, ',', ' ') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-200 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        Total HT
                                    </th>
                                    <td class="p-2 border border-gray-200">
                                        {{ number_format($totalMt - $totalRemise, 2, ',', ' ') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-200 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        Total TVA
                                    </th>
                                    <td class="p-2 border border-gray-200">
                                        {{ number_format($totalTva, 2, ',', ' ') }}
                                    </td>

                                </tr>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-200 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                        Total TTC
                                    </th>
                                    <td class="p-2 border border-gray-200">
                                        {{ number_format($totalTtc, 2, ',', ' ') }}
                                    </td>

                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right pt-3">
                <button type="submit"
                    class="nline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25">
                    Enregistrer
                </button>
            </div>
        </div>

        </form>
    </div>
</div>

<div x-show="openTab === 2">
    @livewire('liste-devis')
</div>

</div>
<script>
    // You can get and set dates with moment objects
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),

    });

    picker.setMoment(moment());

    var picker1 = new Pikaday({
        field: document.getElementById('dateValidite'),

    });

    picker1.setMoment(moment());

    // Spruce.store('bon', {
    //     qte: [''],
    //     prix: [''],
    //     montant: [''],
    //     totalMt: 0,
    //     totalTtc: 0,
    //     totalTva: 0,
    //     prixshow: [''],
    //     montantshow: [''],
    //     totalMtshow: 0,
    //     totalTtcshow: 0,
    //     totalTvashow: 0,

    //     total(index) {
    //         this.montant[index] = this.prix[index] > 0 ? this.qte[index] * this.prix[index] : this.qte[index] *
    //             0;
    //         this.montantshow[index] = new Intl.NumberFormat('de-DE').format(this.prix[index] > 0 ? this.qte[
    //             index] * this.prix[index] : this.qte[index] * 0);
    //         this.totalMt = 0;
    //         this.totalG();
    //         this.totalTt();
    //         this.totalTv();
    //     },

    //     totalG() {

    //         for (i = 0; i < this.montant.length; i++) {
    //             this.totalMt += this.montant[i];
    //         }
    //         this.totalMtshow = new Intl.NumberFormat('de-DE').format(this.totalMt)
    //     },

    //     totalTt() {

    //         this.totalTtcshow = new Intl.NumberFormat('de-DE').format(this.totalMt * 1.2);
    //         this.totalTtc = this.totalMt * 1.2;
    //     },

    //     totalTv() {

    //         //this.totalTva = this.totalTtc > 0 ? this.totalTtc /6 : this.totalTtc * 0 ;
    //         this.totalTva = this.totalTtc / 6;
    //         this.totalTvashow = new Intl.NumberFormat('de-DE').format(this.totalTtc / 6);
    //     }


    // })

</script>
