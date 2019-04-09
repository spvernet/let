<?php


namespace App\Tests\Unit\Aplication\Usecase;


use App\Letgo\Application\Usecase\ShoutRequest;

use App\Letgo\Domain\Exception\EmptyNameException;
use App\Letgo\Domain\Exception\LimitException;
use PHPUnit\Framework\TestCase;

class ShoutRequestTest extends TestCase
{

    public function testCommandLimitGreater()
    {
        $this->expectException(LimitException::class);
        $command = new ShoutRequest('test', 22);
        $command->isValid();
    }

    public function testCommandLimitNull()
    {
        $this->expectException(LimitException::class);
        $command = new ShoutRequest('test', null);
        $command->isValid();
    }

    public function testCommandLimitZero()
    {
        $this->expectException(LimitException::class);
        $command = new ShoutRequest('test', 0);
        $command->isValid();
    }


    public function testCommandNullUsername()
    {
        $this->expectException(EmptyNameException::class);
        $command = new ShoutRequest('', 1);
        $command->isValid();
    }
}