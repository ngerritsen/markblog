<?php
use Jenssegers\Lean\App as SlimWithLeagueContainerApp;

require '../vendor/autoload.php';

$app = new SlimWithLeagueContainerApp;

require_once '../app/dependencies.php';
require_once '../app/routes.php';

$app->run();
