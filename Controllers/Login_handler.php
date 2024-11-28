<?php
session_start();
include_once '../Models/db_connect.php'; // Kết nối DB

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Hàm kiểm tra validation
function validate_input($username, $password) {
    // Kiểm tra username hợp lệ
    $usernameRegex = '/^[a-zA-Z][a-zA-Z0-9]*$/';
    if (!preg_match($usernameRegex, $username)) {
        return "Username must start with a letter and contain only letters and numbers.";
    }

    // Kiểm tra password hợp lệ
    $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if (!preg_match($passwordRegex, $password)) {
        return "Password must be at least 8 characters long, include lowercase, uppercase, a number, and a special character.";
    }

    return true; // Validation thành công
}

// Xử lý khi nhận request POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validation
    $validationResult = validate_input($username, $password);
    if ($validationResult !== true) {
        $_SESSION['error'] = $validationResult;
        header("Location: /CV-management-website/?page=login");
        exit();
    }
    unset($_SESSION['error']); // Xóa thông báo lỗi trước đó

    // Kết nối DB
    global $conn;

    // Tìm user trong DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra username và password
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Kiểm tra password (sử dụng password_verify)
        if (password_verify($password, $user['password'])) {
            // Đăng nhập thành công
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username; // Lưu session
            $_SESSION['full_name'] = $fullName;
            $_SESSION['email'] = $email;
            header("Location: /CV-management-website/index.php");
            exit();
        }
    }

    // Nếu thất bại
    $_SESSION['error'] = "Username or password is incorrect";
    header("Location: /CV-management-website/index.php?page=login");
    exit();
}
?>
