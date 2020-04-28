<?php

namespace AbstractFactory;

use AbstractFactory\Factory\Cellphone;
use AbstractFactory\Factory\Milk;

spl_autoload_register(function ($className) {
    require_once str_replace('AbstractFactory\\', '', $className) . '.php';
});

//初始化
$bigOld = new JackMa(new Milk(), new Cellphone());
$bigOld->investFactory(new Milk());
$bigOld->investFactory(new Cellphone());

//开始运作
echo '<pre>';
echo implode('<hr>', $bigOld->startsOperation());