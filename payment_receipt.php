<?php
include 'db.php';

// Get payment_id and booking_id from the query string
$payment_id = isset($_GET['payment_id']) ? htmlspecialchars($_GET['payment_id'], ENT_QUOTES) : '';

// Fetch booking and payment details if payment_id is provided
if ($payment_id) {
    // Fetch booking and associated customer and car details
    $booking_sql = "
        SELECT b.*, c.name as customer_name, c.email as customer_email, c.id as customer_id, car.car_name, car.price_per_day 
        FROM bookings b
        JOIN customers c ON b.customer_id = c.id
        JOIN cars car ON b.car_id = car.id
        WHERE b.id = (SELECT booking_id FROM payments WHERE id = '$payment_id')
    ";
    $booking_result = $conn->query($booking_sql);
    $booking = $booking_result->fetch_assoc();

    // Fetch payment details
    $payment_sql = "SELECT * FROM payments WHERE id = '$payment_id'";
    $payment_result = $conn->query($payment_sql);
    $payment = $payment_result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        /* Reset default browser styles for a more consistent baseline */
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }

        /* Set base font styles */
        body {
        font-family: "Poppins", Arial, sans-serif; /* Choose a suitable font family */
        font-size: 16px; /* Adjust for preferred font size */
        /* background: rgb(2, 0, 36); */
        /* background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgb(130, 155, 239) 0%,  rgba(172, 212, 231, 1) 62%);
       */
       background-color: #7bcbe6;
        
        }

        /* Header Styles */
        header {
            background-color: #0c2635;
            position: fixed;
            width: 100%;
            padding: 5px 0;
            top: 0;
            z-index: 1000; /* Ensure header stays on top */
        }

        /* Navigation Styles */
        nav {
            display: flex;
            justify-content: space-between; /* Adjust to space out the three sections */
            align-items: center; /* Center items vertically */
            padding: 0 20px; /* Add padding to nav */
        }

        .nav-left {
            display: flex;
            align-items: center; /* Center items vertically */
        }

        .nav-center ul {
            display: flex;
            gap: 20px; /* Adjust gap between navbar items */
        }

        .nav-right ul {
            display: flex;
            gap: 20px; /* Adjust gap between buttons */
        }

        /* Adjust padding and margin for left, center, and right divs */
        .nav-left,
        .nav-center,
        .nav-right {
            padding: 10px 0; /* Add padding to the divs */
        }

        /* Navigation List Styles */
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px; /* Adjust gap between navbar items */
        }

        nav ul li {
            display: inline;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            /* padding: 10px; */
            margin: 10px;
            padding-bottom: 0;
        }

        nav ul li a:hover {
            border-bottom: 2px solid white;
        }

        /* Style the main content area */
        .container {
        max-width: 900px; /* Set a maximum width for responsiveness */
        margin: 0 auto; /* Center the content horizontally */
        padding: 2rem;
        padding-top: 10rem;
        
        }

        /* Style the receipt title */
        h2 {
        text-align: center;
        margin-bottom: 2rem;
        }

        /* Style the receipt table */
        .receipt-table table {
        width: 100%;
        border-collapse: collapse;
        }

        .receipt-table th,
        .receipt-table td {
        padding: 0.75rem 1rem;
        border: 1px solid #ddd;
        text-align: left; /* Align content to the left */
        }

        .receipt-table thead th {
        background-color: #f5f5f5;
        font-weight: bold;
        }

        /* Style for specific rows (optional) */
        .receipt-table .course-details td,
        .receipt-table .booking-details td,
        .receipt-table .payment-details td {
        font-weight: bold; /* Emphasize details */
        }

        /* Footer styling */
        footer {
            background-color: #212529;
            color: white;
            padding: 1rem 2rem;
            text-align: center;
            margin-top: 2rem;
        }

        /* Responsive considerations */
        @media (max-width: 768px) {
            .container {
                padding: 1rem; /* Adjust padding on smaller screens */
            }
            .receipt-table table {
                font-size: 14px; /* Adjust font size for mobile readability */
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-left">
                <ul>
                    <!-- <li><a href="payment.php">Home</a></li> -->
                    <li><a href="index.php#service">Home</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <!-- Search bar -->
        <form class="mb-4" method="GET" action="payment_receipt.php">
            <div class="input-group">
                <input type="text" class="form-control" name="payment_id" placeholder="Enter Payment ID" value="<?php echo htmlspecialchars($payment_id); ?>" required>
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <?php if ($payment_id && $booking && $payment): ?>
            <h2 class="text-center">Payment Receipt</h2>
            <div class="receipt-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">User Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>User ID</th>
                            <td><?php echo htmlspecialchars($booking['customer_id']); ?></td>
                        </tr>
                        <tr>
                            <th>User Full Name</th>
                            <td><?php echo htmlspecialchars($booking['customer_name']); ?></td>
                        </tr>
                        <tr>
                            <th>User Email</th>
                            <td><?php echo htmlspecialchars($booking['customer_email']); ?></td>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Car Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Car ID</th>
                            <td><?php echo htmlspecialchars($booking['car_id']); ?></td>
                        </tr>
                        <tr>
                            <th>Car Name</th>
                            <td><?php echo htmlspecialchars($booking['car_name']); ?></td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td><?php echo htmlspecialchars($booking['total_price']); ?></td>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Booking Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Booking ID</th>
                            <td><?php echo htmlspecialchars($booking['id']); ?></td>
                        </tr>
                        <tr>
                            <th>Booking Date</th>
                            <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td><?php echo htmlspecialchars($booking['start_date']); ?></td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td><?php echo htmlspecialchars($booking['end_date']); ?></td>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Payment Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Payment ID</th>
                            <td><?php echo htmlspecialchars($payment['id']); ?></td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                        </tr>
                        <tr>
                            <th>Amount Paid</th>
                            <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                        </tr>
                        <tr>
                            <th>Payment Date</th>
                            <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php elseif ($payment_id): ?>
            <p class="text-center text-danger">No payment details found for Payment ID: <?php echo htmlspecialchars($payment_id); ?></p>
        <?php endif; ?>
    </div>

    <footer>
        <p><b style="font-size:20px;">© 'carve'</b>, 2024. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
