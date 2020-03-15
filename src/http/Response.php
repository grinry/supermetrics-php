<?php

namespace App\Http;

use App\Http\Interfaces\ResponseInterface;

/**
 * Class Response
 * @package App\Http
 */
class Response implements ResponseInterface {

    /**
     * @param int $status_code
     * @return self
     */
    public function setStatus(int $status_code)
    {
        http_response_code($status_code);
        return $this;
    }

    /**
     * @param string $header
     * @param string $value
     * @return self
     */
    public function setHeader(string $header, string $value)
    {
        header("$header: $value");
        return $this;
    }

    /**
     * Echoes response.
     * @param $data
     * @return string
     */
    public function print($data)
    {
        echo $data;
        exit();
    }
}