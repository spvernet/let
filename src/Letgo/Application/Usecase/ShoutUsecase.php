<?php


namespace App\Letgo\Application\Usecase;


use App\Letgo\Domain\Core\AbstractOutput;
use App\Letgo\Domain\Core\Usecase;
use App\Letgo\Domain\Service\ShoutService;
use App\Letgo\Infrastructure\Output\ShoutOutput;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShoutUsecase implements Usecase
{
    /** @var ShoutRequest $command */
    private $command;

    /** @var ShoutService $service  */
    private $service;

    /** @var LoggerInterface $logger*/
    private $logger;
    /** @var JsonResponse $output */
    private $output;

    /**
     * ShoutUsecase constructor.
     * @param ShoutRequest $command
     * @param ShoutService $service
     * @param LoggerInterface $logger
     * @param JsonResponse $output
     */
    public function __construct(ShoutRequest $command, ShoutService $service, LoggerInterface $logger, ShoutOutput $output)
    {
        $this->command = $command;
        $this->service = $service;
        $this->logger = $logger;
        $this->output = $output;
    }

    public function execute() {

        try{
            $this->command->isValid();
        } catch (\Exception $e){
            $this->logger->error('error: '.$e->getMessage(), ['shout.isValid']);
            $this->output->addError($e->getMessage(), 'shout.validation', AbstractOutput::CODE_BAD_REQUEST);
            return $this->output->execute();
        }


        $response = $this->service->getTweets($this->command->getUsername(), $this->command->getLimit());

        return $this->output->execute($response);
    }
}