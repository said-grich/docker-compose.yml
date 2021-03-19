<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Création bon de commande') }}
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
                            Bon commande ref
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Fournisseur
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Agent
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Attachement
                        </th>
                        @permission('autorisation-bon-commande')

                        <th colspan="4" scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Actions
                        </th>
                        @endpermission


                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(count($list) > 0)
                            @foreach($list as $item)
                            <tr>
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
                                    {{ $item->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($item->demande_achat_ref === 0)
                                        Aucun attachement
                                    @else
                                        <div x-data="{ 'isDialogOpen': false }" @keydown.escape="isDialogOpen = false">
                                            <button type="button" class="text-indigo-700 hover:text-indigo-800" @click="isDialogOpen = true">Demande achat réf : {{$item->demande_achat_ref}}</button>
                                            <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="isDialogOpen" :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }">
                                                <div class="bg-white shadow-2xl m-auto" x-show="isDialogOpen" @click.away="isDialogOpen = false">
                                                    <div class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                                        <h6 class="text-xl font-bold">Demande achat ref: <span class="text-indigo-700">{{$item->demande_achat_ref}}</span> </h6>
                                                        <button type="button" @click="isDialogOpen = false">✖</button>
                                                    </div>
                                                    <div class="p-2">
                                                        @livewire('achat.show-demande-achat', ['ida' => $item->demande_achat_ref])
                                                    </div>
                                                </div>
                                            </div>

                                    @endif
                                </td>
                                @permission('autorisation-bon-commande')
                                {{--<td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a class="{{ $item->validation === 1 ? "bg-gray-500 text-white pointer-events-none" : "bg-transparent hover:bg-indigo-700 text-indigo-700 hover:text-white border border-indigo-700 hover:border-transparent" }}  font-semibold  py-2 px-4 rounded" onclick="confirm('Vous voulez vraiment assigner le bon commande ref : {{$item->ref}}?') || event.stopImmediatePropagation()"  href="{{ route('transfert-bon-commande', ['ref' => $item->ref]) }}">{{ $item->validation === 1 ? "Validé" : "A Signer" }}</a>
                                </td>--}}

                                <td class="w-15">
                                    <a href="{{ route('edit-bon-commande', ['ida' => $item->ref]) }}" class="{{ $item->validation === 1 ? 'pointer-events-none' : "" }}">
                                        <svg class="w-5 h-5 cursor-pointer fill-current {{ $item->validation === 1 ? 'text-gray-200' : "text-indigo-700" }} ml-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                    </a>
                                </td>
                                @endpermission
                                <td class="w-15 px-5 py-4 whitespace-nowrap text-right text-sm font-medium">

                                    <div x-data="{ 'isDialogOpen': false }" @keydown.escape="isDialogOpen = false">
                                        <button type="button" class="text-indigo-700 hover:text-indigo-800" @click="isDialogOpen = true">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="isDialogOpen" :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }">
                                            <div class="bg-white shadow-2xl m-auto" x-show="isDialogOpen" @click.away="isDialogOpen = false">
                                                <div class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                                    <h6 class="text-xl font-bold">Détails bon commande ref: <span class="text-indigo-700">{{$item->ref}}</span> </h6>
                                                    <button type="button" @click="isDialogOpen = false">✖</button>
                                                </div>

                                                <div class="p-2">
                                                    @livewire('achat.show-bon-commande', ['ida' => $item->ref])
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                @permission('suppression-bon-commande')
                                <td class="w-15 delete">
                                    <svg class="w-5 h-5 cursor-pointer fill-current text-red-500" wire:click="deleteBonCommande('{{$item->ref}}', '{{$item->id}}', '{{$item->demande_achat_ref}}')"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <title>Supprimer</title>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </td>
                                @endpermission

                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    Aucun bon de commande n'a été crée
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

