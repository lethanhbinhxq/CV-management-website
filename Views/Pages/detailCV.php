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
    <div class="card m-4 p-5">
        <div class="card-header bg-secondary text-white text-center">
            <h2><?php echo htmlspecialchars($cv['full_name']); ?></h2>
            <p><?php echo htmlspecialchars($cv['job_title']); ?></p>
        </div>

        <div class="card-body">
            <!-- Profile section -->
            <div>
                <div class="d-flex align-items-center">
                    <h2 class="text-secondary">
                        Profile
                    </h2>
                    <hr class="short-divider">
                    <hr class="short-divider">
                </div>

                <p><strong>Email:</strong> <?php echo htmlspecialchars($cv['email']); ?></p>

                <!-- <p><strong>Gender:</strong> <?php echo htmlspecialchars($cv['gender'] == 'F' ? 'Female' : 'Male'); ?></p> -->

                <p><strong>Phone Numbers:</strong></p>
                <ul>
                    <?php foreach ($cv['phone_numbers'] as $phone): ?>
                        <li><?php echo htmlspecialchars($phone); ?></li>
                    <?php endforeach; ?>
                </ul>

                <p><strong>Addresses:</strong></p>
                <ul>
                    <?php foreach ($cv['addresses'] as $address): ?>
                        <li>
                            <?php echo htmlspecialchars($address['street_address'] . ', ' . $address['commune_id'] . ', ' . $address['district_id'] . ', ' . $address['province_id']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <p><strong>Objective:</strong> <?php echo htmlspecialchars($cv['objective']); ?></p>
            </div>
        </div>

        <!-- Education section -->
        <div>
            <div class="d-flex align-items-center">
                <h2 class="text-secondary">
                    Education
                </h2>
                <hr class="short-divider">
                <hr class="short-divider">
            </div>

            <ul>
                <?php foreach ($cv['education'] as $edu): ?>
                    <li>
                        <span>
                            <b><?php echo htmlspecialchars($edu['degree'] . ' of ' . $edu['major']); ?></b>
                            <i><?php echo htmlspecialchars(', ' . $edu['school']); ?></i>
                        </span>

                        <br>

                        <span>
                            (<?php echo htmlspecialchars($edu['start_month'] . '/' . $edu['start_year'] . ' - ' . $edu['end_month'] . '/' . $edu['end_year']); ?>)
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Certificates section -->
        <div>
            <div class="d-flex align-items-center">
                <h2 class="text-secondary">
                    Certificates
                </h2>
                <hr class="short-divider">
                <hr class="short-divider">
            </div>

            <ul>
                <?php foreach ($cv['certificates'] as $cert): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($cert['title']); ?></strong>
                        (<?php echo htmlspecialchars($cert['issue_year']); ?>)
                        <br>
                        <i>Field : <?php echo htmlspecialchars($cert['field']); ?></i>
                        <br>
                        <i>Issued By : <?php echo htmlspecialchars($cert['organization']); ?></i>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Professional Experience section -->
        <div>
            <div class="d-flex align-items-center">
                <h2 class="text-secondary">
                    Professional Experience
                </h2>
                <hr class="short-divider" style="width: 67% !important;">
            </div>

            <ul>
                <?php foreach ($cv['experience'] as $skill): ?>
                    <li>
                        <b><?php echo htmlspecialchars($skill['skill']); ?></b>

                        <?php echo ' (' . htmlspecialchars($skill['years']) . ' years)' ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Work History section -->
        <div>
            <div class="d-flex align-items-center">
                <h2 class="text-secondary">
                    Work History
                </h2>
                <hr class="short-divider" style="width: 82% !important;">
            </div>

            <ul>
                <?php foreach ($cv['work_history'] as $work): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($work['company']); ?></strong>
                        (<?php echo htmlspecialchars($work['start_month'] . '/' . $work['start_year'] . ' - ' . $work['end_month'] . '/' . $work['end_year']); ?>)

                        <br>

                        <i><?php echo htmlspecialchars($work['position']); ?></i>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Other Information section -->
        <div>

            <?php if (!empty($cv['other_information'])): ?>
                <div class="d-flex align-items-center">
                    <h2 class="text-secondary">
                        Other Information
                    </h2>
                    <hr class="short-divider" style="width: 75% !important;">
                </div>

                <ul>
                    <?php foreach ($cv['other_information'] as $info): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($info['title']); ?>:</strong>
                            <br>
                            <?php echo htmlspecialchars($info['description']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </div>

        <!-- References section -->
        <div>

            <?php if (!empty($cv['references'])): ?>
                <div class="d-flex align-items-center">
                    <h2 class="text-secondary">
                        References
                    </h2>
                    <hr class="short-divider" style="width: 85% !important;">
                </div>

                <ul>
                    <?php foreach ($cv['references'] as $reference): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($reference['name']); ?></strong>
                            (<?php echo htmlspecialchars($reference['relationship']); ?>)
                            <br>
                            <i><?php echo htmlspecialchars($reference['position'] . ', ' . $reference['workplace']); ?></i>
                            <br>
                            <i>Tel: <?php echo htmlspecialchars($reference['phone']); ?></i>
                            <br>
                            <i>Email: <?php echo htmlspecialchars($reference['email']); ?></i>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

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
</div>


</div>