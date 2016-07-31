<?php
use Markblog\Infrastructure\Controller\PostController;
use PHPUnit\Framework\TestCase;
use Slim\Http\Response;

class PostControllerTest extends TestCase
{
    private $indexView;
    private $postView;
    private $request;
    private $response;

    /**
     * @var PostController
     */
    private $postController;

    public function setUp()
    {
        $this->indexView = Phake::mock('Markblog\Presentation\View\IndexView');
        $this->postView = Phake::mock('Markblog\Presentation\View\PostView');
        $this->request = Phake::mock('Psr\Http\Message\RequestInterface');
        $this->response = new Response();

        $this->postController = new PostController($this->indexView, $this->postView);
    }

    public function testGetAll()
    {
        $testArgs = ['id' => 1];

        Phake::when($this->indexView)->render($testArgs)->thenReturn('IndexTestHtml');

        $result = $this->postController->getAll($this->request, $this->response, $testArgs);

        $this->assertEquals($result->getBody(), 'IndexTestHtml');
    }

    public function testGet()
    {
        Phake::when($this->postView)->render([])->thenReturn('PostTestHtml');

        $result = $this->postController->get($this->request, $this->response, []);

        $this->assertEquals($result->getBody(), 'PostTestHtml');
    }
}
