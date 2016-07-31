<?php
namespace Markblog\Infrastructure\Controller;

use Markblog\Domain\Contract\PostRepositoryInterface;
use Markblog\Presentation\View\AdminView;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;

class AdminController
{
    /**
     * @var AdminView
     */
    private $adminView;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(AdminView $adminView, PostRepositoryInterface $postRepository)
    {
        $this->adminView = $adminView;
        $this->postRepository = $postRepository;
    }

    public function get(RequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $html = $this->adminView->render($args);
        $response->getBody()->write($html);

        return $response;
    }

    public function post(Request $request, ResponseInterface $response, array $args = [])
    {
        $form = $request->getParams();

        $result = $this->postRepository->add($form['title'], $form['content']);

        if ($result === true) {
            $response->getBody()->write('Success!');
        }

        return $response;
    }
}
