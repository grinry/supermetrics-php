<?php

namespace App\Http;

/**
 * Class JsonResponse
 * @package App\Http
 */
class JsonResponse extends Response
{
    /**
     * @param $data
     * @param int $json_options
     * @return string
     */
    public function json($data, int $json_options = JSON_PRETTY_PRINT)
    {
        $this->setHeader('content-type', 'application/json');
        return $this->print(json_encode($data, $json_options));
    }
}
