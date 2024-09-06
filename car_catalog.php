<?php
include 'db.php';

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    echo "<div class='car-catalog'>";  // Start the grid container
    while($row = $result->fetch_assoc()) {
        echo "<div class='container'>";
        echo "<div class='wrapper'>";
        echo "<div class='banner-image' style='background-image: url(" . $row['image_url'] . ");'></div>";
        echo "<h1>" . $row['car_name'] . "</h1>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>Price: ₹" . $row['price_per_day'] . " Per Day</p>";
        echo "</div>";
        echo "<div class='button-wrapper'>";
        echo "<a href='javascript:void(0);' class='btn outline' onclick='toggleDetails(" . $row['id'] . ")'>DETAILS</a>";
        echo "<a href='booking.php?car_id=" . $row['id'] . "&price=" . $row['price_per_day'] . "' class='btn fill'>BOOK NOW</a>";
        echo "</div>";
        
        // Add a hidden div to hold the car details
        echo "<div id='details-" . $row['id'] . "' class='car-details' style='display: none;'></div>";

        echo "</div>";
    }
    echo "</div>";  // End the grid container
} else {
    echo "<p>No cars available</p>";
}

$conn->close();
?>
