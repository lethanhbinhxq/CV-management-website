<?php
// Kiểm tra xem session đã được khởi tạo chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Nếu chưa khởi tạo session, thì khởi tạo
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    // Nếu chưa đăng nhập, hiển thị thông báo và cung cấp các liên kết đăng nhập hoặc đăng ký
    echo '<div class="alert alert-warning text-center" role="alert">';
    echo 'You are not logged in. Do you want to <a href="index.php?page=login" class="btn btn-primary">Log In</a> / <a href="index.php?page=signup" class="btn btn-success">Sign Up</a>?';
    echo '</div>';
    exit(); // Dừng lại và không cho phép truy cập vào phần còn lại của trang
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My CVs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center mb-4">My CVs</h1>

    <?php if (empty($cvs)): ?>
        <!-- Hiển thị thông báo nếu chưa có CV -->
        <div class="alert alert-warning text-center" role="alert">
            <p>There is no CV available yet.</p>
            <p>
                Do you want to create a CV? 
                <a href="index.php?page=createCV" class="btn btn-primary">Create CV</a>
            </p>
            <p>
                Do you want to view CV?
                <a href="index.php?page=viewCV" class="btn btn-primary">View CV</a>
            </p>
        </div>
    <?php else: ?>
        <!-- Hiển thị danh sách CV nếu đã tạo -->
        <div class="list-group">
            <?php foreach ($cvs as $index => $cv): ?>
                <a href="index.php?page=viewCV&id=<?php echo $index; ?>" class="list-group-item list-group-item-action">
                    <h5 class="mb-1"><?php echo htmlspecialchars($cv['title']); ?></h5>
                    <p class="mb-1"><?php echo htmlspecialchars($cv['description']); ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
