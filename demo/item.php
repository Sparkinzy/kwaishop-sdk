<?php
include __DIR__ . '/../vendor/autoload.php';
$config   = include __DIR__.'/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);
// 获取商品类目列表
$categories = $kwaishop->item->request('open.item.category');
file_put_contents(__DIR__.'/data/categories.json', json_encode($categories,JSON_UNESCAPED_UNICODE).PHP_EOL);
die(json_encode($categories));
// 获取类目相关配置信息
//$param = ['categoryId'=>1027];
//$category_config = $kwaishop->item->request('open.item.category.config',$param);

//print_r($category_config);

//$param = [
//    'kwaiItemId'=>null,
//    'relItemId'=> null,
//    'itemStatus'=> null,
//    'itemType'=> null,
//    'pageNumber'=> 1,
//    'pageSize'=>20
//];
//$list = $kwaishop->item->request('open.item.list',$param);
//print_r($list);
