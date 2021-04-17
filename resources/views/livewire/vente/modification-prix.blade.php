<div>
    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
        <thead>
            <tr class="text-left">
                <th class="pl-0" style="width: 30px">
                    <label class="checkbox checkbox-lg checkbox-inline mr-2">
                        <input type="checkbox" value="1" />
                        <span></span>
                    </label>
                </th>
                <th class="pl-0" wire:click="sortBy('produit_id')" style="cursor: pointer;">Produit @include('layouts.partials._sort-icon',['field'=>'produit_id'])</th>

                <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
            </tr>
        </thead>
        <tbody>

            @if (!empty($items))

                @foreach ($items as $produit => $item)

                    <tr>
                        <td class="pl-0 py-6">
                            <label class="checkbox checkbox-lg checkbox-inline">
                                <input type="checkbox" value="1" />
                                <span></span>
                            </label>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item[0]->produit->nom }}</a>
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td>Aucun enregistrement à afficher</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
