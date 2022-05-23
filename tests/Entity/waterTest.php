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

    /**
     * @dataProvider getSpecificationTestsBadges
     */
    public function test_it_saves_the_right_badges(bool $expectedBig, bool $expectedSmall, bool $expectedCrayfish, bool $expectedHard)
    {
        $this->water->setBigFish($expectedBig);
        $this->water->setSmallFish($expectedSmall);
        $this->water->setKreeften($expectedCrayfish);
        $this->water->setMoeilijk($expectedHard);

        if ($expectedBig) {
           $this->assertSame(true, $this->water->isBigFish());
           $this->assertSame(false, $this->water->isMoeilijk());
           $this->assertSame(false, $this->water->isKreeften());
           $this->assertSame(false, $this->water->isSmallFish());
        }
        if ($expectedSmall) {
            $this->assertSame(false, $this->water->isBigFish());
            $this->assertSame(false, $this->water->isMoeilijk());
            $this->assertSame(false, $this->water->isKreeften());
            $this->assertSame(true, $this->water->isSmallFish());
        }
        if ($expectedCrayfish) {
            $this->assertSame(false, $this->water->isBigFish());
            $this->assertSame(false, $this->water->isMoeilijk());
            $this->assertSame(true, $this->water->isKreeften());
            $this->assertSame(false, $this->water->isSmallFish());
        }
        if ($expectedHard) {
            $this->assertSame(false, $this->water->isBigFish());
            $this->assertSame(true, $this->water->isMoeilijk());
            $this->assertSame(false, $this->water->isKreeften());
            $this->assertSame(false, $this->water->isSmallFish());
        }
    }

    public function getSpecificationTestsBadges(): array
    {
        return [
            [false, false, false, true],
            [false, false, true, false],
            [false, true, false, false],
            [true, false, false, false]
        ];
    }

}
