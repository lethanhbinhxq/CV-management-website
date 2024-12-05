<?php
session_start();
?>

<div class="container-fluid d-flex justify-content-around bg-dark text-center align-items-center">
    <!-- Logo & Name -->
    <a href="index.php" class="text-decoration-none">
        <div>
            <img src="Assets\logo.png" class="rounded-circle" alt="Logo" width="70">
            <span class="fs-3 text-light-blue text-light-blue-hover">CV Management</span>
        </div>
    </a>

    <!-- Search bar -->
    <div>
        <form class="d-flex ms-auto" role="search" action="index.php" method="get">
            <input type="hidden" name="page" value="searchCV">
            <input class="form-control me-2 custom-search" name="keyword" type="search" placeholder="Search"
                aria-label="Search" id="searchByText">
            <button class="btn btn-outline-secondary" type="submit" aria-label="Search">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <!-- Log in / Log out / Profile -->
    <div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Notification button -->
            <!-- <button class="btn btn-outline-secondary rounded-circle me-5" type="button" id="profile" title="Profile"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell-fill" style="font-size: larger;"></i>
            </button> -->

            <!-- Profile button -->
            <button class="btn btn-outline-secondary rounded-circle mx-5" type="button" id="profileButton" title="Profile"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-fill" style="font-size: larger;"></i>
            </button>

            <div id="profileDropdown" class="dropdown-menu dropdown-menu-blue text-center">
                <span id="usernameDisplay"><?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="#" class="dropdown-item">My Profile</a>
                <a href="/CV-management-website/Controllers/logout.php" class="dropdown-item">Log Out</a>
            </div>

        <?php else: ?>
            <button class="btn btn-outline-secondary me-2" type="button" id="loginButton"
                onclick="window.location.href='http://localhost/CV-management-website/?page=login'">
                Log In
            </button>
            <button class="btn btn-outline-secondary" type="button" id="signupButton"
                onclick="window.location.href='http://localhost/CV-management-website/?page=signup'">
                Sign Up
            </button>
        <?php endif; ?>

    </div>

</div>