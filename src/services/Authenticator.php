<?php

namespace App\Services;

use App\Http\App;
use App\Lib\Supermetrics\AuthorizationResponse;
use App\Lib\Supermetrics\RestClient;
use App\Services\Interfaces\AuthenticationInterface;
use Exception;

/**
 * Class Authenticator
 * @package App\Services
 */
class Authenticator implements AuthenticationInterface
{
    /** @var App */
    protected $app;
    /** @var RestClient */
    protected $client;

    /** @var string */
    protected $accessToken;
    /** @var int */
    protected $accessTokenExpiresAt;

    /**
     * Authenticator constructor.
     * @param App $app
     * @param RestClient $client
     */
    public function __construct(App $app, RestClient $client)
    {
        $this->app = $app;
        $this->client = $client;
    }

    /**
     * Retrieves access token from instance properties, cookies or registers new one if all expired.
     * @return string
     * @throws Exception
     */
    public function getAccessToken(): string
    {
        if ($this->accessToken && $this->accessTokenExpiresAt > time()) {
            return $this->accessToken;
        }

        if (
            ($token = $this->app->cookies->get('access-token'))
            && ($expiresAt = $this->app->cookies->get('access-token-expires-at')) > time()
        ) {
            $this->accessToken = $token;
            $this->accessTokenExpiresAt = $expiresAt;
            return $token;
        }

        return $this->registerNewToken();
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function registerNewToken()
    {
        $response = $this->client->register(getenv('USER_EMAIL'), getenv('USER_NAME'));
        if ($response->getStatus() == AuthorizationResponse::STATUS_SUCCESS) {
            $this->setAccessToken($response->getToken(), time() * 60 * 60);
            return $response->getToken();
        }
        throw new Exception($response->getError());
    }

    /**
     * @param string $accessToken
     * @param int $expiresAt
     */
    protected function setAccessToken(string $accessToken, int $expiresAt): void
    {
        $this->accessToken = $accessToken;
        $this->accessTokenExpiresAt = $expiresAt;
        $this->app->cookies->set('access-token', $accessToken, 60 * 60);
        $this->app->cookies->set('access-token-expires-at', $expiresAt, 60 * 60);
    }

}
