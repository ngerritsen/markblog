<?php

use Markblog\Presentation\View\AdminView;
use PHPUnit\Framework\TestCase;

class AdminViewTest extends TestCase
{
    public function testAdminViewRender()
    {
        $twigMock = Phake::mock('Twig_Environment');
        $adminView = new AdminView($twigMock);

        Phake::when($twigMock)->render('admin.html')->thenReturn('TestHtml');

        $result = $adminView->render([]);

        $this->assertEquals($result, 'TestHtml');
    }
}
