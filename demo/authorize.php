<?php

include __DIR__ . '/../vendor/autoload.php';
$config   = include __DIR__.'/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);
$kwaishop->authorize();
