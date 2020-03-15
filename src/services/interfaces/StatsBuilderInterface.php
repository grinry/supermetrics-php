<?php

namespace App\Services\Interfaces;

interface StatsBuilderInterface
{
    public function handlers(array $handlers);
    public function process(array $items);
}
