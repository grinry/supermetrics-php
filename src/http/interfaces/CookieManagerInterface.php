<?php

namespace App\Http\Interfaces;

/**
 * Interface CookieManagerInterface
 * @package App\Http\Interfaces
 */
interface CookieManagerInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @param string $key
     * @param $value
     * @param int $expiresAfterSeconds
     * @param string $path
     * @return mixed
     */
    public function set(string $key, $value, int $expiresAfterSeconds = 0, $path = '/');
}
