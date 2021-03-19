<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
       Journal de banque
    </h2>
</x-slot>
<div class="flex flex-col p-5">
    <div class="mt-4 mb-4">
        <div class="mt-2">
        <label class="inline-flex items-center" >
            <span class="text-gray-700"> Site </span>
            <select  wire:model.lazy="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="0"> Choisir un site</option>
                @foreach ($list_sites as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                @endforeach
            </select>
        </label>
        </div>
    </div>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="mb-3 min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Imputation</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Libellé</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Référence</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">MVT débit</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">MVT crédit</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(!empty($list))
                            @foreach($list as $item)
                            <tr @if($loop->even) class="bg-grey"@endif>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->date_encaissement }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @isset($item->compteCrediteur->code_comptable)
                                    {{ $item->compteCrediteur->code_comptable }}
                                    @endisset
                                    @isset($item->compteDebiteur->code_comptable)
                                    {{ $item->compteDebiteur->code_comptable }}
                                    @endisset
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->fournisseur->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->ref }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->montant }}</td>
                            </tr>

                            <tr @if($loop->even) class="bg-grey"@endif>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->date_encaissement }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->fournisseur->code_comptable }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->fournisseur->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->ref }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->montant }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm"></td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
