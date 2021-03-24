@section('title', 'Clients')
@section('header_title', 'Clients')

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
                        <h3 class="card-title">{{ __('Liste Clients') }}</h3>
                    </div>
                    <div class="card-body">

                        <!--begin::Flash message-->
                        @if (session()->has('message'))
                            <div class="alert alert-custom alert-light-success shadow fade show mb-5" role="alert">
                                <div class="alert-icon"><i class="flaticon-interface-10"></i></div>
                                <div class="alert-text">{{ session('message') }}</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <!--end::Flash message-->

                        <!--Button trigger modal-->
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#client">
                            <i class="flaticon-plus"></i> {{ __('Ajouter client') }}
                        </button>
                        <button class="btn btn-primary font-weight-bold btn-pill" data-toggle="modal" data-target="#type-profile">
                            <i class="flaticon-plus"></i> {{ __('Ajouter profile client') }}
                        </button>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="client" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="client" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau Client') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="client-form" class="form row" wire:submit.prevent="createClient">
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="client_name"/>
                                                    <label>{{ __('Nom') }}</label>
                                                </div>
                                                @error('nom')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope icon-lg"></i></span></div>
                                                    <input type="email" class="form-control" placeholder=" " wire:model.defer="email"/>
                                                    <label>{{ __('E-Mail') }}</label>
                                                </div>
                                                @error('email')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone icon-lg"></i></span></div>
                                                    <input type="tel" class="form-control" placeholder=" " wire:model.defer="phone"/>
                                                    <label>{{ __('Phone') }}</label>
                                                </div>
                                                @error('phone')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                           {{--  <div class="form-group col-md-6">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="password"/>
                                                    <label>{{ __('Password') }}</label>
                                                </div>
                                                @error('password')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                            <div wire:ignore class="form-group col-md-12">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-id-card-alt icon-lg"></i></span></div>

                                                    <select class="form-control selectpicker" wire:model.defer="profil_client">
                                                        <option>{{ __('Choisir un profile') }}</option>
                                                        @foreach ($list_profils as $item)
                                                             <option value="{{$item->id}}">{{$item->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('type-profile')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="client-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Modal-->
                        <div wire:ignore.self class="modal fade" id="type-profile" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="type-profile" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Nouveau Profile Client') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="type-profile-form" class="form" wire:submit.prevent="createProfileClient">
                                            <div class="form-group">
                                                <div class="input-group input-group-prepend">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-id-card-alt icon-lg"></i></span></div>
                                                    <input type="text" class="form-control" placeholder=" " wire:model.defer="profil_name"/>
                                                    <label>{{ __('Nom') }}</label>
                                                </div>
                                                @error('profil_name')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{ __('Fermer') }}</button>
                                        <button type="submit" class="btn btn-primary font-weight-bold" form="type-profile-form">{{ __('Enregistrer') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Table-->
                        <div class="mt-5">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#clients-tab">
                                        <span class="nav-text">Clients</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profiles-tab">
                                        <span class="nav-text">Profiles</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5">
                                <div class="tab-pane fade active show" id="clients-tab" role="tabpanel">
                                    @livewire('parametrage.liste-clients')
                                </div>
                                <div class="tab-pane fade" id="profiles-tab" role="tabpanel">
                                    @livewire('parametrage.liste-profile-clients')
                                </div>
                            </div>
                        </div>
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

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    console.log('fff');
window.addEventListener('swal:modal', event => {
    swal({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.type,

    });
})
</script>
@endpush
