<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Models/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Start transaction
        $conn->begin_transaction();

        ///////// CVs
        $user_id = $_SESSION['user_id'];
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $job_title = $_POST['job_title'];
        $gender = $_POST['gender'];
        $objective = $_POST['objective'];
        $visibility = $_POST['visibility'];

        $stmt = $conn->prepare("INSERT INTO cvs (user_id, full_name, email, job_title, gender, objective, visibility) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $user_id, $full_name, $email, $job_title, $gender, $objective, $visibility);
        $stmt->execute();

        ///////// Phone numbers
        $cv_id = $conn->insert_id;
        $phoneNumbers = $_POST['phoneNumbers'];
        $stmt = $conn->prepare("INSERT INTO phone_numbers (cv_id, phone_number) VALUES (?, ?)");
        foreach ($phoneNumbers as $phoneNumber) {
            if (trim($phoneNumber) === '') {
                continue;
            }
            $stmt->bind_param("is", $cv_id, $phoneNumber);
            $stmt->execute();
        }

        ///////// Addresses
        $provinces = $_POST['province'];
        $districts = $_POST['district'];
        $communes = $_POST['commune'];
        $streetAddresses = $_POST['streetAddress'];
        $stmt = $conn->prepare("INSERT INTO addresses (cv_id, province_id, district_id, commune_id, street_address) VALUES (?, ?, ?, ?, ?)");
        for ($i = 0; $i < count($provinces); $i++) {
            if (empty($provinces[$i]) || empty($districts[$i]) || empty($communes[$i]) || empty($streetAddresses[$i])) {
                continue;
            }
            $stmt->bind_param("issss", $cv_id, $provinces[$i], $districts[$i], $communes[$i], $streetAddresses[$i]);
            $stmt->execute();
        }

        ///////// Education
        $degrees = $_POST['degree'];
        $majors = $_POST['major'];
        $schools = $_POST['school'];
        $startMonths = $_POST['startMonth'];
        $startYears = $_POST['startYear'];
        $endMonths = $_POST['endMonth'];
        $endYears = $_POST['endYear'];
        $stmt = $conn->prepare("INSERT INTO education (cv_id, degree, major, school, start_month, start_year, end_month, end_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        for ($i = 0; $i < count($degrees); $i++) {
            if (empty($degrees[$i]) || empty($majors[$i]) || empty($schools[$i]) || empty($startMonths[$i]) || empty($startYears[$i]) || empty($endMonths[$i]) || empty($endYears[$i])) {
                continue;
            }
            $stmt->bind_param("isssiiii", $cv_id, $degrees[$i], $majors[$i], $schools[$i], $startMonths[$i], $startYears[$i], $endMonths[$i], $endYears[$i]);
            $stmt->execute();
        }

        ///////// Certificates
        $certificateTitles = $_POST['certificateTitle'];
        $fields = $_POST['field'];
        $issueYears = $_POST['issueYear'];
        $issuingOrganizations = $_POST['issuingOrganization'];

        $stmt = $conn->prepare("INSERT INTO certificates (cv_id, certificate_title, field, issue_year, issuing_organization) VALUES (?, ?, ?, ?, ?)");
        for ($i = 0; $i < count($certificateTitles); $i++) {
            if (empty($certificateTitles[$i]) || empty($fields[$i]) || empty($issueYears[$i]) || empty($issuingOrganizations[$i])) {
                continue;
            }
            $stmt->bind_param("issis", $cv_id, $certificateTitles[$i], $fields[$i], $issueYears[$i], $issuingOrganizations[$i]);
            $stmt->execute();
        }

        ///////// Professional Experience
        $skills = $_POST['skill'];
        $yearsOfExperience = $_POST['yearsOfExperience'];

        $stmt = $conn->prepare("INSERT INTO professional_experience (cv_id, skill, years_of_experience) VALUES (?, ?, ?)");
        for ($i = 0; $i < count($skills); $i++) {
            if (empty($skills[$i]) || empty($yearsOfExperience[$i])) {
                continue;
            }
            $stmt->bind_param("isi", $cv_id, $skills[$i], $yearsOfExperience[$i]);
            $stmt->execute();
        }

        ///////// Work History
        $companies = $_POST['company'];
        $positions = $_POST['position'];
        $startMonths = $_POST['startWorkMonth'];
        $startYears = $_POST['startWorkYear'];
        $endMonths = $_POST['endWorkMonth'];
        $endYears = $_POST['endWorkYear'];
        $stmt = $conn->prepare("INSERT INTO work_history (cv_id, company, position, start_month, start_year, end_month, end_year) VALUES (?, ?, ?, ?, ?, ?, ?)");
        for ($i = 0; $i < count($companies); $i++) {
            if (empty($companies[$i]) || empty($positions[$i]) || empty($startMonths[$i]) || empty($startYears[$i]) || empty($endMonths[$i]) || empty($endYears[$i])) {
                continue;
            }
            $stmt->bind_param("issiiii", $cv_id, $companies[$i], $positions[$i], $startMonths[$i], $startYears[$i], $endMonths[$i], $endYears[$i]);
            $stmt->execute();
        }

        ///////// Other Information
        $otherTitles = $_POST['otherTitle'];
        $descriptions = $_POST['otherDescription'];
        $stmt = $conn->prepare("INSERT INTO other_information (cv_id, other_title, description) VALUES (?, ?, ?)");
        for ($i = 0; $i < count($otherTitles); $i++) {
            if (empty($otherTitles[$i]) || empty($descriptions[$i])) {
                continue;
            }
            $stmt->bind_param("iss", $cv_id, $otherTitles[$i], $descriptions[$i]);
            $stmt->execute();
        }

        ///////// References
        $refereeNames = $_POST['refereeName'];
        $relationships = $_POST['relationship'];
        $positions = $_POST['refereePosition'];
        $workplaces = $_POST['refereeWorkplace'];
        $phoneNumbers = $_POST['refereePhoneNumber'];
        $emails = $_POST['refereeEmail'];

        $stmt = $conn->prepare("INSERT INTO reference (cv_id, referee_name, relationship, position, workplace, phone_number, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
        for ($i = 0; $i < count($refereeNames); $i++) {
            if (empty($refereeNames[$i]) || empty($relationships[$i]) || empty($positions[$i]) || empty($workplaces[$i]) || empty($phoneNumbers[$i]) || empty($emails[$i])) {
                continue;
            }
            $stmt->bind_param("issssss", $cv_id, $refereeNames[$i], $relationships[$i], $positions[$i], $workplaces[$i], $phoneNumbers[$i], $emails[$i]);
            $stmt->execute();
        }

        ///////// Viewer
        if ($visibility == 'Custom User') {
            $viewers = $_POST['customUsers'];
            $stmt = $conn->prepare("INSERT INTO viewers (cv_id, viewer_id) VALUES (?, ?)");
            for ($i = 0; $i < count($viewers); $i++) {
                if (empty($viewers[$i])) {
                    continue;
                }
                $stmt->bind_param("ii", $cv_id, $viewers[$i]);
                $stmt->execute();
            }
        }

        // Commit transaction
        $conn->commit();
        header("Location: /CV-management-website/$cv_id");
        exit();
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $conn->rollback();
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request method.';
}