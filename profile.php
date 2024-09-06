<?php
session_start();

// Check if the user is logged in and if session data is set
if (!isset($_SESSION["user"]) || !is_array($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Fetch user ID from session
$user_id = $_SESSION["user"]["id"];

// Database connection
require_once "db.php";

// Prepare and execute the query to fetch customer data
$sql = "SELECT * FROM customers WHERE id = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("SQL error");
}
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$customer = mysqli_fetch_assoc($result);

// Check if customer data was retrieved
if (!$customer) {
    die("Customer not found");
}

// Fetch booking data for the customer
$sql_bookings = "SELECT * FROM bookings WHERE customer_id = ?";
$stmt_bookings = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_bookings, $sql_bookings)) {
    die("SQL error");
}
mysqli_stmt_bind_param($stmt_bookings, "i", $user_id);
mysqli_stmt_execute($stmt_bookings);
$result_bookings = mysqli_stmt_get_result($stmt_bookings);

// Fetch payment data for the customer's bookings
$sql_payments = "SELECT p.* FROM payments p 
                 INNER JOIN bookings b ON p.booking_id = b.id 
                 WHERE b.customer_id = ?";
$stmt_payments = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_payments, $sql_payments)) {
    die("SQL error");
}
mysqli_stmt_bind_param($stmt_payments, "i", $user_id);
mysqli_stmt_execute($stmt_payments);
$result_payments = mysqli_stmt_get_result($stmt_payments);

// Fetch car data for the bookings
$sql_cars = "SELECT c.* FROM cars c 
             INNER JOIN bookings b ON c.id = b.car_id 
             WHERE b.customer_id = ?";
$stmt_cars = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt_cars, $sql_cars)) {
    die("SQL error");
}
mysqli_stmt_bind_param($stmt_cars, "i", $user_id);
mysqli_stmt_execute($stmt_cars);
$result_cars = mysqli_stmt_get_result($stmt_cars);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- <link rel="icon" type="image/x-icon" href="img/logo.jpg"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar menu here -->
        <div class="sidebar">
            <div class="profile">
                <img src="https://as2.ftcdn.net/v2/jpg/02/10/70/13/1000_F_210701394_juARL2AoYEzgYZWI5zHmcGXmqWwQS8L2.jpg" alt="profile_picture" />
                <h3><?php echo htmlspecialchars($customer['name']); ?></h3>
                <p>Customer ID : <?php echo htmlspecialchars($customer['id']); ?></p>
            </div>
            <!-- Sidebar menu items here -->
            <ul>
                <li>
                    <a href="index.php">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">Home</span>
                    </a>
                </li>
                <li>
                    <a href="#profile" class="active">
                        <span class="icon"><i class="fas fa-user" style="font-size:18px"></i></span>
                        <span class="item">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#booking">
                        <span class="icon"><i class="fas fa-calendar"></i></span>
                        <span class="item">My Booking</span>
                    </a>
                </li>
                <li>
                    <a href="#payment">
                        <span class="icon"><i class="fas fa-credit-card"></i></span>
                        <span class="item">Payments</span>
                    </a>
                </li>
                <li>
                    <a href="#car">
                        <span class="icon"><i class="fas fa-car"></i></span>
                        <span class="item">Booked Car</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main_content">
            <h2 class="user-profile-style" id="profile">Your Profile</h2>
            <!-- Customer details table -->
            <table>
                <tr>
                    <td>Customer ID</td>
                    <td><?php echo htmlspecialchars($customer['id']); ?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo htmlspecialchars($customer['name']); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo htmlspecialchars($customer['address']); ?></td>
                </tr>
            </table>

            <!-- Bookings details table -->
            <h2 class="user-profile-style" id="booking">Your Bookings</h2>
            <table>
                <tr>
                    <th>Booking ID</th>
                    <th>Car ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Price</th>
                    <th>Booking Date</th>
                </tr>
                <?php while ($booking = mysqli_fetch_assoc($result_bookings)) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['car_id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($booking['end_date']); ?></td>
                        <td><?php echo htmlspecialchars($booking['total_price']); ?></td>
                        <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <!-- Payments details table -->
            <h2 class="user-profile-style" id="payment">Your Payments Details</h2>
            <table>
                <tr>
                    <th>Payment ID</th>
                    <th>Booking ID</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                </tr>
                <?php while ($payment = mysqli_fetch_assoc($result_payments)) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($payment['id']); ?></td>
                        <td><?php echo htmlspecialchars($payment['booking_id']); ?></td>
                        <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                        <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                        <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <!-- Car details table -->
            <h2 class="user-profile-style" id="car">Your Booked Cars</h2>
            <table>
                <tr>
                    <th>Car ID</th>
                    <th>Car Name</th>
                    <th>Description</th>
                    
                    <th>Image</th>
                </tr>
                <?php while ($car = mysqli_fetch_assoc($result_cars)) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($car['id']); ?></td>
                        <td><?php echo htmlspecialchars($car['car_name']); ?></td>
                        <td><?php echo htmlspecialchars($car['description']); ?></td>
                        
                        <td><img src="<?php echo htmlspecialchars($car['image_url']); ?>" alt="<?php echo htmlspecialchars($car['car_name']); ?>" width="250" height="150"></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
