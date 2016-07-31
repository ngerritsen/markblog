<?php

use Markblog\Presentation\Component\IndexComponent;
use PHPUnit\Framework\TestCase;

class IndexComponentTest extends TestCase
{
    public function testIndexComponentRender()
    {
        $twigMock = Phake::mock('Twig_Environment');
        $postRepositoryMock = Phake::mock('Markblog\Domain\Contract\PostRepositoryInterface');
        $indexComponent = new IndexComponent($twigMock, $postRepositoryMock);
        $fakePosts = [];

        Phake::when($postRepositoryMock)->getAll()->thenReturn($fakePosts);
        Phake::when($twigMock)->render('index.html', ['posts' => $fakePosts])->thenReturn('TestHtml');

        $result = $indexComponent->render([]);

        $this->assertEquals($result, 'TestHtml');
    }
}
