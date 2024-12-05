<?php
// Absolute path to the project's root directory
$baseDir = $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Views/Pages/';
$navbar = 'Views/Components/navbar.php';

// Function to include a page safely
function includePage($page, $baseDir, $default = 'notFound.php') {
    $allowedPages = [
        'home', 'login', 'signup', 'createCV', 'viewCV',
        'detailCV', 'exportCV', 'myCV', 'searchCV', 'contact'
    ];
    if (in_array($page, $allowedPages)) {
        include $baseDir . $page . '.php';
    } else {
        include $baseDir . $default;
    }
}

// Check the 'page' parameter
$page = $_GET['page'] ?? 'home'; // Default to 'home' if 'page' is not set

// Include the navbar unless it's the exportCV page
if ($page !== 'exportCV') {
    include $navbar;
}

// Include the requested page
includePage($page, $baseDir);