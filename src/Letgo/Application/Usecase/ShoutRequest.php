<?php


namespace App\Letgo\Application\Usecase;


use App\Letgo\Domain\Exception\EmptyNameException;
use App\Letgo\Domain\Exception\LimitException;

class ShoutRequest
{

    const LIMIT_MAX = 10;
    const LIMIT_MIN = 1;

    /** @var string $username */
    private $username;

    /** @var int $limit */
    private $limit;

    /**
     * ShoutRequest constructor.
     * @param string $username
     * @param int $limit
     */
    public function __construct(string $username, ?int $limit)
    {
        $this->username = $username;
        $this->limit = $limit;
    }


    public function isValid(): bool {
        if (empty($this->username)) {
            throw new EmptyNameException('empty tweet name');
        }
        if(empty($this->limit) || $this->limit<self::LIMIT_MIN || $this->limit>self::LIMIT_MAX){
            throw new LimitException('the field limit is missing or not in correct ranges (1 - 10)');
        }

        return true;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }



}