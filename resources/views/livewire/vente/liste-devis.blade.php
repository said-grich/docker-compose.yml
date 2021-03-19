
{{--begin::Table--}}
<div class="table-responsive">
    <div class="d-flex flex-row-reverse">
        <div class="input-icon">
            <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Search...">
            <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>
        </div>
    </div>
    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
        <thead>
            <tr class="text-left">
                <th class="pl-0" style="width: 30px">
                    <label class="checkbox checkbox-lg checkbox-inline mr-2">
                        <input type="checkbox" value="1" />
                        <span></span>
                    </label>
                </th>
                <th class="pl-0" wire:click="sortBy('ref')" style="cursor: pointer;">Devis ref @include('layouts.partials._sort-icon',['field'=>'ref'])</th>
                <th class="pl-0" wire:click="sortBy('client_id')" style="cursor: pointer;">Client @include('layouts.partials._sort-icon',['field'=>'client_id'])</th>
                <th class="pl-0" wire:click="sortBy('date')" style="cursor: pointer;">Date @include('layouts.partials._sort-icon',['field'=>'date'])</th>
                <th class="pl-0" wire:click="sortBy('site_id')" style="cursor: pointer;">Site @include('layouts.partials._sort-icon',['field'=>'site_id'])</th>
                <th class="pl-0" wire:click="sortBy('delai')" style="cursor: pointer;">Delai @include('layouts.partials._sort-icon',['field'=>'delai'])</th>
                <th class="pl-0" wire:click="sortBy('user_id')" style="cursor: pointer;">Agent @include('layouts.partials._sort-icon',['field'=>'user_id'])</th>
                <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                <tr @if($loop->even)class="bg-grey"@endif>
                    <td class="pl-0 py-6">
                        <label class="checkbox checkbox-lg checkbox-inline">
                            <input type="checkbox" value="1" />
                            <span></span>
                        </label>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->ref }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->client->name }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->date }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->site->name }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->delai }} jours</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->user->name }}</a>
                    </td>
                    <td class="pr-0 text-right">
                        <a  href="{{ route('edit-devis', ['ida' =>  $item->ref]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                {{--begin::Svg Icon--}}
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    </g>
                                </svg>
                                {{--end::Svg Icon--}}
                            </span>
                        </a>
                        <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm " wire:click="deleteDevis('{{$item->ref}}', '{{$item->id}}', '{{$item->bon_commande_ref}}')" >
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                {{--begin::Svg Icon--}}
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                {{--end::Svg Icon--}}
                            </span>
                        </a>
                        <a class="{{ $item->validation === 1 ? "bg-gray-500 text-white pointer-events-none" : "bg-transparent hover:bg-indigo-700 text-indigo-700 hover:text-white border border-indigo-700 hover:border-transparent" }}  font-semibold  py-2 px-4 rounded" onclick="confirm('Vous voulez vraiment assigner la demande ref : {{$item->ref}}?') || event.stopImmediatePropagation()"  href="{{ route('transfert-devis', ['ref' => $item->ref]) }}">
                            {{ $item->validation === 1 ? "Transferé" : "Transfer" }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $list->links('layouts.partials.custom-pagination') }}
</div>
{{-- <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Liste devis') }}
    </h2>
</x-slot>
<div>

<div class="flex flex-col p-5">
    <div class="mt-4 mb-4">
        <div class="mt-2">
            <label class="inline-flex items-center">
                Afficher
                <select wire:model="perPage" class="form-select mt-1 block w-full">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
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
                        <th wire:click="sortBy('ref')" scope="col" class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Devis ref
                        </th>
                        <th  scope="col" class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Client
                        </th>
                        <th wire:click="sortBy('date')" scope="col" class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Date
                        </th>
                        <th  scope="col" class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Site
                        </th>
                        <th wire:click="sortBy('delai')" scope="col" class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Delai
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Agent
                        </th>
                        <th colspan="2" scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Actions
                        </th>
                        <th colspan="2" scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($list as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $item->ref }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="text-sm text-gray-900">{{ $item->client->name }}</div>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $item->date }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $item->site->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $item->delai }} jours
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $item->user->name }}
                        </td>

                        <td class="w-15">
                            <a   href="{{ route('edit-devis', ['ida' => $item->ref]) }}">
                                <svg class="w-5 h-5 cursor-pointer fill-current text-indigo-700 ml-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                            </a>
                        </td>
                        <td class="w-15 delete">
                            <svg class="w-5 h-5 cursor-pointer fill-current text-red-500" wire:click="deleteDevis('{{$item->ref}}', '{{$item->id}}', '{{$item->demande_achat_ref}}')"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <title>Supprimer</title>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </td>
                        <td class="w-15">

                            <a class="{{ $item->validation === 1 ? "bg-gray-500 text-white pointer-events-none" : "bg-transparent hover:bg-indigo-700 text-indigo-700 hover:text-white border border-indigo-700 hover:border-transparent" }}  font-semibold  py-2 px-4 rounded" onclick="confirm('Vous voulez vraiment assigner la demande ref : {{$item->ref}}?') || event.stopImmediatePropagation()"  href="{{ route('transfert-devis', ['ref' => $item->ref]) }}">{{ $item->validation === 1 ? "Transferé" : "Transfer" }}</a>


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

</div> --}}




{{--<div class="fixed z-10 inset-0 overflow-y-auto" x-data="{ open: false }">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: exclamation -->
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Modifier
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

--}}

