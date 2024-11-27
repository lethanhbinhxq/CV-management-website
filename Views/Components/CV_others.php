<h2>Other information</h2>

<div id="otherContainer">
    <div class="other-entry mb-2">
        <div class="mb-2">
            <label for="otherTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="otherTitle" name="otherTitle[]"
                placeholder="E.g. Hobbies & Interests, Voluntary work, etc." required>
        </div>

        <div class="mb-2">
            <label for="otherDescription" class="form-label">Description</label>
            <textarea class="form-control" id="otherDescription" name="otherDescription[]" rows="5"
                placeholder="E.g. Website Design, Artificial Intelligent, etc." required></textarea>
        </div>

        <button type="button" class="btn btn-danger remove-other-btn d-none">Remove</button>
    </div>
</div>

<div class="d-flex justify-content-center">
    <button type="button" class="btn rounded-circle btn-add" id="addOtherBtn">
        <i class="bi bi-plus-circle-fill text-primary" style="font-size: larger;"></i>
    </button>
</div>


<h2>Reference</h2>

<div id="referenceContainer">
    <div class="reference-entry mb-2">

        <div class="mb-2 row">
            <div class="col-md-6">
                <label for="refereeName" class="form-label">Referee name</label>
                <input type="text" class="form-control" id="refereeName" name="refereeName[]" placeholder="Prof. ABC"
                    required>
            </div>

            <div class="col-md-6">
                <label for="relationship" class="form-label">Relationship</label>
                <input type="text" class="form-control" id="relationship" name="relationship[]"
                    placeholder="E.g. Academic advisor" required>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="col-md-6">
                <label for="refereePosition" class="form-label">Position</label>
                <input type="text" class="form-control" id="refereePosition" name="refereePosition[]"
                    placeholder="E.g. Head of CSE Faculty" required>
            </div>

            <div class="col-md-6">
                <label for="refereeWorkplace" class="form-label">Workplace</label>
                <input type="text" class="form-control" id="refereeWorkplace" name="refereeWorkplace[]"
                    placeholder="E.g. XYZ University " required>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="col-md-6">
                <label for="refereePhoneNumber" class="form-label">Phone number</label>
                <input type="tel" class="form-control" id="refereePhoneNumber" name="refereePhoneNumber[]"
                    placeholder="E.g. 0123456789" required>
            </div>

            <div class="col-md-6">
                <label for="refereeEmail" class="form-label">Email</label>
                <input type="text" class="form-control" id="refereeEmail" name="refereeEmail[]"
                    placeholder="E.g. abc@123.com" required>
            </div>
        </div>

        <button type="button" class="btn btn-danger remove-reference-btn d-none">Remove</button>
    </div>
</div>

<div class="d-flex justify-content-center">
    <button type="button" class="btn rounded-circle btn-add" id="addReferenceBtn">
        <i class="bi bi-plus-circle-fill text-primary" style="font-size: larger;"></i>
    </button>
</div>