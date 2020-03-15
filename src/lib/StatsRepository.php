<?php

namespace App\Lib;

use App\Lib\Handlers\AvgKeyValueHandler;
use App\Lib\Handlers\AvgPostPerUserHandler;
use App\Lib\Handlers\LongestValueHandler;
use App\Lib\Handlers\ReturnPost;
use App\Lib\Handlers\SplitDataByDateFormat;
use App\Lib\Handlers\SumKeyValueHandler;
use App\Lib\Handlers\TransformPost;
use App\Lib\Supermetrics\Post;
use App\Services\StatsBuilder;

/**
 * "Repository" for defining stats "queries".
 * Class StatsRepository
 * @package App\Lib
 */
class StatsRepository
{
    /** @var array */
    protected $posts;

    /**
     * StatsRepository constructor.
     * @param array $posts
     */
    public function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @return array
     */
    public function getAvgPostCharactersForEachMonth()
    {
        return (new StatsBuilder())
            ->handlers([
                new TransformPost(function(Post $post) {
                    return [
                        'key' => $post->getCreatedTime(),
                        'value' => strlen($post->getMessage()),
                    ];
                }),
                new SplitDataByDateFormat('Y-m', 'key'),
                new AvgKeyValueHandler,
            ])
            ->process($this->posts);
    }

    /**
     * @return array
     */
    public function getLongestPostForEachMonth()
    {
        return (new StatsBuilder())
            ->handlers([
                new TransformPost(function(Post $post) {
                    return [
                        'key' => $post->getCreatedTime(),
                        'value' => strlen($post->getMessage()),
                        'post' => $post,
                    ];
                }),
                new SplitDataByDateFormat('Y-m', 'key'),
                new LongestValueHandler,
                new ReturnPost,
            ])
            ->process($this->posts);
    }

    /**
     * @return array
     */
    public function getTotalPostsSplitByWeek()
    {
        return (new StatsBuilder())
            ->handlers([
                new TransformPost(function(Post $post) {
                    return [
                        'key' => $post->getCreatedTime(),
                        'value' => strlen($post->getMessage()),
                    ];
                }),
                new SplitDataByDateFormat('W, Y', 'key'),
                new SumKeyValueHandler,
            ])
            ->process($this->posts);
    }

    /**
     * @return array
     */
    public function getAvgNumberOfPostsPerUserPerMonth()
    {
        return (new StatsBuilder())
            ->handlers([
                new TransformPost(function(Post $post) {
                    return [
                        'key' => $post->getCreatedTime(),
                        'from_id' => $post->getFromId(),
                    ];
                }),
                new SplitDataByDateFormat('Y-m', 'key'),
                new AvgPostPerUserHandler,
            ])
            ->process($this->posts);
    }
}
