<?php

namespace App\Controllers;

use Framework\Http;
use Framework\Renderer;



class Signin extends Controller
{

    protected $modelName = \App\Models\Signin::class;


    public function index($msg = "")
    {
        $pageTitle = "connexion";


        Renderer::twig('signin/index', [
            "pageTitle" => $pageTitle,
            "URL" => URL,
            "msg" => $msg


        ]);
    }

    public function connect()
    {

        $input_params = [
            'email' => [
                'filter'  => FILTER_VALIDATE_EMAIL,
            ],
            'pwd' => [
                'filter'  => FILTER_SANITIZE_STRING
            ],
        ];

        $inputs = (object)filter_input_array(INPUT_POST, $input_params);

        $user = $this->model->connect($inputs->email);

        if ($user) {

            if (password_verify($inputs->pwd, $user->pwd)) {

                // construction de session utilisateur 

                $_SESSION['connected'] = 'yes';
                $_SESSION['user_id'] = $user->id;
                $_SESSION['first_name'] = $user->first_name;
                $_SESSION['last_name'] = $user->last_name;
                $_SESSION['niveau'] = $user->niveau;

                //redirection  
                if ($user->niveau == 1) {

                    Http::redirect(URL . "/admin");
                } else {

                    Http::redirect(URL . "/article");
                }
            } else {

                $this->index("Erreur de connexion, merci de réessayer");
            }
        } else {
            $this->index("Erreur de connexion, merci de réessayer");
        }
    }

    public function disconnect()
    {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            $destroyed = session_destroy();
        }

        session_destroy();

        Http::redirect(URL);
    }
}
