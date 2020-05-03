<?php

namespace AbstractFactory\Projects;

use AbstractFactory\Project;

/**
 * 项目 - 梦幻西游
 * Class WestwardJourney
 * @package AbstractFactory\Project
 */
class WestwardJourney extends Project
{
    /**
     * 项目名称
     * @return string
     */
    function projectName()
    {
        return '梦幻西游';
    }

    /**
     * 成立日期
     * @return string
     */
    function establishDate()
    {
        return '2003-12-18';
    }

    /**
     * 愿景
     * @return string
     */
    function vision()
    {
        return '为社会输送更多的网瘾少年';
    }

    /**
     * 成本
     * @return mixed
     */
    function cost()
    {
        return '50万元人民币';
    }
}