<div class="container my-4">

    <h1 class="my-4 text-center text-uppercase fw-bold text-main-pink">Create CV</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-form rounded">

                <form method="post" class="p-5 mb-5" id="createCV_form">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullName" class="form-label">Full name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName"
                                placeholder="Enter your full name" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jobTitle" class="form-label">Job title</label>
                            <input type="text" class="form-control" id="jobTitle" name="jobTitle"
                                placeholder="Enter job title" required>
                        </div>

                        <div class="col-md-6 mb-3">
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

                        <button type="button" class="btn rounded-circle" id="addPhoneNumberBtn">
                            <i class="bi bi-plus-circle-fill text-primary" style="font-size: larger;"></i>
                        </button>
                    </div>

                    <button type="submit" class="mt-2 btn btn-primary">Create CV</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/CV-management-website/Scripts/dynamic_item.js"></script>