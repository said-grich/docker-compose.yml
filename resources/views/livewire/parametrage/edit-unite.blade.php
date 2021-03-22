
{{-- 
    <!--Modal-->
    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Modification unité') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-unite-form" class="form" wire:submit.prevent="editUnite">
                        <div class="form-group">
                            <div class="input-group input-group-prepend">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                <input type="text" class="form-control" placeholder=" " wire:model.defer="name"/>
                                <label>{{ __('Nom') }}</label>
                            </div>
                            @error('name')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                    <button type="submit" class="btn btn-primary font-weight-bold" form="edit-unite-form">{{ __('Enregistrer') }}</button>
                </div>
            </div>
        </div>
    </div> --}}
<div class="p-5">
    <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('unités') }}
            </h2>
        </x-slot>

        <x-jet-form-section submit="editUnite">
            <x-slot name="title">
                {{ __('Modification unité') }}
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
            <x-slot name="form">

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Nom') }}" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="libelle" />
                    <x-jet-input-error for="name" class="mt-2" />
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
