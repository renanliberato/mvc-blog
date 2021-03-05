<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Model;

/**
 * Description of Post
 *
 * @author renan
 */
class Post
{

    public string $id;
    public string $title;
    public string $pictureUrl;
    public string $text;
    public string $createdAt;
    public string $authorId;
    public string $authorUsername;
    public string $commentsCount;

    public static function fromData(array $postData) : Post
    {
        $post = new self();
        $post->id = $postData['id'];
        $post->title = $postData['title'];
        $post->text = $postData['text'];
        $post->pictureUrl = $postData['pictureurl'];
        $post->createdAt = $postData['created_at'];
        $post->authorId = $postData['author_id'];
        $post->authorUsername = $postData['author_username'];
        $post->commentsCount = (int) $postData['comments_count'];

        return $post;
    }

}
