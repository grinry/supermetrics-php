<?php

namespace App\Lib\Handlers;

/**
 * Class ReturnPost
 * @package App\Lib\Handlers
 */
class ReturnPost extends Handler
{
    /**
     * @return array
     */
    public function handle()
    {
        return array_map(function($item) { return $item['post']; }, $this->data);
    }
}
