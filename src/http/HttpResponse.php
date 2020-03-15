<?php

namespace App\Http;

use JsonSerializable;

/**
 * Class HttpResponse
 * @package App\Http
 */
class HttpResponse implements JsonSerializable
{
    /** @var integer */
    protected $status;
    /** @var object */
    protected $data;

    /**
     * HttpResponse constructor.
     * @param int $status
     * @param $data
     */
    public function __construct(int $status, $data)
    {
        $this->status = $status;
        $this->data = json_decode($data);
    }

    /**
     * Returns http status code of response.
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Returns response data of request.
     * @return object
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
