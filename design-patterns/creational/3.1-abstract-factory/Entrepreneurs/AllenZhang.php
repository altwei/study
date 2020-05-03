<?php

namespace AbstractFactory\Entrepreneurs;

use AbstractFactory\Entrepreneur;

/**
 * 创业者 - 张小龙
 * Class AllenZhang
 * @package AbstractFactory\Entrepreneurs
 */
class AllenZhang extends Entrepreneur
{
    /**
     * 昵称
     * @return string
     */
    protected function nickname()
    {
        return '张小龙';
    }

    /**
     * 出生日期
     * @return string
     */
    protected function birthday()
    {
        return '1969-12-03';
    }

    /**
     * 财富
     * @return string
     */
    protected function wealth()
    {
        return '16亿美元';
    }
}