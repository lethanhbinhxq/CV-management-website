<?php
$servername = "localhost";
$username = "root";
$password = "";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Câu lệnh SQL để tạo cơ sở dữ liệu 'cv_management'
$sql = "CREATE DATABASE IF NOT EXISTS cv_management";
if ($conn->query($sql) === TRUE) {
    echo "Cơ sở dữ liệu 'cv_management' được tạo thành công<br>";
} else {
    echo "Lỗi khi tạo cơ sở dữ liệu: " . $conn->error . "<br>";
}

// Kết nối lại với cơ sở dữ liệu vừa tạo
$conn->select_db("cv_management");

// Câu lệnh SQL để tạo bảng 'users'
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

// Thực hiện câu lệnh tạo bảng
if ($conn->query($sql) === TRUE) {
    echo "Bảng 'users' được tạo thành công";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
