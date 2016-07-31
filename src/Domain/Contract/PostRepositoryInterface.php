<?php
namespace Markblog\Domain\Contract;

use Markblog\Domain\Entity\Post;

interface PostRepositoryInterface
{
    /**
     * @param int $id
     * @return Post
     */
    public function get(int $id);

    /**
     * @return array
     */
    public function getAll();

    /**
     * @param string $title
     * @param string $content
     * @return bool
     */
    public function add(string $title, string $content = null);
}
