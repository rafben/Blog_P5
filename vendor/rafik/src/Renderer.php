<?php

namespace Framework;

class Renderer
{

    public static function twig(string $path, array $variables = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/Templates');
        $twig = new \Twig\Environment($loader, [
            // 'cache' => 'app/cache/twig',
        ]);

        echo $twig->render($path . '.html.twig', $variables);
    }
}
