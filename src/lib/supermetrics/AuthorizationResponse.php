<?php

namespace App\Lib\Supermetrics;

use App\Http\HttpResponse;

/**
 * Class AuthorizationResponse
 * @package App\Lib\Supermetrics
 */
class AuthorizationResponse extends RestResponse
{
    /** @var string */
    protected $token;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param HttpResponse $response
     */
    protected function handleSuccess(HttpResponse $response): void
    {
        $this->token = $response->getData()->data->sl_token;
    }
}
