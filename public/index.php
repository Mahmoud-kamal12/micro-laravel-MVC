<?php

require_once("../vendor/autoload.php");
require_once("../src/Support/helpers.php");
require_once("../routes/web.php");

use \Dotenv\Dotenv;

$env = Dotenv::createImmutable(base_path());
$env->load();

app()->run();


