<?php

$app->get('/', 'Markblog\Infrastructure\Controller\PostController:getAll');
$app->get('/post/{id}', 'Markblog\Infrastructure\Controller\PostController:get');
$app->get('/admin', 'Markblog\Infrastructure\Controller\AdminController:get');
$app->post('/post', 'Markblog\Infrastructure\Controller\AdminController:post');
