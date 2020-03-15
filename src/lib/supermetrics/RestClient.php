<?php

namespace App\Lib\Supermetrics;

use App\Http\HttpClient;
use Exception;

/**
 * Class RestClient
 * @package App\Lib\Supermetrics
 */
class RestClient
{
    /** @var HttpClient */
    private $client;

    /**
     * HttpClient constructor.
     */
    public function __construct()
    {
        $this->client = new HttpClient([
            'base_url' => getenv('API_ENDPOINT'),
        ]);
    }

    /**
     * @param string $email
     * @param string $name
     * @return AuthorizationResponse
     * @throws Exception
     */
    public function register(string $email, string $name)
    {
        $response = $this->client->post('/assignment/register', json_encode([
            'client_id' => getenv('API_CLIENT_ID'),
            'email' => $email,
            'name' => $name,
        ]));

        return new AuthorizationResponse($response);
    }

    /**
     * @param string $token
     * @param int $page
     * @return PostsResponse
     * @throws Exception
     */
    public function posts(string $token, int $page = 1)
    {
        $response = $this->client->get('/assignment/posts?sl_token=' . $token . '&page=' . $page);

        return new PostsResponse($response);
    }

    /**
     * @param array $data
     * @return array
     */
    protected function sendSuccess(array $data): array
    {
        return array_merge(
            ['status' => 'success'],
            $data
        );
    }

    /**
     * @param int|string $code
     * @param string $message
     * @return array
     */
    protected function sendFailed($code, string $message): array
    {
        return [
            'status' => 'failed',
            'code' => $code,
            'error' => $message,
        ];
    }
}
