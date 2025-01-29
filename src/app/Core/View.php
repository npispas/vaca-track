<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class View
 *
 * Handles rendering views using Twig.
 */
class View
{
    /**
     * Render a Twig template.
     *
     * @param string $template The name of the template file (without extension)
     * @param array $data Associative array of data to pass to the template
     * @return void Rendered template content
     */
    public static function render(string $template, array $data = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $twig = new Environment($loader);

        echo $twig->render("$template.twig", $data);
    }
}
