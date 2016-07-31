<?php
namespace Markblog\Presentation\View;

use Markblog\Presentation\Contract\View;
use Twig_Environment;

class AdminView implements View
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(array $args)
    {
        return $this->twig->render('admin.html');
    }
}
