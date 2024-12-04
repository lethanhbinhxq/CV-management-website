<div class="container my-4 text-center">
    <h1 class="text-uppercase fw-bold text-primary">CV Gallery</h1>
    <div class="row">
    
    <?php
    // Include card rendering and pagination logic
    include 'Views/Components/cardCV.php';

    // Set the current page and number of CVs per page
    $currentPage = isset($_GET['paging']) ? (int)$_GET['paging'] : 1; // Default to page 1
    $limit = 8; // Number of CVs per page

    // Render CV cards with pagination
    renderCVCardsWithPagination($currentPage, $limit);
    ?>
    </div>
</div>
