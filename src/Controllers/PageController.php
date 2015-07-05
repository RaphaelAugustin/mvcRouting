<?php
/**
 * Created by PhpStorm.
 * User: TaF
 * Date: 21/05/2015
 * Time: 12:47
 */

namespace Taf\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController {

    protected $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig =$twig;
    }

    public function getHome()
    {
        return new Response(
            $this->render('index.html.twig', array())
        );
    }

    protected function render($template, $variables)
    {
        $template =$this->twig->loadTemplate($template);

        return $template->render($variables);
    }
}