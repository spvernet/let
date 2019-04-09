<?php


namespace App\Letgo\Domain\Service;


use App\Letgo\Domain\Model\Tweet\TweetRepository;

class ShoutService
{

    /** @var TweetRepository $repo */
    private $repo;

    /**
     * ShoutService constructor.
     * @param TweetRepository $repo
     */
    public function __construct(TweetRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getTweets(string $username, int $limit)
    {
        $response = [];
        $tweets = $this->repo->searchByUserName($username, $limit);

        foreach ($tweets as $tweet) {

            $response[] = mb_strtoupper(rtrim($tweet->getText(),".")."!");
        }
       // die(var_dump($response));
        return $response;
    }


}