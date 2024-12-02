<?php
include $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Models/db_connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Models/get_CV.php';

// Check for a valid CV ID
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>No CV ID provided.</div>";
    exit;
}

$cvId = intval($_GET['id']);
try {
    // Fetch CV details
    $cv = getCvById($conn, $cvId);

    if (!$cv) {
        echo "<div class='alert alert-danger'>CV not found.</div>";
        exit;
    }
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    exit;
}
?>

<div class="container my-5">
    <h1 class="text-uppercase fw-bold text-primary text-center">CV Details</h1>
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h2><?php echo htmlspecialchars($cv['full_name']); ?></h2>
        </div>
        <div class="card-body">
            <p><strong>Job Title:</strong> <?php echo htmlspecialchars($cv['job_title']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($cv['email']); ?></p>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <a href="index.php?page=viewCV" class="btn btn-secondary">Back to Gallery</a>
        <form action="index.php?page=exportCV" method="post">
            <input type="hidden" name="id" value="<?php echo $cvId; ?>">
            <input type="hidden" name="full_name" value="<?php echo htmlspecialchars($cv['full_name']); ?>">
            <input type="hidden" name="job_title" value="<?php echo htmlspecialchars($cv['job_title']); ?>">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($cv['email']); ?>">
            <button type="submit" class="btn btn-success">Export to PDF</button>
        </form>

    </div>
</div>