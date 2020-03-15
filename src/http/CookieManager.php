<?php

namespace App\Http;

use App\Http\Interfaces\CookieManagerInterface;

/**
 * Class CookieManager
 * @package App\Http
 */
class CookieManager implements CookieManagerInterface
{
    /**
     * @param string $key
     * @param mixed $value
     * @param int $expireAfterSeconds
     * @param string $path
     */
    public function set(string $key, $value, int $expireAfterSeconds = 0, $path = '/')
    {
        setcookie($key, $value, time() + $expireAfterSeconds, $path);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $this->has($key) ? $_COOKIE[$key] : null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }
}
