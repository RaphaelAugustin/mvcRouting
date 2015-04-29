<?php
/**
 * Created by PhpStorm.
 * User: Taf
 * Date: 29/04/2015
 * Time: 23:36
 */

namespace Taf\Controllers;


use Symfony\Component\HttpFoundation\Response;

class Error {

    public function toto() {
        return new Response("pouet ça marche pas !", 418);
    }
    public function error404Action() {
        return new Response("Cette page n'existe pas !", 404);
    }
}