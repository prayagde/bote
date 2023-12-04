<?php

function getRowByToken($csvFilePath, $token)
{
    // Check if the file exists
    if (!file_exists($csvFilePath)) {
        return false;
    }

    // Open the CSV file for reading
    $csvFile = fopen($csvFilePath, 'r');

    // Check if the file could be opened
    if (!$csvFile) {
        return false;
    }

    // Read the header row to get column names
    $header = fgetcsv($csvFile);

    // Search for the token in the CSV file
    while (($row = fgetcsv($csvFile)) !== false) {
        $data = array_combine($header, $row);

        if ($data['token'] == $token) {
            // Close the file and return the matching row
            fclose($csvFile);
            return $data;
        }
    }

    // Close the file (no match found)
    fclose($csvFile);

    return null;
}


$row = getRowByToken(csvFilePath: "OpenAPIScripMaster.csv", token: "58269");
print_r($row['symbol']);
