document.getElementById("searchByText").addEventListener("input", function () {
    const query = this.value;
    const autocompleteList = document.getElementById("autocomplete-list");

    if (query.length > 0) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `/CV-management-website/Models/fetch_searching.php?keyword=${encodeURIComponent(query)}`, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                // Clear existing suggestions
                autocompleteList.innerHTML = "";
                autocompleteList.style.display = "block"; // Show the autocomplete list

                // Add Full Names
                if (response.full_names && response.full_names.length > 0) {
                    const fullNameHeader = document.createElement("div");
                    fullNameHeader.className = "dropdown-header text-primary fw-bold";
                    fullNameHeader.textContent = "Full Names";
                    autocompleteList.appendChild(fullNameHeader);

                    response.full_names.forEach(fullName => {
                        const fullNameOption = document.createElement("a");
                        fullNameOption.className = "dropdown-item";
                        fullNameOption.href = `index.php?page=searchCV&keyword=${encodeURIComponent(fullName)}`;
                        fullNameOption.textContent = fullName;
                        autocompleteList.appendChild(fullNameOption);
                    });
                }

                // Add Job Titles
                if (response.job_titles && response.job_titles.length > 0) {
                    const jobTitleHeader = document.createElement("div");
                    jobTitleHeader.className = "dropdown-header text-primary fw-bold";
                    jobTitleHeader.textContent = "Job Titles";
                    autocompleteList.appendChild(jobTitleHeader);

                    response.job_titles.forEach(jobTitle => {
                        const jobTitleOption = document.createElement("a");
                        jobTitleOption.className = "dropdown-item";
                        jobTitleOption.href = `index.php?page=searchCV&keyword=${encodeURIComponent(jobTitle)}`;
                        jobTitleOption.textContent = jobTitle;
                        autocompleteList.appendChild(jobTitleOption);
                    });
                }

                // No Matches Found
                if (response.full_names.length === 0 && response.job_titles.length === 0) {
                    const noResult = document.createElement("a");
                    noResult.className = "dropdown-item disabled";
                    noResult.textContent = "No matches found";
                    autocompleteList.appendChild(noResult);
                }
            }
        };

        xhr.send();
    } else {
        autocompleteList.style.display = "none"; // Hide dropdown when input is empty
    }
});

// Hide autocomplete list when clicking outside of the search input or the autocomplete list
document.addEventListener("click", function (event) {
    const autocompleteList = document.getElementById("autocomplete-list");
    const searchInput = document.getElementById("searchByText");

    // If the clicked element is not the search input or the autocomplete list, hide the dropdown
    if (!searchInput.contains(event.target) && !autocompleteList.contains(event.target)) {
        autocompleteList.style.display = "none";
    }
});

// Show autocomplete list when clicking the search input
document.getElementById("searchByText").addEventListener("focus", function () {
    const query = this.value;
    const autocompleteList = document.getElementById("autocomplete-list");

    if (query.length > 0) {
        autocompleteList.style.display = "block";
    }
});
