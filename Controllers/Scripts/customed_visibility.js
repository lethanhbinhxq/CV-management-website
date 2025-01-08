document.addEventListener('DOMContentLoaded', function () {
    const visibilitySelect = document.getElementById('visibility');
    const customUsersField = document.getElementById('customUsersField');
    const userList = document.getElementById('userList');
    let usersLoaded = false; // Flag to prevent repeated fetch requests

    // Function to fetch and load users
    function loadUsers() {
        if (usersLoaded) return; // Skip if already loaded

        // Fetch users from the server
        fetch('/CV-management-website/Models/get_users.php')
            .then(response => response.json())
            .then(users => {
                if (users.length > 0) {
                    userList.innerHTML = users
                        .map(
                            user => `
                                <li>
                                    <label>
                                        <input type="checkbox" value="${user.id}" name="customUsers[]">
                                        ${user.full_name}
                                    </label>
                                </li>
                            `
                        )
                        .join('');
                    usersLoaded = true; // Mark users as loaded
                } else {
                    userList.innerHTML = '<li>No users found.</li>';
                }
            })
            .catch(error => {
                console.error('Error fetching users:', error);
                userList.innerHTML = '<li>Error loading users.</li>';
            });
    }

    // Event listener for user role selection
    visibilitySelect.addEventListener('change', function () {
        if (this.value === 'Custom') {
            customUsersField.style.display = 'block';
            loadUsers();
        } else {
            customUsersField.style.display = 'none';
        }
    });
});
