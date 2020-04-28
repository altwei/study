<?php

namespace AbstractFactory\Factory;

use AbstractFactory\Factory;

/**
 * 手机工厂
 * Class Cellphone
 * @package AbstractFactory\Factory
 */
class Cellphone extends Factory
{
    /**
     * 采购原料
     * @return array|mixed
     */
    public function purchaseMaterials()
    {
        return [
            '100万个A99芯片...',
            '150万个10亿像素摄像头...',
            '200万个万能充...',
        ];
    }

    /**
     * 招聘工人
     * @return array|mixed
     */
    public function recruitmentWorkers()
    {
        return [
            '10个张全蛋...',
            '5个赵铁柱...',
            '1个唐马儒...',
        ];
    }

    /**
     * 制造加工
     * @return array|mixed
     */
    public function manufacture()
    {
        return [
            '赵铁柱，组装了10个手机...',
            '张全蛋，质检了5个手机，锤爆了5个手机...',
            '唐马儒，卖出4个手机，拿走1个送小三...',
        ];
    }
}