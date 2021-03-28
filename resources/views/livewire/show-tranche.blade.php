<!--Modal-Tranches-->
<div wire:ignore.self class="modal secondary fade" id="tranches" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tranches" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Nouvelle tranche') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="tranches-form" class="form" wire:submit.prevent="createTranche">
                    <div x-data="{ open: false }">
                        <div class="mb-6">
                            <div class="radio-inline">
                                @foreach ($list_modes_vente as $mode)
                                    <label class="radio radio-primary">
                                        <input type="radio" name="type" wire:model.defer="type" value="{{$mode->id}}" @click="open = {{$mode->id}}"/>
                                        <span></span>
                                        {{$mode->nom}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="row" x-show="open === 1">
                            <div class="form-group col-md-6">
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="minPoids"/>
                                    <label>{{ __('Poids Minimal') }}</label>
                                </div>
                                @error('minPoids')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-sliders-h icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="maxPoids"/>
                                    <label>{{ __('Poids Maximal') }}</label>
                                </div>
                                @error('maxPoids')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div x-show="open > 1">
                            <div class="form-group">
                                <div class="input-group input-group-prepend">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-weight-hanging icon-lg"></i></span></div>
                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="nom"/>
                                    <label>{{ __('Nom') }}</label>
                                </div>
                                @error('nom')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                <button type="submit" class="btn btn-primary font-weight-bold" form="tranches-form">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div>
