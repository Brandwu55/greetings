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

    public function testMorningGreeting()
    {
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();

        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('08:00'));

        $this->assertEquals('Good morning', $greeter->greeting());
    }

    public function testAfternoonGreeting()
    {
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();

        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('12:00'));

        $this->assertEquals('Good afternoon', $greeter->greeting());
    }

    public function testEveningGreeting()
    {
        $greeter = $this->getMockBuilder(MyGreeter::class)
            ->onlyMethods(['getCurrentTime'])
            ->getMock();

        $greeter->method('getCurrentTime')
            ->willReturn(new DateTime('02:00'));

        $this->assertEquals('Good evening', $greeter->greeting());
    }
}
