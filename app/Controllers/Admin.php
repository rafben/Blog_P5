<?php

namespace App\Controllers;

use Framework\Http;
use Framework\Renderer;






class Admin extends Controller
{

    protected $modelName = \App\Models\Admin::class;


    public function index($msg = "")
    {

        $pageTitle = "espace admin";
        $users = $this->model->findAll();

        


        Renderer::twig('admin/index', [
            "pageTitle" => $pageTitle,
            "URL" => URL,
            "msg" => $msg,
            "users" => $users,




        ]);
    }

    public function activateUser($id = PARAMS[0])

    {
       $id = filter_var($id, FILTER_VALIDATE_INT);

            

        var_dump('activateUser=' . $id);

    
    }
    
    public function desactivateUser($id = PARAMS[0])

    {
       $id = filter_var($id, FILTER_VALIDATE_INT);

            

        var_dump('desactivateUser=' . $id);

    
    }

    public function supprimerUser($id = PARAMS[0])

    {
       $id = filter_var($id, FILTER_VALIDATE_INT);

            

        var_dump('supprimerUser=' . $id);

    
    }




}