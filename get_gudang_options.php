<?php
// Include file db_connection.php
include 'db_connection.php';

// Query to retrieve gudang options
$sql = "SELECT id, nama FROM gudang";
$result = $conn->query($sql);

// Array to store gudang options
$gudangOptions = array();

if ($result->num_rows > 0) {
    // Loop through each row and add to the gudangOptions array
    while ($row = $result->fetch_assoc()) {
        $gudangOptions[] = $row;
    }
}

// Close the connection
$conn->close();

// Return gudang options as JSON
header('Content-Type: application/json');
echo json_encode($gudangOptions);
?>
