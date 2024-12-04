<?php

function getCvById($conn, $cvId) {
    try {
        $query = "
            SELECT 
                cvs.id, 
                cvs.full_name, 
                cvs.job_title, 
                cvs.email,
                cvs.gender,
                cvs.objective,
                cvs.visibility,
                cvs.user_id,

                phone_numbers.phone_number,

                addresses.province_id,
                addresses.district_id,
                addresses.commune_id,
                addresses.street_address,
                
                education.degree AS education_degree,
                education.major AS education_major,
                education.school AS education_school,
                education.start_month AS education_start_month,
                education.start_year AS education_start_year,
                education.end_month AS education_end_month,
                education.end_year AS education_end_year,
                
                certificates.certificate_title,
                certificates.field AS certificate_field,
                certificates.issue_year AS certificate_issue_year,
                certificates.issuing_organization AS certificate_organization,

                professional_experience.skill AS experience_skill,
                professional_experience.years_of_experience AS experience_years,

                work_history.company AS work_company,
                work_history.position AS work_position,
                work_history.start_month AS work_start_month,
                work_history.start_year AS work_start_year,
                work_history.end_month AS work_end_month,
                work_history.end_year AS work_end_year,

                other_information.other_title,
                other_information.description AS other_description,

                reference.referee_name,
                reference.relationship AS referee_relationship,
                reference.position AS referee_position,
                reference.workplace AS referee_workplace,
                reference.phone_number AS referee_phone,
                reference.email AS referee_email
            FROM 
                cvs
            LEFT JOIN 
                phone_numbers ON cvs.id = phone_numbers.cv_id
            LEFT JOIN
                addresses ON cvs.id = addresses.cv_id
            LEFT JOIN
                education ON cvs.id = education.cv_id
            LEFT JOIN
                certificates ON cvs.id = certificates.cv_id
            LEFT JOIN
                professional_experience ON cvs.id = professional_experience.cv_id
            LEFT JOIN
                work_history ON cvs.id = work_history.cv_id
            LEFT JOIN
                other_information ON cvs.id = other_information.cv_id
            LEFT JOIN
                reference ON cvs.id = reference.cv_id
            WHERE 
                cvs.id = ?
        ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $cvId);
        $stmt->execute();
        $result = $stmt->get_result();

        $cv = [];
        while ($row = $result->fetch_assoc()) {
            // Basic CV information
            if (empty($cv)) {
                $cv = [
                    'id' => $row['id'],
                    'full_name' => $row['full_name'],
                    'job_title' => $row['job_title'],
                    'email' => $row['email'],
                    'gender' => $row['gender'],
                    'objective' => $row['objective'],
                    'visibility' => $row['visibility'],
                    'user_id' => $row['user_id'],
                    'phone_numbers' => [],
                    'addresses' => [],
                    'education' => [],
                    'certificates' => [],
                    'experience' => [],
                    'work_history' => [],
                    'other_information' => [],
                    'references' => []
                ];
            }

            // Aggregate unique phone numbers
            if (!empty($row['phone_number']) && !in_array($row['phone_number'], $cv['phone_numbers'])) {
                $cv['phone_numbers'][] = $row['phone_number'];
            }

            // Aggregate unique addresses
            $address = [
                'province_id' => $row['province_id'],
                'district_id' => $row['district_id'],
                'commune_id' => $row['commune_id'],
                'street_address' => $row['street_address']
            ];
            if (!in_array($address, $cv['addresses'])) {
                $cv['addresses'][] = $address;
            }

            // Aggregate unique education entries
            $education = [
                'degree' => $row['education_degree'],
                'major' => $row['education_major'],
                'school' => $row['education_school'],
                'start_month' => $row['education_start_month'],
                'start_year' => $row['education_start_year'],
                'end_month' => $row['education_end_month'],
                'end_year' => $row['education_end_year']
            ];
            if (!in_array($education, $cv['education'])) {
                $cv['education'][] = $education;
            }

            // Aggregate unique certificates
            $certificate = [
                'title' => $row['certificate_title'],
                'field' => $row['certificate_field'],
                'issue_year' => $row['certificate_issue_year'],
                'organization' => $row['certificate_organization']
            ];
            if (!in_array($certificate, $cv['certificates'])) {
                $cv['certificates'][] = $certificate;
            }

            // Aggregate unique professional experiences
            $experience = [
                'skill' => $row['experience_skill'],
                'years' => $row['experience_years']
            ];
            if (!in_array($experience, $cv['experience'])) {
                $cv['experience'][] = $experience;
            }

            // Aggregate unique work history
            $work = [
                'company' => $row['work_company'],
                'position' => $row['work_position'],
                'start_month' => $row['work_start_month'],
                'start_year' => $row['work_start_year'],
                'end_month' => $row['work_end_month'],
                'end_year' => $row['work_end_year']
            ];
            if (!in_array($work, $cv['work_history'])) {
                $cv['work_history'][] = $work;
            }

            // Aggregate unique other information
            $info = [
                'title' => $row['other_title'],
                'description' => $row['other_description']
            ];
            if (!in_array($info, $cv['other_information'])) {
                $cv['other_information'][] = $info;
            }

            // Aggregate unique references
            $reference = [
                'name' => $row['referee_name'],
                'relationship' => $row['referee_relationship'],
                'position' => $row['referee_position'],
                'workplace' => $row['referee_workplace'],
                'phone' => $row['referee_phone'],
                'email' => $row['referee_email']
            ];
            if (!in_array($reference, $cv['references'])) {
                $cv['references'][] = $reference;
            }
        }

        return $cv;
    } catch (Exception $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}
