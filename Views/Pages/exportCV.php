<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Library/vendor/autoload.php';
session_start();  // Start the session to access session variables
ob_end_clean();

$cvId = $_POST['cvId'];
$fullName = $_POST['fullName'];

// Use the $cvId and $fullName to set the filename when exporting to PDF
$fileName = "CV_{$cvId}_{$fullName}.pdf";

// Check if HTML content is stored in session
if (!isset($_SESSION['cv_html_content'])) {
    echo "No CV details found to export.";
    exit;
}

// Get the HTML content from the session
$htmlContent = $_SESSION['cv_html_content'];

// Initialize mPDF
$mpdf = new \Mpdf\Mpdf();

// Write the HTML content to the PDF
$mpdf->WriteHTML($htmlContent);

// Output the PDF to the browser (force download)
$mpdf->Output($fileName, 'D');  // 'D' for download

// Optionally, you can unset the session variable after export
unset($_SESSION['cv_html_content']);