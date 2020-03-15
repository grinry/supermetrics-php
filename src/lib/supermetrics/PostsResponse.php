<?php

namespace App\Lib\Supermetrics;

use App\Http\HttpResponse;

/**
 * Class PostsResponse
 * @package App\Lib\Supermetrics
 */
class PostsResponse extends RestResponse
{
    /** @var int */
    protected $page;
    /** @var Post[] */
    protected $posts = [];

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return Post[]
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param HttpResponse $response
     */
    protected function handleSuccess(HttpResponse $response): void
    {
        $data = $response->getData()->data;
        $this->page = $data->page;

        foreach ($data->posts as $post) {
            $this->posts[] = new Post($post);
        }
    }
}
