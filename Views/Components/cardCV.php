<?php
function renderCvCard($name, $jobTitle, $cvId)
{
    $detailsUrl = "index.php?page=detailCV&id=" . urlencode($cvId);
    echo "
    <div class='col-sm-3 mb-3'>
        <div class='card product-card p-2'>
            <div class='container-fluid p-5 bg-secondary ratio ratio-16x9'></div>
            <div class='card-body'>
                <h5 class='card-title'>$name</h5>
                <p class='price'>$jobTitle</p>
                <a href='$detailsUrl' class='btn btn-primary'>View details</a>
            </div>
        </div>
    </div>";
}

function renderCVCardsWithPagination($currentPage, $limit, $isMyCV = false, $keyword = null)
{
    include $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Models/db_connect.php';
    $offset = ($currentPage - 1) * $limit;

    // Check if the user is logged in
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    try {
        // Build the base query
        if ($isMyCV && $userId) {
            $baseQuery = "SELECT id, full_name, job_title FROM cvs WHERE user_id = ?";
        } else {
            $baseQuery = "SELECT id, full_name, job_title FROM cvs WHERE visibility = 'Public'";
            if ($userId) {
                $baseQuery .= " OR visibility = 'All Users' OR id IN (SELECT cv_id FROM viewers WHERE viewer_id = ?)";
            }
        }

        // Add search functionality with case-insensitive matching
        if (!empty($keyword)) {
            $baseQuery .= " AND (LOWER(full_name) LIKE LOWER(?) OR LOWER(job_title) LIKE LOWER(?))";
        }

        // Add pagination
        $baseQuery .= " LIMIT ? OFFSET ?";

        // Prepare the count query
        $countQuery = "SELECT COUNT(*) AS total FROM cvs WHERE visibility = 'Public'";
        if ($userId) {
            $countQuery .= " OR visibility = 'All Users' OR id IN (SELECT cv_id FROM viewers WHERE viewer_id = ?)";
        }
        if ($isMyCV && $userId) {
            $countQuery = "SELECT COUNT(*) AS total FROM cvs WHERE user_id = ?";
        }
        if (!empty($keyword)) {
            $countQuery .= " AND (LOWER(full_name) LIKE LOWER(?) OR LOWER(job_title) LIKE LOWER(?))";
        }

        // Execute the count query
        $countResult = $conn->prepare($countQuery);
        if ($userId && !empty($keyword)) {
            $searchTerm = '%' . strtolower($keyword) . '%';
            $countResult->bind_param("iss", $userId, $searchTerm, $searchTerm);
        } elseif ($userId) {
            $countResult->bind_param("i", $userId);
        } elseif (!empty($keyword)) {
            $searchTerm = '%' . strtolower($keyword) . '%';
            $countResult->bind_param("ss", $searchTerm, $searchTerm);
        }
        $countResult->execute();
        $countRow = $countResult->get_result()->fetch_assoc();
        $totalCvs = $countRow['total'];
        $totalPages = ceil($totalCvs / $limit);

        // Execute the main query
        $stmt = $conn->prepare($baseQuery);
        if ($userId && !empty($keyword)) {
            $searchTerm = '%' . strtolower($keyword) . '%';
            $stmt->bind_param("issii", $userId, $searchTerm, $searchTerm, $limit, $offset);
        } elseif ($userId) {
            $stmt->bind_param("iii", $userId, $limit, $offset);
        } elseif (!empty($keyword)) {
            $searchTerm = '%' . strtolower($keyword) . '%';
            $stmt->bind_param("ssii", $searchTerm, $searchTerm, $limit, $offset);
        } else {
            $stmt->bind_param("ii", $limit, $offset);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        // Render CV cards
        while ($row = $result->fetch_assoc()) {
            renderCvCard($row['full_name'], $row['job_title'], $row['id']);
        }

        // Render pagination
        echo "<nav aria-label='Pagination'>";
        echo "<ul class='pagination justify-content-center'>";

        // Previous button
        if ($currentPage > 1) {
            echo "<li class='page-item'>
            <a class='page-link custom-page-link' href='index.php?page=" . ($keyword ? "searchCV" : "viewCV") . "&paging=" . ($currentPage - 1) . "&keyword=" . urlencode($keyword) . "' aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
            </a>
          </li>";
        } else {
            echo "<li class='page-item disabled'>
            <span class='page-link custom-page-link' aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
            </span>
          </li>";
        }

        // Page numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<li class='page-item " . ($i == $currentPage ? 'active' : '') . "'>
            <a class='page-link custom-page-link' href='index.php?page=" . ($keyword ? "searchCV" : "viewCV") . "&paging=$i&keyword=" . urlencode($keyword) . "'>$i</a>
          </li>";
        }

        // Next button
        if ($currentPage < $totalPages) {
            echo "<li class='page-item'>
            <a class='page-link custom-page-link' href='index.php?page=" . ($keyword ? "searchCV" : "viewCV") . "&paging=" . ($currentPage + 1) . "&keyword=" . urlencode($keyword) . "' aria-label='Next'>
                <span aria-hidden='true'>&raquo;</span>
            </a>
          </li>";
        } else {
            echo "<li class='page-item disabled'>
            <span class='page-link custom-page-link' aria-label='Next'>
                <span aria-hidden='true'>&raquo;</span>
            </span>
          </li>";
        }

        echo "</ul>";
        echo "</nav>";

    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}