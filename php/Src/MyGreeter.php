<?php
namespace Src;

class MyGreeter
{

    private string $timeZone;

    public function __construct()
    {
        //默认时区
        $this->timeZone = date_default_timezone_get();
    }

    /**
     * 获取当前时间的方法，可以在测试中覆盖
     * @return \DateTime 当前时间
     */
    protected function getCurrentTime(): \DateTime
    {
        return new \DateTime('now', new \DateTimeZone($this->timeZone));
    }

    /**
     * 根据当前时间返回不同的问候语
     * @return string 问候语
     */
    public function greeting(): string
    {
        try {
            //获取当前时间
            $currentTime = $this->getCurrentTime();

            //获取24小时格式时间
            $currentHour = $currentTime->format('G');

            //时间在6AM至12AM之间时，返回 "Good morning"
            //时间在12AM至6PM之间时，返回 "Good afternoon"
            //时间在6PM至第二天6AM之间时，返回 "Good evening"
            return match (true) {
                $currentHour>=6 && $currentHour <12 => "Good morning",
                $currentHour >=12 && $currentHour < 18 => "Good afternoon",
                default => "Good evening"
            };
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
