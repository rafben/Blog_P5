<?php

namespace App\Controllers;

use Framework\Renderer;


class Home extends Controller
{

    protected $modelName = null;

    public function index()
    {
        $pageTitle = "Accueil";

        Renderer::twig('home/index', [
            "pageTitle" => $pageTitle,
            "URL" => URL,
            'session' => $_SESSION

        ]);
    }
}
