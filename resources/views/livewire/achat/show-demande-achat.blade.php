<div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">

        </h2>
    </x-slot>

    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="mb-3 min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">CODE
                    ARTICLE
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">LIBELLE
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">FAMILLE
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">QTE
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @for($line=1; $line <=$lines_count; $line++)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <input wire:model="code.{{$line}}" class="w-full py-1" type="text"/>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <input wire:model="libelle.{{$line}}" class="w-full py-1"
                               type="text"/>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <input wire:model="famille.{{$line}}" class="w-full py-1" type="text"/>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <input wire:model="qte.{{$line}}" class="w-full py-1" type="text"/>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
        </div>
    </div>
</div>
</div>






