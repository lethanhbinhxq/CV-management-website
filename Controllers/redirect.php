<?php
// Đường dẫn tuyệt đối đến thư mục gốc của dự án
$baseDir = $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Views/Pages/';

// Kiểm tra tham số 'page'
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    // Điều hướng dựa trên giá trị của 'page'
    switch ($page) {
        case 'home':
            include $baseDir . 'home.php';
            break;
        case 'login':
            include $baseDir . 'login.php';
            break;
        case 'signup':
            include $baseDir . 'signup.php';
            break;
        default:
            // Nếu không tìm thấy trang, hiển thị lỗi
            echo "<h2>Page not found</h2>";
            break;
    }
} else {
    // Mặc định hiển thị trang chủ
    include $baseDir . 'home.php';
}
?>
