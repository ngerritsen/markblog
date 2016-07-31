<?php
namespace Markblog\Infrastructure\Controller;

use Markblog\Presentation\View\IndexView;
use Markblog\Presentation\View\PostView;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PostController
{
    /**
     * @var IndexView
     */
    private $indexView;

    /**
     * @var PostView
     */
    private $postView;

    public function __construct(IndexView $indexView, PostView $postView)
    {
        $this->postView = $postView;
        $this->indexView = $indexView;
    }

    public function getAll(RequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $html = $this->indexView->render($args);
        $response->getBody()->write($html);

        return $response;
    }

    public function get(RequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $html = $this->postView->render($args);
        $response->getBody()->write($html);

        return $response;
    }
}
