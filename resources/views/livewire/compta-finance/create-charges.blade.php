@section('title', "Création charges directes")
@section('header_title', "Création charges directes")
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
                        <h3 class="card-title">{{ __('Création charges directes') }}</h3>
                    </div>


                    <div class="card-body">

                        <form wire:submit.prevent="saveCharge" class="form-row">
                            <div class="col">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="refCharge"/>
                                    <label>{{ __('Charge ref.') }}</label>
                                </div>
                                @error('refCharge')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col">
                                <div class="input-group">
                                    <select  class="form-control" placeholder=" " wire:model.lazy="siteId" >
                                        <option value="0"> Choisir un site</option>
                                        @foreach ($list_sites as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <label>{{ __('Site') }}</label>
                                </div>
                                @error('siteId')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col">
                                <div class="input-group">
                                    <select class="form-control" placeholder=" " wire:model="bcRef" >
                                        <option value="0"> Choisir un bon de réception</option>
                                        @foreach ($list_bc as $item)
                                            <option value="{{ $item->ref }}">{{ $item->ref }} | {{ $item->fournisseur->name}}</option>
                                        @endforeach
                                    </select>
                                    <label>{{ __('Bon de réception') }}</label>
                                </div>
                                @error('bcRef')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                        <!--Table 1-->


                        <div class="table-responsive">
                            <h1 class="order-b py-8 font-bold text-black text-center text-xl tracking-widest uppercase">Pièces comptables</h1>

                            <table class="table table-vertical-center table-bordered" id="kt_advance_table_widget_4">
                                <thead>
                                    <tr class="text-left">

                                        <th class="">{{ __('Date') }}</th>
                                        <th class=" flex justify-between items-center">{{ __('Fournisseur') }}

                                            <button type="button" class="btn btn-icon btn-light-primary btn-circle mr-2" data-toggle="modal" data-target="#staticBackdrop">
                                                <i class="fas fa-user-plus"></i>
                                            </button>

                                            <!--Modal-->
                                            <div wire:ignore.self class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Nouveau fournisseur') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i aria-hidden="true" class="ki ki-close"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @livewire('achat.show-fournisseur')
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>

                                        <th class="">{{ __('Code comptable') }} </th>

                                        <th class="">{{ __('Num facture') }}</th>

                                        <th class="">{{ __('Libellé opération') }}</th>

                                        <th class="">{{ __('Montant TTC') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pl-0">
                                            <input type="date" class="form-control" wire:model="date.0" />
                                        </td>
                                        <td class="pl-0">
                                            <div class="input-group">
                                                <select  class="form-control" placeholder=" " wire:model="fournisseurId.0">
                                                    <option value="0"> Choisir fournisseur</option>
                                                    @foreach ($list_fournisseurs as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>

                                        <td class="pl-0">
                                            @isset($compteComptableFournisseur[0])
                                                {{$compteComptableFournisseur[0]}}
                                            @endisset
                                        </td>

                                        <td class="pl-0">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Entrez le numéro de la facture" wire:model="numFacture.0"/>
                                            </div>
                                        </td>

                                        <td class="pl-0">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder=" " wire:model="libelle.0"/>
                                            </div>
                                        </td>
                                        <td class="pl-0">

                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Entrez le montant TTC" wire:model="mt.0"/>
                                                <div class="input-group-append">
                                                    <select class="form-control" placeholder=" " wire:model="selectedTaux.0">
                                                        <option value="0"> Choisir un taux de TVA</option>
                                                        <option value="0">0% </option>
                                                        <option value="7">7% </option>
                                                        <option value="10">10% </option>
                                                        <option value="14">14% </option>
                                                        <option value="20">20% </option>
                                                    </select>
                                                </div>
                                            </div>


                                        </td>

                                    </tr>

                                    @foreach ($inputs as $key)
                                        @php
                                            $value = $loop->index + 1;
                                        @endphp

                                        <tr>
                                            <td class="pl-0">
                                                <input type="date" class="form-control" wire:model="date.{{$value}}" />
                                            </td>
                                            <td class="pl-0">
                                                <div class="input-group">
                                                    <select  class="form-control" placeholder=" " wire:model="fournisseurId.{{$value}}">
                                                        <option value="0"> Choisir fournisseur</option>
                                                        @foreach ($list_fournisseurs as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>

                                            <td class="pl-0">
                                                @isset($compteComptableFournisseur[$value])
                                                    {{$compteComptableFournisseur[$value]}}
                                                @endisset
                                            </td>

                                            <td class="pl-0">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder=" " wire:model="numFacture.{{$value}}"/>
                                                </div>
                                            </td>

                                            <td class="pl-0">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder=" " wire:model="libelle.{{$value}}"/>
                                                </div>
                                            </td>
                                            <td class="pl-0">

                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Entrez le montant TTC" wire:model="mt.{{$value}}"/>
                                                    <select  class="form-control" placeholder=" " wire:model="selectedTaux.{{$value}}">
                                                        <option value="0"> Choisir un taux de TVA</option>
                                                        <option value="0">0% </option>
                                                        <option value="7">7% </option>
                                                        <option value="10">10% </option>
                                                        <option value="14">14% </option>
                                                        <option value="20">20% </option>
                                                    </select>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-left pt-3" style="padding-bottom: 12px;">

                                            <button class="btn btn-primary font-weight-bold btn-pill"  wire:click.prevent="add()">
                                                <i class="flaticon-plus"></i> Ajouter une
                                                pièce
                                            </button>

                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!--end Table 1-->



                        <!--Table 2-->


                        <div class="table-responsive">
                            <h1 class="order-b py-8 font-bold text-black text-center text-xl tracking-widest uppercase">Détails</h1>

                            <table class="table table-vertical-center table-bordered" id="kt_advance_table_widget_4">
                                <thead>
                                    <tr class="text-left">
                                        <th class="pl-0">{{ __('Facture') }}</th>
                                        <th class="pl-0">{{ __('MONTANT HT') }}</th>
                                        <th class="pl-0">{{ __('TVA') }} </th>
                                        <th class="pl-0">{{ __('Ventilation des déductions') }}</th>
                                        <th class="pl-0">{{ __('MONTANT TVA') }}</th>
                                        <th class="pl-0">{{ __('Montant TTC') }}</th>
                                        <th class="pl-0">{{ __('Compte HT') }}</th>
                                        {{-- <th class="pl-0">{{ __('Libellé Compte HT') }}</th> --}}
                                        <th class="pl-0">{{ __('Compte TVA') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($detailsInputs))
                                        @foreach ($detailsInputs as $key)
                                            @php
                                                $value = $loop->index;
                                            @endphp
                                            <tr>
                                                <td class="pl-0">
                                                    {{-- <input wire:model.defer="factureDetails.{{$value}}" class="w-full py-1" type="text" wire:change="updateData({{$value}})" /> --}}
                                                    @isset($factureDetails[$value])
                                                    {{$factureDetails[$value]}}

                                                    @endisset
                                                </td>

                                                <td class="pl-0">
                                                    {{-- <input wire:model.defer="montant.{{$value}}" class="w-full py-1" type="text" wire:change="updateData({{$value}})" />--}}
                                                    @isset($montant[$value])
                                                        {{ number_format($montant[$value], 2, ',', ' ') }}
                                                    @endisset
                                                </td>
                                                <td class="pl-0">
                                                    @isset($tvaInputs[$value])
                                                        {{$tvaInputs[$value]}}
                                                    {{-- {{$selectedTaux[$value]}} --}}
                                                    @endisset

                                                </td>
                                                <td class="pl-0">
                                                    {{-- @isset($ventilation[$value])
                                                        {{$ventilation[$value]}}
                                                    @endisset --}}

                                                    <select class="form-control" wire:model="codeVentilation.{{$value}}"class="form-control">
                                                        <option value="0"> Choisir une ventilation</option>

                                                        @isset($listVentilation[$value])
                                                            @foreach ($listVentilation[$value] as $key => $line)
                                                                @foreach ($line as $ke => $val)
                                                                    <optgroup label="{{$ke}}">
                                                                        @foreach ($val as $k => $v)
                                                                            <option value="{{$k}}">{{$k}} | {{$tvaInputs[$value]}}% {{$v}}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                @endforeach
                                                            @endforeach
                                                        @endisset

                                                </select>
                                                </td>
                                                <td class="pl-0">
                                                    @isset($montantTva[$value])
                                                        {{ number_format($montantTva[$value], 2, ',', ' ') }}
                                                    @endisset
                                                </td>
                                                    <td class="pl-0">
                                                    @isset($montantTtc[$value])
                                                        {{ number_format($montantTtc[$value], 2, ',', ' ') }}
                                                    @endisset
                                                </td>

                                                <td class="pl-0">
                                                    <select wire:model="compteComptableHT.{{$value}}" class="form-control">
                                                        <option value="0"> Choisir compte comptable</option>
                                                            @foreach ($comptes_comptable_HT  as $item)
                                                                <option value="{{ $item->id }}">{{ $item->code }} </option>
                                                            @endforeach
                                                    </select>
                                                </td>
                                                {{-- <td class="pl-0">
                                                    @isset($libelleCompteComptableHT[$value])
                                                        {{$libelleCompteComptableHT[$value]}}
                                                    @endisset
                                                </td> --}}
                                                <td class="pl-0">
                                                    <select wire:model.lazy.defer="compteComptableTVA.{{$value}}" class="form-control">
                                                        <option value="0"> Choisir compte comptable</option>
                                                            @foreach ($comptes_comptable_TVA  as $item)
                                                                <option value="{{ $item->id }}">{{ $item->code }} | {{ $item->name }} </option>
                                                            @endforeach
                                                    </select>
                                                    @error('compteComptableTVA') <span class="text-red-500">{{ $message }}</span> @enderror

                                                </td>
                                                {{-- <td>
                                                    <button type="button" class="w-7 rounded-md text-white bg-red-700"
                                                        wire:click="remove({{ $loop->index + 1 }})">X</button>

                                                </td> --}}

                                            </tr>

                                        @endforeach

                                    @else

                                    <tr>
                                        <td class="pl-0"></td>

                                        <td class="pl-0"></td>
                                        <td class="pl-0"> </td>
                                        <td class="pl-0"> </td>
                                        <td class="pl-0"></td>
                                        <td class="pl-0"></td>

                                        <td class="pl-0"></td>
                                        <td class="pl-0"></td>
                                        <td class="pl-0"></td>
                                        {{-- <td>
                                            <button type="button" class="w-7 rounded-md text-white bg-red-700"
                                                wire:click="remove({{ $loop->index + 1 }})">X</button>

                                        </td> --}}

                                    </tr>

                                    @endif
                                </tbody>

                            </table>
                        </div>

                        <!--end Table 2-->
                        <div class="block w-full">
                        <h1 class="order-b py-8 font-bold text-black text-center text-xl tracking-widest uppercase">Totaux</h1>

                        <!--Table 3-->
                        <div class="flex justify-between items-start">

                            <table class="table table-sm table-bordered table-striped" style="width: 40%;">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('TVA') }}</th>
                                        <th scope="col">{{ __('Total HT') }}</th>
                                        <th scope="col">{{ __('Total TVA') }}</th>
                                        <th scope="col">{{ __('Total TTC') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($totalTvas))
                                            @foreach ($totalTvas as $key => $value)
                                                <tr>
                                                    <th scope="row"> {{ $key }} %</th>
                                                    <td>{{ number_format($totalHts[$key], 2, ',', ' ') }}</td>
                                                    <td>{{ number_format($value, 2, ',', ' ') }}</td>
                                                    <td>{{ number_format($totalTtcs[$key], 2, ',', ' ') }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th scope="row"> 0 %</th>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>

                                        @endif
                                </tbody>
                            </table>




                            <table class="table table-sm table-bordered" style="width: 40%;">
                                    <tr scope="col">
                                        <th >{{ __('Total HT') }}</th>
                                        <td class="pl-0">
                                            {{ number_format($totalHt , 2, ',', ' ') }}
                                        </td>
                                    <tr>
                                    <tr scope="col">
                                        <th >{{ __('Total TVA') }}</th>
                                        <td class="pl-0">
                                            {{ number_format($totalTva, 2, ',', ' ') }}
                                        </td>
                                    <tr>
                                    <tr scope="col">
                                        <th >{{ __('Total TTC') }}</th>
                                        <td class="pl-0">
                                            {{ number_format($totalTtc, 2, ',', ' ') }}
                                        </td>
                                    </tr>


                                </table>


                        </div>

                        <!--end Table 3-->

                        <div class="block text-right pt-3">
                                <button type="submit" class="btn btn-primary font-weight-bold btn-pill">
                                <i class="far fa-save"></i> Enregistrer
                            </button>
                        </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
    <!--end::Card-->
        @livewire('liste-charges')
