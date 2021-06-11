<?php

namespace App\Controllers;

use Framework\Http;
use Framework\Renderer;


class Register extends Controller
{

    protected $modelName = \App\Models\Register::class;




    public function index($msg = "")
    {

        $pageTitle = "register";


        Renderer::twig('register/index', [
            "pageTitle" => $pageTitle,
            "URL" => URL,
            "msg" => $msg


        ]);
    }

    public function register()
    {

        $input_params = [
            'nom' =>[
                'filter' => FILTER_SANITIZE_STRING,
            ],
            'prenom' =>[
                'filter' => FILTER_SANITIZE_STRING,
            ],
            'email' => [
                'filter'  => FILTER_VALIDATE_EMAIL,
            ],
            'password' => [
                'filter'  => FILTER_SANITIZE_STRING
            ],
        ];
        
        

        $inputs = (object)filter_input_array(INPUT_POST, $input_params);
        $pass_hache = password_hash($inputs->password, PASSWORD_DEFAULT, ['COST' => 10]);
        

        if ($this->model->register($inputs->nom, $inputs->prenom, $inputs->email, $pass_hache)) {
            
            Http::redirect( URL . "/article" );

        } else {
            $this->index("merci de réessayer");
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

        Http::redirect( URL );
    }

    
}
