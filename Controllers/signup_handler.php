<?php
session_start();
// Kết nối với database
include_once '../Models/db_connect.php'; // Kết nối DB

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Xử lý dữ liệu form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Kiểm tra validation phía server
    $errors = [];

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // Full Name validation
    if (!preg_match('/^[A-Z][a-z]*(?: [A-Z][a-z]*)*$/', $fullName)) {
        $errors[] = "Full Name must start with a capital letter and contain no numbers or special characters.";
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error_log("Email received: " . $email);
        $errors[] = "Invalid email format.";
    }

    // Username validation
    if (!preg_match('/^[A-Za-z][A-Za-z0-9_]*$/', $username)) {
        $errors[] = "Username must start with a letter and can contain only letters, numbers, or underscores.";
    }

    // Password validation
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $errors[] = "Password must be at least 8 characters long, include lowercase, uppercase, a number, and a special character.";
    }

    // Kiểm tra sự tồn tại của email và username trong cơ sở dữ liệu
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra trùng lặp username, password và cả hai
    $emailExists = false;
    $usernameExists = false;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['email'] == $email) {
                $emailExists = true;
            }
            if ($row['username'] == $username) {
                $usernameExists = true;
            }
        }
        
        if ($emailExists && $usernameExists) {
            $errors[] = "Both the email address and username are already taken.";
        } elseif ($emailExists) {
            $errors[] = "The email address is already registered.";
        } elseif ($usernameExists) {
            $errors[] = "The username is already taken.";
        }
    }

    $stmt->close();

    // Nếu có lỗi, trả về trang đăng ký với thông báo lỗi
    if (!empty($errors)) {
        session_start();
        $_SESSION['errors'] = $errors;
        header("Location: /CV-management-website/?page=signup");
        exit();
    }

    // Mã hóa password trước khi lưu
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Chuẩn bị và thực hiện truy vấn SQL
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullName, $email, $username, $hashedPassword);

    if ($stmt->execute()) {
        // Đăng ký thành công, chuyển về trang home
        unset($_SESSION['errors']);
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['full_name'] = $fullName;
        $_SESSION['email'] = $email;
        setcookie('user_logged_in', 'true', time() + 3600, '/'); // 1-hour expiry
        header('Location: /CV-management-website/index.php'); // Redirect to homepage or dashboard
        echo '<h1>Sign up successfully!</h1>';
        exit();
    } else {
        $_SESSION['errors'] = ["Error inserting data: " . $stmt->error];
        header("Location: /CV-management-website/index.php?page=signup");
    }

    $stmt->close();
    $conn->close();
}
?>
