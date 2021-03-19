
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code Departement</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departement</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($list as $item)
                        <tr @if($loop->even)class="bg-grey"@endif>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->code }}</td>
                            <td class="border px-4 py-2">{{ $item->departement }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div></div></div></div>
