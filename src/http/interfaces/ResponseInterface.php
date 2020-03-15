<?php

namespace App\Http\Interfaces;

/**
 * Interface ResponseInterface
 * @package App\Http\Interfaces
 */
interface ResponseInterface
{
    /**
     * @param int $status_code
     * @return self
     */
    public function setStatus(int $status_code);

    /**
     * @param string $header
     * @param string $value
     * @return self
     */
    public function setHeader(string $header, string $value);

    /**
     * Echoes response.
     * @param $data
     * @return string
     */
    public function print($data);
}