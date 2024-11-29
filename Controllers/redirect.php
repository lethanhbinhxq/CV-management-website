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
        case 'createCV':
            include 'Views/Pages/createCV.php';
            break;
        case 'viewCV':
            include 'Views/Pages/viewCV.php';
            break;
        case 'myCV':
            include 'Views/Pages/myCV.php';
            break;
        case 'contact':
            include 'Views/Pages/contact.php';
            break;

        default:
            // Nếu không tìm thấy trang, hiển thị lỗi
            include 'Views/Pages/notFound.php';
            break;
    }
} else {
    // Mặc định hiển thị trang chủ
    include $baseDir . 'home.php';
}
?>