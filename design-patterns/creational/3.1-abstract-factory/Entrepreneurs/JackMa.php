<?php

namespace AbstractFactory\Entrepreneurs;

use AbstractFactory\Entrepreneur;

/**
 * 创业者 - 杰克马
 * Class JackMa
 * @package AbstractFactory\Entrepreneurs
 */
class JackMa extends Entrepreneur
{
    /**
     * 昵称
     * @return string
     */
    protected function nickname()
    {
        return '杰克马';
    }

    /**
     * 出生日期
     * @return string
     */
    protected function birthday()
    {
        return '1964-09-10';
    }

    /**
     * 财富
     * @return string
     */
    protected function wealth()
    {
        return '434亿美元';
    }
}