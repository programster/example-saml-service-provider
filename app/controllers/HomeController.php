<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HomeController extends AbstractSlimController
{

    public static function registerRoutes($app)
    {
        $app->get('/', function (Psr\Http\Message\ServerRequestInterface $request, Psr\Http\Message\ResponseInterface $response) {
            $body = new ViewHomePage(SiteSpecific::isLoggedIn());
            $page = new ViewHtmlTemplate($body);
            return SlimLib::createHtmlResponse($page);
        });
    }
}

