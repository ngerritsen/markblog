<?php
namespace Markblog\Presentation\Component;

use Markblog\Presentation\Contract\Component;
use Twig_Environment;

class AdminComponent implements Component
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
