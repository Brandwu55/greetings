<?php
namespace Src;

class MyGreeter
{

    /**
     * 获取当前时间的方法，可以在测试中覆盖
     * @return \DateTime 当前时间
     * @throws \Exception
     */
    protected function getCurrentTime(): \DateTime
    {
        return new \DateTime('now');
    }

    /**
     * 根据当前时间返回不同的问候语
     * @return string 问候语
     * @throws \Exception
     */
    public function greeting($timezone= 'UTC'): string
    {
        try {
            if (!in_array($timezone, \DateTimeZone::listIdentifiers())) {
                throw new \Exception('DateTimeZone is not valid!');
            }
        } catch (\Throwable $th){
            return $th->getMessage();
            die();
        }

        //获取当前时间
        $currentTime = $this->getCurrentTime();

        //设置时区
        $currentTime->setTimezone(new \DateTimeZone($timezone));

        $currentHour = $currentTime->format('G');//24-hour format of an hour without leading zeros
        if ($currentHour>=6 && $currentHour <12) {
            //时间在6AM至12AM之间时，返回 "Good morning"
            return 'Good morning';
        } elseif ($currentHour >=12 && $currentHour < 18) {
            //时间在12AM至6PM之间时，返回 "Good afternoon"
            return 'Good afternoon';
        } else {
            //时间在6PM至第二天6AM之间时，返回 "Good evening"
            return 'Good evening';
        }
    }
}

//$str = new MyGreeter();
//try {
//    var_dump($str->greeting('Asia/Seoul'));
//} catch (\Exception $e) {
//    var_dump($e->getMessage());
//}
