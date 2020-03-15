<?php

namespace App\Lib\Supermetrics;

use App\Http\HttpResponse;
use JsonSerializable;

/**
 * Class RestResponse
 * @package App\Lib\Supermetrics
 */
abstract class RestResponse implements JsonSerializable
{
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    /** @var string */
    protected $status;
    /** @var string */
    protected $error;

    /**
     * RestResponse constructor.
     * @param HttpResponse $response
     */
    public function __construct(HttpResponse $response)
    {
        $this->setSuccessData($response);
        $this->setFailedData($response);
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
        return array_filter(
            get_object_vars($this),
            function ($item) {
                // Keep only not-NULL values
                return !is_null($item);
            }
        );
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param HttpResponse $response
     */
    protected abstract function handleSuccess(HttpResponse $response): void;

    /**
     * @param HttpResponse $response
     */
    protected function setSuccessData(HttpResponse $response): void
    {
        if ($response->getStatus() >= 200 && $response->getStatus() < 300) {
            $this->status = 'success';
            $this->handleSuccess($response);
        }
    }

    /**
     * @param HttpResponse $response
     */
    protected function setFailedData(HttpResponse $response): void
    {
        if ($response->getStatus() < 200 || $response->getStatus() >= 300) {
            $this->status = 'failed';
            $this->error = $response->getData()->error->message;
        }
    }
}
