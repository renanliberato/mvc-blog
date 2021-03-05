<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Services;

use Application\Repository\UsersRepository;
use Application\Repository\UsersRepositoryInterface;

/**
 * Description of AuthService
 *
 * @author renan
 */
class AuthService implements AuthServiceInterface
{
    const SESSION_KEY = 'userid';
    private UsersRepositoryInterface $usersRepository;
    
    public function __construct(array $config)
    {
        $this->usersRepository = new UsersRepository($config);
    }

    public function login(string $username, string $password)
    {
        $userId = $this->usersRepository->authenticate($username, $password);
        $_SESSION[self::SESSION_KEY] = $userId;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION[self::SESSION_KEY]);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }

}
