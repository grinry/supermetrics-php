<?php

namespace App\Services;

use App\Services\Interfaces\StatsBuilderInterface;

/**
 * Class StatsBuilder
 * @package App\Services
 */
class StatsBuilder implements StatsBuilderInterface
{
    protected $handlers = [];
    protected $items = [];

    /**
     * @param array $handlers
     * @return StatsBuilder
     */
    public function handlers(array $handlers): StatsBuilder
    {
        $this->handlers = $handlers;
        return $this;
    }

    /**
     * @param array $items
     * @return array
     */
    public function process(array $items)
    {
        $this->items = $items;
        foreach ($this->handlers as $handler) {
            $handler($this->items);
            $this->items = $handler->handle();
        }
        return $this->items;
    }
}
