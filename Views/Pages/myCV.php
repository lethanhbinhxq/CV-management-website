<?php
// Kiểm tra xem session đã được khởi tạo chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Nếu chưa khởi tạo session, thì khởi tạo
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    // Nếu chưa đăng nhập, hiển thị thông báo và cung cấp các liên kết đăng nhập hoặc đăng ký
    echo '<div class="alert alert-warning text-center" role="alert">';
    echo 'You are not logged in. Do you want to <a href="index.php?page=login" class="btn btn-primary">Log In</a> / <a href="index.php?page=signup" class="btn btn-success">Sign Up</a> ?';
    exit(); // Dừng lại và không cho phép truy cập vào phần còn lại của trang
}
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
