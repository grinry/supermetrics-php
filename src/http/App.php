<?php

namespace App\Http;

use App\Http\Interfaces\CookieManagerInterface;
use App\Http\Interfaces\ResponseInterface;

/**
 * Class App
 * @package App\Http
 * @property-read CookieManagerInterface $cookies
 * @property-read JsonResponse $response
 */
class App
{
    /** @var CookieManagerInterface */
    protected $_cookies;
    /** @var ResponseInterface  */
    protected $_response;

    /**
     * App constructor.
     * @param CookieManagerInterface $cookies
     * @param ResponseInterface $response
     */
    public function __construct(CookieManagerInterface $cookies, ResponseInterface $response)
    {
        $this->_cookies = $cookies;
        $this->_response = $response;
    }

    /**
     * Fakes read-only properties.
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->{"_$name"} ?? null;
    }
}
