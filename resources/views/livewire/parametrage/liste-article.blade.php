<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header ">
                        <h3 class="card-title">{{ __('Liste Article') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="d-flex flex-row-reverse">
                                <div class="input-icon">
                                    <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Search...">

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
                                                    <th class="pl-0" wire:click="sortBy('code')" style="cursor: pointer;">CODE ARTICLE @include('layouts.partials._sort-icon',['field'=>'code'])</th>
                                                    <th class="pl-0" wire:click="sortBy('libelle')" style="cursor: pointer;">ARTICLE @include('layouts.partials._sort-icon',['field'=>'libelle'])</th>
                                                    <th class="pl-0" wire:click="sortBy('name')" style="cursor: pointer;">FAMILLE @include('layouts.partials._sort-icon',['field'=>'name'])</th>
                                                    <th class="pl-0" wire:click="sortBy('name')" style="cursor: pointer;">Fournisseur @include('layouts.partials._sort-icon',['field'=>'name'])</th>
                                                    <th class="pl-0" wire:click="sortBy('code_comptable')" style="cursor: pointer;">Code Comptable @include('layouts.partials._sort-icon',['field'=>'code_comptable'])</th>
                                                    <th class="pl-0" wire:click="sortBy('assujetti_tva')" style="cursor: pointer;"> Assujetti à la tva @include('layouts.partials._sort-icon',['field'=>'assujetti_tva'])</th>
                                                    <th class="pl-0" wire:click="sortBy('tva')" style="cursor: pointer;">Tva @include('layouts.partials._sort-icon',['field'=>'tva'])</th>
                                                    <th class="pl-0" wire:click="sortBy('qte_minimum ')" style="cursor: pointer;">Qte minimum @include('layouts.partials._sort-icon',['field'=>'qte_minimum '])</th>
                                                    <th class="pl-0" wire:click="sortBy('name')" style="cursor: pointer;">Unite achat @include('layouts.partials._sort-icon',['field'=>'name'])</th>
                                                    <th class="pl-0" wire:click="sortBy('name')" style="cursor: pointer;">Unite vente @include('layouts.partials._sort-icon',['field'=>'name'])</th>

                                                    <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($article as $item)
                                                    <tr @if($loop->even)class="bg-grey"@endif>
                                                        <td class="pl-0 py-6">
                                                            <label class="checkbox checkbox-lg checkbox-inline">
                                                                <input type="checkbox" value="1" />
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td class="pl-0">
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->code }}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->libelle }}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ !empty($item->famille) ? $item->famille->name:'' }}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">
                                                            @foreach($item->fournisseurs as $fournisseur)
                                                                @foreach($fournisseur as $f)
                                                                {{ $f->name }}
                                                                @endforeach
                                                            @endforeach</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->code_comptable }}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->assujetti_tva }}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->tva }}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->qte_minimum }}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ !empty($item->uniteAchat) ? $item->uniteAchat->name:'' }}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ !empty($item->uniteVente) ? $item->uniteVente->name:'' }}</a>
                                                        </td>
                                                        <td class="pr-0 text-right">
                                                            <a  href="{{ route('edit-article', ['ida' => $item->id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                                <span class="svg-icon svg-icon-md svg-icon-primary">

                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                        </g>
                                                                    </svg>

                                                                </span>
                                                            </a>
                                                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" wire:click="deleteArticle('{{$item->id}}')">
                                                                <span class="svg-icon svg-icon-md svg-icon-primary">

                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                                                        </g>
                                                                    </svg>

                                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                            </table>
                        

                            {{ $article->links('layouts.partials.custom-pagination') }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>







{{--<div class="table-responsive">
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
                <th class="pl-0" wire:click="" style="cursor: pointer;">CODE ARTICLE </th>
                <th class="pl-0" wire:click="" style="cursor: pointer;">ARTICLE </th>
                <th class="pl-0" wire:click="" style="cursor: pointer;">FAMILLE </th>
                <th class="pl-0" wire:click="" style="cursor: pointer;">Fournisseur </th>
                <th class="pl-0" wire:click="" style="cursor: pointer;">Code Comptable </th>
                <th class="pl-0" wire:click="" style="cursor: pointer;"> Assujetti à la tva </th>
                <th class="pl-0" wire:click="" style="cursor: pointer;">Tva </th>
                <th class="pl-0" wire:click="" style="cursor: pointer;">Qte minimum </th>
                <th class="pl-0" wire:click="" style="cursor: pointer;">Unite achat </th>
                <th class="pl-0" wire:click="" style="cursor: pointer;">Unite vente </th>

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
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->code }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->libelle }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ !empty($item->famille) ? $item->famille->name:'' }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">
                        @foreach($item->fournisseurs as $fournisseur)
                            @foreach($fournisseur as $f)
                            {{ $f->name }}
                            @endforeach
                        @endforeach</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->code_comptable }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->assujetti_tva }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->tva }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->qte_minimum }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ !empty($item->uniteAchat) ? $item->uniteAchat->name:'' }}</a>
                    </td>
                    <td class="pl-0">
                        <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ !empty($item->uniteVente) ? $item->uniteVente->name:'' }}</a>
                    </td>
                    <td class="pr-0 text-right">
                        <a  href="{{ route('edit-article', ['ida' => $item->id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                            <span class="svg-icon svg-icon-md svg-icon-primary">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    </g>
                                </svg>

                            </span>
                        </a>
                        <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" wire:click="deleteArticle('{{$item->id}}')">
                            <span class="svg-icon svg-icon-md svg-icon-primary">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>

                            </span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   {{--{{ $list->links('layouts.partials.custom-pagination') }}--}}
{{--</div>--}}





























{{--

<div class="flex flex-col py-5">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="mb-3 min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">CODE
                            ARTICLE
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            ARTICLE
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            FAMILLE
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Fournisseur
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Code Comptable
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Assujetti à la tva
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Tva
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Qte minimum
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Unite achat
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                            Unite vente
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Actions</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($list as $item)
                        <tr @if($loop->even)class="bg-grey"@endif>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->code }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->libelle }}</td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm">{{  !empty($item->famille) ? $item->famille->name:'' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @foreach($item->fournisseurs as $fournisseur)
                                    @foreach($fournisseur as $f)
                                    {{ $f->name }}
                                    @endforeach
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->code_comptable }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->assujetti_tva }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->tva}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $item->qte_minimum }}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{!empty($item->uniteAchat) ? $item->uniteAchat->name:'' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{  !empty($item->uniteVente) ? $item->uniteVente->name:'' }}</td>
                            <td class="w-15">
                                <a   href="{{ route('edit-article', ['ida' => $item->id]) }}">
                                    <svg class="w-5 h-5 cursor-pointer fill-current text-indigo-500 ml-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                </a>
                            </td>
                            <td class="w-15">
                                <svg class="w-5 h-5 cursor-pointer fill-current text-red-500" wire:click="deleteArticle('{{$item->id}}')"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
--}}
