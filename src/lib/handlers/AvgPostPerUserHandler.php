<?php

namespace App\Lib\Handlers;

/**
 * Class AvgPostPerUserHandler
 * @package App\Lib\Handlers
 */
class AvgPostPerUserHandler extends Handler
{
    /**
     * @return array
     */
    public function handle()
    {
        $items = [];
        foreach ($this->data as $key => $data) {
            $total_posts = count($data);
            $users = array_keys(
                array_count_values(
                    array_column($data, 'from_id')
                )
            );
            $items[$key] = $total_posts / count($users);
        }
        return $items;
    }
}
