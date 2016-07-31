<?php
namespace Markblog\Presentation\View;

use Markblog\Domain\Contract\PostRepositoryInterface;
use Markblog\Presentation\Contract\View;
use Twig_Environment;

class IndexView implements View
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(Twig_Environment $twig, PostRepositoryInterface $postRepository)
    {
        $this->twig = $twig;
        $this->postRepository = $postRepository;
    }

    public function render(array $args)
    {
        $posts = $this->postRepository->getAll();
        $html = $this->twig->render('index.html', ['posts' => $posts]);

        return $html;
    }
}
