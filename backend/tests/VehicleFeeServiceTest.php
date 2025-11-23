<?php

require_once __DIR__ . '/../src/VehicleFees.php';

use PHPUnit\Framework\TestCase;

class VehicleFeeServiceTest extends TestCase
{
    public function testStandardVehicleFees()
    {
        $service = new VehicleFeeService();

        $fees = $service->calculateFees(1000, 'standard');

        $this->assertEquals(50, $fees['basicFee']); // max cap for standard
        $this->assertEquals(20, $fees['sellerFee']); // 2% of 1000
        $this->assertEquals(15, $fees['associationFee']); // between 1000–3000
    }

    public function testLuxuryVehicleFees()
    {
        $service = new VehicleFeeService();

        $fees = $service->calculateFees(2000, 'luxury');

        $this->assertEquals(200, $fees['basicFee']); // max cap for luxury
        $this->assertEquals(80, $fees['sellerFee']);  // 4% of 2000
        $this->assertEquals(15, $fees['associationFee']);
    }

    public function testLuxuryMinimumFee()
    {
        $service = new VehicleFeeService();

        $fees = $service->calculateFees(100, 'luxury');

        $this->assertEquals(25, $fees['basicFee']); // min cap for luxury
    }
}
