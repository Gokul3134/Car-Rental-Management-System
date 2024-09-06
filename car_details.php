<?php
include 'db.php';

$car_id = $_GET['id']; 
$sql = "SELECT * FROM cars WHERE id = $car_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $car = $result->fetch_assoc();
    
    echo "<h2> Car ID : "  . $car['id'] . "</h2>";
    echo "<h2>" . $car['car_name'] . "</h2>";
    echo "<p>" . $car['description'] . "</p>";
    echo "<p>Price: ₹" . $car['price_per_day'] . " per day</p>";
    
} else {
    echo "Car not found";
}

$conn->close();
?>
