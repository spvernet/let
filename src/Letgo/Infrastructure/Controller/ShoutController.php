<?php

namespace App\Letgo\Infrastructure\Controller;

use App\Letgo\Application\Usecase\ShoutRequest;
use App\Letgo\Application\Usecase\ShoutUsecase;
use App\Letgo\Domain\Service\ShoutService;
use App\Letgo\Infrastructure\Output\ShoutOutput;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

final class ShoutController
{
    public function index(ShoutService $service, Request $request, $username, LoggerInterface $logger)
    {
        $limit = $request->get('limit') ??  null;


        $command = new ShoutRequest($username, $limit);

        $usecase = new ShoutUsecase(
            $command,
            $service,
            $logger,
            new ShoutOutput()
        );

        return $usecase->execute();
    }
}
