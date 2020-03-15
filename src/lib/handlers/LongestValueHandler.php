<?php

namespace App\Lib\Handlers;

/**
 * Class LongestValueHandler
 * @package App\Lib\Handlers
 */
class LongestValueHandler extends Handler
{
    /**
     * @return array
     */
    public function handle()
    {
        $items = [];
        foreach ($this->data as $key => $data) {
            $longest = null;
            foreach ($data as $post) {
                if ($longest == null || $longest['value'] < $post['value']) {
                    $longest = $post;
                }
            }
            $items[$key] = $longest;
        }
        return $items;
    }
}
