<?php


namespace App\Letgo\Infrastructure\Output;


use App\Letgo\Domain\Core\AbstractOutput;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShoutOutput extends AbstractOutput
{


    public function execute(array $data = null)
    {
        $this->init();
        if (is_array($data) && array_key_exists('errors' , $data)) {
            return new JsonResponse($data, self::CODE_BAD_REQUEST);
        } elseif ($this->hasErrors()) {
            $error = $this->getErrors();
            return new JsonResponse($error, $error['metadata'][0]['code']);
        }
        $this->output['data']= $data;
        $response = new JsonResponse();
        $response->setEncodingOptions(JSON_PRETTY_PRINT);
        $response->setData($this->output['data']);
        return $response;
    }
}