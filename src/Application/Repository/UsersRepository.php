<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Repository;

/**
 * Description of UsersRepository
 *
 * @author renan
 */
class UsersRepository implements UsersRepositoryInterface
{

    private \OurMVCFramework\Db\Connection $connection;

    public function __construct(array $config)
    {
        $this->connection = $config['dbconnection']();
    }

    public function authenticate(string $username, string $password): ?string
    {
        $user = $this->connection->query('select * from user where username = ?', [$username]);
        
        if (!$user || !password_verify($password, $user['password'])) {
            throw new \Application\Exception\AuthenticationException();
        }
        
        return $user['id'];
    }

}
