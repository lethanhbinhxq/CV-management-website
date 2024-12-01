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
        // Dynamic validation function for phone numbers
        () => validateDynamicPhoneNumbers(document.querySelectorAll(".phoneNumber"))
    ]
    );
}