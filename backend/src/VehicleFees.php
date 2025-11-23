<?php

/**
 * VehicleFeeCalculator
 * Calculates fees based on vehicle type and base price.
 */

interface FeeCalculatorInterface {
    public function calculate(float $basePrice, string $vehicleType): float;
}

class BasicFeeCalculator implements FeeCalculatorInterface {
    public function calculate(float $basePrice, string $vehicleType): float {
        $basicFee = $basePrice * 0.10;
        if ($vehicleType === 'luxury') $basicFee = max(25, min($basicFee, 200));
        if ($vehicleType === 'standard') $basicFee = max(10, min($basicFee, 50));
        return $basicFee;
    }
}

class SellerFeeCalculator implements FeeCalculatorInterface {
    public function calculate(float $basePrice, string $vehicleType): float {
        return $vehicleType === 'luxury' ? $basePrice * 0.04 : $basePrice * 0.02;
    }
}

class AssociationFeeCalculator implements FeeCalculatorInterface {
    public function calculate(float $basePrice, string $vehicleType): float {
        switch (true) {
            case ($basePrice > 3000):
                return 20;
            case ($basePrice > 1000 && $basePrice < 3000):
                return 15;
            case ($basePrice > 500 && $basePrice < 1000):
                return 10;
            case ($basePrice > 1 && $basePrice < 500):
                return 5;
            default:
                return 0;
        }
    }
}

// Central class to combine all fees
class VehicleFeeService {
    private FeeCalculatorInterface $basicFeeCalc;
    private FeeCalculatorInterface $sellerFeeCalc;
    private FeeCalculatorInterface $associationFeeCalc;

    public function __construct() {
        $this->basicFeeCalc = new BasicFeeCalculator();
        $this->sellerFeeCalc = new SellerFeeCalculator();
        $this->associationFeeCalc = new AssociationFeeCalculator();
    }

    public function calculateFees(float $basePrice, string $vehicleType): array {
        return [
            'basicFee' => $this->basicFeeCalc->calculate($basePrice, $vehicleType),
            'sellerFee' => $this->sellerFeeCalc->calculate($basePrice, $vehicleType),
            'associationFee' => $this->associationFeeCalc->calculate($basePrice, $vehicleType),
        ];
    }
}
