<h2>Professional experience</h2>

<div id="skillContainer">
    <div class="skill-entry mb-4">
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <label for="skill" class="form-label">Skill</label>
                <input type="text" class="form-control" name="skill[]" placeholder="E.g. Python" required>
            </div>

            <div class="col-md-6">
                <label for="yearsOfExperience" class="form-label">Years of experience</label>
                <input type="number" class="form-control" name="yearsOfExperience[]" placeholder="E.g. 5" required
                    min="0" step="1" pattern="\d+">
            </div>
        </div>
        <button type="button" class="btn btn-danger remove-skill-btn d-none">Remove</button>
    </div>
</div>

<div class="d-flex justify-content-center mb-2">
    <button type="button" class="btn rounded-circle btn-add" id="addSkillBtn">
        <i class="bi bi-plus-circle-fill text-primary" style="font-size: larger;"></i>
    </button>
</div>

<h2>Work History</h2>
<div id="workContainer">
    <div class="work-entry mb-4">
        <div class="mb-2">
            <label for="company" class="form-label">Company Name</label>
            <input type="text" class="form-control" name="company[]" placeholder="E.g. ABC Co. Ltd." required>
        </div>

        <div class="mb-2">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" name="position[]" placeholder="E.g. Frontend Developer" required>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <label for="startWorkMonth" class="form-label">Start Month</label>
                <select class="form-select" name="startWorkMonth[]" required>
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
                <label for="startWorkYear" class="form-label">Start Year</label>
                <select class="form-select" name="startWorkYear[]" required>
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
                <label for="endWorkMonth" class="form-label">End Month</label>
                <select class="form-select" name="endWorkMonth[]">
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
                <label for="endWorkYear" class="form-label">End Year</label>
                <select class="form-select" name="endWorkYear[]">
                    <option value="" disabled selected>Select year</option>
                    <?php for ($year = 1970; $year <= 2024; $year++): ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        
        <button type="button" class="btn btn-danger remove-work-btn d-none">Remove</button>
    </div>
</div>

<div class="d-flex justify-content-center mb-2">
    <button type="button" class="btn rounded-circle btn-add" id="addWorkBtn">
        <i class="bi bi-plus-circle-fill text-primary" style="font-size: larger;"></i>
    </button>
</div>