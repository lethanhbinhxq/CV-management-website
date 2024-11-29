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
    echo '</div>';
    exit(); // Dừng lại và không cho phép truy cập vào phần còn lại của trang
}
?>


<div class="container my-4">
    <h1 class="my-4 text-center text-uppercase fw-bold text-main-pink">Create CV</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-form rounded">
                <form method="post" class="p-5 mb-5" id="createCV_form">
                    <?php include 'Views/Components/CV_personal_info.php'; ?>
                    <?php include 'Views/Components/CV_education.php'; ?>
                    <?php include 'Views/Components/CV_work_experience.php'; ?>
                    <?php include 'Views/Components/CV_others.php'; ?>
                    <?php include 'Views/Components/CV_visibility.php'; ?>


                    <button type="submit" class="mt-2 btn btn-primary">Create CV</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/CV-management-website/Controllers/Scripts/dynamic_item.js"></script>
<script src="/CV-management-website/Controllers/Scripts/load_location.js"></script>
<script src="/CV-management-website/Controllers/Scripts/trigger_tooltip.js"></script>
<script src="/CV-management-website/Controllers/Scripts/customed_visibility.js"></script>