<?php
include 'db_connect.php';

// Set content type to JSON
header('Content-Type: application/json');

if (isset($_GET['keyword'])) {
    $keyword = '%' . $_GET['keyword'] . '%';

    // Search by full_name
    $stmtFullName = $conn->prepare("SELECT DISTINCT full_name FROM cvs WHERE full_name LIKE ? LIMIT 10");
    $stmtFullName->bind_param("s", $keyword);
    $stmtFullName->execute();
    $resultFullName = $stmtFullName->get_result();

    $fullNames = [];
    while ($row = $resultFullName->fetch_assoc()) {
        if (!empty($row['full_name'])) {
            $fullNames[] = $row['full_name'];
        }
    }

    // Search by job_title
    $stmtJobTitle = $conn->prepare("SELECT DISTINCT job_title FROM cvs WHERE job_title LIKE ? LIMIT 10");
    $stmtJobTitle->bind_param("s", $keyword);
    $stmtJobTitle->execute();
    $resultJobTitle = $stmtJobTitle->get_result();

    $jobTitles = [];
    while ($row = $resultJobTitle->fetch_assoc()) {
        if (!empty($row['job_title'])) {
            $jobTitles[] = $row['job_title'];
        }
    }

    // Combine full names and job titles into a single response
    $response = [
        'full_names' => array_unique($fullNames),  // Unique full names
        'job_titles' => array_unique($jobTitles)   // Unique job titles
    ];

    echo json_encode($response);
    exit();
} else {
    // Return error if keyword is not set
    echo json_encode(['error' => 'No search keyword provided.']);
    exit();
}