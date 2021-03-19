@section('title', 'Création compte bancaire')
@section('header_title', 'Création compte bancaire')

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
                        <h3 class="card-title">{{ __('Liste Compte Bancaire') }}</h3>
                    </div>
                    <div class="card-body">
                        <!--Button trigger modal-->
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#staticBackdrop">
                            <i class="flaticon-plus"></i> {{ __('Ajouter un nouveau compte bancaire') }}
                        </button>
                        <div wire:ignore.self class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                              <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Nouvelle compte bancaire') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="unite-form" class="form" wire:submit.prevent="createCompte">
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="codeComptable"/>
                                                    <label>{{ __('Code comptable') }}</label>
                                                </div>
                                                @error('code_comptable')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tag icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="name"/>
                                                    <label>{{ __('Libellé compte') }}</label>
                                                </div>
                                                @error('name')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-building icon-lg"></i></span></div>

                                                    <select  class="form-control" wire:model.lazy="siteId" >
                                                        <option value="0"> Choisir un site</option>
                                                        @foreach ($list_sites as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                        @endforeach
                                                    </select>
                                                    <label>{{ __('Choisir un site') }}</label>
                                                </div>
                                                @error('siteId')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-alt icon-lg"></i></span></div>
                                                    <input type="date" class="form-control" placeholder=" " wire:model.defer="date"/>
                                                    <label>{{ __('Date création') }}</label>
                                                </div>
                                                @error('date')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-university icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="nameBanque"/>
                                                    <label>{{ __('Nom de la banque') }}</label>
                                                </div>
                                                @error('nameBanque')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-credit-card icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="numCompte"/>
                                                    <label>{{ __('N° de compte') }}</label>
                                                </div>
                                                @error('numCompte')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-comments-dollar icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="swift"/>
                                                    <label>{{ __('SWIFT') }}</label>
                                                </div>
                                                @error('swift')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-list-alt icon-lg"></i></span></div>

                                                    <select class="form-control" id="typeCompte" wire:model="typeCompte" autocomplete="typeCompte"   >
                                                        <option > Choisir </option>
                                                        <option > Compte bancaire épargne/placement </option>
                                                        <option >Compte bancaire courant ou carte</option>
                                                        <option >Compte caisse/liquide</option>
                                                    </select>
                                                    <label>{{ __('Type de compte') }}</label>
                                                </div>
                                                @error('typeCompte')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-check icon-lg"></i></span></div>

                                                    <select class="form-control" id="devise" wire:model.defer="devise">

                                                    <option>Choisissez la devise</option>
                                                    <option value="AFA">Afghan Afghani</option>
                                                    <option value="ALL">Albanian Lek</option>
                                                    <option value="DZD">Algerian Dinar</option>
                                                    <option value="AOA">Angolan Kwanza</option>
                                                    <option value="ARS">Argentine Peso</option>
                                                    <option value="AMD">Armenian Dram</option>
                                                    <option value="AWG">Aruban Florin</option>
                                                    <option value="AUD">Australian Dollar</option>
                                                    <option value="AZN">Azerbaijani Manat</option>
                                                    <option value="BSD">Bahamian Dollar</option>
                                                    <option value="BHD">Bahraini Dinar</option>
                                                    <option value="BDT">Bangladeshi Taka</option>
                                                    <option value="BBD">Barbadian Dollar</option>
                                                    <option value="BYR">Belarusian Ruble</option>
                                                    <option value="BEF">Belgian Franc</option>
                                                    <option value="BZD">Belize Dollar</option>
                                                    <option value="BMD">Bermudan Dollar</option>
                                                    <option value="BTN">Bhutanese Ngultrum</option>
                                                    <option value="BTC">Bitcoin</option>
                                                    <option value="BOB">Bolivian Boliviano</option>
                                                    <option value="BAM">Bosnia-Herzegovina Convertible Mark</option>
                                                    <option value="BWP">Botswanan Pula</option>
                                                    <option value="BRL">Brazilian Real</option>
                                                    <option value="GBP">British Pound Sterling</option>
                                                    <option value="BND">Brunei Dollar</option>
                                                    <option value="BGN">Bulgarian Lev</option>
                                                    <option value="BIF">Burundian Franc</option>
                                                    <option value="KHR">Cambodian Riel</option>
                                                    <option value="CAD">Canadian Dollar</option>
                                                    <option value="CVE">Cape Verdean Escudo</option>
                                                    <option value="KYD">Cayman Islands Dollar</option>
                                                    <option value="XOF">CFA Franc BCEAO</option>
                                                    <option value="XAF">CFA Franc BEAC</option>
                                                    <option value="XPF">CFP Franc</option>
                                                    <option value="CLP">Chilean Peso</option>
                                                    <option value="CNY">Chinese Yuan</option>
                                                    <option value="COP">Colombian Peso</option>
                                                    <option value="KMF">Comorian Franc</option>
                                                    <option value="CDF">Congolese Franc</option>
                                                    <option value="CRC">Costa Rican ColÃ³n</option>
                                                    <option value="HRK">Croatian Kuna</option>
                                                    <option value="CUC">Cuban Convertible Peso</option>
                                                    <option value="CZK">Czech Republic Koruna</option>
                                                    <option value="DKK">Danish Krone</option>
                                                    <option value="DJF">Djiboutian Franc</option>
                                                    <option value="DOP">Dominican Peso</option>
                                                    <option value="XCD">East Caribbean Dollar</option>
                                                    <option value="EGP">Egyptian Pound</option>
                                                    <option value="ERN">Eritrean Nakfa</option>
                                                    <option value="EEK">Estonian Kroon</option>
                                                    <option value="ETB">Ethiopian Birr</option>
                                                    <option value="EUR">Euro</option>
                                                    <option value="FKP">Falkland Islands Pound</option>
                                                    <option value="FJD">Fijian Dollar</option>
                                                    <option value="GMD">Gambian Dalasi</option>
                                                    <option value="GEL">Georgian Lari</option>
                                                    <option value="DEM">German Mark</option>
                                                    <option value="GHS">Ghanaian Cedi</option>
                                                    <option value="GIP">Gibraltar Pound</option>
                                                    <option value="GRD">Greek Drachma</option>
                                                    <option value="GTQ">Guatemalan Quetzal</option>
                                                    <option value="GNF">Guinean Franc</option>
                                                    <option value="GYD">Guyanaese Dollar</option>
                                                    <option value="HTG">Haitian Gourde</option>
                                                    <option value="HNL">Honduran Lempira</option>
                                                    <option value="HKD">Hong Kong Dollar</option>
                                                    <option value="HUF">Hungarian Forint</option>
                                                    <option value="ISK">Icelandic KrÃ³na</option>
                                                    <option value="INR">Indian Rupee</option>
                                                    <option value="IDR">Indonesian Rupiah</option>
                                                    <option value="IRR">Iranian Rial</option>
                                                    <option value="IQD">Iraqi Dinar</option>
                                                    <option value="ILS">Israeli New Sheqel</option>
                                                    <option value="ITL">Italian Lira</option>
                                                    <option value="JMD">Jamaican Dollar</option>
                                                    <option value="JPY">Japanese Yen</option>
                                                    <option value="JOD">Jordanian Dinar</option>
                                                    <option value="KZT">Kazakhstani Tenge</option>
                                                    <option value="KES">Kenyan Shilling</option>
                                                    <option value="KWD">Kuwaiti Dinar</option>
                                                    <option value="KGS">Kyrgystani Som</option>
                                                    <option value="LAK">Laotian Kip</option>
                                                    <option value="LVL">Latvian Lats</option>
                                                    <option value="LBP">Lebanese Pound</option>
                                                    <option value="LSL">Lesotho Loti</option>
                                                    <option value="LRD">Liberian Dollar</option>
                                                    <option value="LYD">Libyan Dinar</option>
                                                    <option value="LTL">Lithuanian Litas</option>
                                                    <option value="MOP">Macanese Pataca</option>
                                                    <option value="MKD">Macedonian Denar</option>
                                                    <option value="MGA">Malagasy Ariary</option>
                                                    <option value="MWK">Malawian Kwacha</option>
                                                    <option value="MYR">Malaysian Ringgit</option>
                                                    <option value="MVR">Maldivian Rufiyaa</option>
                                                    <option value="MRO">Mauritanian Ouguiya</option>
                                                    <option value="MUR">Mauritian Rupee</option>
                                                    <option value="MXN">Mexican Peso</option>
                                                    <option value="MDL">Moldovan Leu</option>
                                                    <option value="MNT">Mongolian Tugrik</option>
                                                    <option value="MAD">Moroccan Dirham</option>
                                                    <option value="MZM">Mozambican Metical</option>
                                                    <option value="MMK">Myanmar Kyat</option>
                                                    <option value="NAD">Namibian Dollar</option>
                                                    <option value="NPR">Nepalese Rupee</option>
                                                    <option value="ANG">Netherlands Antillean Guilder</option>
                                                    <option value="TWD">New Taiwan Dollar</option>
                                                    <option value="NZD">New Zealand Dollar</option>
                                                    <option value="NIO">Nicaraguan CÃ³rdoba</option>
                                                    <option value="NGN">Nigerian Naira</option>
                                                    <option value="KPW">North Korean Won</option>
                                                    <option value="NOK">Norwegian Krone</option>
                                                    <option value="OMR">Omani Rial</option>
                                                    <option value="PKR">Pakistani Rupee</option>
                                                    <option value="PAB">Panamanian Balboa</option>
                                                    <option value="PGK">Papua New Guinean Kina</option>
                                                    <option value="PYG">Paraguayan Guarani</option>
                                                    <option value="PEN">Peruvian Nuevo Sol</option>
                                                    <option value="PHP">Philippine Peso</option>
                                                    <option value="PLN">Polish Zloty</option>
                                                    <option value="QAR">Qatari Rial</option>
                                                    <option value="RON">Romanian Leu</option>
                                                    <option value="RUB">Russian Ruble</option>
                                                    <option value="RWF">Rwandan Franc</option>
                                                    <option value="SVC">Salvadoran ColÃ³n</option>
                                                    <option value="WST">Samoan Tala</option>
                                                    <option value="SAR">Saudi Riyal</option>
                                                    <option value="RSD">Serbian Dinar</option>
                                                    <option value="SCR">Seychellois Rupee</option>
                                                    <option value="SLL">Sierra Leonean Leone</option>
                                                    <option value="SGD">Singapore Dollar</option>
                                                    <option value="SKK">Slovak Koruna</option>
                                                    <option value="SBD">Solomon Islands Dollar</option>
                                                    <option value="SOS">Somali Shilling</option>
                                                    <option value="ZAR">South African Rand</option>
                                                    <option value="KRW">South Korean Won</option>
                                                    <option value="XDR">Special Drawing Rights</option>
                                                    <option value="LKR">Sri Lankan Rupee</option>
                                                    <option value="SHP">St. Helena Pound</option>
                                                    <option value="SDG">Sudanese Pound</option>
                                                    <option value="SRD">Surinamese Dollar</option>
                                                    <option value="SZL">Swazi Lilangeni</option>
                                                    <option value="SEK">Swedish Krona</option>
                                                    <option value="CHF">Swiss Franc</option>
                                                    <option value="SYP">Syrian Pound</option>
                                                    <option value="STD">São Tomé and Príncipe Dobra</option>
                                                    <option value="TJS">Tajikistani Somoni</option>
                                                    <option value="TZS">Tanzanian Shilling</option>
                                                    <option value="THB">Thai Baht</option>
                                                    <option value="TOP">Tongan pa'anga</option>
                                                    <option value="TTD">Trinidad & Tobago Dollar</option>
                                                    <option value="TND">Tunisian Dinar</option>
                                                    <option value="TRY">Turkish Lira</option>
                                                    <option value="TMT">Turkmenistani Manat</option>
                                                    <option value="UGX">Ugandan Shilling</option>
                                                    <option value="UAH">Ukrainian Hryvnia</option>
                                                    <option value="UYU">Uruguayan Peso</option>
                                                    <option value="USD">US Dollar</option>
                                                    <option value="UZS">Uzbekistan Som</option>
                                                    <option value="VUV">Vanuatu Vatu</option>
                                                    <option value="VEF">Venezuelan BolÃ­var</option>
                                                    <option value="VND">Vietnamese Dong</option>
                                                    <option value="YER">Yemeni Rial</option>
                                                    <option value="ZMK">Zambian Kwacha</option>

                                                </select>
                                                    <label>{{ __('Devise') }}</label>
                                                </div>
                                                @error('devise')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-chart-line icon-lg"></i></span></div>

                                                    <select class="form-control" id="etat" wire:model="etat" autocomplete="etat">
                                                        <option > Choisir </option>
                                                        <option > Ouvert </option>
                                                        <option >Fermé</option>
                                                    </select>
                                                    <label>{{ __('État') }}</label>
                                                </div>
                                                @error('etat')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-globe icon-lg"></i></span></div>

                                                    <select class="form-control" id="paysCompte" wire:model="paysCompte" autocomplete="paysCompte"  >
                                                        <option > Choisir </option>
                                                        <option > Maroc </option>
                                                        <option >Allemagne</option>
                                                    </select>
                                                    <label>{{ __('Pays du compte') }}</label>
                                                </div>
                                                @error('paysCompte')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice icon-lg"></i></span></div>

                                                    <select class="form-control" id="compteComptableId" wire:model="compteComptableId" autocomplete="compteComptableId"   >
                                                        <option > Choisir </option>
                                                        @foreach ($list_comptes_comptables as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>{{ __('Compte comptable') }}</label>
                                                </div>
                                                @error('compteComptableId')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="unite-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Table-->
                        @livewire('paramétrage.liste-compte')
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
{{--<div class="p-5" x-data="{ openTab: 2}">
    <ul class="flex border-b">
        <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-indigo-700' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
            Nouveau compte
            </a>
        </li>
        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-indigo-700' : 'text-gray-500 hover:text-gray-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
            Liste comptes
            </a>
        </li>

    </ul>

    <div x-show="openTab === 1">
        <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Création compte bancaire') }}
        </h2>
    </x-slot>

    <x-jet-form-section submit="createCompte">
        <x-slot name="title">
            {{ __('Ajouter un nouveau compte') }}
        </x-slot>

        <x-slot name="description">

        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="code_comptable" value="{{ __('Code comptable') }}" />
                <x-jet-input id="code_comptable" type="text" class="mt-1 block w-full" wire:model.defer="code_comptable" autocomplete="code_comptable" />
                <x-jet-input-error for="code_comptable" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Libellé compte') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <label class="block">
                    <span class="text-gray-700">Site</span>
                    <select  wire:model.lazy="siteId" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md i-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="0"> Choisir un site</option>
                        @foreach ($list_sites as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <label class="block">
                    <span class="text-gray-700">Date création</span>
                    <input wire:model="date" type="date" class="block w-full mt-1 form-input" >
                    @error('date') <span class="text-red-600">{{ $message }}</span> @enderror

                </label>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="nameBanque" value="{{ __('Nom de la banque') }}" />
                <x-jet-input id="nameBanque" type="text" class="mt-1 block w-full" wire:model.defer="nameBanque" autocomplete="nameBanque" />
                <x-jet-input-error for="nameBanque" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="numCompte" value="{{ __('N° de compte') }}" />
                <x-jet-input id="numCompte" type="text" class="mt-1 block w-full" wire:model.defer="numCompte" autocomplete="numCompte" />
                <x-jet-input-error for="numCompte" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="swift" value="{{ __('SWIFT') }}" />
                <x-jet-input id="swift" type="text" class="mt-1 block w-full" wire:model.defer="swift" autocomplete="swift" />
                <x-jet-input-error for="swift" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="typeCompte" value="{{ __('Type de compte') }}" />
                    <select id="typeCompte" wire:model="typeCompte" autocomplete="typeCompte"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                        <option > Choisir </option>
                        <option > Compte bancaire épargne/placement </option>
                        <option >Compte bancaire courant ou carte</option>
                        <option >Compte caisse/liquide</option>
                    </select>
                <x-jet-input-error for="typeCompte" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="devise" value="{{ __('Devise') }}" />
                    <select id="devise" wire:model.defer="devise"
                        class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">

                        <option>Choisissez la devise</option>
                        <option value="AFA">Afghan Afghani</option>
                        <option value="ALL">Albanian Lek</option>
                        <option value="DZD">Algerian Dinar</option>
                        <option value="AOA">Angolan Kwanza</option>
                        <option value="ARS">Argentine Peso</option>
                        <option value="AMD">Armenian Dram</option>
                        <option value="AWG">Aruban Florin</option>
                        <option value="AUD">Australian Dollar</option>
                        <option value="AZN">Azerbaijani Manat</option>
                        <option value="BSD">Bahamian Dollar</option>
                        <option value="BHD">Bahraini Dinar</option>
                        <option value="BDT">Bangladeshi Taka</option>
                        <option value="BBD">Barbadian Dollar</option>
                        <option value="BYR">Belarusian Ruble</option>
                        <option value="BEF">Belgian Franc</option>
                        <option value="BZD">Belize Dollar</option>
                        <option value="BMD">Bermudan Dollar</option>
                        <option value="BTN">Bhutanese Ngultrum</option>
                        <option value="BTC">Bitcoin</option>
                        <option value="BOB">Bolivian Boliviano</option>
                        <option value="BAM">Bosnia-Herzegovina Convertible Mark</option>
                        <option value="BWP">Botswanan Pula</option>
                        <option value="BRL">Brazilian Real</option>
                        <option value="GBP">British Pound Sterling</option>
                        <option value="BND">Brunei Dollar</option>
                        <option value="BGN">Bulgarian Lev</option>
                        <option value="BIF">Burundian Franc</option>
                        <option value="KHR">Cambodian Riel</option>
                        <option value="CAD">Canadian Dollar</option>
                        <option value="CVE">Cape Verdean Escudo</option>
                        <option value="KYD">Cayman Islands Dollar</option>
                        <option value="XOF">CFA Franc BCEAO</option>
                        <option value="XAF">CFA Franc BEAC</option>
                        <option value="XPF">CFP Franc</option>
                        <option value="CLP">Chilean Peso</option>
                        <option value="CNY">Chinese Yuan</option>
                        <option value="COP">Colombian Peso</option>
                        <option value="KMF">Comorian Franc</option>
                        <option value="CDF">Congolese Franc</option>
                        <option value="CRC">Costa Rican ColÃ³n</option>
                        <option value="HRK">Croatian Kuna</option>
                        <option value="CUC">Cuban Convertible Peso</option>
                        <option value="CZK">Czech Republic Koruna</option>
                        <option value="DKK">Danish Krone</option>
                        <option value="DJF">Djiboutian Franc</option>
                        <option value="DOP">Dominican Peso</option>
                        <option value="XCD">East Caribbean Dollar</option>
                        <option value="EGP">Egyptian Pound</option>
                        <option value="ERN">Eritrean Nakfa</option>
                        <option value="EEK">Estonian Kroon</option>
                        <option value="ETB">Ethiopian Birr</option>
                        <option value="EUR">Euro</option>
                        <option value="FKP">Falkland Islands Pound</option>
                        <option value="FJD">Fijian Dollar</option>
                        <option value="GMD">Gambian Dalasi</option>
                        <option value="GEL">Georgian Lari</option>
                        <option value="DEM">German Mark</option>
                        <option value="GHS">Ghanaian Cedi</option>
                        <option value="GIP">Gibraltar Pound</option>
                        <option value="GRD">Greek Drachma</option>
                        <option value="GTQ">Guatemalan Quetzal</option>
                        <option value="GNF">Guinean Franc</option>
                        <option value="GYD">Guyanaese Dollar</option>
                        <option value="HTG">Haitian Gourde</option>
                        <option value="HNL">Honduran Lempira</option>
                        <option value="HKD">Hong Kong Dollar</option>
                        <option value="HUF">Hungarian Forint</option>
                        <option value="ISK">Icelandic KrÃ³na</option>
                        <option value="INR">Indian Rupee</option>
                        <option value="IDR">Indonesian Rupiah</option>
                        <option value="IRR">Iranian Rial</option>
                        <option value="IQD">Iraqi Dinar</option>
                        <option value="ILS">Israeli New Sheqel</option>
                        <option value="ITL">Italian Lira</option>
                        <option value="JMD">Jamaican Dollar</option>
                        <option value="JPY">Japanese Yen</option>
                        <option value="JOD">Jordanian Dinar</option>
                        <option value="KZT">Kazakhstani Tenge</option>
                        <option value="KES">Kenyan Shilling</option>
                        <option value="KWD">Kuwaiti Dinar</option>
                        <option value="KGS">Kyrgystani Som</option>
                        <option value="LAK">Laotian Kip</option>
                        <option value="LVL">Latvian Lats</option>
                        <option value="LBP">Lebanese Pound</option>
                        <option value="LSL">Lesotho Loti</option>
                        <option value="LRD">Liberian Dollar</option>
                        <option value="LYD">Libyan Dinar</option>
                        <option value="LTL">Lithuanian Litas</option>
                        <option value="MOP">Macanese Pataca</option>
                        <option value="MKD">Macedonian Denar</option>
                        <option value="MGA">Malagasy Ariary</option>
                        <option value="MWK">Malawian Kwacha</option>
                        <option value="MYR">Malaysian Ringgit</option>
                        <option value="MVR">Maldivian Rufiyaa</option>
                        <option value="MRO">Mauritanian Ouguiya</option>
                        <option value="MUR">Mauritian Rupee</option>
                        <option value="MXN">Mexican Peso</option>
                        <option value="MDL">Moldovan Leu</option>
                        <option value="MNT">Mongolian Tugrik</option>
                        <option value="MAD">Moroccan Dirham</option>
                        <option value="MZM">Mozambican Metical</option>
                        <option value="MMK">Myanmar Kyat</option>
                        <option value="NAD">Namibian Dollar</option>
                        <option value="NPR">Nepalese Rupee</option>
                        <option value="ANG">Netherlands Antillean Guilder</option>
                        <option value="TWD">New Taiwan Dollar</option>
                        <option value="NZD">New Zealand Dollar</option>
                        <option value="NIO">Nicaraguan CÃ³rdoba</option>
                        <option value="NGN">Nigerian Naira</option>
                        <option value="KPW">North Korean Won</option>
                        <option value="NOK">Norwegian Krone</option>
                        <option value="OMR">Omani Rial</option>
                        <option value="PKR">Pakistani Rupee</option>
                        <option value="PAB">Panamanian Balboa</option>
                        <option value="PGK">Papua New Guinean Kina</option>
                        <option value="PYG">Paraguayan Guarani</option>
                        <option value="PEN">Peruvian Nuevo Sol</option>
                        <option value="PHP">Philippine Peso</option>
                        <option value="PLN">Polish Zloty</option>
                        <option value="QAR">Qatari Rial</option>
                        <option value="RON">Romanian Leu</option>
                        <option value="RUB">Russian Ruble</option>
                        <option value="RWF">Rwandan Franc</option>
                        <option value="SVC">Salvadoran ColÃ³n</option>
                        <option value="WST">Samoan Tala</option>
                        <option value="SAR">Saudi Riyal</option>
                        <option value="RSD">Serbian Dinar</option>
                        <option value="SCR">Seychellois Rupee</option>
                        <option value="SLL">Sierra Leonean Leone</option>
                        <option value="SGD">Singapore Dollar</option>
                        <option value="SKK">Slovak Koruna</option>
                        <option value="SBD">Solomon Islands Dollar</option>
                        <option value="SOS">Somali Shilling</option>
                        <option value="ZAR">South African Rand</option>
                        <option value="KRW">South Korean Won</option>
                        <option value="XDR">Special Drawing Rights</option>
                        <option value="LKR">Sri Lankan Rupee</option>
                        <option value="SHP">St. Helena Pound</option>
                        <option value="SDG">Sudanese Pound</option>
                        <option value="SRD">Surinamese Dollar</option>
                        <option value="SZL">Swazi Lilangeni</option>
                        <option value="SEK">Swedish Krona</option>
                        <option value="CHF">Swiss Franc</option>
                        <option value="SYP">Syrian Pound</option>
                        <option value="STD">São Tomé and Príncipe Dobra</option>
                        <option value="TJS">Tajikistani Somoni</option>
                        <option value="TZS">Tanzanian Shilling</option>
                        <option value="THB">Thai Baht</option>
                        <option value="TOP">Tongan pa'anga</option>
                        <option value="TTD">Trinidad & Tobago Dollar</option>
                        <option value="TND">Tunisian Dinar</option>
                        <option value="TRY">Turkish Lira</option>
                        <option value="TMT">Turkmenistani Manat</option>
                        <option value="UGX">Ugandan Shilling</option>
                        <option value="UAH">Ukrainian Hryvnia</option>
                        <option value="UYU">Uruguayan Peso</option>
                        <option value="USD">US Dollar</option>
                        <option value="UZS">Uzbekistan Som</option>
                        <option value="VUV">Vanuatu Vatu</option>
                        <option value="VEF">Venezuelan BolÃ­var</option>
                        <option value="VND">Vietnamese Dong</option>
                        <option value="YER">Yemeni Rial</option>
                        <option value="ZMK">Zambian Kwacha</option>

                    </select>
                <x-jet-input-error for="devise" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="etat" value="{{ __('État') }}" />
                    <select id="etat" wire:model="etat" autocomplete="etat"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                        <option > Choisir </option>
                        <option > Ouvert </option>
                        <option >Fermé</option>
                    </select>
                <x-jet-input-error for="etat" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="paysCompte" value="{{ __('Pays du compte') }}" />
                    <select id="paysCompte" wire:model="paysCompte" autocomplete="paysCompte"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                        <option > Choisir </option>
                        <option > Maroc </option>
                        <option >Allemagne</option>
                    </select>
                <x-jet-input-error for="paysCompte" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="compteComptableId" value="{{ __('Compte comptable') }}" />
                    <select id="compteComptableId" wire:model="compteComptableId" autocomplete="compteComptableId"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                        <option > Choisir </option>
                        @foreach ($list_comptes_comptables as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                <x-jet-input-error for="compteComptableId" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Enregistrer') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>
    </div>
    <div class="p-5"  x-show="openTab === 2">
    @livewire('paramétrage.liste-compte')
    </div></div>--}}
