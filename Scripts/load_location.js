function loadLocationData(targetDropdown = null) {
    fetch('/CV-management-website/Scripts/location.json')  // Adjust the path if necessary
        .then(response => response.json())
        .then(locationData => {
            if (targetDropdown) {
                // If a specific target dropdown is provided, populate only that row's dropdowns
                const provinceSelect = targetDropdown;
                const districtSelect = provinceSelect.closest('.address-row').querySelector('select[name="district[]"]');
                const communeSelect = provinceSelect.closest('.address-row').querySelector('select[name="commune[]"]');

                // Populate the Province dropdown for the specific row
                populateDropdown(provinceSelect, locationData.province, 'idProvince', 'name');

                // Event listener for Province selection
                provinceSelect.addEventListener("change", function () {
                    const selectedProvince = provinceSelect.value;
                    const filteredDistricts = locationData.district.filter(district => district.idProvince === selectedProvince);

                    // Populate the District dropdown for the current address row
                    populateDropdown(districtSelect, filteredDistricts, 'idDistrict', 'name');

                    // Enable the District dropdown and reset Commune dropdown
                    districtSelect.disabled = filteredDistricts.length === 0;
                    communeSelect.disabled = true;
                    communeSelect.innerHTML = '<option value="">Select a commune</option>';
                });

                // Event listener for District selection
                districtSelect.addEventListener("change", function () {
                    const selectedDistrict = districtSelect.value;
                    const filteredCommunes = locationData.commune.filter(commune => commune.idDistrict === selectedDistrict);

                    // Populate the Commune dropdown for the current address row
                    populateDropdown(communeSelect, filteredCommunes, 'idCommune', 'name');

                    // Enable the Commune dropdown if there are any filtered communes
                    communeSelect.disabled = filteredCommunes.length === 0;
                });
            } else {
                // If no specific target is provided, populate all address rows
                const addressContainers = document.querySelectorAll('.address-row');
                addressContainers.forEach(container => {
                    const provinceSelect = container.querySelector('select[name="province[]"]');
                    const districtSelect = container.querySelector('select[name="district[]"]');
                    const communeSelect = container.querySelector('select[name="commune[]"]');

                    if (provinceSelect && districtSelect && communeSelect) {
                        // Populate the Province dropdown
                        populateDropdown(provinceSelect, locationData.province, 'idProvince', 'name');

                        // Event listener for Province selection
                        provinceSelect.addEventListener("change", function () {
                            const selectedProvince = provinceSelect.value;
                            const filteredDistricts = locationData.district.filter(district => district.idProvince === selectedProvince);

                            // Populate the District dropdown for the current address row
                            populateDropdown(districtSelect, filteredDistricts, 'idDistrict', 'name');

                            // Enable the District dropdown and reset Commune dropdown
                            districtSelect.disabled = filteredDistricts.length === 0;
                            communeSelect.disabled = true;
                            communeSelect.innerHTML = '<option value="">Select a commune</option>';
                        });

                        // Event listener for District selection
                        districtSelect.addEventListener("change", function () {
                            const selectedDistrict = districtSelect.value;
                            const filteredCommunes = locationData.commune.filter(commune => commune.idDistrict === selectedDistrict);

                            // Populate the Commune dropdown for the current address row
                            populateDropdown(communeSelect, filteredCommunes, 'idCommune', 'name');

                            // Enable the Commune dropdown if there are any filtered communes
                            communeSelect.disabled = filteredCommunes.length === 0;
                        });
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error loading location data:', error);
        });
}

/**
 * Function to populate dropdown options.
 * @param {HTMLElement} selectElement - The select element to populate.
 * @param {Array} data - The data to populate the dropdown with.
 * @param {string} key - The key to use for option values.
 * @param {string} value - The key to use for option text.
 */
function populateDropdown(selectElement, data, key, value) {
    selectElement.innerHTML = '';  // Clear existing options

    const selectOption = document.createElement("option");
    selectOption.value = "";
    selectOption.textContent = "Select";
    selectOption.disabled = true;
    selectOption.selected = true;  // Make it selected by default
    selectElement.appendChild(selectOption);

    data.forEach(item => {
        const option = document.createElement("option");
        option.value = item[key];
        option.textContent = item[value];
        selectElement.appendChild(option);
    });
}
