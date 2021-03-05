<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OurMVCFramework;

use OurMVCFramework\Exception\RouteNotFoundException;

/**
 * Description of Application
 *
 * @author renan
 */
class Application
{

    public static function run($config)
    {
        try {
            View\Template::setBasePath($config['view_path']);

            $config['dbconnection'] = function () use ($config) {
                return Db\Connection::get(
                        $config['db']['host'],
                        $config['db']['db'],
                        $config['db']['user'],
                        $config['db']['pass'],
                        $config['db']['charset'],
                );
            };

            $request = HTTP\Request::createFromGlobals();

            $router = new Router\Router();

            $response = $router->getHandler($request, $config)();

            switch (get_class($response)) {
                case HTTP\HTMLResponse::class:
                    View\Template::view($response->template, array_merge(['config' => $config], $response->data));
                    break;
                case HTTP\RedirectResponse::class:
                    header("Location: {$response->to}");
                    http_response_code(302);
                    break;
                default:
                    throw new Exception("Invalid response");
            }
        } catch (RouteNotFoundException $ex) {
            http_response_code(404);
            View\Template::view('error/404.phtml');
        } catch (\Exception $ex) {
            http_response_code(500);
            View\Template::view('error/index.phtml', [
                'reason' => $ex->getMessage()
            ]);
        }
    }

}
