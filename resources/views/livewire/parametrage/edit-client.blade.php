<div class="p-5 bg-white" x-data="{ openTab: 1 }">
    <ul class="flex border-b mx-5">
        <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-white bg-indigo-700' : 'text-gray-700 hover:text-gray-800'"
                class="bg-white inline-block py-2 px-4 font-sm" href="#">
                Edite Client
            </a>
        </li>
        <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-white bg-indigo-700' : 'text-gray-700 hover:text-gray-800'"
                class="bg-white inline-block py-2 px-4 font-sm" href="#">
                Liste Clients
            </a
        </li>

    </ul>

    <div x-show="openTab === 1">
        <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">

                    {{ __('Edition Client') }}
                </h2>
            </x-slot>

            <x-jet-form-section submit="updateClient">
                <x-slot name="title">
                    {{ __('Modifier le client') }}
                </x-slot>

                <x-slot name="description">

                </x-slot>
                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>



                <x-slot name="client">

                    <div class="flex flex-col flex-1 max-h-full pl-2 pr-2 rounded-md xl:pr-4">
                        <!-- Main Content -->
                        <!-- Placeholder Cards -->

                        <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">

                            <div
                                class="flex flex-col flex-1 items-left justify-left w-full max-h-full bg-gray-100 rounded-md shadow-md p-6">
                                <h1 class="text-xl tracking-wider text-gray-500 uppercase p-2">Client Identification
                                </h1>

                                <div class="flex items-center space-x-4">
                                    <div class="flex flex-col md:w-full">
                                        <x-jet-label for="name" value="{{ __('Nom Entreprise') }}" required/>
                                        <x-jet-input id="name" type="text" class="mt-1 block w-full"
                                            wire:model.defer="name" autocomplete="name" />
                                        <x-jet-input-error for="name" class="mt-2" />
                                    </div>
                                    <div class="flex flex-col md:w-full">
                                        <x-jet-label for="industrie" value="{{ __('Secteur d activité') }}" required/>
                                        <x-jet-input id="industrie" type="text" class="mt-1 block w-full"
                                            wire:model.defer="industrie" autocomplete="industrie" />
                                        <x-jet-input-error for="industrie" class="mt-2" />
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4">

                                    <div class="flex flex-col md:w-full">
                                        <x-jet-label for="date_inscription" value="{{ __('Date dinscription') }}" required/>

                                        <x-jet-input id="date_inscription" type="date"
                                            wire:model.defer="date_inscription"
                                            class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                            placeholder="25/02/2020" />
                                        <x-jet-input-error for="ville" class="mt-2" />
                                    </div>

                                    <div class="flex flex-col md:w-full">
                                        <x-jet-label for="langue" value="{{ __('Langue') }}" required/>

                                        <select id="langue" wire:model.defer="langue"
                                            class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                            data-placeholder="Choose a Language...">

                                            <option>Choisissez la langue</option>
                                            <option value="AF">Afrikaans</option>
                                            <option value="SQ">Albanian</option>
                                            <option value="AR">Arabic</option>
                                            <option value="HY">Armenian</option>
                                            <option value="EU">Basque</option>
                                            <option value="BN">Bengali</option>
                                            <option value="BG">Bulgarian</option>
                                            <option value="CA">Catalan</option>
                                            <option value="KM">Cambodian</option>
                                            <option value="ZH">Chinese (Mandarin)</option>
                                            <option value="HR">Croatian</option>
                                            <option value="CS">Czech</option>
                                            <option value="DA">Danish</option>
                                            <option value="NL">Dutch</option>
                                            <option value="EN">English</option>
                                            <option value="ET">Estonian</option>
                                            <option value="FJ">Fiji</option>
                                            <option value="FI">Finnish</option>
                                            <option value="FR" selected="selected">French</option>
                                            <option value="KA">Georgian</option>
                                            <option value="DE">German</option>
                                            <option value="EL">Greek</option>
                                            <option value="GU">Gujarati</option>
                                            <option value="HE">Hebrew</option>
                                            <option value="HI">Hindi</option>
                                            <option value="HU">Hungarian</option>
                                            <option value="IS">Icelandic</option>
                                            <option value="ID">Indonesian</option>
                                            <option value="GA">Irish</option>
                                            <option value="IT">Italian</option>
                                            <option value="JA">Japanese</option>
                                            <option value="JW">Javanese</option>
                                            <option value="KO">Korean</option>
                                            <option value="LA">Latin</option>
                                            <option value="LV">Latvian</option>
                                            <option value="LT">Lithuanian</option>
                                            <option value="MK">Macedonian</option>
                                            <option value="MS">Malay</option>
                                            <option value="ML">Malayalam</option>
                                            <option value="MT">Maltese</option>
                                            <option value="MI">Maori</option>
                                            <option value="MR">Marathi</option>
                                            <option value="MN">Mongolian</option>
                                            <option value="NE">Nepali</option>
                                            <option value="NO">Norwegian</option>
                                            <option value="FA">Persian</option>
                                            <option value="PL">Polish</option>
                                            <option value="PT">Portuguese</option>
                                            <option value="PA">Punjabi</option>
                                            <option value="QU">Quechua</option>
                                            <option value="RO">Romanian</option>
                                            <option value="RU">Russian</option>
                                            <option value="SM">Samoan</option>
                                            <option value="SR">Serbian</option>
                                            <option value="SK">Slovak</option>
                                            <option value="SL">Slovenian</option>
                                            <option value="ES">Spanish</option>
                                            <option value="SW">Swahili</option>
                                            <option value="SV">Swedish </option>
                                            <option value="TA">Tamil</option>
                                            <option value="TT">Tatar</option>
                                            <option value="TE">Telugu</option>
                                            <option value="TH">Thai</option>
                                            <option value="BO">Tibetan</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TR">Turkish</option>
                                            <option value="UK">Ukrainian</option>
                                            <option value="UR">Urdu</option>
                                            <option value="UZ">Uzbek</option>
                                            <option value="VI">Vietnamese</option>
                                            <option value="CY">Welsh</option>
                                            <option value="XH">Xhosa</option>
                                        </select>

                                        <x-jet-input-error for="langue" class="mt-2" />
                                    </div>


                                </div>

                                <div class="flex items-center space-x-4  ">

                                    <div class="flex flex-col  md:w-full">
                                        <x-jet-label for="tele_professionnel" value="{{ __('Téléphone Fixe') }}" required/>
                                        <x-jet-input id="tele_professionnel" type="tele" class="mt-1 block w-full"
                                            wire:model.defer="tele_professionnel" autocomplete="tele_professionnel" />
                                        <x-jet-input-error for="tele_professionnel" class="mt-2" />
                                    </div>

                                    <div class="flex flex-col  md:w-full">
                                        <x-jet-label for="tele_portable" value="{{ __('Téléphone Portable') }}" />

                                        <x-jet-input id="tele_portable" type="tele" class="mt-1 block w-full"
                                            wire:model.defer="tele_portable" autocomplete="tele_portable" />
                                        <x-jet-input-error for="tele_portable" class="mt-2" />
                                    </div>

                                </div>

                                <div class="flex items-center space-x-4  ">
                                    <div class="flex flex-col  md:w-full">
                                        <x-jet-label for="email" value="{{ __('Email') }}" required/>
                                        <x-jet-input id="email" type="email" class="mt-1 block w-full"
                                            wire:model.defer="email" autocomplete="email" />
                                        <x-jet-input-error for="email" class="mt-2" />
                                    </div>

                                    <div class="flex flex-col  md:w-full">
                                        <x-jet-label for="statut" value="{{ __('STATUT') }}" required/>
                                        <select id="statut" type="text"
                                            class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                            wire:model.defer="statut" autocomplete="statut">
                                            @foreach (App\Models\Client::STATUTS as $value=> $label)
                                            <option value="{{$value}}">{{$label}}</option>
                                            @endforeach
                                        </select>
                                        <x-jet-input-error for="statut" class="mt-2" />
                                    </div>
                                </div>

                            </div>

                            <div
                                class="flex flex-col flex-1 items-left justify-left w-full max-h-full bg-gray-100 rounded-md shadow-md p-6">
                                <h1 class="text-xl tracking-wider text-gray-500 uppercase p-2">Représentant Entreprise
                                </h1>

                                <div class="col-span-6 sm:col-span-4  ">
                                    <div class="flex items-center space-x-4  ">

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="agent_nom" value="{{ __('Nom') }}" required/>
                                            <x-jet-input id="agent_nom" type="text" class="mt-1 block w-full"
                                                wire:model.defer="agent_nom" autocomplete="agent_nom" />
                                            <x-jet-input-error for="agent_nom" class="mt-2" />
                                        </div>

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="agent_prenom" value="{{ __('Prénom') }}" required/>
                                            <x-jet-input id="agent_prenom" type="text" class="mt-1 block w-full"
                                                wire:model.defer="agent_prenom" autocomplete="agent_prenom" />
                                            <x-jet-input-error for="agent_prenom" class="mt-2" />
                                        </div>

                                    </div>
                                </div>

                                <div class="flex items-center space-x-4  ">

                                    <div class="flex flex-col  md:w-full">
                                        <x-jet-label for="poste_agent" value="{{ __('Fonction') }}" required/>
                                        <x-jet-input id="poste_agent" type="text" class="mt-1 block w-full"
                                            wire:model.defer="poste_agent" autocomplete="poste_agent" />
                                        <x-jet-input-error for="poste_agent" class="mt-2" />
                                    </div>

                                    {{-- <div class="flex flex-col  md:w-full">
                                        <x-jet-label for="entreprise_agent"
                                            value="{{ __('Entreprise') }}" />

                                        <x-jet-input id="entreprise_agent" type="text"
                                            class="mt-1 block w-full" wire:model.defer="entreprise_agent"
                                            autocomplete="entreprise_agent" />
                                        <x-jet-input-error for="entreprise_agent" class="mt-2" />
                                    </div> --}}

                                </div>
                                <div class="col-span-6 sm:col-span-4  ">
                                    <div class="flex items-center space-x-4  ">
                                        <div class="flex flex-col  md:w-full">

                                            <x-jet-label for="tele_agent" value="{{ __('Tele') }}" />

                                            <x-jet-input id="tele_agent" type="tele" class="mt-1 block w-full"
                                                wire:model.defer="tele_agent" autocomplete="tele_agent" />
                                            <x-jet-input-error for="tele_agent" class="mt-2" />
                                        </div>

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="genre_agent" value="{{ __('GENRE') }}" required/>
                                            <select id="genre_agent" type="text"
                                                class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                                wire:model.defer="genre_agent" autocomplete="genre_agent">
                                                <option>choisir le genre</option>
                                                <option value="M">M</option>
                                                <option value="F">F</option>
                                            </select>
                                            <x-jet-input-error for="genre_agent" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-4  ">

                                    <div class="flex items-center space-x-4  ">

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="email_agent" value="{{ __('Email') }}" required/>
                                            <x-jet-input id="email_agent" type="email" class="mt-1 block w-full"
                                                wire:model.defer="email_agent" autocomplete="email_agent" />
                                            <x-jet-input-error for="email_agent" class="mt-2" />
                                        </div>

                                        {{-- <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="date_naissance_agent"
                                                value="{{ __('Date de naissance') }}" />
                                            <x-jet-input id="date_naissance_agent" type="date"
                                                class="mt-1 block w-full"
                                                wire:model.defer="date_naissance_agent"
                                                autocomplete="date_naissance_agent" />
                                            <x-jet-input-error for="date_naissance_agent" class="mt-2" />
                                        </div> --}}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                            <div
                                class="flex flex-col flex-1 items-left justify-left w-full max-h-full bg-gray-100 rounded-md shadow-md p-6">
                                <h1 class="text-xl tracking-wider text-gray-500 uppercase p-2">Adresse Entreprise
                                </h1>
                                <div x-data="{active: 0}">
                                    <div class="flex overflow-hidden -mb-px">
                                        <button class="rounded-md px-4 py-2 w-full" x-on:click.prevent="active = 0"
                                            x-bind:class="{'bg-gray-400 text-black': active === 0}">Adresse de
                                            facturation</button>
                                        <button class="rounded-md px-4 py-2 w-full" x-on:click.prevent="active = 1"
                                            x-bind:class="{'bg-gray-400 text-black': active === 1}">Addresse de
                                            livraison</button>

                                    </div>

                                    <div class="bg-white bg-opacity-10  rounded-md -mt-px">
                                        <div class="p-4 space-y-2" x-show="active === 0"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 transform scale-90"
                                            x-transition:enter-end="opacity-100 transform scale-100">

                                            <div class="col-span-6 sm:col-span-4">
                                                <x-jet-label for="address_facturation"
                                                    value="{{ __('Addresse Facturation') }}" />
                                                <x-jet-input id="address" type="text" class="mt-1 block w-full"
                                                    wire:model.defer="address_facturation"
                                                    autocomplete="address_facturation" />
                                                <x-jet-input-error for="address_facturation" class="mt-2" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-4  ">
                                                <div class="flex items-center space-x-4  ">
                                                    <div class="flex flex-col  md:w-full">
                                                        <x-jet-label for="ville_facturation"
                                                            value="{{ __('Ville Facturation') }}" />
                                                        <x-jet-input id="ville_facturation" type="text"
                                                            class="mt-1 block w-full"
                                                            wire:model.defer="ville_facturation"
                                                            autocomplete="ville_facturation" />
                                                        <x-jet-input-error for="ville_facturation" class="mt-2" />
                                                    </div>
                                                    <div class="flex flex-col  md:w-full">
                                                        <x-jet-label for="pays_facturation"
                                                            value="{{ __('Pays Facturation') }}" />

                                                        <x-jet-input id="pay_facturations" type="text"
                                                            class="mt-1 block w-full"
                                                            wire:model.defer="pays_facturation"
                                                            autocomplete="pays_facturation" />
                                                        <x-jet-input-error for="pays_facturation" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-4  ">
                                                <div class="flex items-center space-x-4  ">
                                                    <div class="flex flex-col  md:w-full">
                                                        <x-jet-label for="code_postal_facturation"
                                                            value="{{ __('Code postal Facturation') }}" />
                                                        <x-jet-input id="code_postal_facturation" type="text"
                                                            class="mt-1 block w-full"
                                                            wire:model.defer="code_postal_facturation"
                                                            autocomplete="code_postal_facturation" />
                                                        <x-jet-input-error for="code_postal_facturation" class="mt-2" />
                                                    </div>
                                                    <div class="flex flex-col  md:w-full">
                                                        <x-jet-label for="province_facturation"
                                                            value="{{ __('État / Province Facturation') }}" />

                                                        <x-jet-input id="province_facturation" type="text"
                                                            class="mt-1 block w-full"
                                                            wire:model.defer="province_facturation"
                                                            autocomplete="province_facturation" />
                                                        <x-jet-input-error for="province_facturation" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-4 space-y-2 rounded-md" x-show="active === 1"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 transform scale-90"
                                            x-transition:enter-end="opacity-100 transform scale-100">

                                            <div class="col-span-6 sm:col-span-4">
                                                <x-jet-label for="address_livraison"
                                                    value="{{ __('Addresse livraison') }}" />
                                                <x-jet-input id="address_livraison" type="text"
                                                    class="mt-1 block w-full" wire:model.defer="address_livraison"
                                                    autocomplete="address_livraison" />
                                                <x-jet-input-error for="address_livraison" class="mt-2" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-4  ">
                                                <div class="flex items-center space-x-4  ">

                                                    <div class="flex flex-col  md:w-full">
                                                        <x-jet-label for="ville_livraison"
                                                            value="{{ __('Ville livraison') }}" />
                                                        <x-jet-input id="ville_livraison" type="text"
                                                            class="mt-1 block w-full" wire:model.defer="ville_livraison"
                                                            autocomplete="ville_livraison" />
                                                        <x-jet-input-error for="ville_livraison" class="mt-2" />
                                                    </div>

                                                    <div class="flex flex-col  md:w-full">
                                                        <x-jet-label for="pays_livraison"
                                                            value="{{ __('Pays Livraison') }}" />

                                                        <x-jet-input id="pays_livraison" type="text"
                                                            class="mt-1 block w-full" wire:model.defer="pays_livraison"
                                                            autocomplete="pays_livraison" />
                                                        <x-jet-input-error for="pays_livraison" class="mt-2" />
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-4  ">

                                                <div class="flex items-center space-x-4  ">

                                                    <div class="flex flex-col  md:w-full">
                                                        <x-jet-label for="code_postal_livraison"
                                                            value="{{ __('Code postal_livraison') }}" />
                                                        <x-jet-input id="code_postal_livraison" type="text"
                                                            class="mt-1 block w-full"
                                                            wire:model.defer="code_postal_livraison"
                                                            autocomplete="code_postal_livraison" />
                                                        <x-jet-input-error for="code_postal_livraison" class="mt-2" />
                                                    </div>

                                                    <div class="flex flex-col  md:w-full">
                                                        <x-jet-label for="province_livraison"
                                                            value="{{ __('État / Province Livraison') }}" />
                                                        <x-jet-input id="province_livraison" type="text"
                                                            class="mt-1 block w-full"
                                                            wire:model.defer="province_livraison"
                                                            autocomplete="province_livraison" />
                                                        <x-jet-input-error for="province_livraison" class="mt-2" />
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex flex-col flex-1 items-left justify-left w-full max-h-full bg-gray-100 rounded-md shadow-md p-4">
                                <h1 class="text-xl tracking-wider text-gray-500 uppercase p-2">information additionnelle
                                </h1>

                                <div class="col-span-6 sm:col-span-4  ">
                                    <div class="flex items-center space-x-4  ">
                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="fax" value="{{ __('Fax') }}" />
                                            <x-jet-input id="fax" type="text" class="mt-1 block w-full"
                                                wire:model.defer="fax" autocomplete="fax" />
                                            <x-jet-input-error for="fax" class="mt-2" />
                                        </div>
                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="linkedin" value="{{ __('Linkedin') }}" />

                                            <x-jet-input id="linkedin" type="text" class="mt-1 block w-full"
                                                wire:model.defer="linkedin" autocomplete="linkedin" />
                                            <x-jet-input-error for="linkedin" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="site_internet" value="{{ __('Site Web') }}" />
                                    <x-jet-input id="site_internet" type="text" class="mt-1 block w-full"
                                        wire:model.defer="site_internet" autocomplete="site_internet" />
                                    <x-jet-input-error for="site_internet" class="mt-2" />
                                </div>

                                {{-- <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="comment_nous_trouve"
                                    value="{{ __('Satisfaction') }}" />
                                <x-jet-input id="comment_nous_trouve" type="text" class="mt-1 block w-full"
                                    wire:model.defer="comment_nous_trouve" autocomplete="comment_nous_trouve" />
                                <x-jet-input-error for="comment_nous_trouve" class="mt-2" />
                            </div> --}}

                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="recommandateur" value="{{ __('Recommandateur') }}" />
                                    <x-jet-input id="recommandateur" type="text" class="mt-1 block w-full"
                                        wire:model.defer="recommandateur" autocomplete="recommandateur" />
                                    <x-jet-input-error for="recommandateur" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 my-4 mt-4 md:grid-cols-1">
                            <div
                                class="flex flex-col flex-1 items-left justify-left w-full max-h-full bg-gray-100 rounded-md shadow-md p-6">

                                <h1 class="text-xl tracking-wider text-gray-500 uppercase p-2">Finance / Compta</h1>
                                <div class="col-span-6 sm:col-span-4  ">
                                    <div class="flex items-center space-x-4  ">

                                        <div class="flex flex-col  md:w-full">
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

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="mode_paiement" value="{{ __('mode de paiement') }}" />

                                            <select id="mode_paiement" wire:model.defer="devise"
                                                class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                                @foreach ($modespaiment as $item)
                                                    <option value="{{ $item->name }}"
                                                        {{ $item->name == $mode_paiement ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-jet-input-error for="mode_paiement" class="mt-2" />
                                        </div>

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="capitale" value="{{ __('Capitale') }}" />
                                            <x-jet-input id="capitale" type="text" class="mt-1 block w-full"
                                                wire:model.defer="capitale" autocomplete="capitale" />
                                            <x-jet-input-error for="capitale" class="mt-2" />
                                        </div>

                                    </div>
                                </div>


                                <div class="col-span-6 sm:col-span-4  ">
                                    <div class="flex items-center space-x-4  ">

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="main_oeuvre" value="{{ __('Nombre Ouvrier') }}" />

                                            <x-jet-input id="main_oeuvre" type="text" class="mt-1 block w-full"
                                                wire:model.defer="main_oeuvre" autocomplete="main_oeuvre" />
                                            <x-jet-input-error for="main_oeuvre" class="mt-2" />
                                        </div>

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="taxe_utilisee"
                                                value="{{ __('Taxe de vente utilisée') }}" />
                                            <x-jet-input id="capitale" type="number" min="0" max="100"
                                                class="mt-1 block w-full" wire:model.defer="taxe_utilisee"
                                                autocomplete="taxe_utilisee" />
                                            <x-jet-input-error for="taxe_utilisee" class="mt-2" />
                                        </div>

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="revenue_entreprise"
                                                value="{{ __('Revenue entreprise') }}" />

                                            <x-jet-input id="revenue_entreprise" type="text" class="mt-1 block w-full"
                                                wire:model.defer="revenue_entreprise"
                                                autocomplete="revenue_entreprise" />
                                            <x-jet-input-error for="revenue_entreprise" class="mt-2" />
                                        </div>

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="montant_total" value="{{ __('C.A') }}" />
                                            <x-jet-input id="montant_total" type="number" step="0.001"
                                                class="mt-1 block w-full" wire:model.defer="montant_total"
                                                autocomplete="montant_total" />
                                            <x-jet-input-error for="montant_total" class="mt-2" />
                                        </div>

                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <div class="flex items-center space-x-4  ">



                                        {{-- <div class="flex flex-col flex-2  md:w-full">
                                            <x-jet-label for="tags" value="{{ __('Tags') }}" />
                                            <div x-data="{tags: [], newTag: '', inputName: 'tags' }"
                                                class="mt-1 block w-full">
                                                <template x-for="tag in tags">
                                                    <input type="hidden" x-bind:name="inputName + '[]'"
                                                        x-bind:value="tag">
                                                </template>

                                                <div class="w-full">
                                                    <div class="tags-input">
                                                        <template x-for="tag in tags" :key="tag">
                                                            <span class="tags-input-tag">
                                                                <span x-text="tag"></span>
                                                                <button type="button" class="tags-input-remove"
                                                                    @@click="tags = tags.filter(i => i !== tag)">
                                                                    &times;
                                                                </button>
                                                            </span>
                                                        </template>

                                                        <input class="tags-input-text md:w-full"
                                                            placeholder="Add tag..."
                                                            @@keydown.enter.prevent="if (newTag.trim() !== '') tags.push(newTag.trim()); $wire.pushTag(newTag); newTag = ''"
                                                            x-model="newTag">
                                                    </div>
                                                </div>
                                            </div>

                                        </div> --}}

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Main Footer -->
                    </div>
                    {{-- """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""" --}}


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


</div>


<div class="p-5" x-show="openTab === 2">
    @livewire('paramétrage.list-client')
</div>
</div>

<script>
    function tagSelect() {
        return {
            open: false,
            textInput: '',
            tags: [],
            init() {
                this.tags = JSON.parse(this.$el.parentNode.getAttribute('data-tags'));
            },
            addTag(tag) {
                tag = tag.trim()
                if (tag != "" && !this.hasTag(tag)) {
                    this.tags.push(tag)
                }
                this.clearSearch()
                this.$refs.textInput.focus()
                this.fireTagsUpdateEvent()
            },
            fireTagsUpdateEvent() {
                this.$el.dispatchEvent(new CustomEvent('tags-update', {
                    detail: {
                        tags: this.tags
                    },
                    bubbles: true,
                }));
            },
            hasTag(tag) {
                var tag = this.tags.find(e => {
                    return e.toLowerCase() === tag.toLowerCase()
                })
                return tag != undefined
            },
            removeTag(index) {
                this.tags.splice(index, 1)
                this.fireTagsUpdateEvent()
            },
            search(q) {
                if (q.includes(",")) {
                    q.split(",").forEach(function(val) {
                        this.addTag(val)
                    }, this)
                }
                this.toggleSearch()
            },
            clearSearch() {
                this.textInput = ''
                this.toggleSearch()
            },
            toggleSearch() {
                this.open = this.textInput != ''
            }
        }
    }

</script>
