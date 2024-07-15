<?php

use PHPUnit\Framework\TestCase;
use Src\MyGreeter;

class MyGreeterTest extends TestCase
{
    private MyGreeter $greeter;

    public function setUp(): void
    {
        $this->greeter = new MyGreeter();
    }

    public function testInit()
    {
        $this->assertInstanceOf(
            MyGreeter::class,
            $this->greeter
        );
    }

//    public function testGreeting()
//    {
//        $this->assertTrue(
//            strlen($this->greeter->greeting()) > 0
//        );
//    }

    public function testGreetingInvalidDate()
    {
        // 模拟一个不存在的时区：Asia/Shanghai11
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();

        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('08:00'));

        $this->assertEquals('DateTimeZone is not valid!', $greeter->greeting('Asia/Shanghai88'));
    }

    public function testGreetingTwo()
    {
        // 模拟Asia/Shanghai时区，UTC时间早上2点
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();

        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('02:00'));//UTC时区，早上2点

        $this->assertEquals('Good morning', $greeter->greeting('Asia/Shanghai'));
    }

    public function testGreetingFour()
    {
        // 模拟Asia/Shanghai时区，UTC时间早上4点
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();

        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('04:00'));

        $this->assertEquals('Good afternoon', $greeter->greeting('Asia/Shanghai'));
    }

    public function testGreetingTwelve()
    {
        // 模拟Asia/Shanghai时区，UTC时间中午12点
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();

        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('12:00'));

        $this->assertEquals('Good evening', $greeter->greeting('Asia/Shanghai'));
    }

    public function testGreetingZero()
    {
        // 模拟Asia/Shanghai时区，UTC时间凌晨12点
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();

        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('00:00'));

        $this->assertEquals('Good morning', $greeter->greeting('Asia/Shanghai'));
    }

    public function testGreetingTwentyTwo()
    {
        // 模拟Asia/Shanghai时区，UTC时间晚上22点
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();

        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('00:00'));

        $this->assertEquals('Good morning', $greeter->greeting('Asia/Shanghai'));
    }


    public function testGreetingSixUtc()
    {
        // 模拟UTC时区，早上06：00
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();

        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('06:00'));

        $this->assertEquals('Good morning', $greeter->greeting());
    }

    public function testGreetingTwelveUtc()
    {
        // 模拟UTC时区，下午12：00
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();
        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('12:00'));

        $this->assertEquals('Good afternoon', $greeter->greeting());
    }

    public function testGreetingTwentyUtc()
    {
        // 模拟UTC时区，晚上时间20:00
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();
        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('20:00'));

        $this->assertEquals('Good evening', $greeter->greeting());
    }

    public function testGreetingFiveUtc()
    {
        // 模拟UTC时区，早上时间05:00
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();
        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('05:00'));

        $this->assertEquals('Good evening', $greeter->greeting());
    }
}
