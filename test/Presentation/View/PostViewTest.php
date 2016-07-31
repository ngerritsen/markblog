<?php

use Markblog\Domain\Entity\Post;
use Markblog\Presentation\View\PostView;
use PHPUnit\Framework\TestCase;

class PostViewTest extends TestCase
{
    public function testPostViewRender()
    {
        $parsedownMock = Phake::mock('Parsedown');
        $twigMock = Phake::mock('Twig_Environment');
        $postRepositoryMock = Phake::mock('Markblog\Domain\Contract\PostRepositoryInterface');

        $postView = new PostView($twigMock, $postRepositoryMock, $parsedownMock);

        $fakePost = new Post(1, 'Test', 'Fake content');
        $fakePostParsed = new Post(1, 'Test', 'Fake content');
        $fakePostParsed->setParsedContent('Fake parsed content');

        Phake::when($postRepositoryMock)->get(1)->thenReturn($fakePost);
        Phake::when($parsedownMock)->text('Fake content')->thenReturn('Fake parsed content');
        Phake::when($twigMock)->render('post.html', ['post' => $fakePostParsed])->thenReturn('TestHtml');

        $result = $postView->render(['id' => 1]);

        $this->assertEquals($result, 'TestHtml');
    }
}
