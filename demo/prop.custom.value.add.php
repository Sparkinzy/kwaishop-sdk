<?php
include __DIR__ . '/../vendor/autoload.php';
$config   = include __DIR__.'/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);

//$param = [
//    'propId'=> 36673175139,
//    'propValues' => ["35","36","37",'38','39','40'],
//];
$param = [
    'propId'=> 36672967439,
    'propValues' => ['红色','黑色'],
];

$rs = $kwaishop->item->request('open.item.prop.custom.value.add',$param,'POST');
print_r($rs);