<?php

namespace App\Lib\Handlers;

use App\Services\Interfaces\StatsHandlerInterface;

/**
 * Class Handler
 * @package App\Lib\Handlers
 */
abstract class Handler implements StatsHandlerInterface
{
    /** @var  */
    protected $data;

    /**
     * @param $data
     */
    public function __invoke($data)
    {
        $this->data = $data;
    }
}
