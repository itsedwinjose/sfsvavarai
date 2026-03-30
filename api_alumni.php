<?php
header('Content-Type: application/json');

$year = isset($_GET['year']) ? trim($_GET['year']) : '';

// Validate year - must be numeric and reasonable
if (!preg_match('/^\d{4}$/', $year)) {
    echo json_encode(['error' => 'Invalid year parameter.']);
    http_response_code(400);
    exit;
}

$filepath = "assets/data/alumni/{$year}.csv";

if (!file_exists($filepath)) {
    echo json_encode(['error' => 'No data found for the selected year.']);
    http_response_code(404);
    exit;
}

$sections = [];

if (($handle = fopen($filepath, "r")) !== FALSE) {
    // Skip header row
    $header = fgetcsv($handle, 1000, ",");

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if (count($data) < 3) continue;
        $name    = trim($data[0]);
        $email   = trim($data[1]);
        $section = trim($data[2]);

        if (!empty($name) && !empty($section)) {
            if (!isset($sections[$section])) {
                $sections[$section] = [];
            }
            $sections[$section][] = [
                'name'  => htmlspecialchars($name),
                'email' => htmlspecialchars($email)
            ];
        }
    }
    fclose($handle);
}

// Sort sections alphabetically
ksort($sections);

echo json_encode(['year' => $year, 'sections' => $sections]);
