<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Repository;

/**
 *
 * @author renan
 */
interface PostsRepositoryInterface
{
    function getPost(string $id);

    function getPosts(int $limit, int $offset);

    function getPostsCount();
    
    function getAuthors();
}
