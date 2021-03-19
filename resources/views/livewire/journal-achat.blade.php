@section('title', "Journal d'achat")
@section('header_title', "Journal d'achat")
    {{-- <div class="mt-4 mb-4">
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
    </div> --}}

<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-xl-12">

                <!--begin::Card-->
                <div class="card card-custom card-stretch gutter-b">

                    <div class="card-header">
                        <h3 class="card-title">{{ __("Journal d'achat") }}</h3>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">


                            <div class="form-row mb-10">
                                <div class="col">
                                    <input type="text" name="birthday" value="10/24/1984" />
                                    <span class="text-gray-700"> Site </span>
                                    <select  wire:model.lazy="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="0"> Choisir un site</option>
                                        @foreach ($list_sites as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" name="birthday" value="10/24/1984" />
                                    {{-- <span class="text-gray-700"> Date </span>
                                    <div class='input-group' id='kt_daterangepicker_5'>
                                        <input type='text' class="form-control" readonly  placeholder="Select date range"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <div class="input-icon">
                                    <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Search...">
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>

                            <table class="table table-vertical-center" id="kt_advance_table_widget_4">
                                <thead>
                                    <tr class="text-left">
                                        <th class="pl-0" style="width: 30px">
                                            <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                                <input type="checkbox" value="1" />
                                                <span></span>
                                            </label>
                                        </th>
                                        <th scope="col" class="pl-0">Compte</th>
                                        <th scope="col" class="pl-0">Date</th>
                                        <th scope="col" class="pl-0">Libellé</th>
                                        <th scope="col" class="pl-0">Ctr partie</th>
                                        <th scope="col" class="pl-0">N° pièce</th>
                                        <th scope="col" class="pl-0">débit</th>
                                        <th scope="col" class="pl-0">crédit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($list))

                                        @foreach($list as $item)
                                        <tr @if($loop->even) class="bg-grey"@endif>
                                            <td class="pl-0 py-6">
                                                <label class="checkbox checkbox-lg checkbox-inline">
                                                    <input type="checkbox" value="1" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td class="pl-0">{{ $item->compte_comptable_fournisseur_id }}</td>
                                            <td class="pl-0">{{ $item->date }}</td>
                                            <td class="pl-0">{{ $item->libelle }}</td>
                                            <td class="pl-0">___</td>
                                            <td class="pl-0">{{ $item->num_facture }}</td>
                                            <td class="pl-0">___</td>
                                            <td class="pl-0">{{ number_format(floatval($item->montant_total_ttc), 2, ',', ' ') }}</td>
                                        </tr>
                                            @foreach($item->montant_ht as $key=>$value)

                                                <tr @if($loop->even) class="bg-grey"@endif>
                                                    <td class="pl-0 py-6">
                                                        <label class="checkbox checkbox-lg checkbox-inline">
                                                            <input type="checkbox" value="1" />
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td class="pl-0">{{$compteHt[$key]}}</td>
                                                    <td class="pl-0">{{ $item->date }}</td>
                                                    <td class="pl-0">{{ $item->libelle }}</td>
                                                    <td class="pl-0">{{ $item->compte_comptable_fournisseur_id }}</td>
                                                    <td class="pl-0">{{ $item->num_facture }}</td>
                                                    <td class="pl-0">{{ $value }}</td>
                                                    <td class="pl-0">___</td>
                                                </tr>
                                                <tr @if($loop->even) class="bg-grey"@endif>
                                                    <td class="pl-0 py-6">
                                                        <label class="checkbox checkbox-lg checkbox-inline">
                                                            <input type="checkbox" value="1" />
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td class="pl-0">{{$compteTva[$key]}}</td>
                                                    <td class="pl-0">{{ $item->date }}</td>
                                                    <td class="pl-0">{{ $item->libelle }}</td>
                                                    <td class="pl-0">{{ $item->compte_comptable_fournisseur_id }}</td>
                                                    <td class="pl-0">{{ $item->num_facture }}</td>
                                                    <td class="pl-0">{{ $item->montant_tva[$key] }}</td>
                                                    <td class="pl-0">___</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js"></script>

    <script>
        $(function() {
          $('input[name="birthday"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10)
          }/* , function(start, end, label) {
            var years = moment().diff(start, 'years');
            alert("You are " + years + " years old!");
          }); */
        });
        </script>
@endpush


