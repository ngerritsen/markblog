<?php
use Markblog\Infrastructure\Controller\PostController;
use PHPUnit\Framework\TestCase;
use Slim\Http\Response;

class PostControllerTest extends TestCase
{
    private $indexComponent;
    private $postComponent;
    private $request;
    private $response;

    /**
     * @var PostController
     */
    private $postController;

    public function setUp()
    {
        $this->indexComponent = Phake::mock('Markblog\Presentation\Component\IndexComponent');
        $this->postComponent = Phake::mock('Markblog\Presentation\Component\PostComponent');
        $this->request = Phake::mock('Psr\Http\Message\RequestInterface');
        $this->response = new Response();

        $this->postController = new PostController($this->indexComponent, $this->postComponent);
    }

    public function testGetAll()
    {
        $testArgs = ['id' => 1];

        Phake::when($this->indexComponent)->render($testArgs)->thenReturn('IndexTestHtml');

        $result = $this->postController->getAll($this->request, $this->response, $testArgs);

        $this->assertEquals($result->getBody(), 'IndexTestHtml');
    }

    public function testGet()
    {
        Phake::when($this->postComponent)->render([])->thenReturn('PostTestHtml');

        $result = $this->postController->get($this->request, $this->response, []);

        $this->assertEquals($result->getBody(), 'PostTestHtml');
    }
}
