<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Model;

/**
 * Description of Comment
 *
 * @author renan
 */
class Comment
{

    public string $id;
    public string $name;
    public string $email;
    public string $website;
    public string $comment;
    public string $createdAt;
    public string $postId;

    public static function new(string $postId, string $name, string $email, string $website, string $text)
    {
        if (!$postId) {
            throw new \Exception("post id is required");
        }
        
        if ($name == '' || $text == '') {
            throw new \Application\Exception\RequiredFieldsException();
        }
        
        $comment = new Comment();
        $comment->id = uniqid();
        $comment->name = $name;
        $comment->email = $email;
        $comment->website = $website;
        $comment->comment = $text;
        $comment->postId = $postId;
        
        return $comment;
    }

    public static function fromData(array $commentData): Comment
    {
        $comment = new self();
        $comment->id = $commentData['id'];
        $comment->name = $commentData['name'];
        $comment->email = $commentData['email'];
        $comment->website = $commentData['website'];
        $comment->comment = $commentData['comment'];
        $comment->createdAt = $commentData['created_at'];
        $comment->postId = $commentData['post_id'];

        return $comment;
    }

}
