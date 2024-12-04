<?php

$locationDataPath = $_SERVER['DOCUMENT_ROOT'] . '/CV-management-website/Controllers/Scripts/location.json';
if (!file_exists($locationDataPath)) {
    die("Location data file not found."); // Add proper error handling
}
$locationData = json_decode(file_get_contents($locationDataPath), true);
if (!$locationData) {
    die("Failed to load location data."); // Add proper error handling
}
$GLOBALS['locationData'] = $locationData;

function getProvinceName($provinceId, $provinces) {
    foreach ($provinces as $province) {
        if ($province['idProvince'] === $provinceId) {
            return $province['name'];
        }
    }
    return "Unknown Province";
}

function getDistrictName($districtId, $districts) {
    foreach ($districts as $district) {
        if ($district['idDistrict'] === $districtId) {
            return $district['name'];
        }
    }
    return "Unknown District";
}

function getCommuneName($communeId, $communes) {
    foreach ($communes as $commune) {
        if ($commune['idCommune'] === $communeId) {
            return $commune['name'];
        }
    }
    return "Unknown Commune";
}

function convertAddress($rawAddress)
{
    // Access the global location data
    $locationData = $GLOBALS['locationData'];

    // Parse the raw address
    $parts = explode(',', $rawAddress);
    if (count($parts) !== 4) {
        return $rawAddress; // Invalid format; return as-is
    }

    list($street, $communeId, $districtId, $provinceId) = array_map('trim', $parts);

    // Convert IDs to names
    $province = array_column($locationData['province'], 'name', 'idProvince')[$provinceId] ?? $provinceId;
    $district = array_column($locationData['district'], 'name', 'idDistrict')[$districtId] ?? $districtId;
    $commune = array_column($locationData['commune'], 'name', 'idCommune')[$communeId] ?? $communeId;

    // Return the formatted address
    return "$street, $commune, $district, $province";
}