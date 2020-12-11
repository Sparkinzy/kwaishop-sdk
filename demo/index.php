<?php

include __DIR__ . '/../vendor/autoload.php';

$config   = include __DIR__.'/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);
$result = $kwaishop->token();
var_dump($result);


