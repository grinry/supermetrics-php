<?php

namespace App\Http;

use Exception;

/**
 * Curl wrapper with post & get functionality.
 * Supports authentication.
 *
 * Class HttpClient
 * @package App
 */
class HttpClient
{
    /** @var string */
    protected $base_url;
    /** @var array */
    protected $headers;

    /**
     * HttpClient constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->base_url = array_get($options, 'base_url');
        $this->headers = array_get($options, 'headers', [
            'content-type' => 'application/json',
            'accept' => 'application/json',
        ]);
    }

    /**
     * @param string $endpoint
     * @param array $options
     * @return HttpResponse
     * @throws Exception
     */
    public function request(string $endpoint, array $options = [])
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->buildEndpoint($endpoint));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $this->handleRequestMethod($options, $curl);
        $this->handleRequestHeaders($options, $curl);

        $result = curl_exec($curl);
        if ($result == false) {
            throw new Exception(curl_error($curl));
        }

        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        return new HttpResponse($http_status, $result);
    }

    /**
     * @param string $endpoint
     * @param array|string $body
     * @param array $options
     * @return HttpResponse
     * @throws Exception
     */
    public function post(string $endpoint, $body, array $options = [])
    {
        return $this->request(
            $endpoint,
            array_merge(
                $options,
                [
                    'method' => 'POST',
                    'body' => $body
                ]
            )
        );
    }

    /**
     * @param string $endpoint
     * @param array $options
     * @return HttpResponse
     * @throws Exception
     */
    public function get(string $endpoint, array $options = [])
    {
        return $this->request(
            $endpoint,
            array_merge(
                $options,
                ['method' => 'GET']
            )
        );
    }


    /**
     * Returns given url with base url if any.
     * @param string $url
     * @return string
     */
    protected function buildEndpoint(string $url): string
    {
        if ($this->base_url) {
            return join('/', [trim($this->base_url, '/'), trim($url, '/')]);
        }
        return $url;
    }

    /**
     * @param array $options
     * @param $curl
     */
    protected function handleRequestMethod(array $options, $curl)
    {
        switch (strtolower(array_get($options, 'method'))) {
            default:
            case 'get':
                break;
            case 'post':
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, array_get($options, 'body', []));
                break;
        }
    }

    /**
     * @param array $options
     * @param $curl
     */
    protected function handleRequestHeaders(array $options, $curl)
    {
        $headers = array_merge(
            $this->headers,
            array_get($options, 'headers', [])
        );
        $request_headers = array();

        foreach ($headers as $key => $value) {
            $request_headers[] = "$key: $value";
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
    }

}
