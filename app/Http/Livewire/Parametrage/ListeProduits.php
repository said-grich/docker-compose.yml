<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Famille;
use App\Models\ModePreparation;
use App\Models\ModeVente;
use App\Models\PreparationType;
use App\Models\ProduitTranche;
use App\Models\Tranche;
use App\Models\Unite;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Http\Livewire\Parametrage\Produits;
use Livewire\WithFileUploads;
use App\Models\ProduitPhoto;
use App\Models\Produit;
use Livewire\Component;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;


class ListeProduits extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $produit_id;
    public $nom;
    public $nomTranche;
    public $minPoids;
    public $maxPoids;
    public $type;
    public $famille;
    public $code_comptable;
    public $code_analytique;
    public $photo_principale;
    public $photo_principalea;
    public $unite;
    public $list_familles = [];
    public $list_cuisine = [];
    public $list_modes_vente = [];
    public $list_unite = [];
    public $list_nettoyage = [];
    public $mode_vente;
    public $mode_cuisine = [];
    public $mode_nettoyage = [];
    public $tranches=[];
    public $list_tranches = [];
    public $active ;
    public $photos =[] ;
    public $photosa =[];
    public $_photos=[];

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved', 'imagesUpload' => 'handleimgupload',
    'produitname' => 'produitSetName', 'getproduitphoto' => 'getproduitphoto'];
    public $iteme = [];
    public $showPoids = false;
    public $showKgPiece = false;
    /************************************************* */
    public function handleimgupload($imagesuploaded)
    {
        $this->_photos = $imagesuploaded;
    }
    public function debug(){
            dd($this->_photos);
    }


    public function renderData()
    {
       // $this->list_categories = Categorie::all()->sortBy('nom');
        $modea = ModePreparation::find(1);
        $this->list_cuisine = $modea->preparations;
        $modeb = ModePreparation::find(2);
        $this->list_nettoyage = $modeb->preparations;
        $this->list_modes_vente = ModeVente::all()->sortBy('nom');
        $this->list_unite = Unite::all()->sortBy('nom');
        $this->list_familles = Famille::all()->sortBy('nom');
        //$this->mode_vente  == 1 ?  $this->list_tranches = Tranche::where('type',"Poids par pièce")->get() :  $this->list_tranches = Tranche::where('type',"Kg/Pièce")->get();
       /*  $p = Produit::where('id',1)->first(); */
       $this->mode_vente == 1 ? $this->list_tranches = Tranche::where('mode_vente_id',1)->get() :  $this->list_tranches = Tranche::where('mode_vente_id','!=',1)->get();
        // dd($p->preparations->first()->preparation->nom);

    }

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }
    public function createTranches()
    {
        //dd('ttt');
        $uniqueId = str_replace(".","",microtime(true)).rand(000,999);

        $this->type == 1 ? $this->nomTranche =  $this->minPoids." - ".$this->maxPoids : $this->nomTranche;
        Tranche::create([
            'nom' => $this->nomTranche,
            'mode_vente_id'=> $this->mode_vente_id,
            'min_poids' => $this->minPoids,
            'max_poids' => $this->maxPoids,
            'uid' => $this->mode_vente_id == 1 ? "PP".$uniqueId : "KP".$uniqueId,
        ]);
        $this->mode_vente == 1 ? $this->list_tranches = Tranche::where('mode_vente_id',1)->get() :  $this->list_tranches = Tranche::where('mode_vente_id','!=',1)->get();
        $this->reset(['nomTranche','minPoids','maxPoids']);

    }

    public function updatedModeVente($value){

       if($value == 1) {
           $this->showPoids = true;
           $this->showKgPiece = false;
           //dd($this->minPoids );
       }else{
           $this->showKgPiece = true;
           $this->showPoids = false;
           //dd($this->showKgPiece );
       }
    }

    public function edit($id){

        $item = Produit::where('id',$id)->firstOrFail();
        $this->produit_id = $item->id;
        $this->nom = $item->nom;
        $this->famille = $item->famille_id;
        $this->code_comptable = $item->code_comptable ;
        $this->code_analytique = $item->code_analytique ;
        $this->unite = $item->unite_id;
        $this->mode_vente = $item->mode_vente_id ;
        $this->active = $item->active ;
        //$this->mode_cuisine = $item->mode_cuisine_id ;

        $this->photo_principalea = $item->photo_principale;

        if($this->mode_vente == 1) {
            $this->showPoids = true;
            $this->showKgPiece = false;
            //dd($this->minPoids );
        }else{
            $this->showKgPiece = true;
            $this->showPoids = false;
            //dd($this->showKgPiece );
        }

        //$this->mode_nettoyage = $item->mode_nettoyage_id ;
        //dd($this->photo_principale);

        $item = ProduitTranche::where('produit_id', $id)->get();
        foreach ($item as $key => $value) {
            $this->tranches[ $key] = $value->tranche_id ;
        }

        $itemb = PreparationType::where('produit_id', $id)->get();
        foreach ($itemb as $key => $value) {
            $this->mode_cuisine[ $key] = $value->preparation_id ;
            $this->mode_nettoyage[ $key] = $value->preparation_id ;

        }

        $this->iteme = ProduitPhoto::where('produit_id',$id)->get();
        foreach ($this->iteme as $key => $value) {
            $this->photosa[$key]= Storage::url($value->photo) ;
        }


        // dd($this->photos[$key]);

    }

    public function editProduit(){
        DB::transaction(function () {

            if ( $this->photo_principale != null) {
                    $photo_principale = $this->photo_principale->storeAs('public/produits/' . $this->nom . '/principale', date("Y-m-d") . "-" . $this->nom . "." . $this->photo_principale->guessExtension());

                    Produit::where('id', $this->produit_id)
                        ->update([
                            'nom' => $this->nom,
                            'famille_id' => $this->famille,
                            'code_comptable' => $this->code_comptable,
                            'code_analytique' => $this->code_analytique,
                            'photo_principale' => $photo_principale,
                            'unite_id' => $this->unite,
                            'mode_vente_id' => $this->mode_vente,
                            'active' => $this->active,

                    ]);
                    //dd($this->tranches);
                    foreach ($this->tranches as $key => $value) {
                        ProduitTranche::where('produit_id', $this->produit_id)
                        ->delete();
                        ProduitTranche::create([
                            'produit_id' => $this->produit_id,
                            'tranche_id' => $this->tranches[$key],
                        ]);

                    }

                    $paths = [];
                    foreach ($this->photos as $key => $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $filename  = "photo-$key-" . time() . '.' . $extension;
                        $paths[$key] = $photo->storeAs("public/produits/$this->nom/photos", $filename);
                    }
                    foreach ($paths as $key => $value) {
                        ProduitPhoto::where('produit_id', $this->produit_id)
                        ->update([
                            'photo' => $paths[$key],
                        ]);
                    }
            }else{
                    Produit::where('id', $this->produit_id)
                    ->update([
                        'nom' => $this->nom,
                        'famille_id' => $this->famille,
                        'code_comptable' => $this->code_comptable,
                        'code_analytique' => $this->code_analytique,
                        //'photo_principale' => $photo_principale,
                        'unite_id' => $this->unite,
                        'mode_vente_id' => $this->mode_vente,
                        'active' => $this->active,
                    ]);
                    //dd($this->tranches);
                    foreach ($this->tranches as $key => $value) {

                        ProduitTranche::where('produit_id', $this->produit_id)
                        ->delete();
                        ProduitTranche::create([
                            'produit_id' => $this->produit_id,
                            'tranche_id' => $this->tranches[$key],
                        ]);

                    }

                 /*
                    foreach ($this->tranches as $key => $value) {
                        ProduitTranche::where('produit_id', $this->produit_id)
                        ->update([
                            'tranche_id' => $this->tranches[$key],
                        ]);
                    } */

                    $paths = [];
                    foreach ($this->photos as $key => $photo) {
                        $extension = $photo->getClientOriginalExtension();
                        $filename  = "photo-$key-" . time() . '.' . $extension;
                        $paths[$key] = $photo->storeAs("public/produits/$this->nom/photos", $filename);
                    }
                    foreach ($paths as $key => $value) {
                        ProduitPhoto::where('produit_id', $this->produit_id)
                        ->update([
                            'photo' => $paths[$key],
                        ]);
                }

            }

            /* foreach ($this->tranches as $key => $value) {
                ProduitTranche::where('produit_id', $this->produit_id)
                ->update([
                    'tranche_id' => $this->tranches[$key],
                ]);
            } */
        });

        session()->flash('message', 'Unité "'.$this->nom.'" à été modifiée');
    }

    public function deleteProduit($id)
    {

        $item = Produit::findOrFail($id);
        $item->delete();
        session()->flash('message', 'Produit "'.$item->nom.'" à été supprimé');

        return redirect()->to('/produits');

    }


    public function render()
    {

        $items = Produit::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        foreach ($items as &$item) {
            $item['photo_url'] = Storage::url($item->photo_principale);
        }

        $this->renderData();
        return view('livewire.parametrage.liste-produits',[
            'items' => $items
        ]);
    }
        /****************************************************************************************************************** */
        /*****************declaration***---------------------------------- */
        public $photos_names = [];
        public $produit_name;
        public $names = [];
        public $nameProduit;
        public $photoslist = [];
        public   $produit_tmp;
        public $item;
        public $produitId;
        public $listProduitPhotos = array(
            array()
        );
        public $photoOfOneProduit=[];

        /***************************save methode----------------------------- */
        public function remove($i)
        {
            unset($this->_photos[$i]);
        }

        public function deleteImgByurl($index1, $index2)
    {
       /* $url = $this->listProduitPhotos[$index2][$index1];
        Storage::disk('public')->delete($url);
        ProduitPhoto::select()
            ->where('photo', $url)
            ->delete();
        unset($this->listProduitPhotos[$index2][$index1]);*/
    }

    public function deleteImgProduitByurl($index1)

    {

        $url = $this->photoOfOneProduit[$index1];
        Storage::disk('public')->delete($url);
        ProduitPhoto::select()
            ->where('photo', $url)
            ->delete();
        unset($this->listProduitPhotos[$index1]);
    }
    public function saveImgsBd($produit, $img, $i)
    {
        Storage::disk('public')->put('image' . time() . $i . $produit['nom'] . '.png', $img);
        ProduitPhoto::create([
            'produit_id' => $produit['id'],
            'photo' => 'image' . time() . $i . $produit['nom'] . '.png'
        ]);
        dump($i);
    }
   /* public function setIdProduit($id)
    {
        $this->produit_id = $id;
        dd($this->item);
    }*/

    public function storegeImages($produitName)
    {

        foreach ($this->_photos as $i => $photo) {
            // dd($this->names[$i]);
        /*    $produit = Produit::select()
                ->where('id', $this->produit_id)
                ->get();*/
            // if(!file_exists('/public/photos/'.$produit[0]->nom.'/')){
            //     dd(mkdir('/public/photos/'.$produit[0]->nom.'/',0777,true));
            //   }
            dump($produitName['nom']);
            $img = Image::make($photo['_result'])->encode('png');
            $this->saveImgsBd($produitName, $img, $i);
        }
    }

    public function saveImages($produitName)
    {
        $this->storegeImages($produitName);
    }
    public function listOfProduit()
    {
        return Produit::all();
    }
    public function listOfPhotosOfProduit($id)
    {
        $photos_list_fetch = [];
        $photo_list =  ProduitPhoto::select()
            ->where('produit_id', $id)
            ->get('photo');
        foreach ($photo_list as $tmphoto) {
            // dump($tmphoto->photo);
            //  $tmphoto=Storage::url($tmphoto->photo);
            array_push($photos_list_fetch, $tmphoto->photo);
        }
        return $photos_list_fetch;
    }
    public function getfromStorege()
    {
        $listphoto = [];
        foreach ($this->listProduitPhotos as $produitphoto) {
            foreach ($produitphoto as $photo) {
                //  $tmpphoto=  Storage::url($photo);
                /* $tmpphoto= Storage::get($photo[0]);
            $tmpphoto=Image::make($tmpphoto)->encode('png');
            */
                array_push($listphoto, $photo);
                //  dd($tmpphoto);

            }
            array_push($this->listProduitPhoto_ph, $listphoto);
            $listphoto = [];
        }
    }

    public function getproduitphoto()
    {
        //emm array pour collecter la photo principale et lesautre photo
        $listphoto = [];
        //la list de tout les produit
        $list_produits = $this->listOfProduit();
        //list vide pour les autre photo
        $list_photo_par_produit = [];
        foreach ($list_produits as $produit) {
            //dabord add la photo principale to the list photo
            array_push($listphoto, $produit->photo_principale);
            //get les autre photo de  produit
            $list_photo_par_produit = $this->listOfPhotosOfProduit($produit->id);

            $listphoto = array_merge($listphoto, $list_photo_par_produit);
            //im just get photos of 1 prodduit;
            //donc i need to push it in main list of produit_photo
            array_push($this->listProduitPhotos, $listphoto);
            //dd($this->listProduitPhotos);
            $listphoto = [];
        }
        //  $this->getfromStorege();
    }

    public function getPhotoOfProduit($id){
      //  $this->photoOfOneProduit = [];
        $this->photoOfOneProduit = ProduitPhoto::select('photo')->where('produit_id',$id)->get();

    }
        /****************************************************************************************************************** */

    public function saved()
    {
        $this->render();
    }


}
