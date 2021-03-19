
    <form id="unite-form" class="form" wire:submit.prevent="createProductionTransformation">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                            <input type="date" class="form-control" placeholder=" " wire:model.defer="date_reception"/>
                            <label>{{ __('Date réception') }}</label>
                        </div>
                        @error('date_reception')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>

                            <select class="form-control" id="article_id" wire:model.defer="article_id" data-placeholder="">
                                <option value="0"> Choisir </option>
                                @foreach ( $list_article as $item)
                                   <option value="{{ $item->id }}">{{ $item->libelle }} </option>
                                @endforeach
                            </select>
                            <label>{{ __('Article') }}</label>
                        </div>
                        @error('article_id')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                            <select class="form-control" id="site_id" wire:model.defer="site_id" data-placeholder="">
                                <option value="0"> Choisir </option>
                                @foreach ( $list_sites as $item)
                                   <option value="{{ $item->id }}">{{ $item->name }} </option>
                                @endforeach
                            </select>
                            <label>{{ __('Sociéte') }}</label>
                        </div>
                        @error('site_id')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="lotmp"/>
                            <label>{{ __('Lot MP') }}</label>
                        </div>
                        @error('lotmp')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                            <select class="form-control" id="site_id" wire:model.defer="fournisseur_id" data-placeholder="">
                                <option value="0"> Choisir </option>
                                @foreach ( $list_fournisseurs as $item)
                                   <option value="{{ $item->id }}">{{ $item->name }} </option>
                                @endforeach
                            </select>
                            <label>{{ __('Fournisseur MP') }}</label>
                        </div>
                        @error('fournisseur_id')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="qteinitial"/>
                            <label>{{ __('Quantité initial M.P') }}</label>
                        </div>
                        @error('qteinitial')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="qte_apres_transformation"/>
                            <label>{{ __('Qte aprés transformation') }}</label>
                        </div>
                        @error('qte_apres_transformation')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="nbheure_travail"/>
                            <label>{{ __('Nombre d\'heure laborale travaille') }}</label>
                        </div>
                        @error('nbheure_travail')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                            <input type="text" class="form-control" placeholder=" " wire:model.defer="CRR"/>
                            <label>{{ __('Le cout CRR') }}</label>
                        </div>
                        @error('CRR')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                            <input type="date" class="form-control" placeholder=" " wire:model.defer="debut_tache"/>
                            <label>{{ __('Début tache') }}</label>
                        </div>
                        @error('debut_tache')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group input-group-prepend">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-vihara icon-lg"></i></span></div>
                            <input type="date" class="form-control" placeholder=" " wire:model.defer="fin_tache"/>
                            <label>{{ __('Fin tache') }}</label>
                        </div>
                        @error('fin_tache')
                        <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>

