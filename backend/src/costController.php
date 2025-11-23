<?php

require_once __DIR__ . '/VehicleFees.php';

function calculateCost() {
    $body = file_get_contents('php://input');
    $data = json_decode($body, true);

    if ($data === null || !isset($data['basePrice']) || !isset($data['vehicleType'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input']);
        return;
    }

    $basePrice = (float)$data['basePrice'];
    $vehicleType = $data['vehicleType'];

    // Basic fee percentage
    $vehicleFeeService = new VehicleFeeService();
    $calculatedFees = $vehicleFeeService->calculateFees($basePrice, $vehicleType);

    // All fees for frontend
    $fees = [
        ['name' => 'Basic fees', 'amount' => $calculatedFees['basicFee']],
        ['name' => 'Seller\'s specific charges', 'amount' => $calculatedFees['sellerFee']],
        ['name' => 'Additional association charges', 'amount' => $calculatedFees['associationFee']],
        ['name' => 'Warehousing fees', 'amount' => 100.0],
    ];

    // Sum fees
    $totalFees = array_reduce($fees, function ($sum, $fee) {
        return $sum + $fee['amount'];
    }, 0);

    // Final cost
    $totalCost = $basePrice + $totalFees;

    echo json_encode([
        'fees' => $fees,
        'totalCost' => $totalCost
    ]);
}