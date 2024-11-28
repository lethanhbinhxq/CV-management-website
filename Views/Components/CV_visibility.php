<div class="mb-3">
    <label for="visibility" class="form-label">Set visibility</label>
    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-html="true" title="
           <strong>Public</strong>: For everyone, including users not logged in.<br>
           <strong>Private</strong>: Only you can view it.<br>
           <strong>All Users</strong>: For all logged-in users.<br>
           <strong>Custom</strong>: For specified users only.">
    </i>
    <select class="form-select" id="userRole" name="userRole" required>
        <option value="" disabled selected>Select visibility</option>
        <option value="Public">Public</option>
        <option value="Private">Private</option>
        <option value="All Users">All Users</option>
        <option value="Custom User">Custom</option>
    </select>
</div>

<div class="mb-3" id="customUsersField" style="display: none;">
    <label for="customUsers" class="form-label">Select users</label>
    <div class="custom-multi-select">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle w-auto" data-bs-toggle="dropdown"
            aria-expanded="false">
            Select Users
        </button>

        <ul class="dropdown-menu p-3 w-auto" id="userList">
            <!-- Replace these with PHP code to fetch dynamically -->
            <li><label><input type="checkbox" value="User1" name="customUsers[]"> User1</label></li>
            <li><label><input type="checkbox" value="User2" name="customUsers[]"> User2</label></li>
            <li><label><input type="checkbox" value="User3" name="customUsers[]"> User3</label></li>
            <li><label><input type="checkbox" value="User4" name="customUsers[]"> User4</label></li>
        </ul>
    </div>
</div>