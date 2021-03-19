<div>
    <div>

        <x-slot name="title">
            {{ __('Ajouter un nouveau client') }}
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
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name"
                                autocomplete="name" />
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
                            <x-jet-label for="date_inscription" value="{{ __('Date dinscription') }}" required />

                            <x-jet-input id="date_inscription" type="date" wire:model.defer="date_inscription"
                                class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                placeholder="25/02/2020" />
                            <x-jet-input-error for="date_inscription" class="mt-2" />
                        </div>

                        <div class="flex flex-col md:w-full">
                            <x-jet-label for="langue" value="{{ __('Langue') }}" required />

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
                            <x-jet-label for="email" value="{{ __('Email') }}" required />
                            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email"
                                autocomplete="email" />
                            <x-jet-input-error for="email" class="mt-2" />
                        </div>

                        <div class="flex flex-col  md:w-full">
                            <x-jet-label for="tele_portable" value="{{ __('STATUT') }}" required />

                            <select id="statut" type="text"
                                class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                wire:model.defer="statut" autocomplete="statut">
                                @foreach (App\Models\Client::STATUTS as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
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
                                <x-jet-label for="agent_nom" value="{{ __('Nom') }}" required />
                                <x-jet-input id="agent_nom" type="text" class="mt-1 block w-full"
                                    wire:model.defer="agent_nom" autocomplete="agent_nom" />
                                <x-jet-input-error for="agent_nom" class="mt-2" />
                            </div>

                            <div class="flex flex-col  md:w-full">
                                <x-jet-label for="agent_prenom" value="{{ __('Prénom') }}" required />
                                <x-jet-input id="agent_prenom" type="text" class="mt-1 block w-full"
                                    wire:model.defer="agent_prenom" autocomplete="agent_prenom" />
                                <x-jet-input-error for="agent_prenom" class="mt-2" />
                            </div>

                        </div>
                    </div>

                    <div class="flex items-center space-x-4  ">

                        <div class="flex flex-col  md:w-full">
                            <x-jet-label for="poste_agent" value="{{ __('Fonction') }}" required />
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
                                <x-jet-label for="genre_agent" value="{{ __('GENRE') }}" required />
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
                                <x-jet-label for="email_agent" value="{{ __('Email') }}" required />
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
                                        wire:model.defer="address_facturation" autocomplete="address_facturation" />
                                    <x-jet-input-error for="address_facturation" class="mt-2" />
                                </div>

                                <div class="col-span-6 sm:col-span-4  ">
                                    <div class="flex items-center space-x-4  ">
                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="ville_facturation"
                                                value="{{ __('Ville Facturation') }}" />
                                            <x-jet-input id="ville_facturation" type="text" class="mt-1 block w-full"
                                                wire:model.defer="ville_facturation" autocomplete="ville_facturation" />
                                            <x-jet-input-error for="ville_facturation" class="mt-2" />
                                        </div>
                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="pays_facturation"
                                                value="{{ __('Pays Facturation') }}" />

                                            <x-jet-input id="pay_facturations" type="text" class="mt-1 block w-full"
                                                wire:model.defer="pays_facturation" autocomplete="pays_facturation" />
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
                                                class="mt-1 block w-full" wire:model.defer="code_postal_facturation"
                                                autocomplete="code_postal_facturation" />
                                            <x-jet-input-error for="code_postal_facturation" class="mt-2" />
                                        </div>
                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="province_facturation"
                                                value="{{ __('État / Province Facturation') }}" />

                                            <x-jet-input id="province_facturation" type="text" class="mt-1 block w-full"
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
                                    <x-jet-label for="address_livraison" value="{{ __('Addresse livraison') }}" />
                                    <x-jet-input id="address_livraison" type="text" class="mt-1 block w-full"
                                        wire:model.defer="address_livraison" autocomplete="address_livraison" />
                                    <x-jet-input-error for="address_livraison" class="mt-2" />
                                </div>

                                <div class="col-span-6 sm:col-span-4  ">
                                    <div class="flex items-center space-x-4  ">

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="ville_livraison" value="{{ __('Ville livraison') }}" />
                                            <x-jet-input id="ville_livraison" type="text" class="mt-1 block w-full"
                                                wire:model.defer="ville_livraison" autocomplete="ville_livraison" />
                                            <x-jet-input-error for="ville_livraison" class="mt-2" />
                                        </div>

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="pays_livraison" value="{{ __('Pays Livraison') }}" />

                                            <x-jet-input id="pays_livraison" type="text" class="mt-1 block w-full"
                                                wire:model.defer="pays_livraison" autocomplete="pays_livraison" />
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
                                                class="mt-1 block w-full" wire:model.defer="code_postal_livraison"
                                                autocomplete="code_postal_livraison" />
                                            <x-jet-input-error for="code_postal_livraison" class="mt-2" />
                                        </div>

                                        <div class="flex flex-col  md:w-full">
                                            <x-jet-label for="province_livraison"
                                                value="{{ __('État / Province Livraison') }}" />
                                            <x-jet-input id="province_livraison" type="text" class="mt-1 block w-full"
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
                                <x-jet-input id="fax" type="text" class="mt-1 block w-full" wire:model.defer="fax"
                                    autocomplete="fax" />
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


            <!-- Main Footer -->
        </div>
        {{-- """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""" --}}

        <div class="text-right pt-3 pr-4">
            <button type="button" wire:click.prevent="createClient"
                class="nline-flex items-center px-4 py-3 text-xs font-sm tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md right-10 w-94 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:i-outline-indigo disabled:opacity-25">
                Enregistrer
            </button>
        </div>
    </div>
</div>
