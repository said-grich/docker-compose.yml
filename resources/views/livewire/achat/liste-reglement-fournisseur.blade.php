
<div class="flex flex-col p-5">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="mb-3 min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Fournisseur</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Site</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Mode de paiement</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Montant</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Date échéance</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Date mise en banque</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Date encaissement</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Remise</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Actions</th>


                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($list as $item)
                        <tr @if($loop->even)class="bg-grey"@endif>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->fournisseur->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->site->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->modePaiement->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->montant }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->date_echeance }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->date_mise_banque }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->date_encaissement }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->remise }}</td>
                            <td class="w-15">
                                <a   href="{{ route('edit-reglement-fournisseur', ['ida' => $item->id]) }}">
                                    <svg class="w-5 h-5 cursor-pointer fill-current text-indigo-500 ml-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
