<div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Modification bon réception') }}
        </h2>
    </x-slot>

    <form wire:submit.prevent="editBonAchat">

        <div class="grid grid-cols-4 gap-4 p-4 mb-8">
            <label class="block">
                <span class="text-gray">Date</span>
                <input wire:model.lazy="date" id="datepicker" type="text" class="block w-full mt-1 form-input" id="date"
                       autocomplete="date">
                @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
            </label>
            <label class="block">
                <span class="text-gray">Bon achat Ref.</span>
                <input type="text" wire:model.lazy="ref" class="block w-full mt-1 form-input" placeholder="">
                @error('ref') <span class="text-red-500">{{ $message }}</span> @enderror
            </label>
            <label class="block">
                <span class="text-gray">Lot num.</span>
                <input type="text" wire:model.lazy="numLot" class="block w-full mt-1 form-input" placeholder="">
                @error('numLot') <span class="text-red-500">{{ $message }}</span> @enderror
            </label>

            <label class="block">
                <span class="text-gray">Depot</span>
                <select wire:model.lazy="depotId"
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="0"> Choisir un depot</option>
                    @foreach ($list_depots as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
                @error('depotId') <span class="text-red-500">{{ $message }}</span> @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Site</span>
                <select  wire:model.lazy="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="0"> Choisir un site</option>
                    @foreach ($list_sites as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
                @error('siteId') <span class="text-red-500">{{ $message }}</span> @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Date BL Fournissuer</span>
                <input wire:model.lazy="dateBlFournisseur" id="dateBlFournisseur" type="text" class="block w-full mt-1 form-input" autocomplete="date">
                @error('dateBlFournisseur') <span class="text-red-500">{{ $message }}</span> @enderror
            </label>

            <label class="block">
                <span class="text-gray">Fournisseur</span>
                <select wire:model.lazy="fournisseurId"
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="0"> Choisir un fournisseur</option>
                    @foreach ($list_fournisseurs as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
                @error('fournisseurId') <span class="text-red-500">{{ $message }}</span> @enderror
            </label>
        </div>
        <div class="grid p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">CODE
                            ARTICLE
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">LIBELLE
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">FAMILLE
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            TVA
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">QTE
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-indigo-700 uppercase">PRIX
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            MONTANT TVA
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">MONTANT
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @for ($line = 0; $line < $lines_count; $line++)
                        <tr>
                            <td class="border bordergray600" x-data="{isOpen{{ $line }}:false}">
                                <input type="hidden" wire:model="articleId.{{ $line }}" />
                                <input wire:model="code.{{ $line }}" @keyup="isOpen{{ $line }}=true"
                                    wire:keyup="showArticle({{ $line }})" class="w-full py-1" type="text" />

                                <ul x-show="isOpen{{ $line }}" @click.away="isOpen{{ $line }}=false"
                                    class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                    @if (!empty($articles))

                                        @foreach ($articles as $item)

                                        <li class="py-1" x-on:click="isOpen{{$line}} = !isOpen{{$line}}"
                                        wire:click="getArticle('{{ $item->id }}','{{ $item->code }}', '{{ $item->libelle }}', {{ $item->famille}} , '{{ $item->tva }}')">{{$item->code }} | {{$item->libelle}}</li>
                                        @endforeach
                                    @endif
                                </ul>

                    </td>
                    <td class="border bordergray600">
                        <input wire:model="libelle.{{ $line }}" class="w-full py-1" type="text" />
                    </td>
                    <td class="border bordergray600">
                        <input wire:model="famille.{{$line}}" class="w-full py-1" type="text"/>
                    </td>
                    <td class="border bordergray600"">
                        @isset($tva[$line])
                            {{ $tva[$line] }}
                        @endisset
                    </td>
                    <td class=" border bordergray600">
                        <input wire:change="updateData({{ $line }})" wire:model="qte.{{ $line }}"
                            class="w-full py-1" type="text" />
                    </td>
                    <td class="border bordergray600">
                        <input wire:change="updateData({{ $line }})" wire:model="prixAchat.{{ $line }}"
                            class="w-full py-1" type="text" />
                    </td>
                    <td class="border bordergray600"">
                        @isset($montanttva[$line])
                                {{ number_format($montanttva[$line], 2, ',', ' ') }}
                        @endisset
                    </td>
                    <td class=" border bordergray600">
                        @isset($montant[$line])
                            {{ number_format($montant[$line], 2, ',', ' ') }}
                        @endisset
                    </td>
                    <td>
                        @if ($lines_count > 1)
                            <button wire:click="remove({{ $line }})" type="button"
                                class="w-7 rounded-md text-white bg-red-700" wire:click="">X</button>
                        @endif


                    </td>
                    </tr>
                    @endfor
                </tbody>
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

            </table>
            <br>

        </div>
        <table>
            <thead class="bg-gray-200">
                <tr>
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
                <td class="p-2 border border-gray-200">
                    {{ number_format($totalMt, 2, ',', ' ') }}
                    {{-- <input x-model="$store.bon.totalMtshow" class="w-full py-1"  type="text" /> --}}
                </td>

                <td class="p-2 border border-gray-200">
                    {{ number_format($totalTva, 2, ',', ' ') }}
                    {{-- <input x-model="$store.bon.totalTvashow" class="w-full py-1" type="text" /> --}}
                </td>

                <td class="p-2 border border-gray-200">
                    {{ number_format($totalTtc, 2, ',', ' ') }}
                    {{-- <input x-model="$store.bon.totalTtcshow" class="w-full py-1" type="text" /> --}}
                </td>
            </tbody>

        </table>
        <button type="submit"
            class="absolute inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md right-10 w-94 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
            Enregistrer
        </button>

    </form>
</div>
</div>
</div>

<script>
    // You can get and set dates with moment objects
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        firstDay: 1,
        //minDate: new Date(2000, 0, 1),
        //maxDate: new Date(2020, 12, 31),
        //yearRange: [2000,2020],
        onSelect: function() {
            //  var date = document.createTextNode(this.getMoment().format('Do MMMM YYYY') + ' ');
            // document.getElementById('selected').appendChild(date);
        }
    });

    picker.setMoment(moment().dayOfYear(365));

</script>
