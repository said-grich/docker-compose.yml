<div wire:ignore.self class="modal fade" id="livraison-localisation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title">Livraison Localisation</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" wire:model="ville">
                                <option>Ville</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" wire:model="zone">
                                <option>Zone Ville</option>
                                @if(!empty($zones))
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->nom }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                    <button wire:click="saveZoneLivraison()" type="button" class="btn btn-rounded btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@if(!Session::has('zoneLivraison'))
@push('scripts')
    <script>
        $(window).load(function(){
            setTimeout(function(){
                $('#livraison-localisation').modal('show');
            }, 4000);
        });
    </script>
@endpush
@endif
