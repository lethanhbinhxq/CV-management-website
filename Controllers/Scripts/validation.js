// Reusable function to display specific errors
function displayFieldError(errorElement, error) {
    if (error) {
        errorElement.innerText = error;
    } else {
        errorElement.innerText = "";
    }
}

// Validation functions
function validateUsername(username) {
    const usernameRegex = /^[a-zA-Z][a-zA-Z0-9]*$/;

    if (username.length < 3 || username.length > 255) {
        return "Username must be between 3 and 255 characters.";
    }

    if (!usernameRegex.test(username)) {
        return "Username must start with a letter and contain only letters and numbers.";
    }

    return null; // No errors
}


function validatePassword(password) {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    return passwordRegex.test(password)
        ? null
        : "Password must be at least 8 characters long, include lowercase, uppercase, a number, and a special character.";
}

function validateFullName(fullName) {
    const fullNameRegex = /^[A-Z][a-z]*(?: [A-Z][a-z]*)*$/;

    // Trim whitespace
    fullName = fullName.trim();

    // Check length (e.g., 3 to 100 characters)
    if (fullName.length < 3 || fullName.length > 255) {
        return "Full Name must be between 3 and 255 characters.";
    }

    // Check format
    if (!fullNameRegex.test(fullName)) {
        return "Full Name must start with a capital letter and contain no numbers or special characters.";
    }

    return null; // No errors
}

function validateEmail(email) {
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Check the length of the email
    if (email.length > 255) {
        return "Email must not exceed 255 characters.";
    }

    // Validate the format
    if (!emailRegex.test(email)) {
        return "Email must follow these rules: \n" +
            "- Begin with letters, numbers, dots (.), underscores (_), percent signs (%), plus signs (+), or hyphens (-). \n" +
            "- Contain an '@' symbol followed by a valid domain name. \n" +
            "- End with a top-level domain (e.g., .com, .org) consisting of at least two letters.";
    }

    return null; // No errors
}

