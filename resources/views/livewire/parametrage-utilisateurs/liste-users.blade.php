<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profil / Autorisation(s)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($list_users as $user)
                        <tr @if($loop->even)class="bg-grey"@endif>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                @if(count($user->roles))
                                    @foreach($user->roles as $r)

                                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs">{{$r->display_name}}</span>
                                    </span>
                                    @endforeach
                                @else
                                    <div class="flex">
                                        <span class="relative inline-block px-3 py-1 font-semibold text-indigo-900 leading-tight">
                                            <span aria-hidden class="absolute inset-0 bg-indigo-200 opacity-50 rounded-full"></span>
                                            <span class="relative text-xs">Pesonnalisé</span>
                                        </span>

                                        <div x-data="{ 'showAutorisations': false }" @keydown.escape="showAutorisations = false">
                                            <button type="button" class="text-indigo-700 hover:text-indigo-800" @click="showAutorisations = true">
                                                <svg class="w-6 text-indigo-700 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showAutorisations" :class="{ 'absolute inset-0 z-10 flex items-start justify-center': showAutorisations }">
                                                <div class="bg-white shadow-2xl m-auto" x-show="showAutorisations" @click.away="showAutorisations = false">
                                                    <div class="flex align-middle justify-between items-center border-b p-2 text-xl">
                                                        <h6 class="text-xl font-bold">Autorisations associées à : <span class="text-indigo-700">{{$user->name}}</span> </h6>
                                                        <button type="button" @click="showAutorisations = false">✖</button>
                                                    </div>

                                                    <div class="p-2">
                                                        @foreach($user->permissions as $r)

                                                            <span class="relative inline-block px-3 py-1 font-semibold text-indigo-900 leading-tight">
                                                            <span aria-hidden class="absolute inset-0 bg-indigo-200 opacity-50 rounded-full"></span>
                                                            <span class="relative text-xs">{{$r->display_name}}</span>
                                                         </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </td>


                            <td class="w-15">
                                <a href="{{ route('edit-user', ['ida' => $user->id]) }}">
                                    <svg class="w-5 h-5 cursor-pointer fill-current text-indigo-500 ml-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                </a>
                            </td>
                            <td class="w-15">
                                <svg class="w-5 h-5 cursor-pointer fill-current text-red-500" wire:click="deleteUser('{{$user->id}}')"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
