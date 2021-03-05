<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

/**
 * Description of IndexControllerFactory
 *
 * @author renan
 */
class IndexControllerFactory
{
    public function __invoke($config)
    {
        $commentsRepository = new \Application\Repository\CommentsRepository($config);
        $postsRepository = new \Application\Repository\PostsRepository($config);
        $authService = new \Application\Services\AuthService($config);
        return new IndexController($commentsRepository, $postsRepository, $authService);
    }
}
