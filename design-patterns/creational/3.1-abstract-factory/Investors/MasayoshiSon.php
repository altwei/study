<?php

namespace AbstractFactory\Investors;

use AbstractFactory\Investor;

/**
 * 投资人 - 孙正义
 * Class MasayoshiSon
 * @package AbstractFactory\Investors
 */
class MasayoshiSon extends Investor
{
    /**
     * 中文名
     * @return string
     */
    function chineseName()
    {
        return '孙正义';
    }

    /**
     * 公司
     * @return string
     */
    function company()
    {
        return '软银';
    }
}