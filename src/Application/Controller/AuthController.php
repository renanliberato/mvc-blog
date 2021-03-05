<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

use Application\Services\AuthService;
use Application\Services\AuthServiceInterface;

/**
 * Description of AuthController
 *
 * @author renan
 */
class AuthController
{

    private AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function indexAction(\OurMVCFramework\HTTP\Request $request)
    {
        if ($this->authService->isLoggedIn()) {
            return new \OurMVCFramework\HTTP\RedirectResponse('/');
        }
        
        return new \OurMVCFramework\HTTP\HTMLResponse('auth/index.phtml', [
            'login_error' => false
        ]);
    }

    public function loginAction(\OurMVCFramework\HTTP\Request $request)
    {
        if ($request->method !== \OurMVCFramework\HTTP\RequestMethod::POST) {
            return new \OurMVCFramework\HTTP\RedirectResponse('/auth/index');
        }

        if ($this->authService->isLoggedIn()) {
            return new \OurMVCFramework\HTTP\RedirectResponse('/');
        }

        try {
            $this->authService->login($request->data['username'], $request->data['password']);

            return new \OurMVCFramework\HTTP\RedirectResponse('/');
        } catch (\Application\Exception\AuthenticationException $ex) {
            return new \OurMVCFramework\HTTP\HTMLResponse('auth/index.phtml', [
                'login_error' => true
            ]);
        }
    }

    public function logoutAction(\OurMVCFramework\HTTP\Request $request)
    {
        $this->authService->logout();

        return new \OurMVCFramework\HTTP\RedirectResponse('/');
    }

}
