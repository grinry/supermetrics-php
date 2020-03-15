<?php

if (!function_exists('array_get')) {
    /**
     * Returns array key value or provided default value if it does not exist.
     * @param array $array
     * @param string|integer $key
     * @param mixed $default
     * @return mixed|null
     */
    function array_get(array $array, $key, $default = null)
    {
        return array_key_exists($key, $array) ? $array[$key] : $default;
    }
}
