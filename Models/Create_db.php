<?php
$servername = "localhost";
$username = "root";
$password = "";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

// Câu lệnh SQL để tạo cơ sở dữ liệu 'cv_management'
$sql = "CREATE DATABASE IF NOT EXISTS cv_management";
if ($conn->query($sql) === TRUE) {
    echo "Database 'cv_management' created successfully \n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Kết nối lại với cơ sở dữ liệu vừa tạo
$conn->select_db("cv_management");

// 1. 'users'
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully \n";
} else {
    echo "Error creating table 'user': " . $conn->error . "\n";
}

// 2. 'cvs'
$sql = "CREATE TABLE IF NOT EXISTS cvs (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    job_title VARCHAR(255) NOT NULL,
    gender CHAR(1) NOT NULL,
    objective TEXT NOT NULL,
    visibility VARCHAR(9) NOT NULL,
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'cvs' created successfully \n";
} else {
    echo "Error creating table 'cvs': " . $conn->error . "\n";
}

// 3. 'phone_numbers'
$sql = "CREATE TABLE IF NOT EXISTS phone_numbers (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    cv_id INT(11) NOT NULL,
    FOREIGN KEY (cv_id) REFERENCES cvs(id),
    phone_number VARCHAR(11) NOT NULL,
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'phone_numbers' created successfully \n";
} else {
    echo "Error creating table 'phone_numbers': " . $conn->error . "\n";
}

// 4. 'addresses'
$sql = "CREATE TABLE IF NOT EXISTS addresses (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    cv_id INT(11) NOT NULL,
    FOREIGN KEY (cv_id) REFERENCES cvs(id),
    province_id CHAR(2) NOT NULL,
    district_id CHAR(3) NOT NULL,
    commune_id CHAR(5) NOT NULL,
    street_address TEXT NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'addresses' created successfully \n";
} else {
    echo "Error creating table 'addresses': " . $conn->error . "\n";
}

// 5. 'education'
$sql = "CREATE TABLE IF NOT EXISTS education (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    cv_id INT(11) NOT NULL,
    FOREIGN KEY (cv_id) REFERENCES cvs(id),
    degree VARCHAR(255) NOT NULL,
    major VARCHAR(255) NOT NULL,
    school VARCHAR(255) NOT NULL,
    start_month INT(11) NOT NULL CHECK (start_month >= 1 AND start_month <= 12),
    start_year INT(11) NOT NULL CHECK (start_year >= 1970 AND start_year <= 2024),
    end_month INT(11) NOT NULL CHECK (end_month >= 1 AND end_month <= 12),
    end_year INT(11) NOT NULL CHECK (end_year >= 1970 AND end_year <= 2024)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'education' created successfully \n";
} else {
    echo "Error creating table 'education': " . $conn->error . "\n";
}

// 6. 'certificates'
$sql = "CREATE TABLE IF NOT EXISTS certificates (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    cv_id INT(11) NOT NULL,
    FOREIGN KEY (cv_id) REFERENCES cvs(id),
    certificate_title VARCHAR(255) NOT NULL,
    field VARCHAR(255) NOT NULL,
    issue_year INT(11) NOT NULL CHECK (issue_year >= 1970 AND issue_year <= 2024),
    issuing_organization VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'certificates' created successfully \n";
} else {
    echo "Error creating table 'certificates': " . $conn->error . "\n";
}

// 7. 'professional_experience'
$sql = "CREATE TABLE IF NOT EXISTS professional_experience (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    cv_id INT(11) NOT NULL,
    FOREIGN KEY (cv_id) REFERENCES cvs(id),
    skill VARCHAR(255) NOT NULL,
    years_of_experience INT(11) NOT NULL CHECK (years_of_experience >= 1970 && years_of_experience <= 2024)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'professional_experience' created successfully \n";
} else {
    echo "Error creating table 'professional_experience': " . $conn->error . "\n";
}

// 8. 'work_history'
$sql = "CREATE TABLE IF NOT EXISTS work_history (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    cv_id INT(11) NOT NULL,
    FOREIGN KEY (cv_id) REFERENCES cvs(id),
    company VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    start_month INT(11) NOT NULL CHECK (start_month >= 1 AND start_month <= 12),
    start_year INT(11) NOT NULL CHECK (start_year >= 1970 AND start_year <= 2024),
    end_month INT(11) NOT NULL CHECK (end_month >= 1 AND end_month <= 12),
    end_year INT(11) NOT NULL CHECK (end_year >= 1970 AND end_year <= 2024),
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'work_history' created successfully \n";
} else {
    echo "Error creating table 'work_history': " . $conn->error . "\n";
}

// 9. 'other_information'
$sql= "CREATE TABLE IF NOT EXISTS other_information (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    cv_id INT(11) NOT NULL,
    FOREIGN KEY (cv_id) REFERENCES cvs(id),
    other_title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'other_information' created successfully \n";
} else {
    echo "Error creating table 'other_information': " . $conn->error . "\n";
}

// 10. 'references'
$sql= "CREATE TABLE IF NOT EXISTS references (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    cv_id INT(11) NOT NULL,
    FOREIGN KEY (cv_id) REFERENCES cvs(id),
    referee_name VARCHAR(255) NOT NULL,
    relationship VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    workplace VARCHAR(255) NOT NULL,
    phone_nummber VARCHAR(11) NOT NULL,
    email VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'references' created successfully \n";
} else {
    echo "Error creating table 'references': " . $conn->error . "\n";
}

// 11. 'viewers'
$sql= "CREATE TABLE IF NOT EXISTS viewers (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    cv_id INT(11) NOT NULL,
    FOREIGN KEY (cv_id) REFERENCES cvs(id),
    viewer_id INT(11) NOT NULL,
    FOREIGN KEY (cv_id) REFERENCES users(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'viewers' created successfully \n";
} else {
    echo "Error creating table 'viewers': " . $conn->error . "\n";
}

// Đóng kết nối
$conn->close();
?>
