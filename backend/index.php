<?php

/**
 * Simple PHP API Router
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit(200);

$path = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

require_once __DIR__ . '/src/costController.php';

if ($path === '/api/calculate-cost' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    calculateCost();
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Not Found']);
