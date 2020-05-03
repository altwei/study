<?php

namespace AbstractFactory\BusinessPlans;

use AbstractFactory\BusinessPlan;

/**
 * 商业计划书 - 淘宝
 * Class TaoBao
 * @package AbstractFactory\BusinessPlans
 */
class TaoBao extends BusinessPlan
{
    /**
     * 项目名称
     * @return string
     */
    function projectName()
    {
        return '淘宝网';
    }

    /**
     * 成立日期
     * @return string
     */
    function establishDate()
    {
        return '2003-05-10';
    }

    /**
     * 愿景
     * @return string
     */
    function vision()
    {
        return '让天下没有难做的生意';
    }

    /**
     * 成本
     * @return mixed
     */
    function cost()
    {
        return '2500万美元';
    }
}