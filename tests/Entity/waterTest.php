<?php

use \PHPUnit\Framework\TestCase;
use App\Entity\Water;

class WaterTest extends TestCase
{
    private $water;

    protected function setUp():void
    {
        $this->water = new Water();
    }

    public function test_water_name_can_be_set()
    {

        $this->water->setName('Kanaal');
        $waterName = $this->water->getName();

        $this->assertSame('Kanaal', $waterName);
    }

    public function test_water_saves_BigFish_badge()
    {
        $this->water->setBigFish(true);
        $this->assertSame(true, $this->water->isBigFish());
    }

    public function test_water_saves_crayfish_badge()
    {
        $this->water->setKreeften(true);
        $this->assertSame(true, $this->water->isKreeften());
    }

    public function test_water_saves_small_fish_badge()
    {
        $this->water->setSmallFish(true);
        $this->assertSame(true, $this->water->isSmallFish());
    }

    public function test_water_saves_hard_water()
    {
        $this->water->setMoeilijk(true);
        $this->assertSame(true, $this->water->isMoeilijk());
    }

}
