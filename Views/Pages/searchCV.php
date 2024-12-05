<div class="container my-4 text-center">
    <h1 class="text-uppercase fw-bold text-primary">Search Result</h1>
    <div class="row">

        <?php
        include 'Views/Components/cardCV.php';

        $currentPage = isset($_GET['paging']) ? (int) $_GET['paging'] : 1;
        $limit = 8;
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;

        if ($keyword) echo "<h5>Result for: $keyword</h5>";
        
        renderCVCardsWithPagination($currentPage, $limit, false, $keyword);
        ?>
    </div>
</div>