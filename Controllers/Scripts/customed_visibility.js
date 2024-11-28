document.addEventListener('DOMContentLoaded', function () {
    const userRoleSelect = document.getElementById('userRole');
    const customUsersField = document.getElementById('customUsersField');

    userRoleSelect.addEventListener('change', function () {
        if (this.value === 'Custom User') {
            customUsersField.style.display = 'block';
        } else {
            customUsersField.style.display = 'none';
        }
    });
});
