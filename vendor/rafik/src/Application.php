<?php

namespace Framework;

use App\Controllers\Controller;

class Application
{

    public static function process()
    {


        define('URL', '/cours-php-poo-corrigee');

        $request = explode(
            '/',
            trim(
                str_replace(
                    ['index.php', URL],
                    '',
                    strtolower($_SERVER['REQUEST_URI'])
                ),
                '/'
            )
        );

        if ($request[0] !== "upload") {

            $request[0] = $request[0] ?: 'Home';
            $request[1] = $request[1] ?? 'index';

            define('CONTROLLER', $request[0]);
            define('TASK', $request[1]);
            define('CURRENT_URL', '/' . CONTROLLER . '/' . TASK);

            unset($request[0], $request[1]);
            define('PARAMS', array_values($request));

            $controllerName = "\\App\\Controllers\\" . CONTROLLER;
            
            if(class_exists($controllerName)){
                $controller = new $controllerName();
                $controller->{TASK}(...PARAMS);
            }
            else{
                $controllerName = "\\App\\Controllers\\Home";
                $controller = new $controllerName();
                $controller->page_404();
            }
          
        } else {
            // Store the file name into variable
            $filename = "http://localhost/cours-php-poo-corrigee/upload/CV_RafikBengrid.pdf";



            echo '<script>window.location.href = "' . $filename . '";</script>';
        }
    }
}