function validateJobTitle(jobTitle) {
    // Trim whitespace
    const trimmedTitle = jobTitle.trim();

    // Length constraints
    if (trimmedTitle.length < 2 || trimmedTitle.length > 100) {
        return "Job title must be between 2 and 100 characters.";
    }

    // Character constraints: letters, spaces, hyphens, ampersands, apostrophes, and periods
    const titleRegex = /^[a-zA-Z\s\-&'.]+$/;
    if (!titleRegex.test(trimmedTitle)) {
        return "Job title can only contain letters, spaces, hyphens, ampersands (&), apostrophes ('), and periods (.)";
    }

    // Success
    return null;
}

function validatePhoneNumber(phoneNumber) {
    const phonePattern = /^\d{10,11}$/; // Validates phone numbers with 10 or 11 digits
    return phonePattern.test(phoneNumber)
        ? null
        : "Phone number must be 10 or 11 digits.";
}
function validateDynamicPhoneNumbers(phoneFields) {
    let hasError = false;
    phoneFields.forEach((phoneField, index) => {
        const errorElement = document.querySelectorAll(".phone_number_error")[index]; // Corresponding error element
        const error = validatePhoneNumber(phoneField.value.trim());
        displayFieldError(errorElement, error);
        if (error) hasError = true;
    });
    return hasError;
}

function validateStreetAddress(address) {
    // Check length (2 to 255 characters)
    if (address.length < 2 || address.length > 255) {
        return "Street address must be between 2 and 255 characters.";
    }

    // Check for allowed characters (letters, numbers, spaces, slashes, hyphens, commas, periods, apostrophes, and quotes)
    const addressRegex = /^[a-zA-Z0-9\s\-\/\.,'"]+$/;
    if (!addressRegex.test(address.trim())) {
        return "Street address can only contain letters, numbers, spaces, slashes, hyphens, commas, periods, apostrophes, and quotes.";
    }

    return null; // No errors
}

function validateDynamicStreetAddress(addressFields) {
    let hasError = false;
    addressFields.forEach((address, index) => {
        const errorElement = document.querySelectorAll(".street_address_error")[index];
        const error = validateStreetAddress(address.value);
        displayFieldError(errorElement, error);
        if (error) hasError = true;
    });
    return hasError;
}

function validateCompanyName(name) {
    name = name.trim(); // Remove extra spaces

    // Length validation
    if (name.length < 2 || name.length > 255) {
        return "Company name must be between 2 and 255 characters.";
    }

    // Allowed characters validation
    const allowedCharactersRegex = /^[a-zA-Z0-9\s.,&\/-]+$/;
    if (!allowedCharactersRegex.test(name)) {
        return "Company name contains invalid characters.";
    }

    // Consecutive special characters validation
    const consecutiveSpecialCharsRegex = /[.,&\/-]{2,}/;
    if (consecutiveSpecialCharsRegex.test(name)) {
        return "Company name cannot have consecutive special characters.";
    }

    // Start or end with special characters validation
    const startEndSpecialCharsRegex = /^[.,&\/-]|[.,&\/-]$/;
    if (startEndSpecialCharsRegex.test(name)) {
        return "Company name cannot start or end with special characters.";
    }

    // At least one letter validation
    const onlySpecialCharsRegex = /^[0-9.,&\/-]+$/;
    if (onlySpecialCharsRegex.test(name)) {
        return "Company name must contain letters.";
    }

    return ""; // Valid
}

function validateDynamicCompanyName(companyFields) {
    let hasError = false;
    companyFields.forEach((company, index) => {
        const errorElement = document.querySelectorAll(".company-error")[index];
        const error = validateCompanyName(company.value);
        displayFieldError(errorElement, error);
        if (error) hasError = true;
    });
    return hasError;
}

function validateStartEndDate(startMonth, startYear, endMonth, endYear) {
    // Convert to Date objects for easy comparison
    const startDate = new Date(startYear, startMonth - 1); // JavaScript months are 0-indexed
    const endDate = new Date(endYear, endMonth - 1);

    // Check if the start date is later than the end date
    if (startDate > endDate) {
        return "Start date cannot be later in time than end date";
    }
    return null; // No errors
}

function validateDynamicEducationDate() {
    let hasError = false;
    
    // Get all start and end date fields
    const startMonths = document.querySelectorAll("select[name='startMonth[]']");
    const startYears = document.querySelectorAll("select[name='startYear[]']");
    const endMonths = document.querySelectorAll("select[name='endMonth[]']");
    const endYears = document.querySelectorAll("select[name='endYear[]']");
    
    startMonths.forEach((startMonth, index) => {
        const startYear = startYears[index].value;
        const endMonth = endMonths[index].value;
        const endYear = endYears[index].value;
        
        const errorElement = document.querySelectorAll(".start-end-error")[index];
        
        // Validate dates
        const error = validateStartEndDate(startMonth.value, startYear, endMonth, endYear);
        
        // Display error if validation fails
        displayFieldError(errorElement, error);
        
        if (error) hasError = true;
    });

    return hasError;
}

function validateDynamicWorkDate() {
    let hasError = false;
    
    // Get all start and end date fields
    const startMonths = document.querySelectorAll("select[name='startWorkMonth[]']");
    const startYears = document.querySelectorAll("select[name='startWorkYear[]']");
    const endMonths = document.querySelectorAll("select[name='endWorkMonth[]']");
    const endYears = document.querySelectorAll("select[name='endWorkYear[]']");
    
    startMonths.forEach((startMonth, index) => {
        const startYear = startYears[index].value;
        const endMonth = endMonths[index].value;
        const endYear = endYears[index].value;
        
        const errorElement = document.querySelectorAll(".work-start-end-error")[index];
        
        // Validate dates
        const error = validateStartEndDate(startMonth.value, startYear, endMonth, endYear);
        
        // Display error if validation fails
        displayFieldError(errorElement, error);
        
        if (error) hasError = true;
    });

    return hasError;
}

// General validation function for text fields (degree, major, school, etc)
function validateTextField(value, fieldType) {
    const capitalizedFieldType = fieldType.charAt(0).toUpperCase() + fieldType.slice(1);

    if (value.length < 2 || value.length > 255) {
        return `${capitalizedFieldType} must be between 2 and 255 characters.`;
    }

    // Check for allowed characters (letters, spaces, hyphens, apostrophes, periods)
    const regex = /^[a-zA-Z\s\-'.]+$/;
    if (!regex.test(value.trim())) {
        return `${capitalizedFieldType} can only contain letters, spaces, hyphens, apostrophes, and periods.`;
    }

    return null; // No errors
}

// Validate dynamic text fields (degree, major, school) with type-specific error handling
function validateDynamicTextFields(fieldElements, fieldType) {
    let hasError = false;

    fieldElements.forEach((field, index) => {
        // Dynamically select the error element based on fieldType (e.g., major-error, degree-error)
        const errorElement = document.querySelectorAll(`.${fieldType}-error`)[index];
        const error = validateTextField(field.value, fieldType);
        displayFieldError(errorElement, error);
        if (error) hasError = true;
    });

    return hasError;
}

// Handle form submission
function handleFormSubmit(form, validations, dynamicValidations = []) {
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        let hasError = false;

        // Validate static fields
        validations.forEach(({ value, validate, errorElement }) => {
            const error = validate(value());
            displayFieldError(errorElement, error);
            if (error) hasError = true;
        });

        // Validate dynamic fields
        dynamicValidations.forEach((validateDynamic) => {
            if (validateDynamic()) hasError = true;
        });

        // Submit form if no errors
        if (!hasError) {
            form.submit();
        }
    });
}

// Get forms
const loginForm = document.getElementById("login_form");
const signupForm = document.getElementById("signup_form");
const createCVForm = document.getElementById("createCV_form");

if (loginForm) {
    handleFormSubmit(loginForm, [
        {
            value: () => document.getElementById("username").value.trim(),
            validate: validateUsername,
            errorElement: document.getElementById("username_error"),
        },
        {
            value: () => document.getElementById("password").value,
            validate: validatePassword,
            errorElement: document.getElementById("password_error"),
        },
    ]);
}

if (signupForm) {
    handleFormSubmit(signupForm, [
        {
            value: () => document.getElementById("full_name").value.trim(),
            validate: validateFullName,
            errorElement: document.getElementById("full_name_error"),
        },
        {
            value: () => document.getElementById("email").value.trim(),
            validate: validateEmail,
            errorElement: document.getElementById("email_error"),
        },
        {
            value: () => document.getElementById("username").value.trim(),
            validate: validateUsername,
            errorElement: document.getElementById("username_error"),
        },
        {
            value: () => document.getElementById("password").value,
            validate: validatePassword,
            errorElement: document.getElementById("password_error"),
        },
    ]);
}

if (createCVForm) {
    handleFormSubmit(createCVForm, [
        {
            value: () => document.getElementById("full_name").value.trim(),
            validate: validateFullName,
            errorElement: document.getElementById("full_name_error"),
        },

        {
            value: () => document.getElementById("email").value.trim(),
            validate: validateEmail,
            errorElement: document.getElementById("email_error"),
        },

        {
            value: () => document.getElementById("job_title").value.trim(),
            validate: validateJobTitle,
            errorElement: document.getElementById("job_title_error"),
        },
    ], [
        // Dynamic validation function
        () => validateDynamicPhoneNumbers(document.querySelectorAll(".phoneNumber")),
        () => validateDynamicStreetAddress(document.querySelectorAll("input[name='streetAddress[]']")),

        () => validateDynamicTextFields(document.querySelectorAll("input[name='degree[]']"), 'degree'),
        () => validateDynamicTextFields(document.querySelectorAll("input[name='major[]']"), 'major'),
        () => validateDynamicTextFields(document.querySelectorAll("input[name='school[]']"), 'school'),
        () => validateDynamicEducationDate(),

        () => validateDynamicTextFields(document.querySelectorAll("input[name='certificateTitle[]']"), 'certificateTitle'),
        () => validateDynamicTextFields(document.querySelectorAll("input[name='field[]']"), 'field'),
        () => validateDynamicTextFields(document.querySelectorAll("input[name='issuingOrganization[]']"), 'issuingOrganization'),

        () => validateDynamicTextFields(document.querySelectorAll("input[name='skill[]']"), 'skill'),

        () => validateDynamicCompanyName(document.querySelectorAll("input[name='company[]']"), 'company'),
        () => validateDynamicTextFields(document.querySelectorAll("input[name='position[]']"), 'position'),
        () => validateDynamicWorkDate()
    ]
    );
}