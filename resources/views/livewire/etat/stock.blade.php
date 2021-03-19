<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Stock') }}
    </h2>
</x-slot>
<div class="flex flex-col p-5">



    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                libelle
                                <input type="text" wire:model="libelle"
                                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                {{-- <select  wire:model.lazy="libelle" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value=""> Choisir un article</option>
                                @foreach ($list_articles as $item)
                                    <option value="{{ $item->libelle }}">{{ $item->libelle }} </option>
                                @endforeach
                            </select> --}}

                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Depot

                                <select multiple wire:model.lazy="depotId"
                                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value=""> Choisir un depot</option>
                                    @foreach ($list_depots as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                                        {{-- <option value="{{ $item->id }}"><input wire:model="depotId" type="checkbox" value="{{ $item->id }}">{{ $item->name }} </option> --}}
                                    @endforeach
                                </select>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Site

                                <select multiple wire:model.lazy="siteId"
                                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value=""> Choisir un site</option>
                                    @foreach ($list_sites as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} </option>

                                        {{-- <option value="{{ $item->id }}"><input wire:model="siteId" type="checkbox" value="{{ $item->id }}"/>{{ $item->name }} </option> --}}
                                    @endforeach
                                </select>



                                {{-- <ul>
                                @foreach ($list_sites as $item)
                                <li><input wire:model="siteId" type="checkbox" value="{{ $item->id }}"/>{{ $item->name }}</li>
                                 @endforeach
                           </ul> --}}

                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Num lot.
                                <input wire:model="numLot" class="form-input block" />

                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Quantité</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Prix d'achat</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Prix + charges directes </th>
                            {{-- <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Prix + charges indirectes </th> --}}
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Prix de vente </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Marge </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if (count($list) > 0)

                            @foreach ($list as $item)
                                <tr @if ($loop->even) class="bg-grey" @endif>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->libelle }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->depot_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->site_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->num_lot }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->qte }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ number_format((float)($item->prix_achat), 2, '.', '') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ number_format((float)($item->prix_plus_charges_directes), 2, '.', '') }}</td>
                                    {{--<td class="px-6 py-4 whitespace-nowrap text-sm"></td>--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ number_format((float)($item->prix_vente), 2, '.', '') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ number_format((float)($item->marge), 2, '.', '') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center" colspan="5">
                                    Aucun enregistrement à afficher
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

</div>
