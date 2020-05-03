<?php

namespace AbstractFactory;

/**
 * 创业者
 * Class Entrepreneur
 * @package AbstractFactory
 */
abstract class Entrepreneur
{
    protected $businessPlan = null;
    protected $investor = null;

    /**
     * Entrepreneur constructor.
     * @param BusinessPlan|null $businessPlan
     * @param Investor|null $investor
     */
    public function __construct(BusinessPlan $businessPlan = null, Investor $investor = null)
    {
        $this->businessPlan = $businessPlan;
        $this->investor = $investor;
    }

    /**
     * 昵称
     * @return string
     */
    abstract protected function nickname();

    /**
     * 出生日期
     * @return string
     */
    abstract protected function birthday();

    /**
     * 财富
     * @return string
     */
    abstract protected function wealth();

    /**
     * 拿着 - 商业计划书
     * @param BusinessPlan $businessPlan
     * @return $this
     */
    public function take(BusinessPlan $businessPlan)
    {
        $this->businessPlan = $businessPlan;

        return $this;
    }

    /**
     * 寻求 - 投资人
     * @param Investor $investor
     * @return $this
     */
    public function seek(Investor $investor)
    {
        $this->investor = $investor;

        return $this;
    }

    /**
     * 历程
     * @return string
     */
    public function course()
    {
        //创业者
        $establishTime = strtotime($this->businessPlan->establishDate()); //成立日期(时间戳)
        $birthdayTime = strtotime($this->birthday()); //出生日期(时间戳)
        $howOld = date('Y', $establishTime) - date('Y', $birthdayTime);
        $howLong = date('Y', time()) - date('Y', $establishTime);
        $entrepreneur = $this->nickname();
        $wealth = $this->wealth();

        //项目
        $projectName = $this->businessPlan->projectName();
        $vision = $this->businessPlan->vision();
        $cost = $this->businessPlan->cost();

        if (null === $this->investor) {

            //投资人
            $course = <<<COURSE
{$howOld}岁的{$entrepreneur}，拿着{$cost}的启动资金，研发出《{$projectName}》。
肩负着沉重的使命，打出强烈的口号：“{$vision}”。
经过{$howLong}年的不懈努力，成功的积累了{$wealth}的财富。
COURSE;
        } else {

            //投资人
            $investor = $this->investor->chineseName();
            $company = $this->investor->company();

            $course = <<<COURSE
{$howOld}岁的{$entrepreneur}，拿着《{$projectName}》的商业计划书，跑到{$company}，找到了投资人{$investor}。
鼓吹自己的使命是：“{$vision}”，成功地吸引了{$investor}的兴趣，并融资{$cost}。
经过{$howLong}年的不懈努力，成功地积累了{$wealth}的财富。
COURSE;
        }

        return $course;

    }
}