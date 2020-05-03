<?php

namespace AbstractFactory;

use AbstractFactory\BusinessPlans\TaoBao;
use AbstractFactory\BusinessPlans\WeChat;
use AbstractFactory\BusinessPlans\WestwardJourney;
use AbstractFactory\Entrepreneurs\AllenZhang;
use AbstractFactory\Entrepreneurs\JackMa;
use AbstractFactory\Entrepreneurs\WilliamDing;
use AbstractFactory\Investors\MasayoshiSon;
use AbstractFactory\Investors\PonyMa;

spl_autoload_register(function ($className) {
    require_once str_replace('AbstractFactory\\', '', $className) . '.php';
});

echo '<pre>';

//张小龙的创业历程
$entrepreneur = new AllenZhang();
$entrepreneur->take(new WeChat());
$entrepreneur->seek(new PonyMa());
echo $entrepreneur->course();
echo PHP_EOL . PHP_EOL;
//输出：
//42岁的张小龙，拿着《微信》的商业计划书，跑到腾讯，找到了投资人麻花疼。
//鼓吹自己的使命是：“定义一种生活方式”，成功地吸引了麻花疼的兴趣，并融资1200万元人民币。
//经过9年的不懈努力，成功地积累了16亿美元的财富。

//马云的创业历程
$entrepreneur = new JackMa();
$entrepreneur->take(new TaoBao());
$entrepreneur->seek(new MasayoshiSon());
echo $entrepreneur->course();
echo PHP_EOL . PHP_EOL;
//输出：
//39岁的杰克马，拿着《淘宝网》的商业计划书，跑到软银，找到了投资人孙正义。
//鼓吹自己的使命是：“让天下没有难做的生意”，成功地吸引了孙正义的兴趣，并融资2500万美元。
//经过17年的不懈努力，成功地积累了434亿美元的财富。

//丁磊的创业历程
$entrepreneur = new WilliamDing();
$entrepreneur->take(new WestwardJourney());
echo $entrepreneur->course();
//输出：
//32岁的丁三石，拿着50万元人民币的启动资金，研发出《梦幻西游》。
//肩负着沉重的使命，打出强烈的口号：“为社会输送更多的网瘾少年”。
//经过17年的不懈努力，成功的积累了160亿美元的财富。
