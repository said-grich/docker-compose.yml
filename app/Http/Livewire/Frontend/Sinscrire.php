<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Client;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Livewire\Component;

class Sinscrire extends Component{
    public $form = [
        'name' => '',
        'email' => '',
        'tel' => '',
        'password' => '',
        'agree' => '',
    ];

    protected $rules = [
        'form.name' => 'required|min:6',
        'form.email' => 'required|email',
        'form.tel' => 'required',
        'form.agree' => 'required',
    ];

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
        $mail->AddAddress($this->form['email'], $this->form['name']);
        $mail->SetFrom("contact@flouka.ma", "Flouka");
        $mail->AddReplyTo("contact@flouka.ma", "Flouka");
        $mail->AddCC("contact@flouka.ma", "Flouka");
        $mail->Subject = "Account Verification in Flouka";
        $content = view('tpl')->with([
            'name' => $this->form['name'],
            'password' => $this->form['password'],
        ]);

        $mail->MsgHTML($content);
        if(!$mail->Send()){
            // dd($mail->ErrorInfo);
            var_dump($mail);
        }else{
            return redirect(route('connexion'));
        }
    }

    public function submit(){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $this->form['password'] = substr(str_shuffle($chars),0,10);

        $this->validate();
        $this->createClient();
    }

    public function createClient(){
        $checkEmail = Client::select()->where('email', $this->form['email'])->get();
        $checkTel = Client::select()->where('tel', $this->form['tel'])->get();

        if(count($checkEmail) === 0 && count($checkTel) === 0){
            $item = new Client();
            $item->nom = $this->form['name'];
            $item->tel = $this->form['tel'];
            $item->email = $this->form['email'];
            $item->password = sha1($this->form['password']);
            $item->profil_client_id = 1;
            $item->save();

            session()->flash('success-message', 'Votre compte a été créé avec succès');
            $this->sendPassword();
        }elseif(count($checkEmail) > 0){
            session()->flash('warning-message', 'Existe déjà un compte possède cette adresse e-mail');
        }elseif(count($checkTel) > 0){
            session()->flash('warning-message', 'Existe déjà un compte possède ce numéro de téléphone');
        }
    }

    public function render(){
        return view('livewire.frontend.sinscrire')->layout('layouts.frontend.app');
    }
}
