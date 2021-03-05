<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Model;

/**
 * Description of User
 *
 * @author renan
 */
class User
{

    public string $id;
    public string $username;
    public string $password;
    public \DateTime $createdAt;

}
