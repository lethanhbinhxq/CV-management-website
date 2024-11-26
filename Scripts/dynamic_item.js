document.addEventListener('DOMContentLoaded', function () {
    initializePhoneNumberManagement();
});

/**
 * Initializes the phone number management system.
 */
function initializePhoneNumberManagement() {
    const container = document.getElementById('phoneNumbersContainer');
    const addPhoneNumberBtn = document.getElementById('addPhoneNumberBtn');

    // Add event listener to the "Add Phone Number" button
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
        phoneInput.classList.add('form-control');
        phoneInput.placeholder = 'Enter your phone number';
        phoneInput.required = true;

        // Create remove button
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'remove-phone-btn');
        removeButton.textContent = 'Remove';

        // Append input and button to the group
        newInputGroup.appendChild(phoneInput);
        newInputGroup.appendChild(removeButton);

        // Add the new input group to the container
        container.appendChild(newInputGroup);
    } else if (action === 'remove' && rowToRemove) {
        // Remove the specified row
        container.removeChild(rowToRemove);
    }

    // Update the visibility of the remove buttons
    updateRemoveButtons(container);
}

/**
 * Update the visibility of remove buttons based on the number of rows.
 * @param {HTMLElement} container - The container for phone numbers.
 */
function updateRemoveButtons(container) {
    const phoneNumberRows = container.querySelectorAll('.phone-number-row');
    const removeButtons = container.querySelectorAll('.remove-phone-btn');

    // Show remove buttons only if there are more than one rows
    removeButtons.forEach(button => button.classList.remove('d-none'));
    if (phoneNumberRows.length === 1) {
        removeButtons.forEach(button => button.classList.add('d-none'));
    }
}