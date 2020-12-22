<?php
include __DIR__ . '/../vendor/autoload.php';
$config   = include __DIR__ . '/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);
$categoryId= 1715;

$param = [
    'categoryId'=>$categoryId
];
$rs = $kwaishop->item->request('open.item.category.config',$param);

file_put_contents(__DIR__ . '/data/category.' . $categoryId . '.config.json', json_encode($rs,JSON_UNESCAPED_UNICODE));