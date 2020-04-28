<?php

namespace AbstractFactory;

/**
 * 马云
 * Class JackMa
 * @package AbstractFactory
 */
class JackMa
{
    protected $group = [];

    /**
     * JackMa constructor.
     * @param Factory ...$factory
     */
    public function __construct(Factory ...$factory)
    {
        $this->investFactory(...$factory);
    }

    /**
     * 投资工厂
     * @param Factory ...$factory
     */
    public function investFactory(Factory ...$factory)
    {
        $this->group = array_merge($this->group, $factory);
    }

    /**
     * 开始运作
     * @return array
     */
    public function startsOperation()
    {
        return array_map(function (Factory $factory) {
            return implode(PHP_EOL, $factory->startsOperation());
        }, $this->group);
    }
}