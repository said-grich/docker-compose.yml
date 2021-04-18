<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\User;
use App\Models\ProfilClient;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Livewire\Component;

class Clients extends Component
{
    public $profile_name;
    public $name;
    public $tel;
    public $email;
    public $password;
    public $profile_client;
    public $list_profils;

    protected $listeners = ['profilAdded' => 'renderProfilesClients'];

    public function sendPassword(){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "erp2am@gmail.com";
        $mail->Password   = "erp2am@21";

        $mail->IsHTML(true);
        $mail->AddAddress($this->email, $this->name);
        $mail->SetFrom("contact@flouka.ma", "Flouka");
        $mail->AddReplyTo("contact@flouka.ma", "Flouka");
        $mail->AddCC("contact@flouka.ma", "Flouka");
        $mail->Subject = "Account Verification in Flouka";
        $content = view('tpl')->with([
            'name' => $this->name,
            'password' => $this->password,
        ]);

        $mail->MsgHTML($content);
        if(!$mail->Send()){
            // dd($mail->ErrorInfo);
            var_dump($mail);
        }else{
            // return redirect(route('connexion'));
        }
    }

    public function renderProfilesClients()
    {
        $this->list_profils = ProfilClient::all()->sortBy('id');
    }

    public function createProfileClient()
    {
        $this->validate([
            'profile_name' => 'required',
        ]);

        $item = new ProfilClient();
        $item->nom = $this->profile_name;
        $item->save();

        session()->flash('message', 'Profile "'.$this->profile_name. '" a été crée ');
        $this->reset(['profile_name']);

        $this->emit('saved');
    }

    public function createClient()
    {
        $this->validate([
            'name' => 'required',
            'tel' => 'required',
            'email' => 'required|email',
            'profile_client' => 'required',
        ]);

        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $this->password = substr(str_shuffle($chars),0,10);

        $checkEmail = User::select()->where('email', $this->email)->get();
        $checkTel = User::select()->where('tel', $this->tel)->get();

        if(count($checkEmail) === 0 && count($checkTel) === 0){
            $item = new User();
            $item->name = $this->name;
            $item->tel = $this->tel;
            $item->email = $this->email;
            $item->password = bcrypt($this->password);
            $item->profil_client_id = 1;
            $item->type = 'client';
            $item->save();

            $profile = ProfilClient::findOrFail($this->profile_client);
            session()->flash('message', 'Client "' . $this->name . '" a été crée comme étant un client ' . $profile->nom);
            $this->reset(['name','tel','email','profile_client']);

            $this->emit('saved');

            
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "erp2am@gmail.com";
        $mail->Password   = "erp2am@21";

        $mail->IsHTML(true);
        $mail->AddAddress($this->email, $this->name);
        $mail->SetFrom("contact@flouka.ma", "Flouka");
        $mail->AddReplyTo("contact@flouka.ma", "Flouka");
        $mail->AddCC("contact@flouka.ma", "Flouka");
        $mail->Subject = "Account Verification in Flouka";
        $content = view('tpl')->with([
            'name' => $this->name,
            'password' => $this->password,
        ]);

        $mail->MsgHTML($content);
        if(!$mail->Send()){
            // dd($mail->ErrorInfo);
            var_dump($mail);
        }else{
            // return redirect(route('connexion'));
        }
        }elseif(count($checkEmail) > 0){
            session()->flash('warning-message', 'Existe déjà un compte possède cette adresse e-mail');
        }elseif(count($checkTel) > 0){
            session()->flash('warning-message', 'Existe déjà un compte possède ce numéro de téléphone');
        }
    }

    public function render()
    {
        $this->renderProfilesClients();
        return view('livewire.parametrage.clients');
    }
}
