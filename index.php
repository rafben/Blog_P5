<?php


//Affiche la page d'accueil

session_start();
session_regenerate_id();

require __DIR__ . '/vendor/autoload.php';

define("URL", "/Blog_P5");

Framework\Application::process();



