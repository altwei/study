<?php

namespace AbstractFactory\Entrepreneurs;

use AbstractFactory\Entrepreneur;

/**
 * 创业者 - 丁三磊
 * Class WilliamDing
 * @package AbstractFactory\Entrepreneurs
 */
class WilliamDing extends Entrepreneur
{
    /**
     * 昵称
     * @return string
     */
    protected function nickname()
    {
        return '丁三石';
    }

    /**
     * 出生日期
     * @return string
     */
    protected function birthday()
    {
        return '1971-10-01';
    }

    /**
     * 财富
     * @return string
     */
    protected function wealth()
    {
        return '160亿美元';
    }
}