<?php

namespace AbstractFactory\Investors;

use AbstractFactory\Investor;

/**
 * 投资人 - 麻花疼
 * Class PonyMa
 * @package AbstractFactory\Investors
 */
class PonyMa extends Investor
{
    /**
     * 中文名
     * @return string
     */
    function chineseName()
    {
        return '麻花疼';
    }

    /**
     * 公司
     * @return string
     */
    function company()
    {
        return '腾讯';
    }
}