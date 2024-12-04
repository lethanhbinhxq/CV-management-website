<h2>Education</h2>

<div id="educationContainer">
    <!-- Initial education entry (static) -->
    <div class="education-entry mb-4">
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <label for="degree" class="form-label">Degree</label>
                <input type="text" class="form-control" name="degree[]" placeholder="E.g. Bachelor" required>
                <div class="degree-error" style="color: red; font-size: 0.9rem; margin-top: 10px;"></div>
            </div>

            <div class="col-md-6">
                <label for="major" class="form-label">Major</label>
                <input type="text" class="form-control" name="major[]" placeholder="E.g. Computer Science" required>
                <div class="major-error" style="color: red; font-size: 0.9rem; margin-top: 10px;"></div>
            </div>
        </div>

        <div class="mb-3">
            <label for="school" class="form-label">School</label>
            <input type="text" class="form-control" name="school[]"
                placeholder="E.g. Ho Chi Minh City University of Technology" required>
            <div class="school-error" style="color: red; font-size: 0.9rem; margin-top: 10px;"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <label for="startMonth" class="form-label">Start Month</label>
                <select class="form-select" name="startMonth[]" required>
                    <option value="" disabled selected>Select month</option>
                    <!-- Months -->
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="startYear" class="form-label">Start Year</label>
                <select class="form-select" name="startYear[]" required>
                    <option value="" disabled selected>Select year</option>
                    <!-- Years -->
                    <?php for ($year = 1970; $year <= 2024; $year++): ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <label for="endMonth" class="form-label">End Month</label>
                <select class="form-select" name="endMonth[]">
                    <option value="" disabled selected>Select month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="endYear" class="form-label">End Year</label>
                <select class="form-select" name="endYear[]">
                    <option value="" disabled selected>Select year</option>
                    <?php for ($year = 1970; $year <= 2024; $year++): ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="start-end-error mb-2" style="color: red; font-size: 0.9rem; margin-top: 10px;"></div>

        <!-- Remove button -->
        <button type="button" class="btn btn-danger remove-education-btn d-none">Remove</button>
    </div>
</div>

<!-- Add Education Button -->
<div class="d-flex justify-content-center mb-2">
    <button type="button" class="btn rounded-circle btn-add" id="addEducationBtn">
        <i class="bi bi-plus-circle-fill text-primary" style="font-size: larger;"></i>
    </button>
</div>

<h2>Certificate</h2>

<div id="certificateContainer">
    <div class="certificate-entry mb-4">
        <div class="mb-3">
            <label for="certificateTitle" class="form-label">Certificate Title</label>
            <input type="text" class="form-control" name="certificateTitle[]" placeholder="E.g. IELTS certificate"
                required>
            <div class="certificateTitle-error mb-2" style="color: red; font-size: 0.9rem; margin-top: 10px;"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <label for="field" class="form-label">Field</label>
                <input type="text" class="form-control" name="field[]" placeholder="E.g. English" required>
                <div class="field-error mb-2" style="color: red; font-size: 0.9rem; margin-top: 10px;"></div>
            </div>

            <div class="col-md-6">
                <label for="issueYear" class="form-label">Issue Year</label>
                <select class="form-select" name="issueYear[]" required>
                    <option value="" disabled selected>Select year</option>
                    <!-- Years -->
                    <?php for ($year = 1970; $year <= 2024; $year++): ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="issuingOrganization" class="form-label">Issuing organization</label>
            <input type="text" class="form-control" name="issuingOrganization[]" placeholder="E.g. British Council"
                required>
            <div class="issuingOrganization-error mb-2" style="color: red; font-size: 0.9rem; margin-top: 10px;"></div>
        </div>

        <button type="button" class="btn btn-danger remove-certificate-btn d-none">Remove</button>
    </div>
</div>

<div class="d-flex justify-content-center mb-2">
    <button type="button" class="btn rounded-circle btn-add" id="addCertificateBtn">
        <i class="bi bi-plus-circle-fill text-primary" style="font-size: larger;"></i>
    </button>
</div>