<?php
namespace Markblog\Presentation\Contract;

interface View
{
    /**
     * @param array $args
     * @return string
     */
    public function render(array $args);
}
