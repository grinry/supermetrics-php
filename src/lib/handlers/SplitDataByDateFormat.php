<?php

namespace App\Lib\Handlers;

/**
 *
 * Class SplitDataByMonth
 * @package App\Lib\Handlers
 */
class SplitDataByDateFormat extends Handler
{
    protected $items = [];
    protected $dateFormat;
    protected $dateColumn;

    /**
     * SplitDataByDateFormat constructor.
     * @param string $dateFormat
     * @param string $dateColumn
     */
    public function __construct(string $dateFormat = 'Y-m-d', string $dateColumn = 'date')
    {
        $this->dateFormat = $dateFormat;
        $this->dateColumn = $dateColumn;
    }

    /**
     * @return array
     */
    public function handle()
    {
        foreach ($this->data as $post) {
            $month = $post[$this->dateColumn]->format($this->dateFormat);
            if (!array_key_exists($month, $this->items)) {
                $this->items[$month] = [];
            }
            array_push($this->items[$month], $post);
        }
        return $this->items;
    }
}
