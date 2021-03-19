<div class="flex flex-col p-5">

    @if (session()->has('message'))
        <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
        <span class="inline-block align-middle mr-8">
            {{ session('message') }}
        </span>
        </div>
    @endif

    <div class="mb-6 mt-4 pl-4">
        <div class="mr-4 inline-flex items-center">
            <label class="mr-2">
                Afficher</label>
            <select wire:model="perPage" class="form-select mt-1">
                <option>1</option>
                <option>2</option>
                <option>10</option>
            </select>
        </div>
        <div class="mr-4 inline-flex items-center">
            <label class="inline-flex items-center mr-2">Recherche</label>
            <input wire:model="search" class="form-input "/>
        </div>
    </div>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="mb-3 min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                    <tr>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            <a role="button" wire:click="sortBy('ref')"> DEMANDE REF.</a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            <a role="button" wire:click="sortBy('date')"> DATE </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Site
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Depot
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            AGENT
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Actions
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider"></th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider"></th>


                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($list as $item)
                        <tr>
                            {{--<td class="bg-purple-300 text-center"> <input type="checkbox" /> </td>--}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->ref }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                {{ $item->site->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                {{ $item->depot->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->user->name }}</td>
                            </td>
                            @permission('modification-demande-achat')
                            <td class="w-15">
                                <a   href="{{ route('edit-demande-achat', ['ida' => $item->ref]) }}">
                                    <svg class="w-5 h-5 cursor-pointer fill-current text-indigo-500 ml-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                </a>
                            </td>
                            @endpermission
                            @permission('suppression-demande-achat')
                                <td class="w-15">
                                    <svg class="w-5 h-5 cursor-pointer fill-current text-red-500" wire:click="deleteDemandeAchat('{{$item->ref}}', '{{$item->id}}')"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <title>Supprimer</title>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </td>
                            @endpermission
                            <td class="w-21">
                                {{--<button class="bg-transparent hover:bg-indigo-700 text-indigo-700 font-semibold hover:text-white py-2 px-4 border border-indigo-700 hover:border-transparent rounded" onclick="confirm('Vous voulez vraiment assigner la demande ref : {{$item->ref}}?')" wire:click="assigner('{{$item->ref}}')">
                                    A Signer
                                </button>--}}
                                @ability('magasinier,admin', 'création-demande-achat')
                                <a class="{{ $item->validation === 1 ? "bg-gray-500 text-white pointer-events-none" : "bg-gray-500 text-white" }}  font-semibold  py-2 px-4 rounded"}}">{{ $item->validation === 1 ? "Traitée" : "En cours" }}</a>
                                @endability

                                @permission('autorisation-demande-achat')
                                <a class="{{ $item->validation === 1 ? "bg-gray-500 text-white pointer-events-none" : "bg-transparent hover:bg-indigo-700 text-indigo-700 hover:text-white border border-indigo-700 hover:border-transparent" }}  font-semibold  py-2 px-4 rounded" onclick="confirm('Vous voulez vraiment assigner la demande ref : {{$item->ref}}?') || event.stopImmediatePropagation()"  href="{{ route('assigner-bon-commande', ['ref' => $item->ref]) }}">{{ $item->validation === 1 ? "Validée" : "A Signer" }}</a>
                                @endpermission
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
{{ $list->links() }}
</div>

