<?php

namespace App\Controllers;

use Framework\Renderer;


class Cv extends Controller
{

    protected $modelName = null;

    public function index()
    {
        $pageTitle = "cv";

        Renderer::twig('home/cv', [
            "pageTitle" => $pageTitle,
            "URL" => URL,
            'session' => $_SESSION

        ]);
    }
}
