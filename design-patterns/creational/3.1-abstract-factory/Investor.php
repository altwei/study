<?php

namespace AbstractFactory;

/**
 * 投资人
 * Class Investor
 * @package AbstractFactory
 */
abstract class Investor
{
    /**
     * 中文名
     * @return string
     */
    abstract function chineseName();

    /**
     * 公司
     * @return string
     */
    abstract function company();
}