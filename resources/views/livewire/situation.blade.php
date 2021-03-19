<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Liste bon de réception') }}
    </h2>
</x-slot>
<div>

    <div class="flex flex-col p-5">

        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="mb-3 min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                
                            </th>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Montant TTC
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Agent
                            </th>
                            <th colspan="2" scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($list as $item)
                            <tr>
                            <td class="bg-purple-300 text-center"> <input type="checkbox" /> </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $item->id }}
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $item->total_ttc }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    {{ $item->user->name }}
                                </td>
                                <td class="w-15">
                                    <a   href="{{ route('edit-bon-achat', ['ida' => $item->ref]) }}">
                                        <svg class="w-5 h-5 cursor-pointer fill-current text-indigo-700 ml-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                    </a>
                                </td>
                                <td class="w-15 delete">
                                    <svg class="w-5 h-5 cursor-pointer fill-current text-red-500" wire:click="deleteBonCommande('{{$item->ref}}', '{{$item->id}}', '{{$item->demande_achat_ref}}')"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <title>Supprimer</title>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
    
</div>






