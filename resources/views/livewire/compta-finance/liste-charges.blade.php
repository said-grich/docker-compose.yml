

<div class="flex flex-col p-5">
        <div class="mt-4 mb-4">
            <div class="mt-2">
                <label class="inline-flex items-center">
                    Afficher
                    <select wire:model="perPage" class="form-select mt-1 block w-full">
                        <option value="3">3</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                </label>

                <label class="inline-flex items-center">Recherche</label>
                <input wire:model="search" class="form-input h-8 w-1/10" />
            </div>
        </div>

        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="mb-3 min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                            <tr>
                                <th wire:click="sortBy('ref')" scope="col"
                                    class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                    Charge ref
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                    Site
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                    Bon réception ref
                                </th>
                                <th wire:click="sortBy('delai')" scope="col"
                                    class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                    Montant total HT
                                </th>
                                <th scope="col" class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                    Validation
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                    Agent
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                    Actions
                                </th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($list as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $item->ref }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $item->created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $item->site->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $item->bonReception->ref }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $item->montant_total }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm {{ $item->is_valid === true ? "" : "text-red-500"}}">
                                        {{ $item->is_valid === true ? "Validée" : "Non validée"}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $item->user->name }}
                                    </td>
                                    <td class="w-15">
                                        <a href="{{ route('edit-charge', ['ida' => $item->ref]) }}">
                                            <svg class="w-5 h-5 cursor-pointer fill-current text-indigo-500 ml-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $list->links() }}
                </div>
            </div>
        </div>
    </div>

