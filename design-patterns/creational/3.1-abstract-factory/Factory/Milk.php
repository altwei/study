<?php

namespace AbstractFactory\Factory;

use AbstractFactory\Factory;

/**
 * 牛奶工厂
 * Class Milk
 * @package AbstractFactory\Factory
 */
class Milk extends Factory
{
    /**
     * 采购原料
     * @return array|mixed
     */
    public function purchaseMaterials()
    {
        return [
            '100头奶牛...',
            '1万个铁桶...',
            '10万个250ml纸盒...',
        ];
    }

    /**
     * 招聘工人
     * @return array|mixed
     */
    public function recruitmentWorkers()
    {
        return [
            '10名挤奶工人...',
            '3名打包员...',
            '3名销售员...',
        ];
    }

    /**
     * 制造加工
     * @return array|mixed
     */
    public function manufacture()
    {
        return [
            '10名挤奶工，挤完奶牛...',
            '3名打包员，完成打包',
            '3名销售员，跑路1个，其余2人加班来完成指标',
        ];
    }
}