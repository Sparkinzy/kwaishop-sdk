<?php
include __DIR__ . '/../vendor/autoload.php';
$config   = include __DIR__.'/config.php';
$kwaishop = new \Sparkinzy\KwaishopSdk\Kwaishop($config);
echo "<pre>";


$param = [
    'relItemId'=> 'oaiiipppeam',
    'title' => '二驴同款T恤',
    'imageUrls' => ([
        'http://img03.k3cdn.com/k/1030761/2020120818539762459543w800h800_750x750.jpg',
        'http://img03.k3cdn.com/k/2047953/2020112013019418458583w800h800_750x750.jpg',
        'http://img03.k3cdn.com/k/1001050/2020112111495121567339w800h800_310x310.jpg',
    ]),
    'details' => '谁穿谁秃头的 T Shirt',
    'expressFee'=>0,
    'serviceRule'=>([
        'refundRule'=> 4,# 1:支持7天无理由退货 4:不支持7天无理由退货 5:支持7天无理由退货(拆封后不支持) 6:支持7天无理由退货(激活后不支持) 7:支持7天无理由退货(安装后不支持) 8:支持7天无理由退货(定制类不支持) 9:支持7天无理由退货(使用后不支持)
        'theDayOfDeliverGoodsTime'=> 3,#发货间隔时间，单位：天，范围在[4,90]
        //        'promiseDeliveryTime'=> '', # 非必选，非预售商品承诺，发货时间单位：秒，取值86400,172800,259200,分别代表24、48、72小时，取值-1代表发货时间不承诺 注：ServiceRule.theDayOfDeliverGoodsTime代表预售商品发货间隔时间，故theDayOfDeliverGoodsTime和promiseDeliveryTime不能同时设置
        'depositRule'=> 1,# 保证金，请求内容为枚举数值，非后面文案： 1:未交 2已交
    ]),
    'categoryId' => 1715,
    'categoryName'=> '单鞋',
    'parentCategoryId'=> 1713,
    'parentCategoryName'=> '女鞋',
    //    'itemVideoId'=> 22, # 商品关联的视频id
    //    'limitCount'=> 1,# 限购数量
        'skuInfoParams'=> ([
                          [
                              'relSkuId'=>123,
                              'imageUrl'=> 'http://img03.k3cdn.com/k/1030761/2020120818539762459543w800h800_750x750.jpg',
                              'skuSpecifications' => [
                                  [
                                      'propId'=> 36672967439,
                                      'propName'=>'颜色',
                                      'propValueId'=> 412,
                                      'propValueName' => '颜色',
                                  ],
                              ],
                              'skuStock'=> 90,
                              ''
                          ],
        ]), # SKU数据，多属性规格参数。目前只支持两级属性，并且需要传两级属性的完整笛卡尔积。录入多规格商品时，需要包含所有规格的组合
    'itemPropValues'=> json_encode([
        [
            'propId' => 123321,
            'radioPropValue'=> [
                'propValueId' => 123123123,# 属性值id
                'propValueName'=> '海贼王',# 属性值
                'propId'=> 123321,# 属性ID
            ],
            'checkBoxPropValuesList'=>[
                'propValueId'=> 1234213213,
                'propValueName'=> '海贼王',#
                'propId'=> 123456
            ],
            'textPropValue' => '测试',# 文本属性值
            'datetimeTimestamp'=> 1577808000000,
            'dateRange'=> [
                'startTimeTimestamp' => 1577808000000,
                'endTimeTimestamp'=> 1577809000000
            ],
            'sortNum'=> 12,# 序号，open.item.category.config返回
            'imagePropValues'=>[],# 可选 图片属性列表(根据属性的输入类型判断是否必填),可以参考：https://open.kwaixiaodian.com/#/docs/dev?id=k6Gk8TpkjA
        ]
    ]),
    //    'expressTemplateId'=> 321, # 已经存在的运费模板id，表示该商品使用该运费模板id
];

$item = $kwaishop->item->request('open.item.add',$param,'POST');
print_r($item);