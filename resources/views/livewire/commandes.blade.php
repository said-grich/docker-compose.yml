@section('title', 'Commandes')
@section('header_title', 'Commandes')
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
                        <h3 class="card-title">{{ __('Liste des commandes') }}</h3>
                    </div>
                    <div class="card-body">

                        <!--begin::Alerts-->
                        @include('layouts.partials.alerts')
                        <!--end::Alerts-->

                        <div class="mt-5">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#recues-tab">
                                        <span class="nav-text">Reçues</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#validees-tab">
                                        <span class="nav-text">Validées</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#pretes-tab">
                                        <span class="nav-text">Prêtes</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#en-expedition-tab">
                                        <span class="nav-text">En Expédition</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#livree-tab">
                                        <span class="nav-text">Livrée</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5">
                                <div class="tab-pane fade active show" id="recues-tab" role="tabpanel">
                                    @livewire('vente.liste-commandes')
                                </div>
                                <div class="tab-pane fade" id="validees-tab" role="tabpanel">
                                    @livewire('vente.liste-commande-validee')
                                </div>
                                <div class="tab-pane fade" id="pretes-tab" role="tabpanel">
                                    @livewire('vente.liste-commandes')
                                </div>
                                <div class="tab-pane fade" id="en-expedition-tab" role="tabpanel">
                                    @livewire('vente.liste-commandes')
                                </div>
                                <div class="tab-pane fade" id="livrees-tab" role="tabpanel">
                                    @livewire('vente.liste-commandes')
                                </div>
                            </div>
                        </div>

                        <!--Table-->
                        {{-- @livewire('vente.liste-commandes') --}}
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
