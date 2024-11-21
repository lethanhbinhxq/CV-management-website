// Lấy form và phần tử hiển thị lỗi
const form = document.getElementById("login_form");
const errorMessages = document.getElementById("errorMessages");

form.addEventListener("submit", function (e) {
    e.preventDefault(); // Ngăn form gửi đi nếu không hợp lệ

    // Lấy giá trị input
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Biến lưu lỗi
    let errors = [];

    // Kiểm tra Username: bắt đầu bằng chữ cái
    const usernameRegex = /^[a-zA-Z][a-zA-Z0-9]*$/; // Bắt đầu bằng chữ cái, các ký tự sau là chữ cái hoặc số
    if (!usernameRegex.test(username)) {
        errors.push("Username must start with a letter and contain only letters and numbers.");
    }

    // Kiểm tra Password: ít nhất 8 ký tự, gồm chữ thường, in hoa, số, ký tự đặc biệt
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (!passwordRegex.test(password)) {
        errors.push(
            "Password must be at least 8 characters long, include lowercase, uppercase, a number, and a special character."
        );
    }

    // Hiển thị lỗi hoặc gửi form nếu hợp lệ
    if (errors.length > 0) {
        errorMessages.innerHTML = errors.join("<br>"); // Hiển thị lỗi
    } else {
        errorMessages.innerHTML = ""; // Xóa lỗi
        form.submit(); // Gửi form nếu không có lỗi
    }
});
