<?php
include __DIR__ . '/../vendor/autoload.php';
$config   = include __DIR__.'/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);


$param = [
    'categoryId' => 1715,
    'propName' => '尺码',
];
$rs = $kwaishop->item->request('open.item.prop.custom.add',$param,'POST');
print_r($rs);