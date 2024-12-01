document.addEventListener('DOMContentLoaded', function () {
    initializePhoneNumberManagement();
    initializeEducationManagement();
    
    initializeAddressManagement(); 
    loadLocationData(); 
    
    initializeCertificateManagement();
    initializeSkillManagement();
    initializeWorkManagement();

    initializeOtherManagement();
    initializeReferenceManagement();
});

/**
 * Initializes the phone number management system.
 */
function initializePhoneNumberManagement() {
    const container = document.getElementById('phoneNumbersContainer');
    const addPhoneNumberBtn = document.getElementById('addPhoneNumberBtn');

    // Add event listener to the "Add Phone Number" button
    if (container && addPhoneNumberBtn) {
        addPhoneNumberBtn.addEventListener('click', function () {
            managePhoneNumbers(container, 'add');
        });
    
        // Delegate event for "Remove" buttons
        container.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-phone-btn')) {
                const phoneRow = event.target.closest('.phone-number-row');
                managePhoneNumbers(container, 'remove', phoneRow);
            }
        });
    }
}

/**
 * Manage phone numbers dynamically.
 * @param {HTMLElement} container - The container for phone numbers.
 * @param {string} action - The action to perform ('add' or 'remove').
 * @param {HTMLElement} [rowToRemove] - The row to remove (only for 'remove' action).
 */
function managePhoneNumbers(container, action, rowToRemove = null) {
    if (action === 'add') {
        // Create a new phone number row
        const newInputGroup = document.createElement('div');
        newInputGroup.classList.add('input-group', 'mb-2', 'phone-number-row');

        // Create phone input
        const phoneInput = document.createElement('input');
        phoneInput.type = 'tel';
        phoneInput.name = 'phoneNumbers[]';
        phoneInput.classList.add('form-control', 'phoneNumber');
        phoneInput.placeholder = 'Enter your phone number';
        phoneInput.required = true;

        // Create remove button
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'remove-phone-btn');
        removeButton.textContent = 'Remove';

        // Create error message container
        const errorMessageContainer = document.createElement('div');
        errorMessageContainer.classList.add('phone_number_error');
        errorMessageContainer.style.color = 'red';
        errorMessageContainer.style.fontSize = '0.9rem';
        errorMessageContainer.style.marginTop = '10px';

        // Append input, button, and error message container to the group
        newInputGroup.appendChild(phoneInput);
        newInputGroup.appendChild(removeButton);

        // Add the error message container after the phone number input
        container.appendChild(newInputGroup);
        container.appendChild(errorMessageContainer);

        // Add event listener to validate phone number
        phoneInput.addEventListener('input', function() {
            validatePhoneNumber(phoneInput, errorMessageContainer);
        });

    } else if (action === 'remove' && rowToRemove) {
        // Remove the specified row
        container.removeChild(rowToRemove);
    }

    // Update the visibility of the remove buttons
    updateRemovePhoneButtons(container);
}


/**
 * Update the visibility of remove buttons based on the number of rows.
 * @param {HTMLElement} container - The container for phone numbers.
 */
function updateRemovePhoneButtons(container) {
    const phoneNumberRows = container.querySelectorAll('.phone-number-row');
    const removeButtons = container.querySelectorAll('.remove-phone-btn');

    // Show remove buttons only if there are more than one rows
    removeButtons.forEach(button => button.classList.remove('d-none'));
    if (phoneNumberRows.length === 1) {
        removeButtons.forEach(button => button.classList.add('d-none'));
    }
}

/**
 * Initialize dynamic education section management.
 */
function initializeEducationManagement() {
    const educationContainer = document.getElementById('educationContainer');
    const addEducationBtn = document.getElementById('addEducationBtn');

    if (educationContainer && addEducationBtn) {
        // Add new education entry
        addEducationBtn.addEventListener('click', function () {
            manageEducationEntries(educationContainer, 'add');
        });

        // Delegate event for remove buttons
        educationContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-education-btn')) {
                const educationEntry = event.target.closest('.education-entry');
                manageEducationEntries(educationContainer, 'remove', educationEntry);
            }
        });
    }
}

/**
 * Manage education entries dynamically.
 * @param {HTMLElement} container - The container for education entries.
 * @param {string} action - The action to perform ('add' or 'remove').
 * @param {HTMLElement} [entryToRemove] - The entry to remove (only for 'remove' action).
 */
