
<div class="p-5" >


        <x-jet-form-section submit="createEtatReglement" style="padding-bottom: 45px;">
            <x-slot name="title">

            </x-slot>

            <x-slot name="description">

            </x-slot>

            <x-slot name="form">


                <div x-data="{ open: false }" class="col-span-6 sm:col-span-4">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="deuxime_mise" value="{{ __('la deuxième mise') }}" />
                        <select id="deuxime_mise" wire:model="deuxime_mise" autocomplete="deuxime_mise"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                            <option > Choisir </option>
                            <option @click="open = 1"> Oui </option>
                            <option  @click="open = 2"> Non</option>

                        </select>
                        <x-jet-input-error for="tva" class="mt-2" />
                    </div>


                    <div x-show="open === 1" class="col-span-6 sm:col-span-4">
                        <label class="block">
                            <span class="text-gray-700">Date mise en banque</span>
                            <input wire:model.lazy="date_mise_banque" id="date_mise_banque" type="text" class="block w-full mt-1 form-input"  autocomplete="date_mise_banque">
                        </label>
                    </div>
                    <div x-show="open === 1" class="col-span-6 sm:col-span-4">
                    <label class="block">
                        <span class="text-gray-700">Date encaissement</span>
                        <input wire:model.lazy="date_encaissement" id="date_encaissement" type="text" class="block w-full mt-1 form-input"  autocomplete="date_encaissement">
                    </label>
                    </div>
                </div>

                <x-slot name="actions">
                    <x-jet-action-message class="mr-3" on="saved">
                        {{ __('Saved.') }}
                    </x-jet-action-message>

                    <x-jet-button>
                        {{ __('Enregistrer') }}
                    </x-jet-button>
                </x-slot>
            </x-slot>

        </x-jet-form-section>


</div>

<script>
    // You can get and set dates with moment objects

    var picker1 = new Pikaday(
        {
            field: document.getElementById('date_encaissement'),

        });

    picker1.setMoment(moment());
    var picker1 = new Pikaday(
        {
            field: document.getElementById('date_mise_banque'),

        });

    picker1.setMoment(moment());




</script>

