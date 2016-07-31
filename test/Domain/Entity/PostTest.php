<?php
use Markblog\Domain\Entity\Post;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function testPostConstructs()
    {
        $post = new Post(2, 'Test title', 'Test content');

        $this->assertEquals($post->getId(), 2);
        $this->assertEquals($post->getTitle(), 'Test title');
        $this->assertEquals($post->getContent(), 'Test content');
    }

    public function testPostCreates()
    {
        $testData = [ 'id' => 2, 'title' => 'Test title', 'content' => 'Test content'];
        $post = Post::create($testData);

        $this->assertEquals($post->getId(), 2);
        $this->assertEquals($post->getTitle(), 'Test title');
        $this->assertEquals($post->getContent(), 'Test content');
    }

    public function testPostCreatesWithoutContent()
    {
        $testData = [ 'id' => 2, 'title' => 'Test title', 'content' => null];
        $post = Post::create($testData);

        $this->assertEquals($post->getId(), 2);
        $this->assertEquals($post->getTitle(), 'Test title');
        $this->assertEquals($post->getContent(), null);
    }

    public function testPostSetsParsedContent()
    {
        $post = new Post(2, 'Test title', 'Test content');

        $post->setParsedContent('Parsed content');

        $this->assertEquals($post->getParsedContent(), 'Parsed content');
    }
}
