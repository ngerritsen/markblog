<?php
namespace Markblog\Infrastructure\Controller;

use Markblog\Presentation\Component\IndexComponent;
use Markblog\Presentation\Component\PostComponent;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PostController
{
    /**
     * @var IndexComponent
     */
    private $indexComponent;

    /**
     * @var PostComponent
     */
    private $postComponent;

    public function __construct(IndexComponent $indexComponent, PostComponent $postComponent)
    {
        $this->postComponent = $postComponent;
        $this->indexComponent = $indexComponent;
    }

    public function getAll(RequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $html = $this->indexComponent->render($args);
        $response->getBody()->write($html);

        return $response;
    }

    public function get(RequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $html = $this->postComponent->render($args);
        $response->getBody()->write($html);

        return $response;
    }

    public function post(Request $request, Response $response, array $args = [])
    {
        $form = $request->getParams();

        $this->postRepository->add($form['title'], $form['content']);

        return $response->withRedirect('/');
    }
}
