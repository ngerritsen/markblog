<?php
use Markblog\Infrastructure\Controller\AdminController;
use PHPUnit\Framework\TestCase;
use Slim\Http\Response;

class AdminControllerTest extends TestCase
{
    private $postRepository;
    private $adminView;
    private $request;
    private $response;

    /**
     * @var AdminController
     */
    private $adminController;

    public function setUp()
    {
        $this->adminView = Phake::mock('Markblog\Presentation\View\AdminView');
        $this->postRepository = Phake::mock('Markblog\Domain\Contract\PostRepositoryInterface');
        $this->request = Phake::mock('Slim\Http\Request');
        $this->response = new Response();

        $this->adminController = new AdminController($this->adminView, $this->postRepository);
    }

    public function testGet()
    {
        Phake::when($this->adminView)->render([])->thenReturn('TestHtml');

        $result = $this->adminController->get($this->request, $this->response, []);

        $this->assertEquals($result->getBody(), 'TestHtml');
    }

    public function testPost()
    {
        Phake::when($this->request)->getParams()->thenReturn(['title' => 'Test title', 'content' => 'Test content']);
        Phake::when($this->postRepository)->add('Test title', 'Test content')->thenReturn(true);

        $result = $this->adminController->post($this->request, $this->response, []);

        $this->assertEquals($result->getBody(), 'Success!');
    }
}
