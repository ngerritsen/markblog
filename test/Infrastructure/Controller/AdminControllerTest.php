<?php
use Markblog\Infrastructure\Controller\AdminController;
use PHPUnit\Framework\TestCase;
use Slim\Http\Response;

class AdminControllerTest extends TestCase
{
    private $postRepository;
    private $adminComponent;
    private $request;
    private $response;

    /**
     * @var AdminController
     */
    private $adminController;

    public function setUp()
    {
        $this->adminComponent = Phake::mock('Markblog\Presentation\Component\AdminComponent');
        $this->postRepository = Phake::mock('Markblog\Domain\Contract\PostRepositoryInterface');
        $this->request = Phake::mock('Slim\Http\Request');
        $this->response = new Response();

        $this->adminController = new AdminController($this->adminComponent, $this->postRepository);
    }

    public function testGet()
    {
        Phake::when($this->adminComponent)->render([])->thenReturn('TestHtml');

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
