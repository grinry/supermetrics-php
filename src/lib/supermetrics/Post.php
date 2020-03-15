<?php

namespace App\Lib\Supermetrics;

use DateTime;
use JsonSerializable;

/**
 * Class Post
 * @package App\Lib\Supermetrics
 */
class Post implements JsonSerializable
{
    protected $id;
    protected $from_name;
    protected $from_id;
    protected $message;
    protected $type;
    protected $created_time;

    /**
     * PostResponse constructor.
     * @param object $item
     */
    public function __construct(object $item)
    {
        $this->id = $item->{'id'};
        $this->from_name = $item->{'from_name'};
        $this->from_id = $item->{'from_id'};
        $this->message = $item->{'message'};
        $this->type = $item->{'type'};
        $this->created_time = DateTime::createFromFormat("Y-m-d\TH:i:sO", $item->{'created_time'});
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->from_name;
    }

    /**
     * @return string
     */
    public function getFromId()
    {
        return $this->from_id;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * @return DateTime
     */
    public function getCreatedTime()
    {
        return $this->created_time;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
