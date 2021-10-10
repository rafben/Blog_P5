<?php

namespace Framework;

use App\Controllers\Controller;

class Application
{

    public static function process()
    {
        $request_uri = $_SERVER['REQUEST_URI'];
        $request_uri_without_base_url = strtolower(str_replace(['index.php', URL], '', $_SERVER['REQUEST_URI'])) ;
        $request = explode( '/', trim( $request_uri_without_base_url, '/' ) );

        if ($request[0] !== "upload") {
            $controllerName = (isset($request[0]) && !empty($request[0])) ? $request[0] : "Home";
            $methodeName = (isset($request[1]) && !empty($request[1])) ? $request[1] : "index";

            unset($request[0], $request[1]);
            $params = array_values($request);
            $controllerName = "\\App\\Controllers\\" . $controllerName;
            
            if(!class_exists($controllerName)){
                $controllerName = "\\App\\Controllers\\Home";
                $methodeName = "page_404";
            }
            
            $controller = new $controllerName();
            $controller->{$methodeName}(...$params);
        } else {
            // Store the file name into variable
            $filename = URL . "/upload/CV_RafikBengrid.pdf";
            echo '<script>window.location.href = "' . $filename . '";</script>';
        }
    }
}
