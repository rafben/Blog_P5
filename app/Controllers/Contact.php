<?php

namespace App\Controllers;

use Framework\Renderer;


class Contact extends Controller
{

    // protected $modelName = \App\Models\Register::class;

    public function index($msg = "")
    {

        $pageTitle = "connexion";


        Renderer::twig('home/index', [
            "pageTitle" => $pageTitle,
            "URL" => URL,
            "msg" => $msg


        ]);
    }

    public function envoi()
    {

        // Vérification pour les champs vides

        if (
            empty($_POST['name']) ||
            empty($_POST['email']) ||
            empty($_POST['objet']) ||
            empty($_POST['message']) ||
            !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
        ) {

            return $this->index("Veuillez remplir tous les champs.");
        } else {
            $name = strip_tags(htmlspecialchars($_POST['name']));
            $email_address = strip_tags(htmlspecialchars($_POST['email']));
            $objet = strip_tags(htmlspecialchars($_POST['objet']));
            $message = strip_tags(htmlspecialchars($_POST['message']));

            // Créé l'email et l'envoi
            $to = 'rbengrid@hotmail.com';
            $email_subject = "Contact du Blog:  $name";
            $email_body = "Vous avez reçu un nouveau message du Blog.\n\n" . "Voici les details:\n\nNom: $name\n\nEmail: $email_address\n\nNumero de téléphone: $objet\n\nMessage:\n$message";
            $headers = "De: noreply@devsblog.com\n";
            $headers .= "Répondre au: $email_address";

            if (mail($to, $email_subject, $email_body, $headers)) {

                return $this->index(" Votre mail a été envoyé avec succés, nous vous répondrons dans les meilleurs délais");
            } else {

                return  $this->index("Erreur d'envoi, merci de réessayer");
            }
        }
        //Http::redirect( URL ."/article");


    }
}
