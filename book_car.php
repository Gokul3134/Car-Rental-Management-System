<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $car_id = $_POST['car_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $total_price = $_POST['total_price'];

    // Insert the booking details and retrieve the booking ID
    $sql = "INSERT INTO bookings (customer_id, car_id, start_date, end_date, total_price) VALUES ('$customer_id', '$car_id', '$start_date', '$end_date', '$total_price')";
    
    if ($conn->query($sql) === TRUE) {
        // Get the last inserted booking ID
        $booking_id = $conn->insert_id;
        
        // Redirect to booking.php with success message and booking ID
        header("Location: booking.php?success=1&booking_id=$booking_id&total_price=$total_price");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
