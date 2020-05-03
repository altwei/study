<?php

namespace AbstractFactory;

/**
 * 创业者
 * Class Entrepreneur
 * @package AbstractFactory
 */
abstract class Entrepreneur
{
    protected $project = null; //项目
    protected $investor = null; //投资人

    //创业模式
    protected $startupMode = null;
    const STARTUP_MODE_INVEST = '外部投资';
    const STARTUP_MODE_ALONE = '独自创业';

    /**
     * Entrepreneur constructor.
     * @param Project|null $project
     * @param Investor|null $investor
     */
    public function __construct(Project $project = null, Investor $investor = null)
    {
        $this->project = $project;
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
     * 拿着 - 项目的商业计划书
     * @param Project $project
     * @return $this
     */
    public function take(Project $project)
    {
        $this->project = $project;
        $this->startupMode = self::STARTUP_MODE_INVEST;

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
     * 开发 - 项目
     * @param Project $project
     * @return $this
     */
    public function develop(Project $project)
    {
        $this->project = $project;
        $this->startupMode = self::STARTUP_MODE_ALONE;

        return $this;
    }

    /**
     * 历程
     * @return string
     */
    public function course()
    {
        //创业者
        $establishTime = strtotime($this->project->establishDate()); //成立日期(时间戳)
        $birthdayTime = strtotime($this->birthday()); //出生日期(时间戳)
        $howOld = date('Y', $establishTime) - date('Y', $birthdayTime);
        $howLong = date('Y', time()) - date('Y', $establishTime);
        $entrepreneur = $this->nickname();
        $wealth = $this->wealth();

        //项目
        $projectName = $this->project->projectName();
        $vision = $this->project->vision();
        $cost = $this->project->cost();

        switch ($this->startupMode) {
            case self::STARTUP_MODE_INVEST:
                //投资人
                $investor = $this->investor->chineseName();
                $company = $this->investor->company();

                $course = <<<COURSE
{$howOld}岁的{$entrepreneur}，拿着《{$projectName}》的商业计划书，跑到{$company}，找到了投资人{$investor}。
鼓吹自己的使命是：“{$vision}”，成功地吸引了{$investor}的兴趣，并融资{$cost}。
经过{$howLong}年的不懈努力，成功地积累了{$wealth}的财富。
COURSE;
                break;
            default:
            case self::STARTUP_MODE_ALONE:
                $course = <<<COURSE
{$howOld}岁的{$entrepreneur}，拿着{$cost}的启动资金，研发出《{$projectName}》。
肩负着沉重的使命，打出强烈的口号：“{$vision}”。
经过{$howLong}年的不懈努力，成功的积累了{$wealth}的财富。
COURSE;
                break;
        }
        return $course;

    }
}