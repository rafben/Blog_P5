<?php

namespace App\Controllers;

use Framework\Http;
use Framework\Renderer;



class Admin extends Controller
{

    protected $modelName = \App\Models\Admin::class;

    public function checkAdmin()
    {
        // Autorisations globales pour l'admin seulement
        if (!$_SESSION['connected'] || $_SESSION['connected'] !== 'yes' || $_SESSION['niveau'] != 1) {
            Http::redirect( URL );
        }
    }


    public function index($msg = "")
    {
        $this->checkAdmin();

        $pageTitle = "espace admin";
        $users = $this->model->findAll();

        Renderer::twig('admin/index', [
            "pageTitle" => $pageTitle,
            "URL" => URL,
            'session' => $_SESSION,
            "msg" => $msg,
            "users" => $users,
        ]);
    }

    // PAGES
    public function users($msg = "")
    {
        $this->checkAdmin();

        $pageTitle = "espace admin - gestion des utilisateurs";
        $users = $this->model->findAll();

        Renderer::twig('admin/users', [
            "pageTitle" => $pageTitle,
            "URL" => URL,
            'session' => $_SESSION,
            "msg" => $msg,
            "users" => $users,
        ]);
    }

    public function comments($msg = "")
    {
        $this->checkAdmin();

        $pageTitle = "espace admin - gestion des commentaires";

        $this->model->table = "comments";
        $comments = $this->model->findAll();

        Renderer::twig('admin/comments', [
            "pageTitle" => $pageTitle,
            "URL" => URL,
            'session' => $_SESSION,
            "msg" => $msg,
            "comments" => $comments,
        ]);
    }

    // ACTIONS
    public function actionUser($id = PARAMS[0], $action = PARAMS[1], $role = PARAMS[2])
    {
        // Vérification des droits admin
        $this->checkAdmin();

        // Params récupèrés depuis l'URL
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $action = filter_var($action, FILTER_SANITIZE_STRING);

        if ($role && $action == "role") {
            // Appel de la methode editRoleUser du Model
            $this->model->editRoleUser($id, $role);
        } else {
            // Appel de la methode actionUser du Model
            $this->model->actionUser($id, $action);
        }

        // Redirection vers la liste des users
        Http::redirect(URL . '/admin/users');
    }

     // ACTIONS
     public function actionComments($id = PARAMS[0], $action = PARAMS[1])
     {
         // Vérification des droits admin
         $this->checkAdmin();
 
         // Params récupèrés depuis l'URL
         $id = filter_var($id, FILTER_VALIDATE_INT);
         $action = filter_var($action, FILTER_SANITIZE_STRING);
 
         // Appel de la methode actionUser du Model
         $this->model->actionComments($id, $action);
 
         // Redirection vers la liste des users
         Http::redirect(URL . '/admin/comments');
     }

    

}
