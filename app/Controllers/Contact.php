<?php

namespace App\Controllers;

use Framework\Renderer;


class Register extends Controller
{

    protected $modelName = \App\Models\Register::class;

    public function contact(){

        // Vérification pour les champs vides
        
        if(empty($_POST['name'])       ||
            empty($_POST['email'])     ||
            empty($_POST['objet'])     ||
            empty($_POST['message'])   ||
            !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        {
            echo "Veuillez remplir tous les champs.";
        
            return $this->index();
        }
        
            $name = strip_tags(htmlspecialchars($_POST['name']));
            $email_address = strip_tags(htmlspecialchars($_POST['email']));
            $phone = strip_tags(htmlspecialchars($_POST['objet']));
            $message = strip_tags(htmlspecialchars($_POST['message']));
        
            // Créé l'email et l'envoie
            $to = 'rbengrid@hotmail.com';
            $email_subject = "Contact du Blog:  $name";
            $email_body = "Vous avez reçu un nouveau message du Blog.\n\n"."Voici les details:\n\nNom: $name\n\nEmail: $email_address\n\nNumero de téléphone: $phone\n\nMessage:\n$message";
            $headers = "De: noreply@devsblog.com\n";
            $headers .= "Répondre au: $email_address";
            mail($to,$email_subject,$email_body,$headers);
            return $this->index();
        
        
            }
        
        }
    
