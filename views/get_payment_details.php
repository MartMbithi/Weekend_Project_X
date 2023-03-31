<?php
/*
 *   Crafted On Fri Mar 31 2023
 *   Author Martin (martin@devlan.co.ke)
 */

require_once('../config/config.php');

if (isset($_REQUEST['tenants'])) {
    $tenants = mysqli_real_escape_string($mysqli, $_REQUEST['tenants']);
}
$tenant_details = array();


$sql = "SELECT * FROM houses h
INNER JOIN tenants t ON h.house_id = t.tenant_house_id
INNER JOIN properties p ON h.house_property_id = p.property_id WHERE t.tenant_id = '{$tenants}'";

$result = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_array($result)) {
    $tenant_national_id = $row['tenant_national_id'];
    $tenant_mobile_number = $row['tenant_mobile_number'];
    $house_number = $row['house_number'];
    $house_category = $row['house_category'];
    $house_rent = $row['house_rent'];
    $property_name = $row['property_name'];
    $property_location = $row['property_location'];

    /* Serialize them */
    $tenant_details[] = array(
        "tenant_national_id" => $tenant_national_id,
        "tenant_mobile_number" => $tenant_mobile_number,
        "house_number" => $house_number,
        "house_category" => $house_category,
        "house_rent" => $house_rent,
        "property_name" => $property_name,
        "property_location" => $property_location
    );
}


// encoding array to json format
echo json_encode($directories);
