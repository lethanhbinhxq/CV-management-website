<?php
ob_end_clean(); // Start output buffering

require $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Library/fpdf/fpdf.php';

// Check if CV data is passed via POST
if (isset($_POST['full_name'], $_POST['job_title'], $_POST['email'])) {
    // Get CV data from POST
    $cv = [
        'full_name' => $_POST['full_name'],
        'job_title' => $_POST['job_title'],
        'email' => $_POST['email']
    ];
} else {
    // Fall back to getting CV from database if not passed via POST
    require $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Models/db_connect.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Models/get_CV.php';

    $cvId = isset($_POST['id']) ? intval($_POST['id']) : 0; // Get the ID from POST

    $cv = getCvById($conn, $cvId);

    if (!$cv) {
        die('CV not found.');
    }
}

// Generate PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'CV Details', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Full Name: ' . $cv['full_name'], 0, 1);
$pdf->Cell(0, 10, 'Job Title: ' . $cv['job_title'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $cv['email'], 0, 1);
$pdf->Output('D', $cv['full_name'] . '_CV.pdf');
exit;
