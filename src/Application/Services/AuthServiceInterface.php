<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Services;

/**
 *
 * @author renan
 */
interface AuthServiceInterface
{
    function login(string $username, string $password);

    function isLoggedIn();

    function logout();
}
