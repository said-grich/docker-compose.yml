@section('title', "Création d'article")
@section('header_title', "Création d'article")
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header card-header-tabs-line">
                        <div class="card-toolbar">
                            <br><ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#lient_tab_1">
                                        <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                        <span class="nav-text">Article Identification</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#lient_tab_2">
                                        <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                                        <span class="nav-text">Comptable</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="lient_tab_1" role="tabpanel" aria-labelledby="lient_tab_1">
                                <form id="unite-form" class="form" wire:submit.prevent="createArticle">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-alt icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="code"/>
                                                        <label>{{ __('Code Article') }}</label>
                                                    </div>
                                                    @error('code')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-box-open icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="libelle"/>
                                                        <label>{{ __('Article') }}</label>
                                                    </div>
                                                    @error('libelle')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-cogs icon-lg"></i></span></div>

                                                        <select class="form-control" id="nature" wire:model.defer="nature" data-placeholder="">
                                                            <option > Choisir </option>
                                                            <option >Matière première </option>
                                                            <option >Produit fini </option>
                                                            <option >Service </option>
                                                        </select>
                                                        <label>{{ __('Nature') }}</label>
                                                    </div>
                                                    @error('nature')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-lightbulb icon-lg"></i></span></div>

                                                        <select class="form-control" id="type" wire:model.defer="type"data-placeholder="">
                                                       <option > Choisir </option>
                                                       <option >Local</option>
                                                       <option >Import</option>
                                                   </select>
                                                        <label>{{ __('Type') }}</label>
                                                    </div>
                                                    @error('type')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="marque"/>
                                                        <label>{{ __('Marque') }}</label>
                                                    </div>
                                                    @error('marque')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-boxes icon-lg"></i></span></div>
                                                        <select class="form-control" id="famille_id" wire:model.defer="famille_id" data-placeholder="">
                                                            <option> Choisir une famille </option>
                                                            @foreach ($list_familles as $item)
                                                                <option value="{{ $item->id }}"> {{ $item->famille }} </option>
                                                            @endforeach
                                                        </select>
                                                        <label>{{ __('Famille') }}</label>
                                                    </div>
                                                    @error('famille_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-boxes icon-lg"></i></span></div>

                                                        <select class="form-control" id="sousFamilleId" wire:model.defer="sousFamilleId" data-placeholder="">
                                                            <option value="0"> Choisir </option>
                                                            @foreach ($list_sous_familles as $item)
                                                               <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                            @endforeach
                                                        </select>
                                                        <label>{{ __('Sous Famille') }}</label>
                                                    </div>
                                                    @error('sousFamilleId')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-alt icon-lg"></i></span></div>
                                                        <select class="form-control" id="sousFamilleId" wire:model.defer="selection" data-placeholder="">
                                                            <option value="0"> Choisir un fournisseur</option>
                                                            @foreach ($list_fournisseurs as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                            @endforeach
                                                        </select>
                                                        <label>{{ __('Fournisseur') }}</label>
                                                    </div>
                                                    @error('selection')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary font-weight-bold" form="unite-form">{{ __('Enregistrer') }}</button>
                                </div>
                            </div>
                            <div class="tab-pane fade show " id="lient_tab_2" role="tabpanel" aria-labelledby="lient_tab_2">
                                <form id="unite-form" class="form" wire:submit.prevent="createArticle">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calculator icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="code_comptable"/>
                                                        <label>{{ __('Code Comptable') }}</label>
                                                    </div>
                                                    @error('code_comptable')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-invoice-dollar icon-lg"></i></span></div>

                                                        <select class="form-control" id="assujetti_tva" wire:model.defer="assujetti_tva" data-placeholder="">
                                                         <option > Choisir </option>
                                                         <option @click="open = 1"> Oui </option>
                                                         <option  @click="open = 2"> Non</option>
                                                    </select>
                                                        <label>{{ __('Assujetti à la tva') }}</label>
                                                    </div>
                                                    @error('assujetti_tva')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary font-weight-bold" form="unite-form">{{ __('Enregistrer') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header card-header-tabs-line">
                        <div class="card-toolbar">
                            <br><ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#lient_tab_3">
                                        <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                        <span class="nav-text">Stock</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#lient_tab_4">
                                        <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                                        <span class="nav-text">Tarif</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="lient_tab_3" role="tabpanel" aria-labelledby="lient_tab_3">
                                <form id="unite-form" class="form" wire:submit.prevent="createArticle">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-cart-plus icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="qte_minimum"/>
                                                        <label>{{ __('Qte minimum') }}</label>
                                                    </div>
                                                    @error('qte_minimum')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-cart-plus icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="qte_securite"/>
                                                        <label>{{ __('Qte de sécurité') }}</label>
                                                    </div>
                                                    @error('qte_securite')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-balance-scale icon-lg"></i></span></div>

                                                        <select class="form-control" id="uniteAfficheeId" wire:model.defer="uniteAfficheeId" data-placeholder="">
                                                        <option value="0"> Choisir</option>
                                                        @foreach ($list_unites as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                        @endforeach
                                                   </select>
                                                        <label>{{ __('Unité affichée') }}</label>
                                                    </div>
                                                    @error('uniteAfficheeId')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-store icon-lg"></i></span></div>

                                                        <select class="form-control" id="uniteAchatId" wire:model.defer="uniteAchatId" data-placeholder="">
                                                            <option value="0"> Choisir</option>
                                                             @foreach ($list_unites as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                            @endforeach
                                                    </select>
                                                        <label>{{ __('Unité achat') }}</label>
                                                    </div>
                                                    @error('uniteAchatId')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tags icon-lg"></i></span></div>
                                                        <select class="form-control" id="uniteVenteId" wire:model.defer="uniteVenteId" data-placeholder="">
                                                           <option value="0"> Choisir</option>
                                                              @foreach ($list_unites as $item)
                                                           <option value="{{ $item->id }}">{{ $item->name }} </option>
                                                              @endforeach
                                                        </select>
                                                        <label>{{ __('Unité vente') }}</label>
                                                    </div>
                                                    @error('uniteVenteId')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-cubes icon-lg"></i></span></div>

                                                        <select class="form-control" id="regle_sorties_stocks" wire:model.defer="regle_sorties_stocks" data-placeholder="">
                                                          <option > Choisir </option>
                                                          <option >FIFO</option>
                                                          <option >LIFO</option>
                                                        </select>
                                                        <label>{{ __('Régle sortie du stock') }}</label>
                                                    </div>
                                                    @error('regle_sorties_stocks')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="checkbox-inline">
                                                        <label class="checkbox">
                                                            <input wire:model.defer="interdire_achat" class="form-control" type="checkbox" name="Checkboxes2"/>
                                                            <span></span>
                                                            Interdire l' achat
                                                        </label>
                                                        <label class="checkbox">
                                                            <input wire:model.defer="interdire_vente" class="form-control" type="checkbox" name="Checkboxes2"/>

                                                            <span></span>
                                                            Interdire la vente
                                                        </label>
                                                        <label class="checkbox">
                                                            <input wire:model.defer="montage" class="form-control" type="checkbox" name="Checkboxes2"/>
                                                            <span></span>
                                                            Montage
                                                        </label>
                                                        <label class="checkbox">
                                                            <input wire:model.defer="peremption" class="form-control" type="checkbox" name="Checkboxes2"/>
                                                            <span></span>
                                                            Péremption
                                                        </label>
                                                        <label class="checkbox">
                                                            <input wire:model.defer="cache" class="form-control" type="checkbox" name="Checkboxes2"/>
                                                            <span></span>
                                                            Caché
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary font-weight-bold" form="unite-form">{{ __('Enregistrer') }}</button>
                                </div>
                            </div>
                            <div class="tab-pane fade show " id="lient_tab_4" role="tabpanel" aria-labelledby="lient_tab_4">
                                <form id="unite-form" class="form" wire:submit.prevent="createArticle">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-check icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="garantie_client"/>
                                                        <label>{{ __('Garantie client') }}</label>
                                                    </div>
                                                    @error('garantie_client')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tags icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="plafond_remise"/>
                                                        <label>{{ __('Plafond remise') }}</label>
                                                    </div>
                                                    @error('plafond_remise')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-percentage icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="marge"/>
                                                        <label>{{ __('Taux de marque') }}</label>
                                                    </div>
                                                    @error('marge')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-box-open icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="pmp"/>
                                                        <label>{{ __('PMP') }}</label>
                                                    </div>
                                                    @error('pmp')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-hand-holding-usd icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="taux_assurance"/>
                                                        <label>{{ __('Taux d assurance') }}</label>
                                                    </div>
                                                    @error('taux_assurance')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-prepend">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money-bill-wave icon-lg"></i></span></div>
                                                        <input type="text" class="form-control" placeholder=" " wire:model.defer="frais_possession"/>
                                                        <label>{{ __('Frais Possession') }}</label>
                                                    </div>
                                                    @error('frais_possession')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary font-weight-bold" form="unite-form">{{ __('Enregistrer') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@livewire('paramétrage.liste-article')



