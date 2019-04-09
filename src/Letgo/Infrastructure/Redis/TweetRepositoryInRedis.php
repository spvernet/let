<?php


namespace App\Letgo\Infrastructure\Redis;


use App\Letgo\Domain\Model\Tweet\TweetRepositoryCache;

class TweetRepositoryInRedis implements TweetRepositoryCache
{

    const TTL = 600;
    /** @var \Redis */
    private $redis;

    /**
     * TweetRepositoryInRedis constructor.
     */
    public function __construct(
        string $host,
        string $port,
        int $timeout,
        int $databaseIndex
    )
    {

        $this->redis = new \Redis();
        $this->redis->connect($host, $port, $timeout);
        $this->redis->select($databaseIndex);
    }

    public function setCache($username, $limit, $results): bool
    {
        return $this->redis->setex($username."_".$limit,self::TTL, json_encode($results));

    }

    public function getCache($username, $limit)
    {
        return $this->redis->get($username."_".$limit);

    }
}