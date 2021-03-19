<div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Modification devis') }}
        </h2>
    </x-slot>

    <form wire:submit.prevent="editDevis">

        <div class="grid grid-cols-6 gap-4 p-4 mb-8">
            <label class="block">
                <span class="text-gray">Date</span>
                <input wire:model.lazy="date" id="datepicker" type="text" class="block w-full mt-1 form-input" id="date"
                    autocomplete="date">
            </label>
            <label class="block">
                <span class="text-gray">devis ref.</span>
                <input type="text" wire:model.lazy="ref" class="block w-full mt-1 form-input" placeholder="">
            </label>

            <label class="block">
                <span class="text-gray-700">Site</span>
                <select wire:model.lazy="siteId"
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="0"> Choisir un site</option>
                    @foreach ($list_sites as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span class="text-gray-700">Délai liv en jours</span>
                <input type="text" wire:model.lazy="delai" class="block w-full mt-1 form-input" placeholder="">
            </label>
            <label class="block">
                <span class="text-gray-700">date d’expiration</span>
                <input wire:model.lazy="dateValidite" id="dateValidite" type="text" class="block w-full mt-1 form-input"
                    autocomplete="date">
            </label>
            <label class="block">
                <span class="text-gray">Client</span>
                <select wire:model.lazy="clientId"
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="0"> Choisir un client</option>
                    @foreach ($list_clients as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
            </label>

        </div>
        <div class="grid p-4">
            <table class="divide-y divide-gray-200">
                <thead class="bg-gray-300">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-indigo-700 uppercase">
                            CODE
                            ARTICLE
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-indigo-700 uppercase">
                            LIBELLE
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-indigo-700 uppercase">QTE
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-indigo-700 uppercase">
                            PRIX
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-indigo-700 uppercase">
                            MONTANT
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-indigo-700 uppercase">TVA
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Remise
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-gray">

                    @for ($line = 0; $line < $lines_count; $line++)
                        <tr>
                            <td class="border border-gray-200" x-data="{isOpen{{ $line }}:false}">
                                <input type="hidden" wire:model="articleId.{{ $line }}" />
                                <input wire:model="code.{{ $line }}" @keyup="isOpen{{ $line }}=true"
                                    wire:keyup="showArticle({{ $line }})" class="w-full py-1" type="text" />

                                <ul x-show="isOpen{{ $line }}" @click.away="isOpen{{ $line }}=false"
                                    class="absolute z-10 cursor-pointer bg-indigo-700 text-white py-1 w-1/4">
                                    @if (!empty($articles))
                                        @foreach ($articles as $item)
                                            <li @click="isOpen{{ $line }} = !isOpen{{ $line }}"
                                                wire:click="getArticle('{{ $item->id }}', '{{ $item->code }}', '{{ $item->libelle }}', '{{ $item->tva }}')">
                                                {{ $item->code }} | {{ $item->libelle }}</li>
                                        @endforeach
                                    @endif
                                </ul>

                            </td>
                            <td class="border p-2 border border-gray-200">
                                @isset($libelle[$line])
                                    {{ $libelle[$line] }}
                                @endisset
                            </td>

                            <td class="border p-2 border border-gray-200">
                                <input wire:change="updateData({{ $line }})"
                                    wire:model="qte.{{ $line }}" class="w-full py-1" type="text" />
                            </td>
                            <td class="border p-2 border border-gray-200">
                                <input wire:change="updateData({{ $line }})"
                                    wire:model="prix.{{ $line }}" class="w-full py-1" type="text" />
                            </td>
                            </td>
                            <td class="border p-2 border border-gray-200">
                                @isset($montant[$line])
                                    {{ number_format($montant[$line], 2, ',', ' ') }}
                                @endisset
                            </td>
                            <td class="border p-2 border border-gray-200">
                                @isset($tva[$line])
                                    {{ $tva[$line] }}%
                                @endisset
                            </td>
                            <td class="p-2 border border-gray-200">
                                @isset($remise[$line])
                                    <input wire:model.defer="remise.{{ $line }}" class="w-full py-1" type="text"
                                        wire:change="updateData({{ $line }})" />
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

    var picker1 = new Pikaday({
        field: document.getElementById('dateValidite'),

    });

    picker1.setMoment(moment());

</script>
