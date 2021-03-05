<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Repository;

/**
 * Description of PostsRepository
 *
 * @author renan
 */
class PostsRepository implements PostsRepositoryInterface
{

    private \OurMVCFramework\Db\Connection $connection;

    public function __construct(array $config)
    {
        $this->connection = $config['dbconnection']();
    }

    public function getPost(string $id)
    {
        $post = $this->connection->query("select post.id, post.title, post.text, post.pictureurl, post.created_at, post.author_id, user.username as author_username, count(comment.id) as comments_count from post left join user on post.author_id = user.id left join comment on comment.post_id = post.id where post.id = ?", [$id]);
        
        return \Application\Model\Post::fromData($post);
    }

    public function getPosts(int $limit, int $offset)
    {
        $posts = $this->connection->queryAll("select post.id, post.title, post.text, post.pictureurl, post.created_at, post.author_id, user.username as author_username, count(comment.id) as comments_count from post left join user on post.author_id = user.id left join comment on comment.post_id = post.id group by post.id order by post.created_at desc limit {$limit} offset {$offset}");

        return array_map(function ($post) {
            return \Application\Model\Post::fromData($post);
        }, $posts);
    }

    public function getPostsCount()
    {

        $result = array_values($this->connection->query('select count(*) from post'));
        return (int) $result[0];
    }
    
    public function getAuthors()
    {
        return $this->connection->queryAll('select user.username from post left join user on user.id = post.author_id group by user.id');
    }

}
