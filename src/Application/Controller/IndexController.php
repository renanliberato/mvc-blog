<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

use Application\Repository\PostsRepository;
use Application\Repository\PostsRepositoryInterface;
use Application\Repository\CommentsRepository;
use Application\Repository\CommentsRepositoryInterface;
use Application\Services\AuthService;

/**
 * Description of IndexController
 *
 * @author renan
 */
class IndexController
{

    const POSTS_PER_PAGE = 3;

    private CommentsRepositoryInterface $commentsRepository;
    private PostsRepositoryInterface $postsRepository;
    private AuthService $authService;

    public function __construct(CommentsRepositoryInterface $commentsRepository, PostsRepositoryInterface $postsRepository, AuthService $authService)
    {
        $this->commentsRepository = $commentsRepository;
        $this->postsRepository = $postsRepository;
        $this->authService = $authService;
    }

    public function indexAction(\OurMVCFramework\HTTP\Request $request)
    {
        $page = (int) ($request->params['page'] ?? 1);

        $postsCount = $this->postsRepository->getPostsCount();
        $pages = floor($postsCount / self::POSTS_PER_PAGE) + 1;

        return new \OurMVCFramework\HTTP\HTMLResponse('index/index.phtml', [
            'posts' => $this->postsRepository->getPosts(self::POSTS_PER_PAGE, ($page - 1) * 3),
            'page' => $page,
            'pages' => $pages
        ]);
    }

    public function detailAction(\OurMVCFramework\HTTP\Request $request)
    {
        $postId = $request->params['post'] ?? null;

        if (!$postId) {
            return new \OurMVCFramework\HTTP\RedirectResponse('/');
        }

        return new \OurMVCFramework\HTTP\HTMLResponse('index/detail.phtml', [
            'post' => $this->postsRepository->getPost($postId),
            'comments' => $this->commentsRepository->getCommentsFromPost($postId),
            'comment_required_fields_error' => false,
            'commentData' => [
                    'postId' => null,
                    'name' => null,
                    'email' => null,
                    'website' => null,
                    'text' => null
                ]
        ]);
    }
    
    
    // @TODO implement frontend template.
    public function imprintAction(\OurMVCFramework\HTTP\Request $request)
    {
        $authors = $this->postsRepository->getAuthors();
        
        return new \OurMVCFramework\HTTP\HTMLResponse('index/imprint.phtml', [
            'authors' => $authors
        ]);
    }

    public function commentAction(\OurMVCFramework\HTTP\Request $request)
    {
        $postId = $request->params['post'] ?? null;

        if (!$postId) {
            return new \OurMVCFramework\HTTP\RedirectResponse('/');
        }

        $postUrl = "/index/detail?post={$postId}";

        if ($request->method !== \OurMVCFramework\HTTP\RequestMethod::POST) {
            return new \OurMVCFramework\HTTP\RedirectResponse($postUrl);
        }

        $name = $request->data['name'] ?? "";
        $email = $request->data['email'] ?? "";
        $website = $request->data['website'] ?? "";
        $text = $request->data['comment'] ?? "";

        try {
            $comment = \Application\Model\Comment::new($postId, $name, $email, $website, $text);

            $this->commentsRepository->saveComment($comment);
        } catch (\Application\Exception\RequiredFieldsException $ex) {
            return new \OurMVCFramework\HTTP\HTMLResponse('index/detail.phtml', [
                'post' => $this->postsRepository->getPost($postId),
                'comments' => $this->commentsRepository->getCommentsFromPost($postId),
                'comment_required_fields_error' => true,
                'commentData' => [
                    'postId' => $postId,
                    'name' => $name,
                    'email' => $email,
                    'website' => $website,
                    'text' => $text
                ]
            ]);
        }

        return new \OurMVCFramework\HTTP\RedirectResponse($postUrl);
    }

    public function uncommentAction(\OurMVCFramework\HTTP\Request $request)
    {
        $commentId = $request->params['comment'] ?? null;
        $postId = $request->params['post'] ?? null;

        if (!$commentId || !$postId) {
            return new \OurMVCFramework\HTTP\RedirectResponse('/');
        }

        $postUrl = "/index/detail?post={$postId}";

        if ($request->method !== \OurMVCFramework\HTTP\RequestMethod::POST) {
            return new \OurMVCFramework\HTTP\RedirectResponse($postUrl);
        }

        if (!$this->authService->isLoggedIn()) {
            return new \OurMVCFramework\HTTP\RedirectResponse($postUrl);
        }

        $this->commentsRepository->deleteComment($commentId);

        return new \OurMVCFramework\HTTP\RedirectResponse($postUrl);
    }

}
