<?php

use Markblog\Domain\Contract\PostRepositoryInterface;
use Markblog\Infrastructure\Repository\PostRepository;
use PHPUnit\Framework\TestCase;

class PostRepositoryTest extends TestCase
{
    private $dbMock;
    private $pdoStatementMock;
    private $fakePostData1;
    private $fakePostData2;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function setUp()
    {
        $this->dbMock = Phake::mock('PDO');
        $this->pdoStatementMock = Phake::mock('PDOStatement');

        $this->postRepository = new PostRepository($this->dbMock);

        $this->fakePostData1 = ['id' => 1, 'title' => 'Post1', 'content' => null];
        $this->fakePostData2 = ['id' => 2, 'title' => 'Post2', 'content' => 'test'];
    }

    public function testGet()
    {
        Phake::when($this->dbMock)
            ->prepare('SELECT * FROM posts WHERE id=:id')
            ->thenReturn($this->pdoStatementMock);

        Phake::when($this->pdoStatementMock)->fetch()->thenReturn($this->fakePostData1);

        $result = $this->postRepository->get(1);

        $this->assertEquals($result->getTitle(), 'Post1');
    }

    public function testGetAll()
    {
        Phake::when($this->dbMock)
            ->prepare('SELECT * FROM posts')
            ->thenReturn($this->pdoStatementMock);

        Phake::when($this->pdoStatementMock)->fetchAll()->thenReturn([
            $this->fakePostData1,
            $this->fakePostData2
        ]);

        $result = $this->postRepository->getAll();

        $this->assertEquals($result[0]->getTitle(), 'Post1');
        $this->assertEquals($result[1]->getTitle(), 'Post2');
    }

    public function testAdd()
    {
        Phake::when($this->dbMock)
            ->prepare('INSERT INTO posts (title, content) VALUES (:title, :content)')
            ->thenReturn($this->pdoStatementMock);

        Phake::when($this->pdoStatementMock)
            ->execute(['title' => 'Test title', 'content' => 'Test content'])
            ->thenReturn(true);

        $result = $this->postRepository->add('Test title', 'Test content');

        $this->assertEquals($result, true);
    }
}