function manageEducationEntries(container, action, entryToRemove = null) {
    if (action === 'add') {
        // Clone the first education entry
        const firstEntry = container.querySelector('.education-entry');
        if (firstEntry) {
            const newEntry = firstEntry.cloneNode(true);

            // Clear input values
            newEntry.querySelectorAll('input, select').forEach(input => {
                if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });

            newEntry.querySelectorAll('.degree-error, .major-error, .school-error').forEach(errorElement => {
                errorElement.textContent = ''; // Clear any previous error messages
            });

            // Remove 'd-none' class from remove button
            const removeButton = newEntry.querySelector('.remove-education-btn');
            if (removeButton) {
                removeButton.classList.remove('d-none');
            }

            // Append the new entry
            container.appendChild(newEntry);
        }
    } else if (action === 'remove' && entryToRemove) {
        // Remove the specified education entry
        container.removeChild(entryToRemove);
    }

    // Update remove button visibility
    updateRemoveEducationButtons(container);
}

/**
 * Update visibility of remove buttons based on the number of entries.
 * @param {HTMLElement} container - The container for education entries.
 */
function updateRemoveEducationButtons(container) {
    const educationEntries = container.querySelectorAll('.education-entry');
    const removeButtons = container.querySelectorAll('.remove-education-btn');

    // Show remove buttons only if there are more than one entries
    removeButtons.forEach(button => button.classList.remove('d-none'));
    if (educationEntries.length === 1) {
        removeButtons.forEach(button => button.classList.add('d-none'));
    }
}

function initializeAddressManagement() {
    const container = document.getElementById('addressContainer');
    const addAddressBtn = document.getElementById('addAddressBtn');

    // Add event listener to the "Add Address" button
    if (container && addAddressBtn) {
        addAddressBtn.addEventListener('click', function () {
            manageAddress(container, 'add');
        });

        // Delegate event for "Remove" buttons
        container.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-address-btn')) {
                const addressRow = event.target.closest('.address-row');
                manageAddress(container, 'remove', addressRow);
            }
        });
    }
}

/**
 * Manage address entries dynamically.
 * @param {HTMLElement} container - The container for address entries.
 * @param {string} action - The action to perform ('add' or 'remove').
 * @param {HTMLElement} [rowToRemove] - The row to remove (only for 'remove' action).
 */
function manageAddress(container, action, rowToRemove = null) {
    if (action === 'add') {
        // Create a new address row
        const newAddressRow = document.createElement('div');
        newAddressRow.classList.add('address-row', 'mb-2');

        // Add the address fields and the remove button
        newAddressRow.innerHTML = ` 
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

            <button type="button" class="btn btn-danger remove-address-btn">Remove</button>
        `;

        // Add the new row to the container
        container.appendChild(newAddressRow);

        // Reinitialize the province dropdown for the newly added address row
        const newProvinceDropdown = newAddressRow.querySelector('select[name="province[]"]');
        loadLocationData(newProvinceDropdown); // Populate only the new province dropdown
    } else if (action === 'remove' && rowToRemove) {
        // Remove the specified row
        container.removeChild(rowToRemove);
    }
    updateRemoveAddressButtons(container);
}

function updateRemoveAddressButtons(container) {
    const addressRow = container.querySelectorAll('.address-row');
    const removeButtons = container.querySelectorAll('.remove-address-btn');

    // Show remove buttons only if there are more than one entries
    removeButtons.forEach(button => button.classList.remove('d-none'));
    if (addressRow.length === 1) {
        removeButtons.forEach(button => button.classList.add('d-none'));
    }
}

/**
 * Initialize dynamic certificate section management.
 */
function initializeCertificateManagement() {
    const certificateContainer = document.getElementById('certificateContainer');
    const addCertificateBtn = document.getElementById('addCertificateBtn');

    if (certificateContainer && addCertificateBtn) {
        // Add new certificate entry
        addCertificateBtn.addEventListener('click', function () {
            manageCertificateEntries(certificateContainer, 'add');
        });

        // Delegate event for remove buttons
        certificateContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-certificate-btn')) {
                const certificateEntry = event.target.closest('.certificate-entry');
                manageCertificateEntries(certificateContainer, 'remove', certificateEntry);
            }
        });
    }
}

