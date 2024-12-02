<?php

function getCvById($conn, $cvId) {
    try {
        $stmt = $conn->prepare("SELECT * FROM cvs WHERE id = ?");
        $stmt->bind_param("i", $cvId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Return CV details as an associative array
        } else {
            return null; // Return null if no CV is found
        }
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}
