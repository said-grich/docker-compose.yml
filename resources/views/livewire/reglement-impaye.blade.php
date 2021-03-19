
<div class="flex flex-col p-5">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="mb-3 min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">la deuxième remise</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Date remise en banque</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Date encaissement</th>
                        
                        
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($list as $item)
                        <tr @if($loop->even)class="bg-grey"@endif>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->deuxime_remise }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->date_remise_banque }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->date_encaissement }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
