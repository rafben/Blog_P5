<?php

namespace App\Controllers;

use Framework\Renderer;


class Register extends Controller
{

    protected $modelName = \App\Models\Register::class;

        public function contact(){

            $input_params = [
                'nom' =>[
                    'filter' => FILTER_SANITIZE_STRING,
                ],
                'email' =>[
                    'filter' => FILTER_VALIDATE_EMAIL
                ],
                'object' => [
                    'filter' => FILTER_SANITIZE_STRING,

                ],
                'message' => [
                    'filter'  => FILTER_SANITIZE_STRING
                ],
                 ];

                 $inputs = (object)filter_input_array(INPUT_POST, $input_params);

                if ($this->model->connect($inputs->nom, $inputs->email, $inputs->object, $inputs->message)) {
                    header('Location: ' . URL . '/Article');
                } else {
                    $this->index("Veuillez remplir tous les champs,  merci de réessayer");
                }
            


                 /*   // Vérification pour les champs vides
                    
                    if(empty($_POST['name'])      ||
                        empty($_POST['email'])     ||
                        empty($_POST['object'])     ||
                        empty($_POST['message'])   ||
                        !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
                    {
                        echo "Veuillez remplir tous les champs.";
                    
                        return $this->index();
                    }*/
                    
                        $name = strip_tags(htmlspecialchars($_POST['name']));
                        $email = strip_tags(htmlspecialchars($_POST['email']));
                        $object = strip_tags(htmlspecialchars($_POST['object']));
                        $message = strip_tags(htmlspecialchars($_POST['message']));
                    
                        // Créé l'email et l'envoie
                        $to = 'rbengrid23@hotmail.com';
                        $to = 'rbengrid23@hotmail.com';
                        $to = 'rbengrid23@hotmail.com';


                        $email_subject = "Contact du Blog:  $name";
                        $email_body = "Vous avez reçu un nouveau message du Blog";
                        $headers = "De: noreply@devsblog.com\n";
                        $headers .= "Répondre au: $email";
                        mail($to,$email_subject,$email_body,$headers);
                        return $this->index();
                    
                    
                        }

}
    
