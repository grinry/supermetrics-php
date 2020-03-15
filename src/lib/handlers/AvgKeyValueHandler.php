<?php

namespace App\Lib\Handlers;

/**
 * Class AvgKeyValueHandler
 * @package App\Lib\Handlers
 */
class AvgKeyValueHandler extends Handler
{
    /**
     * @return array
     */
    public function handle()
    {
        $items = [];
        foreach ($this->data as $key => $data) {
            $characters = array_sum(array_column($data, 'value'));
            $items[$key] = $characters / count($data);
        }
        return $items;
    }
}
