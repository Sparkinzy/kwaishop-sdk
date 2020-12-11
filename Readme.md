# 快手电商SDK

## 配置项
config.php
```php

return [
    'app_key'      => '123',
    'app_secret'   => '123',
    'sign_secret'  => '123',
    'state'        => time(),
    'redirect_uri' => 'http://kuaishou.xxx.com',
    'debug'        => false,
    'access_token' => 'access_token',
    'log'=>[
        'name'=>'kuaishou',
        'file'=> __DIR__.'/kuaishou.log',
        'level'=>'debug',
        'permission'=> 0777
    ]
];
```

## 授权
```php

$config   = include __DIR__.'/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);
# 自动跳转到授权页面
$kwaishop->authorize();

```

## 获取token
```php
$config   = include __DIR__.'/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);
$result = $kwaishop->token();
```

## 获取商家信息
```php
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);
$user = $kwaishop->user->request('open.user.seller.get');
```

## 获取商品类目列表
```php
''""$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);
// 获取商品类目列表
$categories = $kwaishop->item->request('open.item.category');
// 获取商品列表
$param = [
    'kwaiItemId'=>null,
    'relItemId'=> null,
    'itemStatus'=> null,
    'itemType'=> null,
    'pageNumber'=> 1,
    'pageSize'=>20
];
$list = $kwaishop->item->request('open.item.list',$param);

// 新增商品
$param = [
    'relItemId'=>null,
    'title'=> null,
    'imageUrls'=> null,
    'details'=> null,
    'expressFee'=> 1,
    'categoryId'=>20,
        
];
$item = $kwaishop->item->request('open.item.add',$param,'POST');

```