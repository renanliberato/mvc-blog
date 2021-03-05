<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OurMVCFramework\Router;

use OurMVCFramework\Exception\RouteNotFoundException;

/**
 * Description of Router
 *
 * @author renan
 */
class Router
{

    public function getHandler(\OurMVCFramework\HTTP\Request $request, array $config)
    {
        $fromRoutesHandler = $this->getFromRoutes($request, $config);

        if ($fromRoutesHandler !== null) {
            return $fromRoutesHandler;
        }

        $fromMappingHandler = $this->getFromControllerMapping($request, $config);

        if ($fromMappingHandler !== null) {
            return $fromMappingHandler;
        }

        throw new RouteNotFoundException();
    }

    public function getFromRoutes(\OurMVCFramework\HTTP\Request $request, array $config)
    {
        if (!isset($config['routes'][$request->url])) {
            return null;
        }

        $routeDefinition = $config['routes'][$request->url];

        $controller = null;
        if (isset($config['controllers_factories'][$routeDefinition['controller']])) {
            $controller = (new $config['controllers_factories'][$routeDefinition['controller']])($config);
        } else {
            $controller = new $routeDefinition['controller']($config);
        }

        return function() use ($controller, $routeDefinition, $request) {
            return call_user_func([$controller, $routeDefinition['action'] . 'Action'], $request);
        };
    }

    public function getFromControllerMapping(\OurMVCFramework\HTTP\Request $request, array $config)
    {
        $controllersMapping = array_reduce($config['controllers'], function($res, $controller) {
            $exploded = explode('\\', $controller);
            $key = strtolower(str_replace('Controller', '', $exploded[count($exploded) - 1]));
            $reflection = new \ReflectionClass($controller);

            $publicMethods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
            $actionMethods = array_filter($publicMethods, function ($method) {
                return strpos($method->name, 'Action') !== false;
            });

            $res[$key] = [
                'class' => $controller,
                'actions' => array_reduce($actionMethods, function($actionsRes, $method) {
                    $actionsRes[strtolower(str_replace('Action', '', $method->name))] = $method->name;

                    return $actionsRes;
                }, [])
            ];

            return $res;
        }, []);

        $explodedUrl = explode('/', $request->url);

        if (count($explodedUrl) != 3) {
            throw new \Exception('invalid url');
        }

        $controllerKey = $explodedUrl[1];
        $actionKey = $explodedUrl[2];

        if (!isset($controllersMapping[$controllerKey]) || !isset($controllersMapping[$controllerKey]['actions'][$actionKey])) {
            throw new RouteNotFoundException();
        }

        $controller = null;
        if (isset($config['controllers_factories'][$controllersMapping[$controllerKey]['class']])) {
            $controller = (new $config['controllers_factories'][$controllersMapping[$controllerKey]['class']])($config);
        } else {
            $controller = new $controllersMapping[$controllerKey]['class']($config);
        }

        $action = $controllersMapping[$controllerKey]['actions'][$actionKey];

        return function() use ($controller, $action, $request) {
            return call_user_func([$controller, $action], $request);
        };
    }

}
