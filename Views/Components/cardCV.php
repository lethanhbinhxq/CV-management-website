<?php
function renderCvCard($name, $jobTitle, $cvId) {
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

function renderCVCardsWithPagination($currentPage, $limit) {
    include $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Models/db_connect.php';
    $offset = ($currentPage - 1) * $limit;

    try {
        // Count total CVs
        $result = $conn->query("SELECT COUNT(*) AS total FROM cvs");
        $row = $result->fetch_assoc();
        $totalCvs = $row['total'];
        $totalPages = ceil($totalCvs / $limit);

        // Fetch CV data
        $stmt = $conn->prepare("SELECT id, full_name, job_title FROM cvs LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
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
                    <a class='page-link custom-page-link' href='?paging=" . ($currentPage - 1) . "' aria-label='Previous'>
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
                    <a class='page-link custom-page-link' href='?paging=$i'>$i</a>
                  </li>";
        }

        // Next button
        if ($currentPage < $totalPages) {
            echo "<li class='page-item'>
                    <a class='page-link custom-page-link' href='?paging=" . ($currentPage + 1) . "' aria-label='Next'>
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
