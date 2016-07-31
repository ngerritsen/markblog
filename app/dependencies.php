<?php

use League\Container\Argument\RawArgument;
use League\Container\ContainerInterface;

$settings = require_once __DIR__ . '/settings.php';

/** @var ContainerInterface $container */
$container = $app->getContainer();

$container->add('Twig_Loader_Filesystem')
    ->withArgument(new RawArgument(__DIR__ . '/../src/Presentation/Template'));

$container->add('Twig_Environment')
    ->withArgument('Twig_Loader_Filesystem');

$container->add('PDO')
    ->withArguments([
        new RawArgument('mysql:host=' . $settings['mysql']['host'] . ';dbname=markblog;charset=utf8mb4'),
        new RawArgument($settings['mysql']['user']),
        new RawArgument($settings['mysql']['password'])
    ]);

$container->add('Markblog\Domain\Contract\PostRepositoryInterface', 'Markblog\Infrastructure\Repository\PostRepository')
    ->withArgument('PDO');
