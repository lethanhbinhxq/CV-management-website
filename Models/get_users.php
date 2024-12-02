<?php
include 'db_connect.php';

header('Content-Type: application/json');

try {
    // Query to select users
    $query = "SELECT id, full_name FROM users";
    $result = $conn->query($query);

    if ($result === false) {
        throw new Exception("Failed to execute query: " . $conn->error);
    }

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row; // Add each user to the array
    }

    echo json_encode($users);
} catch (Exception $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => $e->getMessage()]);
}