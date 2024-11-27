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

    <!-- Include header -->
    <div class="container-fluid d-flex justify-content-around bg-dark text-center align-items-center">
        <a href="index.php" class="text-decoration-none">
            <div>
                <img src="Assets/logo.png" class="rounded-circle" alt="Logo" width="70">
                <span class="fs-3 text-light-blue text-light-blue-hover">CV Management</span>
            </div>
        </a>

        <!-- Search bar -->
        <div>
            <form class="d-flex ms-auto" role="search" action="index.php" method="get">
                <input class="form-control me-2 custom-search" name="keyword" type="search" placeholder="Search"
                    aria-label="Search" id="searchByText">
                <button class="btn btn-outline-secondary" type="submit" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <!-- Login / Logout / Profile Logic -->
        <div>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0): ?>
                <!-- If user is logged in -->
                <button class="btn btn-outline-secondary rounded-circle mx-5" type="button" id="profileButton" title="Profile"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill" style="font-size: larger;"></i>
                </button>

                <div id="profileDropdown" class="dropdown-menu dropdown-menu-blue text-center">
                    <span id="usernameDisplay"><?php echo $_SESSION['username']; ?></span>
                    <a href="profile.php" class="dropdown-item">My Profile</a>
                    <a href="logout.php" class="dropdown-item">Log Out</a>
                </div>
            <?php else: ?>
                <!-- If user is not logged in -->
                <a href="index.php?page=login" class="btn btn-outline-light me-2">Log In</a>
                <a href="index.php?page=signup" class="btn btn-outline-success">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm bg-primary">
        <div class="container-fluid d-flex justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="?page=home">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        CV
                    </a>
                    <ul class="dropdown-menu dropdown-menu-blue" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php?page=createCV">Create CV</a></li>
                        <li><a class="dropdown-item" href="index.php?page=viewCV">View CV</a></li>
                        
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0): ?>
                            <!-- Only show "My CV" if the user is logged in -->
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?page=myCV">My CV</a></li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=contact">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main content -->
    <main>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            switch ($page) {
                case 'home':
                    include 'Views/Pages/home.php';
                    break;
                case 'login':
                    include 'Views/Pages/login.php';
                    break;
                case'signup':
                    include 'Views/Pages/signup.php';
                    break;
                case 'createCV':
                    include 'Views/Pages/createCV.php'; // Ensure this file exists
                    break;
                case 'viewCV':
                    include 'Views/Pages/viewCV.php';
                    break;
                case 'myCV':
                    include 'Views/Pages/myCV.php';
                    break;
                case 'contact':
                    include 'Views/Pages/contact.php';
                    break;
                default:
                    echo "<h1 class='text-center mt-5'>Page Not Found</h1>";
                    break;
            }
        } else {
            include 'Views/Pages/home.php';
        }
        ?>
    </main>

    <footer>
        <?php include 'Views/Components/footer.html'; ?>
    </footer>
</body>

</html>
