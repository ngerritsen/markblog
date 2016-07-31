<?php

use Markblog\Presentation\View\IndexView;
use PHPUnit\Framework\TestCase;

class IndexViewTest extends TestCase
{
    public function testIndexViewRender()
    {
        $twigMock = Phake::mock('Twig_Environment');
        $postRepositoryMock = Phake::mock('Markblog\Domain\Contract\PostRepositoryInterface');
        $indexView = new IndexView($twigMock, $postRepositoryMock);
        $fakePosts = [];

        Phake::when($postRepositoryMock)->getAll()->thenReturn($fakePosts);
        Phake::when($twigMock)->render('index.html', ['posts' => $fakePosts])->thenReturn('TestHtml');

        $result = $indexView->render([]);

        $this->assertEquals($result, 'TestHtml');
    }
}
