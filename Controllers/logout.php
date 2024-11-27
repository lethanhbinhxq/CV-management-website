<?php
session_start();
session_unset(); // Xóa toàn bộ dữ liệu trong session
session_destroy(); // Hủy session
header("Location: /CV-management-website/?page=login"); // Chuyển hướng về trang login
exit();
?>