function manageCertificateEntries(container, action, entryToRemove = null) {
    if (action === 'add') {
        // Clone the first certificate entry
        const firstEntry = container.querySelector('.certificate-entry');
        if (firstEntry) {
            const newEntry = firstEntry.cloneNode(true);

            // Clear input values
            newEntry.querySelectorAll('input, select').forEach(input => {
                if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });

            // Remove 'd-none' class from remove button
            const removeButton = newEntry.querySelector('.remove-certificate-btn');
            if (removeButton) {
                removeButton.classList.remove('d-none');
            }

            // Append the new entry
            container.appendChild(newEntry);
        }
    } else if (action === 'remove' && entryToRemove) {
        // Remove the specified certificate entry
        container.removeChild(entryToRemove);
    }

    // Update remove button visibility
    updateRemoveCertificateButtons(container);
}

function updateRemoveCertificateButtons(container) {
    const certificateEntries = container.querySelectorAll('.certificate-entry');
    const removeButtons = container.querySelectorAll('.remove-certificate-btn');

    // Show remove buttons only if there are more than one entries
    removeButtons.forEach(button => button.classList.remove('d-none'));
    if (certificateEntries.length === 1) {
        removeButtons.forEach(button => button.classList.add('d-none'));
    }
}

/**
 * Initialize dynamic skill section management.
 */
function initializeSkillManagement() {
    const skillContainer = document.getElementById('skillContainer');
    const addSkillBtn = document.getElementById('addSkillBtn');

    if (skillContainer && addSkillBtn) {
        // Add new skill entry
        addSkillBtn.addEventListener('click', function () {
            manageSkillEntries(skillContainer, 'add');
        });

        // Delegate event for remove buttons
        skillContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-skill-btn')) {
                const skillEntry = event.target.closest('.skill-entry');
                manageSkillEntries(skillContainer, 'remove', skillEntry);
            }
        });
    }
}

function manageSkillEntries(container, action, entryToRemove = null) {
    if (action === 'add') {
        // Clone the first skill entry
        const firstEntry = container.querySelector('.skill-entry');
        if (firstEntry) {
            const newEntry = firstEntry.cloneNode(true);

            // Clear input values
            newEntry.querySelectorAll('input, select').forEach(input => {
                if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });

            // Remove 'd-none' class from remove button
            const removeButton = newEntry.querySelector('.remove-skill-btn');
            if (removeButton) {
                removeButton.classList.remove('d-none');
            }

            // Append the new entry
            container.appendChild(newEntry);
        }
    } else if (action === 'remove' && entryToRemove) {
        // Remove the specified skill entry
        container.removeChild(entryToRemove);
    }

    // Update remove button visibility
    updateRemoveSkillButtons(container);
}

function updateRemoveSkillButtons(container) {
    const skillEntries = container.querySelectorAll('.skill-entry');
    const removeButtons = container.querySelectorAll('.remove-skill-btn');

    // Show remove buttons only if there are more than one entries
    removeButtons.forEach(button => button.classList.remove('d-none'));
    if (skillEntries.length === 1) {
        removeButtons.forEach(button => button.classList.add('d-none'));
    }
}

/**
 * Initialize dynamic work section management.
 */
function initializeWorkManagement() {
    const workContainer = document.getElementById('workContainer');
    const addWorkBtn = document.getElementById('addWorkBtn');

    if (workContainer && addWorkBtn) {
        // Add new work entry
        addWorkBtn.addEventListener('click', function () {
            manageWorkEntries(workContainer, 'add');
        });

        // Delegate event for remove buttons
        workContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-work-btn')) {
                const workEntry = event.target.closest('.work-entry');
                manageWorkEntries(workContainer, 'remove', workEntry);
            }
        });
    }
}

function manageWorkEntries(container, action, entryToRemove = null) {
    if (action === 'add') {
        // Clone the first work entry
        const firstEntry = container.querySelector('.work-entry');
        if (firstEntry) {
            const newEntry = firstEntry.cloneNode(true);

            // Clear input values
            newEntry.querySelectorAll('input, select').forEach(input => {
                if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });

            // Remove 'd-none' class from remove button
            const removeButton = newEntry.querySelector('.remove-work-btn');
            if (removeButton) {
                removeButton.classList.remove('d-none');
            }

            // Append the new entry
            container.appendChild(newEntry);
        }
    } else if (action === 'remove' && entryToRemove) {
        // Remove the specified work entry
        container.removeChild(entryToRemove);
    }

    // Update remove button visibility
    updateRemoveWorkButtons(container);
}

