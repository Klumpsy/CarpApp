<?php

use \PHPUnit\Framework\TestCase;
use App\Entity\Vangst;
use App\Entity\Water;

class VangstTest extends TestCase
{
    public function testIfWeightIsStored()
    {
        $vangst = new Vangst();

        $vangst->setGewicht(20);
        $gewicht = $vangst->getGewicht();

        $this->assertEquals(20, $gewicht);
    }

}
