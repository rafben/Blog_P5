<?php

namespace App\Controllers;

abstract class Controller
{
    
    protected $model;
    protected $modelName;

    public function __construct()
    {
        if ($this->modelName) {

            $this->model = new $this->modelName();    

        }
    }
}