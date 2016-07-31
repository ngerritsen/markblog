<?php
namespace Markblog\Presentation\Contract;

interface Component
{
    /**
     * @param array $args
     * @return string
     */
    public function render(array $args);
}
