<?php

namespace Tests\Unit;

use App\Lib\Handlers\TransformPost;
use App\Services\StatsBuilder;
use PHPUnit\Framework\TestCase;

final class StatsBuilderTest extends TestCase
{

    public $data = [1, 2, 3, 4, 5, 6, 7, 8, 9];

    public function testCanReturnWithoutHandlersData(): void
    {
        $builder = new StatsBuilder;
        $result = $builder->process($this->data);

        $this->assertEquals($this->data, $result);
    }

    public function testCanReturnWithHandlersData(): void
    {
        $builder = new StatsBuilder;
        $builder->handlers([
            new TransformPost(function($item) {
                return $item * 2;
            })
        ]);
        $result = $builder->process($this->data);

        $expected = array_map(function($item) { return $item * 2; }, $this->data);

        $this->assertEquals($expected, $result);
    }
}
