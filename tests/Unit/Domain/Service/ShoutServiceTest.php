<?php


namespace App\Tests\Unit\Domain\Service;


use App\Letgo\Domain\Model\Tweet\Tweet;
use App\Letgo\Domain\Model\Tweet\TweetRepository;
use App\Letgo\Domain\Model\Tweet\TweetRepositoryCache;
use App\Letgo\Domain\Service\ShoutService;
use PHPUnit\Framework\TestCase;

class ShoutServiceTest extends TestCase
{

    private $cache;

    private $inMemory;


    protected function setUp()
    {
        $this->inMemory = $this
            ->getMockBuilder(TweetRepository::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->cache = $this
            ->getMockBuilder(TweetRepositoryCache::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->inMemory
            ->expects($this->any())
            ->method('searchByUserName')
            ->willReturn([new Tweet('aaa'),
                new Tweet('bbb'),
                new Tweet('ccc')
            ]);
    }


    public function testTweetsifCache()
    {
        $this->cache
            ->expects($this->any())
            ->method('getCache')
            ->willReturn(json_encode(['DDD!','EEE!','FFF!']));



        $service = new ShoutService($this->inMemory, $this->cache);
        $result= $service->getTweets("test", 5);
        $this->assertEquals('DDD!', $result[0]);
        $this->assertEquals('EEE!', $result[1]);
        $this->assertEquals('FFF!', $result[2]);
    }

    public function testTweetsifNoCache()
    {
        $this->cache
            ->expects($this->any())
            ->method('getCache')
            ->willReturn(false);

        $service = new ShoutService($this->inMemory, $this->cache);
        $result= $service->getTweets("test", 5);
        $this->assertEquals('AAA!', $result[0]);
        $this->assertEquals('BBB!', $result[1]);
        $this->assertEquals('CCC!', $result[2]);
    }


}