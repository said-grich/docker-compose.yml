<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Création bon de réception') }}
    </h2>
</x-slot>
<div>

    <div class="flex flex-col p-5">
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
            <div class="mr-4 inline-flex items-center">
                <label class="mr-2">Etat</label>
                <select wire:model="etat" class="form-select mt-1">
                    <option value="">Veuillez choisir</option>
                    <option value="true">Validé</option>
                    <option value="false">Non validé</option>
                </select>
            </div>
        </div>

        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="mb-3 min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Bon reception ref
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Fournisseur
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Site
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Depot
                            </th>
                            @role(['directeur_achats', 'admin'])
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Montant TTC
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Etat
                            </th>
                            @endrole
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Agent
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Date création
                            </th>
                            {{-- @role(['directeur_achats', 'admin'])
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Status
                            </th>
                            @endrole --}}
                            <th colspan="2" scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(count($list) > 0)
                                @foreach($list as $item)
                                     <tr class="{{ $item->validation === false && Auth::user()->hasRole(['directeur_achats', 'admin']) ? "bg-red-300" : "" }} ">

                                       <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $item->ref }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $item->fournisseur->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $item->date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $item->site->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $item->depot->name }}
                                        </td>
                                        @role(['directeur_achats', 'admin'])
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ number_format($item->total_ttc, 2, ',', ' ') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $item->validation === true ? "Validé": "N'est pas validé" }}
                                        </td>
                                        @endrole
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $item->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{$item->created_at}} | {{$item->created_at->diffForHumans()}}
                                        </td>
                                        @role(['directeur_achats', 'admin'])

                                            {{-- @if($item->total_ttc === null)
                                                <td>
                                                    <span class="relative text-xs">Nécessite une saisie des prix</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="relative text-xs">Nécessite une vérification des prix</span>
                                                </td>
                                            @endif --}}
                                            <td class="w-15">
                                                <a  href="{{ route('edit-bon-achat', ['ida' => $item->ref]) }}">
                                                    <svg class="w-5 h-5 cursor-pointer fill-current text-indigo-700 ml-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                                </a>
                                            </td>

                                        @endrole
                                        @role(['directeur_achats', 'admin'])

                                            <td class="w-15 delete">
                                                <svg class="w-5 h-5 cursor-pointer fill-current text-red-500" wire:click="deleteBonCommande('{{$item->ref}}', '{{$item->id}}', '{{$item->demande_achat_ref}}')"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <title>Supprimer</title>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </td>
                                        @endrole
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    Aucun enregistrement à afficher
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $list->links() }}
                </div>
            </div>
        </div>
    </div>

</div>






