<?php
use PHPUnit\Framework\TestCase;

// Include the file with your function
require_once __DIR__ . '/../src/VehicleFees.php';

final class FunctionsTest extends TestCase
{
    public function testCalculateFeesStandard()
    {
        $fees = calculateFees(1000, 'standard');

        $this->assertEquals(50, $fees['basicFee']);  
        $this->assertEquals(20, $fees['sellerFee']);  
        $this->assertEquals(15, $fees['associationFee']); 
    }

    public function testCalculateFeesLuxury()
    {
        $fees = calculateFees(1200, 'luxury');

        $this->assertEquals(200, $fees['basicFee']);  
        $this->assertEquals(48, $fees['sellerFee']);  
        $this->assertEquals(15, $fees['associationFee']); 
    }
}
