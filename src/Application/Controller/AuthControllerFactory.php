<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

/**
 * Description of AuthControllerFactory
 *
 * @author renan
 */
class AuthControllerFactory
{
    public function __invoke($config)
    {
        $authService = new \Application\Services\AuthService($config);
        return new AuthController($authService);
    }
}
