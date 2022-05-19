<?php

use \PHPUnit\Framework\TestCase;
use App\Entity\Water;

class WaterTest extends TestCase
{
    public function test_water_name_can_be_set()
    {
        $water = new Water();
        $water->setName('Kanaal');
        $waterName = $water->getName();

        $this->assertSame('Kanaal', $waterName);
    }

}
