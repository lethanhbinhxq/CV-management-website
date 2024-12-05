<?php
include $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Controllers/auth_middleware.php';
?>


<div class="container my-4 text-center">
    <h1 class="text-uppercase fw-bold text-primary">My CV</h1>
    <div class="row">
    
    <?php
    // Include card rendering and pagination logic
    include 'Views/Components/cardCV.php';

    // Set the current page and number of CVs per page
    $currentPage = isset($_GET['paging']) ? (int)$_GET['paging'] : 1; // Default to page 1
    $limit = 8; // Number of CVs per page

    // Render CV cards with pagination for the user's own CVs
    renderCVCardsWithPagination($currentPage, $limit, true);
    ?>
    </div>
</div>
