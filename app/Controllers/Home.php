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
    public function cv()
    {
        $pageTitle = "cv";

        Renderer::twig('home/cv', [
            "pageTitle" => $pageTitle,
            "URL" => URL,
            'session' => $_SESSION

        ]);
    }

    public function page_404() {
        Renderer::twig('home/404', [
            "pageTitle" => "Page 404",
            "URL" => URL,
            'session' => $_SESSION

        ]);
    }
}
