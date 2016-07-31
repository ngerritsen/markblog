<?php
namespace Markblog\Infrastructure\Repository;

use Markblog\Domain\Contract\PostRepositoryInterface;
use Markblog\Domain\Entity\Post;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var \PDO
     */
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function get(int $id)
    {
        $rows = $this->db->prepare('SELECT * FROM posts WHERE id=:id');
        $rows->execute([ 'id' => $id ]);
        $post = $rows->fetch();

        return Post::create($post);
    }

    public function getAll()
    {
        $posts = [];
        $rows = $this->db->prepare('SELECT * FROM posts');
        $rows->execute();

        foreach ($rows->fetchAll() as $post) {
            $posts[] = Post::create($post);
        }

        return $posts;
    }

    public function add(string $title, string $content = null)
    {
        $rows = $this->db->prepare('INSERT INTO posts (title, content) VALUES (:title, :content)');
        $result = $rows->execute(['title' => $title, 'content' => $content]);

        return $result;
    }
}
