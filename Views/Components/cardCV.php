<?php
function renderCvCard($name, $jobTitle, $cvId) {
    $detailsUrl = "cv_detail.php?id=" . urlencode($cvId);
    echo "
    <div class='col-sm-3 mb-3'>
        <div class='card product-card p-2'>
            <div class='container-fluid p-5 bg-secondary ratio ratio-16x9'></div>
            <div class='card-body'>
                <h5 class='card-title'>$name</h5>
                <p class='price'>$jobTitle</p>
                <a href='$detailsUrl' class='btn btn-primary'>View details</a>
            </div>
        </div>
    </div>";
}