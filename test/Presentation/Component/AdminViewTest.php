<?php

use Markblog\Presentation\Component\AdminComponent;
use PHPUnit\Framework\TestCase;

class AdminComponentTest extends TestCase
{
    public function testAdminComponentRender()
    {
        $twigMock = Phake::mock('Twig_Environment');
        $adminComponent = new AdminComponent($twigMock);

        Phake::when($twigMock)->render('admin.html')->thenReturn('TestHtml');

        $result = $adminComponent->render([]);

        $this->assertEquals($result, 'TestHtml');
    }
}
