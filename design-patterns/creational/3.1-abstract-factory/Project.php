<?php

namespace AbstractFactory;

/**
 * 项目
 * Class Project
 * @package AbstractFactory
 */
abstract class Project
{
    /**
     * 项目名称
     * @return string
     */
    abstract function projectName();

    /**
     * 成立日期
     * @return string
     */
    abstract function establishDate();

    /**
     * 愿景
     * @return string
     */
    abstract function vision();

    /**
     * 成本
     * @return mixed
     */
    abstract function cost();
}