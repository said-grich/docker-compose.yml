<div>
    <div class="table-responsive">
        <div class="d-flex flex-row-reverse">
            <div class="input-icon">
                <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Recherche...">
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
                        <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Ref @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                        <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Date @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                        <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Client @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                        <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Date de livraison @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                        <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Quartie de livraison @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                        <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Livreur @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                        <th class="pl-0" wire:click="sortBy('nom')" style="cursor: pointer;">Statut @include('layouts.partials._sort-icon',['field'=>'nom'])</th>
                        <th class="pr-0 text-right" style="min-width: 160px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
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
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->date }}</a>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->client->nom }}</a>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->date_livraison }}</a>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->villeQuartier->nom }}</a>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $item->livreur->nom }}</a>
                        </td>
                        <td class="pl-0">
                            <span class="label label-lg label-light-primary label-inline">{{ $item->etat}}</span>
                        </td>

                        <td class="pr-0 text-right">

                            <a href="#" wire:click="show('{{$item->ref}}')" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#show-livree">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    {{--begin::Svg Icon--}}
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                    {{--end::Svg Icon--}}
                                </span>
                            </a>
                            <a href="#" wire:click="edit('{{$item->ref}}')" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="modal" data-target="#exampleModalSizeSm">
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
                            <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" wire:click="deleteDepot('{{$item->id}}')">
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
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $items->links('layouts.partials.custom-pagination') }}

            {{-- Show Modal --}}
            <div wire:ignore.self class="modal fade" id="show-livree" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="show-livree" aria-hidden="true">
                <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Commande ') }} - {{$commande_ref}} - {{$date}} </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                            <!--Progress end-->
                                <div class="md-stepper-horizontal green">

                                    <div class="md-step {{$etat_commande === 'Reçue' ? "active" : "done"}}">
                                        <div class="md-step-circle"><span>1</span></div>
                                        <div class="md-step-title">Reçue <br> {{$date_recue}}</div>
                                        <div class="md-step-bar-left"></div>
                                        <div class="md-step-bar-right"></div>
                                    </div>
                                    <div class="md-step {{$etat_commande === 'Validée' ? "active" : "done"}}">
                                        <div class="md-step-circle"><span>2</span></div>
                                        <div class="md-step-title">Validée <br> {{$date_validee}}</div>
                                        <div class="md-step-bar-left"></div>
                                        <div class="md-step-bar-right"></div>
                                    </div>
                                    <div class="md-step {{$etat_commande === 'Prête' ? "active" : "done"}}">
                                        <div class="md-step-circle"><span>3</span></div>
                                        <div class="md-step-title">Prête <br> {{$date_prete}}</div>
                                        <div class="md-step-bar-left"></div>
                                        <div class="md-step-bar-right"></div>
                                    </div>
                                    <div class="md-step {{$etat_commande === 'En Expédition' ? "active" : "done"}}">
                                        <div class="md-step-circle"><span>4</span></div>
                                        <div class="md-step-title">En Expédition <br> {{$date_expedition}}</div>
                                        <div class="md-step-bar-left"></div>
                                        <div class="md-step-bar-right"></div>
                                    </div>
                                    <div class="md-step {{$etat_commande === 'Livrée' ? "active" : "done"}}">
                                        <div class="md-step-circle"><span>5</span></div>
                                        <div class="md-step-title">Livrée <br> {{$date_livree}}</div>
                                        <div class="md-step-bar-left"></div>
                                        <div class="md-step-bar-right"></div>
                                    </div>
                                </div>


                            </div>
                            <!--Progress end-->

                            <!--Info livraison-->
                            <div class="form-group row">

                                <div class="col">
                                    <label>{{ __('Téléphone de livraison') }}</label>
                                    <input type="text" class="form-control" wire:model.defer="tel_livraison" disabled/>
                                </div>
                                <div class="col">
                                    <label>{{ __('Contact de livraison') }}</label>
                                    <input type="text" class="form-control" wire:model.defer="contact_livraison" disabled/>
                                </div>

                                <div class="col">
                                    <label>{{ __('Adresse de livraison') }}</label>
                                    <input type="text" class="form-control" wire:model.defer="adresse_livraison" disabled/>
                                </div>
                                <div class="col">
                                    <label>{{ __('Ville de livraison') }}</label>
                                    <input type="text" class="form-control" wire:model.defer="ville" disabled/>
                                </div>
                                <div class="col">
                                    <label>{{ __('Ville zone') }}</label>
                                    <input type="text" class="form-control" wire:model.defer="ville_zone" disabled/>
                                </div>
                                <div class="col">
                                    <label>{{ __('Quartier') }}</label>
                                    <input type="text" class="form-control" wire:model.defer="ville_quartie_id" disabled/>
                                </div>
                            </div>

                            <div class="separator separator-dashed my-10"></div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>{{ __('Mode de paiement') }}</label>
                                    <input type="text" class="form-control" wire:model.defer="mode_paiement" disabled/>
                                </div>
                                <div class="col">
                                    <label>{{ __('Mode de livraison') }}</label>
                                    <input type="text" class="form-control" wire:model.defer="mode_livraison_id" disabled/>
                                </div>
                                <div class="col">
                                    <label>{{ __('Frais de livraison') }}</label>
                                    <input type="text" class="form-control" placeholder="Frais de livraison" wire:model.defer="frais_livraison" disabled/>
                                </div>

                                <div class="col">
                                    <label>{{ __('Date de livraison') }}</label>
                                    <input type="date" class="form-control" placeholder="Date de livraison" wire:model.defer="date_livraison" disabled/>
                                </div>

                                <div class="col">
                                    <label>{{ __('Livreur') }}</label>
                                    <input type="text" class="form-control" wire:model.defer="livreur" disabled/>
                                </div>
                            </div>

                            <!--end Info livraison-->

                            <div class="separator separator-dashed my-10"></div>

                            <!--begin::Table-->
                            <div class="table-responsive">
                                @foreach ($commande_lignes as $categorie_id => $items)
                                    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_5">
                                        <thead>
                                            <tr class="text-center {{$categorie_id == 1 ? 'bg-primary-o-50' : 'bg-warning-o-50'}}">
                                                <th colspan="5">
                                                    {{$categories[$categorie_id]}}
                                                </th>
                                            </tr>
                                            <tr class="text-left">
                                                <th>
                                                    <span class="text-dark-75">Produit</span>
                                                </th>
                                                <th>
                                                    <span class="text-dark-75">Préparation</span>
                                                </th>
                                                <th>
                                                    <span class="text-dark-75">Quantité</span>
                                                </th>
                                                <th>
                                                    <span class="text-dark-75">Prix</span>
                                                </th>
                                                <th>
                                                    <span class="text-dark-75">Montant</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $key=>$item)
                                                <tr>
                                                    <td>
                                                        {{$produits[$categorie_id][$key]}}
                                                    </td>
                                                    <td>
                                                        @if (is_array($item['preparations']))
                                                            @foreach ($item['preparations'] as $value)
                                                                {{ $loop->first ? '' : ', ' }} {{ $value }}
                                                            @endforeach
                                                        @else
                                                            {{isset($item['preparations']) ? $item['preparations'] : "Sans préparation"}}
                                                        @endif

                                                    </td>
                                                    <td>
                                                        {{$item['qte']}}
                                                    </td>
                                                    <td>
                                                        {{$item['prix']}}
                                                    </td>
                                                    <td>
                                                        {{$item['montant']}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                @endforeach
                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_6">
                                    <tfoot>
                                        <tr>
                                            <th>Montant total</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>{{$montant_total}}</th>
                                        </tr>
                                        <tr>
                                            <th><span class="text-dark-75">Montant total è payer</span></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>{{$montant_total_a_payer}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Show Modal --}}

        </div>

</div>



