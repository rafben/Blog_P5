<?php

namespace Framework;

use App\Controllers\Controller;

class Application
{

    public static function process()
    {
      /*  $controllerName = "Home";
        $task = "index";

        if(!empty($_GET['controller'])){
            $controllerName = ucfirst($_GET['controller']);
        }
        if(!empty($_GET['task'])){
            $task = ucfirst($_GET['task']);
        }
    */
       /*$controllerName = "\\App\\Controllers\\" . $controllerName;
        
        $controller = new $controllerName();
        $controller->$task();*/
        
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
        
        if($request[0] !== "upload"){
        
            $request[0] = $request[0] ?: 'Home';
            $request[1] = $request[1] ?? 'index';

            define('CONTROLLER', $request[0]);
            define('TASK', $request[1]);
            define('CURRENT_URL', '/' . CONTROLLER . '/' . TASK);
            
            unset($request[0], $request[1]);
            define('PARAMS', array_values($request));

            $controllerName = "\\App\\Controllers\\" . CONTROLLER;
            
            $controller = new $controllerName();
            $controller->{TASK}(...PARAMS);
        } else {
           // Store the file name into variable
           $filename = "http://localhost/cours-php-poo-corrigee/upload/CV_RafikBengrid.pdf";

           // Header content type
           //header("Content-type: application/pdf");
           //header("Content-Disposition: inline; filename=CV_RafikBengrid.pdf");
           
           // Send the file to the browser.
           //readfile($filename);

           echo '<script>window.location.href = "'.$filename.'";</script>';
        }
    }
}
