#!/usr/bin/env php
<?php

/* vim: set shiftwidth=2 expandtab softtabstop=2: */

require_once __DIR__ . '/../vendor/d11wtq/boris/lib/autoload.php';
require_once __DIR__ . '/../autoloader.php';

$boris  = new \Boris\Boris();

$boris->setLocal(array('rest' => new \Curl\Modules\REST()));
$config = new \Boris\Config();
$config->apply($boris);

$options = new \Boris\CLIOptionsHandler();
$options->handle($boris);

$boris->start();
