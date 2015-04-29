<?php
/**
 * Created by PhpStorm.
 * User: Taf
 * Date: 29/04/2015
 * Time: 19:50
 */
namespace Taf\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Hello
{
    protected $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig =$twig;
    }

    public function helloWorldAction()
    {
       return new Response("hello world !!");
    }

    public function titi() {
    }

    public function nameAction(Request $request)
    {
        $name = $request->get("name");
        return new Response(
            $this->render('index.html.twig', array(
                'name' => $name
            ))
        );
    }

    protected function render($template, $variables)
    {
        $template =$this->twig->loadTemplate($template);

        return $template->render($variables);
    }
}