function updateRemoveWorkButtons(container) {
    const workEntries = container.querySelectorAll('.work-entry');
    const removeButtons = container.querySelectorAll('.remove-work-btn');

    // Show remove buttons only if there are more than one entries
    removeButtons.forEach(button => button.classList.remove('d-none'));
    if (workEntries.length === 1) {
        removeButtons.forEach(button => button.classList.add('d-none'));
    }
}

/**
 * Initialize dynamic other section management.
 */
function initializeOtherManagement() {
    const otherContainer = document.getElementById('otherContainer');
    const addOtherBtn = document.getElementById('addOtherBtn');

    if (otherContainer && addOtherBtn) {
        // Add new other entry
        addOtherBtn.addEventListener('click', function () {
            manageOtherEntries(otherContainer, 'add');
        });

        // Delegate event for remove buttons
        otherContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-other-btn')) {
                const otherEntry = event.target.closest('.other-entry');
                manageOtherEntries(otherContainer, 'remove', otherEntry);
            }
        });
    }
}

function manageOtherEntries(container, action, entryToRemove = null) {
    if (action === 'add') {
        // Clone the first other entry
        const firstEntry = container.querySelector('.other-entry');
        if (firstEntry) {
            const newEntry = firstEntry.cloneNode(true);

            // Clear input values
            newEntry.querySelectorAll('input, select').forEach(input => {
                if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });

            // Remove 'd-none' class from remove button
            const removeButton = newEntry.querySelector('.remove-other-btn');
            if (removeButton) {
                removeButton.classList.remove('d-none');
            }

            // Append the new entry
            container.appendChild(newEntry);
        }
    } else if (action === 'remove' && entryToRemove) {
        // Remove the specified other entry
        container.removeChild(entryToRemove);
    }

    // Update remove button visibility
    updateRemoveOtherButtons(container);
}

function updateRemoveOtherButtons(container) {
    const otherEntries = container.querySelectorAll('.other-entry');
    const removeButtons = container.querySelectorAll('.remove-other-btn');

    // Show remove buttons only if there are more than one entries
    removeButtons.forEach(button => button.classList.remove('d-none'));
    if (otherEntries.length === 1) {
        removeButtons.forEach(button => button.classList.add('d-none'));
    }
}

/**
 * Initialize dynamic reference section management.
 */
function initializeReferenceManagement() {
    const referenceContainer = document.getElementById('referenceContainer');
    const addReferenceBtn = document.getElementById('addReferenceBtn');

    if (referenceContainer && addReferenceBtn) {
        // Add new reference entry
        addReferenceBtn.addEventListener('click', function () {
            manageReferenceEntries(referenceContainer, 'add');
        });

        // Delegate event for remove buttons
        referenceContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-reference-btn')) {
                const referenceEntry = event.target.closest('.reference-entry');
                manageReferenceEntries(referenceContainer, 'remove', referenceEntry);
            }
        });
    }
}

function manageReferenceEntries(container, action, entryToRemove = null) {
    if (action === 'add') {
        // Clone the first reference entry
        const firstEntry = container.querySelector('.reference-entry');
        if (firstEntry) {
            const newEntry = firstEntry.cloneNode(true);

            // Clear input values
            newEntry.querySelectorAll('input, select').forEach(input => {
                if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
            });

            // Remove 'd-none' class from remove button
            const removeButton = newEntry.querySelector('.remove-reference-btn');
            if (removeButton) {
                removeButton.classList.remove('d-none');
            }

            // Append the new entry
            container.appendChild(newEntry);
        }
    } else if (action === 'remove' && entryToRemove) {
        // Remove the specified reference entry
        container.removeChild(entryToRemove);
    }

    // Update remove button visibility
    updateRemoveReferenceButtons(container);
}

function updateRemoveReferenceButtons(container) {
    const referenceEntries = container.querySelectorAll('.reference-entry');
    const removeButtons = container.querySelectorAll('.remove-reference-btn');

    // Show remove buttons only if there are more than one entries
    removeButtons.forEach(button => button.classList.remove('d-none'));
    if (referenceEntries.length === 1) {
        removeButtons.forEach(button => button.classList.add('d-none'));
    }
}