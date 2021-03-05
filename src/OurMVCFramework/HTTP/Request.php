<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OurMVCFramework\HTTP;

/**
 * Description of Request
 *
 * @author renan
 */
class Request
{

    public string $url;
    public string $method;
    public array $params;
    public array $data;

    public function __construct($url, $method, $params, $data)
    {
        $this->url = $url;
        $this->method = $method;
        $this->params = $params;
        $this->data = $data;
    }

    public static function createFromGlobals()
    {
        $params = [];
        if (isset($_SERVER['QUERY_STRING']))
            parse_str($_SERVER['QUERY_STRING'], $params);

        $request = new Request(
                parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH),
                $_SERVER['REQUEST_METHOD'],
                $params,
                $_POST
        );


        return $request;
    }

}
