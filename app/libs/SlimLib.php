<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SlimLib
{
    public static function createHtmlResponse(string|Stringable $content) : Psr\Http\Message\ResponseInterface
    {
        $response = new \Slim\Psr7\Response(200);
        $response->getBody()->write((string)$content);
        return $response;
    }


    public static function createXmlResponse(string | Stringable $content) : Psr\Http\Message\ResponseInterface
    {
        $response = new \Slim\Psr7\Response(200);
        $response->getBody()->write((string)$content);
        $response = $response->withHeader("Content-Type", "text/xml");
        return $response;
    }
}
