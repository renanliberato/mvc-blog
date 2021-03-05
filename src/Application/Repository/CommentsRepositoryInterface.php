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
interface CommentsRepositoryInterface
{
    function getCommentsFromPost(string $postId);
    function deleteComment(string $commentId);
    function saveComment(\Application\Model\Comment $comment);
}
