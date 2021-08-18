<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SlimLib
{
    public static function createHtmlResponse(string|stringabel $content) : Psr\Http\Message\ResponseInterface
    {
        $response = new \Slim\Psr7\Response(200);
        $response->getBody()->write((string)$content);
        return $response;
    }
}
