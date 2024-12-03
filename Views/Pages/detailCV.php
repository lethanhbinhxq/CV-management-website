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

    <!-- Main Information Card -->
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h2><?php echo htmlspecialchars($cv['full_name']); ?></h2>
        </div>
        <div class="card-body">
            <p><strong>Job Title:</strong> <?php echo htmlspecialchars($cv['job_title']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($cv['email']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($cv['gender']); ?></p>
            <p><strong>Objective:</strong> <?php echo htmlspecialchars($cv['objective']); ?></p>
        </div>
    </div>

    <!-- Phone Numbers Section -->
    <div class="mt-4">
        <h3 class="text-secondary">Phone Numbers</h3>
        <ul>
            <?php foreach ($cv['phone_numbers'] as $phone): ?>
                <li><?php echo htmlspecialchars($phone); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Addresses Section -->
    <div class="mt-4">
        <h3 class="text-secondary">Addresses</h3>
        <ul>
            <?php foreach ($cv['addresses'] as $address): ?>
                <li>
                    <?php echo htmlspecialchars($address['street_address'] . ', ' . $address['commune_id'] . ', ' . $address['district_id'] . ', ' . $address['province_id']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Education Section -->
    <div class="mt-4">
        <h3 class="text-secondary">Education</h3>
        <ul>
            <?php foreach ($cv['education'] as $edu): ?>
                <li>
                    <?php echo htmlspecialchars($edu['degree'] . ' in ' . $edu['major'] . ' from ' . $edu['school']); ?>
                    (<?php echo htmlspecialchars($edu['start_month'] . '/' . $edu['start_year'] . ' - ' . $edu['end_month'] . '/' . $edu['end_year']); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Certificates Section -->
    <div class="mt-4">
        <h3 class="text-secondary">Certificates</h3>
        <ul>
            <?php foreach ($cv['certificates'] as $cert): ?>
                <li>
                    <strong><?php echo htmlspecialchars($cert['title']); ?></strong>
                    in <?php echo htmlspecialchars($cert['field']); ?>
                    issued by <?php echo htmlspecialchars($cert['issue_year']); ?>
                    (<?php echo htmlspecialchars($cert['organization']); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Professional Experience Section -->
    <div class="mt-4">
        <h3 class="text-secondary">Professional Experience</h3>
        <ul>
            <?php foreach ($cv['experience'] as $skill): ?>
                <li><?php echo htmlspecialchars($skill['skill']) . ' (' . htmlspecialchars($skill['years']) . ' years)'; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Work History Section -->
    <div class="mt-4">
        <h3 class="text-secondary">Work History</h3>
        <ul>
            <?php foreach ($cv['work_history'] as $work): ?>
                <li>
                    <strong><?php echo htmlspecialchars($work['position']); ?></strong> at
                    <?php echo htmlspecialchars($work['company']); ?>
                    (<?php echo htmlspecialchars($work['start_month'] . '/' . $work['start_year'] . ' - ' . $work['end_month'] . '/' . $work['end_year']); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Other Information Section -->
    <div class="mt-4">
        <h3 class="text-secondary">Other Information</h3>
        <?php if (!empty($cv['other_information'])): ?>
            <ul>
                <?php foreach ($cv['other_information'] as $info): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($info['title']); ?>:</strong>
                        <?php echo htmlspecialchars($info['description']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <!-- References Section -->
    <div class="mt-4">
        <h3 class="text-secondary">References</h3>
        <ul>
            <?php foreach ($cv['references'] as $reference): ?>
                <li>
                    <strong><?php echo htmlspecialchars($reference['name']); ?></strong>
                    (<?php echo htmlspecialchars($reference['relationship']); ?>)
                    - <?php echo htmlspecialchars($reference['position'] . ', ' . $reference['workplace']); ?>
                    - Contact: <?php echo htmlspecialchars($reference['phone'] . ' / ' . $reference['email']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Back and Export Buttons -->
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