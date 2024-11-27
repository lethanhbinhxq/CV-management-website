<!-- For test only -->
<?php
session_start();  // Bắt đầu phiên làm việc
$_SESSION['user_id'] = 0; // Giả định thoát đăng nhập, hoặc bạn có thể để dòng này tùy theo trạng thái
//$_SESSION['username'] = 'user1';

session_unset();
session_destroy();
?>
<?php
// Kiểm tra trạng thái session trước khi gọi session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Chỉ khởi tạo session nếu chưa được khởi tạo
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Management Website</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="Views/Styles/style.css">
</head>

<body>
    <?php include 'Views/Components/header.php'; ?>
    <!-- Redirect processing -->

    <?php include 'Views/Components/navbar.php'; ?>
    
    <?php include 'Controllers/redirect.php'; ?>
    
    <?php include 'Views/Components/footer.php'; ?>
</body>

</html>
