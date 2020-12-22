<?php
include __DIR__ . '/../vendor/autoload.php';
$config   = include __DIR__ . '/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);

$categoryId = 1715;

$param = [
    'categoryId' => 1715,
    'propId'     => 102,
    'propValue'  => '品牌',
    'cursor'     => 0,
    'limit'      => 10
];

$rs = $kwaishop->item->request('open.item.category.prop.value.search', $param);
file_put_contents(__DIR__ . '/data/category.' . $param['categoryId'] . '.prop.' . $param['propId'] . '.value.search.json', json_encode($rs, JSON_UNESCAPED_UNICODE) . PHP_EOL);
print_r($rs);