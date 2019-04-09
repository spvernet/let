<?php

namespace App\Letgo\Domain\Model\Tweet;

interface TweetRepository
{
    public function searchByUserName(string $username, int $limit): array;
}
