<?php
namespace Markblog\Domain\Entity;

class Post
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $parsedContent;

    public function __construct(int $id, string $title, string $content = null)
    {
        $this->title = $title;
        $this->id = $id;
        $this->content = $content;
    }

    public static function create(array $data)
    {
        return new self($data['id'], $data['title'], $data['content']);
    }

    public function getTitle() {
        return $this->title;
    }

    public function getId() {
        return $this->id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getParsedContent() {
        return $this->parsedContent;
    }

    public function setParsedContent(string $parsedContent) {
        return $this->parsedContent = $parsedContent;
    }
}
