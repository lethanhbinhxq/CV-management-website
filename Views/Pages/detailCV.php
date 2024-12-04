<?php
include $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Models/db_connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Models/get_CV.php';
include $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Controllers/address_conversion.php';

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

// Function to generate the HTML content for the CV without the header and the buttons
function generateCvContent($cv)
{
    ob_start();  // Start output buffering
    ?>
    <div class="container my-2">
        <!-- Main Information Card -->
        <div class="card m-4 p-5">
            <div class="card-header bg-secondary text-white text-center">
                <h2><?php echo htmlspecialchars($cv['full_name']); ?></h2>
                <p><?php echo htmlspecialchars($cv['job_title']); ?></p>
            </div>

            <div class="card-body">
                <!-- Profile section -->
                <div>
                    <div class="mb-3">
                        <hr class="long-divider mb-2">
                        <h2 class="text-secondary">Profile</h2>
                    </div>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($cv['email']); ?></p>
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
                                <?php
                                $rawAddress = $address['street_address'] . ', ' . $address['commune_id'] . ', ' . $address['district_id'] . ', ' . $address['province_id'];
                                echo htmlspecialchars(convertAddress($rawAddress));
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <p><strong>Objective:</strong> <?php echo htmlspecialchars($cv['objective']); ?></p>
                </div>
            </div>

            <!-- Education section -->
            <div>
                <div class="mb-3">
                    <hr class="long-divider mb-2">
                    <h2 class="text-secondary">Education</h2>
                </div>
                <ul>
                    <?php foreach ($cv['education'] as $edu): ?>
                        <li>
                            <b><?php echo htmlspecialchars($edu['degree'] . ' of ' . $edu['major']); ?></b>
                            <i><?php echo htmlspecialchars(', ' . $edu['school']); ?></i>
                            <br>
                            <span>(<?php echo htmlspecialchars($edu['start_month'] . '/' . $edu['start_year'] . ' - ' . $edu['end_month'] . '/' . $edu['end_year']); ?>)</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Certificates section -->
            <div>
                <div class="mb-3">
                    <hr class="long-divider mb-2">
                    <h2 class="text-secondary">Certificates</h2>
                </div>
                <ul>
                    <?php foreach ($cv['certificates'] as $cert): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($cert['title']); ?></strong>
                            (<?php echo htmlspecialchars($cert['issue_year']); ?>)
                            <br>
                            <i>Field: <?php echo htmlspecialchars($cert['field']); ?></i>
                            <br>
                            <i>Issued By: <?php echo htmlspecialchars($cert['organization']); ?></i>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Professional Experience section -->
            <div>
                <div class="mb-3">
                    <hr class="long-divider mb-2">
                    <h2 class="text-secondary">Professional Experience</h2>
                </div>
                <ul>
                    <?php foreach ($cv['experience'] as $exp): ?>
                        <li><b><?php echo htmlspecialchars($exp['skill']); ?></b>
                            (<?php echo htmlspecialchars($exp['years']); ?> years)</li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Work History section -->
            <div>
                <div class="mb-3">
                    <hr class="long-divider mb-2">
                    <h2 class="text-secondary">Work History</h2>
                </div>
                <ul>
                    <?php foreach ($cv['work_history'] as $work): ?>
                        <li><strong><?php echo htmlspecialchars($work['company']); ?></strong>
                            (<?php echo htmlspecialchars($work['start_month'] . '/' . $work['start_year'] . ' - ' . $work['end_month'] . '/' . $work['end_year']); ?>)
                            <br><i><?php echo htmlspecialchars($work['position']); ?></i>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Other Information section -->
            <?php if (!empty($cv['other_information'])): ?>
                <div class="mb-3">
                    <hr class="long-divider mb-2">
                    <h2 class="text-secondary">Other Information</h2>
                </div>
                <ul>
                    <?php foreach ($cv['other_information'] as $info): ?>
                        <li><strong><?php echo htmlspecialchars($info['title']); ?>:</strong><br><?php echo htmlspecialchars($info['description']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <!-- References section -->
            <?php if (!empty($cv['references'])): ?>
                <div class="mb-3">
                    <hr class="long-divider mb-2">
                    <h2 class="text-secondary">References</h2>
                </div>
                <ul>
                    <?php foreach ($cv['references'] as $reference): ?>
                        <li><strong><?php echo htmlspecialchars($reference['name']); ?></strong>
                            (<?php echo htmlspecialchars($reference['relationship']); ?>)
                            <br><i><?php echo htmlspecialchars($reference['position'] . ', ' . $reference['workplace']); ?></i>
                            <br><i>Tel: <?php echo htmlspecialchars($reference['phone']); ?></i>
                            <br><i>Email: <?php echo htmlspecialchars($reference['email']); ?></i>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean(); // Return the generated HTML content without buttons
}

// Function to generate the buttons
function generateCvButtons($cvId, $fullName)
{
    return "
    <div class='container mt-3 mb-5 px-5'>
        <div class='d-flex justify-content-between mt-3'>
            <a href='index.php?page=viewCV' class='btn btn-secondary'>Back to Gallery</a>
            <form action='index.php?page=exportCV' method='post'>
                <input type='hidden' name='cvId' value='" . htmlspecialchars($cvId) . "'>
                <input type='hidden' name='fullName' value='" . htmlspecialchars($fullName) . "'>
                <button type='submit' class='btn btn-success'>Export to PDF</button>
            </form>
            <button class='btn btn-primary' onclick='generateCvUrl($cvId)'>Generate Link</button>
        </div>
        <div id='shareable-url-container' class='mt-3 d-none'>
            <input id='shareable-url' type='text' class='form-control' readonly>
            <button onclick='copyToClipboard()' class='btn btn-outline-primary mt-2'>Copy to Clipboard</button>
        </div>
    </div>
    ";
}

// Generate the header
$htmlHeader = "
    <h1 class='text-uppercase fw-bold text-primary text-center my-4'>CV Details</h1>";

// Generate the HTML for the CV content (without buttons)
$htmlContent = generateCvContent($cv);

// Generate the buttons
// Call this function, passing the CV ID and full name
$htmlButtons = generateCvButtons($cvId, $cv['full_name']);

// Store only the content (excluding the header and buttons) in session
$_SESSION['cv_html_content'] = $htmlContent;

// Display the header, content, and buttons
echo $htmlHeader;
echo $htmlContent;
echo $htmlButtons;
?>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="clipboardToast" class="toast align-items-center bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                URL copied to clipboard!
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script src="/CV-management-website/Controllers/Scripts/copy_url.js"></script>