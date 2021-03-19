
<div class="p-5">


    <div class="min-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profils') }}
            </h2>
        </x-slot>

        <x-jet-form-section submit="editRole">
            <x-slot name="title">
                {{ __('Modification profil') }}
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
                    <x-jet-label for="display_name" value="{{ __('Nom') }}" />
                    <x-jet-input id="display_name" type="text" class="mt-1 block w-full" wire:model.defer="display_name" autocomplete="display_name" />
                    <x-jet-input-error for="display_name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="description" value="{{ __('description') }}" />
                    <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="description" autocomplete="description" />
                    <x-jet-input-error for="description" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="permissions" value="{{ __('Permissions') }}" />
                    @if(count($permissions))

                        {{--@foreach ($permissions as $permission)

                            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                                <input type="hidden" wire:model="selectedPermissions" name="listPermissions[]" value="{{$permission->id}}">

                                <input
                                    type="checkbox"
                                    class="form-checkbox h-4 w-4"
                                    name="listPermissions[]"
                                    value="{{$permission->id}}"
                                    {!! $permission->assigned ? 'checked' : '' !!}
                                >
                                <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                            </label>
                        @endforeach--}}

                        @foreach ($permissions as $permission)
                            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                                <input
                                    type="checkbox"
                                    class="form-checkbox h-4 w-4"
                                    name="selectedPermissions[]"
                                    wire:model="selectedPermissions"
                                    value="{{$permission->id}}"
                                >
                                <span class="ml-2">{{$permission->display_name ?? $permission->name}}</span>
                            </label>
                    @endforeach
                    @else
                        <p>Aucune permission créée pour le moment</p>
                    @endif

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
