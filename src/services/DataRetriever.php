<?php

namespace App\Services;

use App\Lib\Supermetrics\Post;
use App\Lib\Supermetrics\RestClient;
use App\Services\Interfaces\AuthenticationInterface;
use App\Services\Interfaces\DataRetrieverInterface;

/**
 * Class DataRetriever
 * @package App\Services
 */
class DataRetriever implements DataRetrieverInterface
{
    /** @var AuthenticationInterface */
    protected $authenticator;
    /** @var RestClient */
    protected $client;

    /** @var Post[] */
    protected $items = [];

    /**
     * DataRetriever constructor.
     * @param AuthenticationInterface $authenticator
     * @param RestClient $client
     */
    public function __construct(AuthenticationInterface $authenticator, RestClient $client)
    {
        $this->authenticator = $authenticator;
        $this->client = $client;
    }

    /**
     * @param int $firstPage
     * @param int $lastPage
     * @return Post[]
     * @throws \Exception
     */
    public function getData($firstPage = 1, $lastPage = 10)
    {
        $page = $firstPage;
        while ($page <= $lastPage) {
            $posts = $this->getPage($page)->getPosts();
            array_push($this->items, ...$posts);
            $page++;
        }
        return $this->items;
    }

    /**
     * @param int $page
     * @return \App\Lib\Supermetrics\PostsResponse
     * @throws \Exception
     */
    protected function getPage(int $page = 1)
    {
        return $this->client->posts(
            $this->authenticator->getAccessToken(),
            $page
        );
    }

}
