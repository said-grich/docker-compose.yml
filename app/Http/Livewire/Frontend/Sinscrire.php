<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Client;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Livewire\Component;

// require '../vendor/autoload.php';

class Sinscrire extends Component{
    public $form = [
        'name' => '',
        'email' => '',
        'tel' => '',
        'password' => '',
        // 'password_confirm' => '',
        'agree' => '',
    ];

    protected $rules = [
        'form.name' => 'required|min:6',
        'form.email' => 'required|email',
        'form.tel' => 'required',
        // 'form.password' => 'required|confirmed',
        // 'form.password_confirm' => 'required',
        'form.agree' => 'required',
    ];

    // public function rand_pass($length){
    //     $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    //     return substr(str_shuffle($chars),0,$length);
    // }

    public function submit(){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $this->form['password'] = substr(str_shuffle($chars),0,10);

        $this->validate();

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = SMTP::DEBUG_SERVER;
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
            $this->createClient();
        }
    }

    public function createClient()
    {
        $item = new Client();
        $item->nom = $this->form['name'];
        $item->tel = $this->form['tel'];
        $item->email = $this->form['email'];
        $item->password = bcrypt($this->form['password']);
        $item->profil_client_id = 1;
        $item->save();

        // session()->flash('message', 'Client "' . $this->client_name . '" a été crée comme étant un client ' . $profil->nom);

        $this->emit('saved');
    }

    public function render(){
        return view('livewire.frontend.sinscrire')->layout('layouts.frontend.app');
    }
}
