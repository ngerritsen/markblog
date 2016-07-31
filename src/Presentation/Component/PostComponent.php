<?php
namespace Markblog\Presentation\Component;

use Markblog\Domain\Contract\PostRepositoryInterface;
use Markblog\Domain\Entity\Post;
use Markblog\Presentation\Contract\Component;
use Parsedown;
use Twig_Environment;

class PostComponent implements Component
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var Parsedown
     */
    private $parseDown;

    public function __construct(Twig_Environment $twig, PostRepositoryInterface $postRepository, Parsedown $parseDown)
    {
        $this->twig = $twig;
        $this->postRepository = $postRepository;
        $this->parseDown = $parseDown;
    }

    public function render(array $args)
    {
        $post = $this->postRepository->get($args['id']);
        $parsedPost = $this->parsePost($post);
        $html = $this->twig->render('post.html', ['post' => $parsedPost]);

        return $html;
    }

    private function parsePost(Post $post)
    {
        $content = $post->getContent();
        $parsedContent = $this->parseDown->text($content);
        $post->setParsedContent($parsedContent);

        return $post;
    }
}
