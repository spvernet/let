<?php


namespace App\Tests\Unit\Domain\Service;


use App\Letgo\Application\Usecase\ShoutRequest;
use PHPUnit\Framework\TestCase;

class ShoutServiceTest extends TestCase
{
    public function testCommandNoLimit()
    {
       $this->markTestSkipped('temporal');
    }
}