// Lấy tất cả các form
const loginForm = document.getElementById("login_form");
const signupForm = document.getElementById("signup_form");

if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Ngăn form gửi đi nếu không hợp lệ

        // Lấy giá trị input
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        // Biến lưu lỗi
        let errors = [];

        // Kiểm tra Username: bắt đầu bằng chữ cái
        const usernameRegex = /^[a-zA-Z][a-zA-Z0-9]*$/;
        if (!usernameRegex.test(username)) {
            errors.push("Username must start with a letter and contain only letters and numbers.");
        }

        // Kiểm tra Password
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (!passwordRegex.test(password)) {
            errors.push(
                "Password must be at least 8 characters long, include lowercase, uppercase, a number, and a special character."
            );
        }

        // Hiển thị lỗi hoặc gửi form nếu hợp lệ
        const errorMessages = document.getElementById("errorMessages");
        if (errors.length > 0) {
            errorMessages.innerHTML = errors.join("<br>");
        } else {
            errorMessages.innerHTML = "";
            loginForm.submit();
        }
    });
}

if (signupForm) {
    signupForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Lấy giá trị input
        const fullName = document.getElementById("full_name").value.trim();
        const email = document.getElementById("email").value.trim();
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value;

        let errors = [];

        // Kiểm tra Full Name
        const fullNameRegex = /^[A-Z][a-z]*(?: [A-Z][a-z]*)*$/;
        if (!fullNameRegex.test(fullName)) {
            errors.push("Full Name must start with a capital letter and contain no numbers or special characters.");
        }

        // Kiểm tra Email
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if(!emailRegex.test(email)){
            errors.push("Vcl");
        }
            
        // Kiểm tra Username
        const usernameRegex = /^[A-Za-z][A-Za-z0-9_]*$/;
        if (!usernameRegex.test(username)) {
            errors.push("Username must start with a letter and can contain only letters, numbers, or underscores.");
        }

        // Kiểm tra Password
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (!passwordRegex.test(password)) {
            errors.push(
                "Password must be at least 8 characters long, include lowercase, uppercase, a number, and a special character."
            );
        }

        // Hiển thị lỗi hoặc gửi form nếu hợp lệ
        const errorMessages = document.getElementById("errorMessagesSignup");
        if (errors.length > 0) {
            errorMessages.innerHTML = errors.join("<br>");
        } else {
            errorMessages.innerHTML = "";
            signupForm.submit();
        }
    });
}
