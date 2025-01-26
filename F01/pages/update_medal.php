<?php
include("../connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $country_id = $_POST['country_id'];
  $medal_type = $_POST['medal_type'];
  $increment = (int)$_POST['increment'];

  // Ensure the medal type is valid
  if (in_array($medal_type, ['gold', 'silver', 'bronze'])) {
    $query = "UPDATE medal SET $medal_type = $medal_type + ? WHERE country_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $increment, $country_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      echo "Success";
    } else {
      echo "Error updating medal count.";
    }
    $stmt->close();
  } else {
    echo "Invalid medal type.";
  }
}

$conn->close();
?>
