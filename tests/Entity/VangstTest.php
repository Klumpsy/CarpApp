<?php

use \PHPUnit\Framework\TestCase;
use App\Entity\Vangst;

class VangstTest extends TestCase
{
    public function testIfWeightIsStored()
    {
        $vangst = new Vangst();

        $vangst->setGewicht(20);

        $this->assertSame(20.0, $vangst->getGewicht());
    }

    public function testIfNotesAreStored()
    {
        $vangst = new Vangst();
        $vangst->setAantekeningen('Dit zijn de aantekeningen');

        $this->assertSame('Dit zijn de aantekeningen', $vangst->getAantekeningen());
    }

}