<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Repository;

/**
 * Description of CommentsRepository
 *
 * @author renan
 */
class CommentsRepository implements CommentsRepositoryInterface
{

    private \OurMVCFramework\Db\Connection $connection;

    public function __construct(array $config)
    {
        $this->connection = $config['dbconnection']();
    }

    
    public function getCommentsFromPost(string $postId)
    {
        $comments = $this->connection->queryAll("select * from comment where post_id = ? order by created_at desc", [$postId]);

        return array_map(function ($comment) {
            return \Application\Model\Comment::fromData($comment);
        }, $comments);
    }
    
    public function deleteComment(string $commentId) {
        $this->connection->execute('delete from comment where id = ?', [$commentId]);
    }
    
    public function saveComment(\Application\Model\Comment $comment) {
        $this->connection->execute('insert into comment values (?,?,?,?,?,CURRENT_TIME(),?)', [
            $comment->id,
            $comment->name,
            $comment->email,
            $comment->website,
            $comment->comment,
            $comment->postId
        ]);
    }
}
