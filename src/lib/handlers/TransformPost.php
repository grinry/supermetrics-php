<?php

namespace App\Lib\Handlers;

/**
 *
 * Class SplitDataByMonth
 * @package App\Lib\Handlers
 */
class TransformPost extends Handler
{
    protected $callable = null;

    /**
     * SplitDataByDateFormat constructor.
     * @param callable $callable
     */
    public function __construct(Callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * @return array
     */
    public function handle()
    {
        return array_map($this->callable, $this->data);
    }
}
