<?php

namespace App\Lib\Handlers;

/**
 * Class SumKeyValueHandler
 * @package App\Lib\Handlers
 */
class SumKeyValueHandler extends Handler
{
    /**
     * @return array
     */
    public function handle()
    {
        $items = [];
        foreach ($this->data as $key => $data) {
            $items[$key] = count($data);
        }
        return $items;
    }
}
