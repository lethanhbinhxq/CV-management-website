<h2>Personal Information</h2>

<div class="row justify-content-center mb-3">
    <div class="col-md-6">
        <label for="fullName" class="form-label">Full name</label>
        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name"
            required>
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="jobTitle" class="form-label">Job title</label>
        <input type="text" class="form-control" id="jobTitle" name="jobTitle" placeholder="Enter job title" required>
    </div>

    <div class="col-md-6">
        <p>Gender</p>
        <div class="form-check d-inline-block me-3">
            <input class="form-check-input" type="radio" name="gender" id="radioMale" checked>
            <label class="form-check-label" for="radioMale" value="M">
                Male
            </label>
        </div>

        <div class="form-check d-inline-block me-3">
            <input class="form-check-input" type="radio" name="gender" id="radioFemale" value="F">
            <label class="form-check-label" for="radioFemale">
                Female
            </label>
        </div>
    </div>
</div>

<div>
    <label for="phoneNumber" class="form-label">Phone Number</label>
    <div id="phoneNumbersContainer">
        <div class="input-group mb-2 phone-number-row">
            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumbers[]"
                placeholder="Enter your phone number" required>
            <button type="button" class="btn btn-danger remove-phone-btn d-none">Remove</button>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="button" class="btn rounded-circle btn-add" id="addPhoneNumberBtn">
            <i class="bi bi-plus-circle-fill text-primary" style="font-size: larger;"></i>
        </button>
    </div>
</div>

<!-- Address -->

<div class="mb-3">
    <p>Address</p>
    <div id="addressContainer">
        <!-- Address row template -->
        <div class="address-row mb-2">
            <div class="mb-2">
                <label for="province" class="text-main-pink">Province</label>
                <select name="province[]" class="form-select" required>
                    <option value="">Select a province</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="district" class="text-main-pink">District</label>
                <select name="district[]" class="form-select" disabled required>
                    <option value="">Select a district</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="commune" class="text-main-pink">Commune</label>
                <select name="commune[]" class="form-select" disabled required>
                    <option value="">Select a commune</option>
                </select>
            </div>

            <div class="mb-2">
                <label for="streetAddress" class="text-main-pink">Street address</label>
                <input type="text" class="form-control" name="streetAddress[]" placeholder="Enter your street address" required>
            </div>

            <button type="button" class="btn btn-danger remove-address-btn d-none">Remove</button>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="button" class="btn rounded-circle btn-add" id="addAddressBtn">
            <i class="bi bi-plus-circle-fill text-primary" style="font-size: larger;"></i>
        </button>
    </div>
</div>

<div class="mb-3">
    <label for="objective" class="form-label">Objective</label>
    <textarea class="form-control" id="objective" name="objective" rows="5" placeholder="Enter your objective." required></textarea>
</div>