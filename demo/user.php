<?php
include __DIR__ . '/../vendor/autoload.php';
$config   = include __DIR__.'/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);
$params = [];
$user = $kwaishop->user->request('open.user.seller.get', $params);
var_dump($user);