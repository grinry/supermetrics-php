<?php

namespace App\Services\Interfaces;

/**
 * Interface AuthenticationInterface
 * @package App\Services\Interfaces
 */
interface AuthenticationInterface
{
    /**
     * @return string
     */
    public function getAccessToken(): string;
}
