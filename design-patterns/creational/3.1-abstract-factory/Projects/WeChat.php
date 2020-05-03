<?php

namespace AbstractFactory\Projects;

use AbstractFactory\Project;

/**
 * 项目 - 微信
 * Class WeChat
 * @package AbstractFactory\Project
 */
class WeChat extends Project
{
    /**
     * 项目名称
     * @return string
     */
    function projectName()
    {
        return '微信';
    }

    /**
     * 成立日期
     * @return string
     */
    function establishDate()
    {
        return '2011-01-21';
    }

    /**
     * 愿景
     * @return string
     */
    function vision()
    {
        return '定义一种生活方式';
    }

    /**
     * 成本
     * @return mixed
     */
    function cost()
    {
        return '1200万元人民币';
    }
}