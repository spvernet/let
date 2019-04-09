<?php


namespace App\Letgo\Domain\Model\Tweet;


interface TweetRepositoryCache
{
    public function setCache($username, $limit, $results): bool;
    public function getCache($username, $limit);
}