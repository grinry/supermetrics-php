<?php

namespace App\Services\Interfaces;

use App\Lib\Supermetrics\Post;

/**
 * Interface DataRetrieverInterface
 * @package App\Services
 */
interface DataRetrieverInterface
{
    /**
     * @param int $firstPage
     * @param int $lastPage
     * @return Post[]
     */
    public function getData(int $firstPage = 1, int $lastPage = 10);
}