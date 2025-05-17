<?php
header('Content-Type: application/json');

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);

$filename = 'users.txt';

if (!file_exists($filename)) {
    echo json_encode(['success' => false, 'message' => 'User database not found']);
    exit;
}

$fileContent = file_get_contents($filename);
$users = json_decode($fileContent, true) ?: [];

foreach ($users as $user) {
    if ($user['username'] === $data['username'] && $user['password'] === $data['password']) {
        echo json_encode(['success' => true]);
        exit;
    }
}

echo json_encode(['success' => false, 'message' => 'Username හෝ Password වැරදියි']);
?>
