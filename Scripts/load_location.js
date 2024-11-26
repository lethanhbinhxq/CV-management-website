function loadLocationData() {
    fetch('/CV-management-website/Scripts/location.json')  // Adjust the path if necessary
        .then(response => response.json())
        .then(locationData => {
            // Get the select elements
            const provinceSelect = document.getElementById("province");
            const districtSelect = document.getElementById("district");
            const communeSelect = document.getElementById("commune");

            if (provinceSelect && districtSelect && communeSelect) {
                // Function to populate dropdown options
                function populateDropdown(selectElement, data, key, value) {
                    selectElement.innerHTML = '';  // Clear existing options

                    // Add the "Select" option as disabled
                    const selectOption = document.createElement("option");
                    selectOption.value = "";
                    selectOption.textContent = "Select";
                    selectOption.disabled = true;
                    selectOption.selected = true;  // Make it selected by default
                    selectElement.appendChild(selectOption);

                    // Add the rest of the options
                    data.forEach(item => {
                        const option = document.createElement("option");
                        option.value = item[key];
                        option.textContent = item[value];
                        selectElement.appendChild(option);
                    });
                }

                // Populate the Province dropdown
                populateDropdown(provinceSelect, locationData.province, "idProvince", "name");

                // Event listener for Province selection
                provinceSelect.addEventListener("change", function () {
                    const selectedProvince = provinceSelect.value;

                    // Filter the districts by selected province
                    const filteredDistricts = locationData.district.filter(district => district.idProvince === selectedProvince);

                    // Populate the District dropdown
                    populateDropdown(districtSelect, filteredDistricts, "idDistrict", "name");

                    // Enable the District dropdown and reset Commune dropdown
                    districtSelect.disabled = filteredDistricts.length === 0;
                    communeSelect.disabled = true;
                    communeSelect.innerHTML = '';  // Clear the Commune options
                    const defaultCommuneOption = document.createElement("option");
                    defaultCommuneOption.value = "";
                    defaultCommuneOption.textContent = "Select a commune";
                    defaultCommuneOption.disabled = true;
                    defaultCommuneOption.selected = true;
                    communeSelect.appendChild(defaultCommuneOption);
                });

                // Event listener for District selection
                districtSelect.addEventListener("change", function () {
                    const selectedDistrict = districtSelect.value;

                    // Filter the communes by selected district
                    const filteredCommunes = locationData.commune.filter(commune => commune.idDistrict === selectedDistrict);

                    // Populate the Commune dropdown
                    populateDropdown(communeSelect, filteredCommunes, "idCommune", "name");

                    // Enable the Commune dropdown if there are any filtered communes
                    communeSelect.disabled = filteredCommunes.length === 0;
                });
            }
        })
        .catch(error => {
            console.error('Error loading location data:', error);
        });
}

const createCVForm = document.getElementById("createCV_form");