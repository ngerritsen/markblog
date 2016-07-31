<?php
namespace Markblog\Infrastructure\Controller;

use Markblog\Domain\Contract\PostRepositoryInterface;
use Markblog\Presentation\Component\AdminComponent;
use Slim\Http\Request;
use Slim\Http\Response;

class AdminController
{
    /**
     * @var AdminComponent
     */
    private $adminComponent;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(AdminComponent $adminComponent, PostRepositoryInterface $postRepository)
    {
        $this->adminComponent = $adminComponent;
        $this->postRepository = $postRepository;
    }

    public function get(Request $request, Response $response, array $args = [])
    {
        $html = $this->adminComponent->render($args);
        $response->getBody()->write($html);

        return $response;
    }
}
