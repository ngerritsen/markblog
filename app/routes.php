<?php

$app->get('/', 'Markblog\Infrastructure\Controller\PostController:getAll');
$app->get('/post/{id}', 'Markblog\Infrastructure\Controller\PostController:get');
$app->post('/post', 'Markblog\Infrastructure\Controller\PostController:post');
$app->get('/admin', 'Markblog\Infrastructure\Controller\AdminController:get');
