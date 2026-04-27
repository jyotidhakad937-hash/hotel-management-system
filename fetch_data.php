<?php
// fetch_data.php
header('Content-Type: application/json');

$query = "SELECT month_name, total_amount FROM monthly_records ORDER BY id ASC";
$result = $conn->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>