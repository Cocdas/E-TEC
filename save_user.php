<?php
header('Content-Type: application/json');

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);

// Validate data
if (empty($data['username']) || empty($data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Username හෝ Password හිස්ව තැබිය නොහැක']);
    exit;
}

// Check if user already exists
$filename = 'users.txt';
$users = [];

if (file_exists($filename)) {
    $fileContent = file_get_contents($filename);
    $users = json_decode($fileContent, true) ?: [];
    
    foreach ($users as $user) {
        if ($user['username'] === $data['username']) {
            echo json_encode(['success' => false, 'message' => 'මෙම Username එක දැනටමත් පවතියි']);
            exit;
        }
    }
}

// Add new user
$users[] = $data;

// Save to file
if (file_put_contents($filename, json_encode($users, JSON_PRETTY_PRINT)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'File save failed']);
}
?>
