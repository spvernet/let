<?php


namespace App\Letgo\Domain\Service;


use App\Letgo\Domain\Model\Tweet\TweetRepository;
use App\Letgo\Domain\Model\Tweet\TweetRepositoryCache;

class ShoutService
{

    /** @var TweetRepository $repo */
    private $repo;

    /** @var TweetRepositoryCache $cache */
    private $cache;

    /**
     * ShoutService constructor.
     * @param TweetRepository $repo
     */
    public function __construct(TweetRepository $repo, TweetRepositoryCache $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    public function getTweets(string $username, int $limit)
    {
        $response = [];
        $tweets = $this->cache->getCache($username, $limit);
        if (!$tweets) {
            $tweets = $this->repo->searchByUserName($username, $limit);
            foreach ($tweets as $tweet) {
                $response[] = mb_strtoupper(rtrim($tweet->getText(),".")."!");
            }
            $this->cache->setCache($username, $limit, $response);
            return $response;
        }
        return json_decode($tweets);
    }


}