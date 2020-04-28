<?php

namespace AbstractFactory;

/**
 * 工厂
 * Class Factory
 * @package AbstractFactory
 */
abstract class Factory
{
    /**
     * 采购原料
     * @return mixed
     */
    abstract protected function purchaseMaterials();

    /**
     * 招聘工人
     * @return mixed
     */
    abstract protected function recruitmentWorkers();

    /**
     * 制造加工
     * @return mixed
     */
    abstract protected function manufacture();

    /**
     * 开始运作
     * @return array
     */
    public function startsOperation()
    {
        $pipeline = [
            static::class,
        ];
        foreach ($this->purchaseMaterials() as $item) {
            $pipeline[] = '采购：' . $item;
        }
        foreach ($this->recruitmentWorkers() as $item) {
            $pipeline[] = '招聘：' . $item;
        }
        foreach ($this->manufacture() as $item) {
            $pipeline[] = '制造：' . $item;
        }
        return $pipeline;
    }
}