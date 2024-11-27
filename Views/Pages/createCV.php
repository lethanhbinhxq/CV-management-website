<?php
// Kiểm tra xem session đã được khởi tạo chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Nếu chưa khởi tạo session, thì khởi tạo
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    // Nếu chưa đăng nhập, hiển thị thông báo và cung cấp các liên kết đăng nhập hoặc đăng ký
    echo '<div class="alert alert-warning text-center" role="alert">';
    echo 'You are not logged in. Do you want to <a href="Views/Pages/login.php" class="btn btn-primary">Log In</a> / <a href="Views/Pages/signup.php" class="btn btn-success">Sign Up</a>?';
    echo '</div>';
    exit(); // Dừng lại và không cho phép truy cập vào phần còn lại của trang
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Create CV</title>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center fw-bold mb-5">Create Your CV</h1>
        <form action="processCV.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label for="skills" class="form-label">Skills</label>
                <input type="text" class="form-control" id="skills" name="skills" placeholder="List your skills (comma separated)" required>
            </div>

            <div class="mb-3">
                <label for="experience" class="form-label">Experience</label>
                <textarea class="form-control" id="experience" name="experience" rows="4" placeholder="Describe your work experience" required></textarea>
            </div>

            <div class="mb-3">
                <label for="uploadCV" class="form-label">Upload CV (PDF)</label>
                <input type="file" class="form-control" id="uploadCV" name="uploadCV" accept=".pdf" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100">Save CV</button>
        </form>
    </div>
</body>

</html>

