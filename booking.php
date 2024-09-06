
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

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <style>
        /* body{
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: "Poppins", Arial, sans-serif;
            background-image: radial-gradient(circle, rgb(212, 148, 210), rgb(110, 117, 228), rgb(185, 138, 252));
        
            background-repeat: no-repeat;
            background-attachment: fixed;
        } */

        /* Common body styling */
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #7bcbe6;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            /* background-image: radial-gradient(circle, rgb(212, 148, 244), rgb(110, 217, 228), rgb(85, 138, 252));
             */
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            /* display: flex; */
            justify-content: center;
            align-items: center;
        }

        

        /* Container for the booking form */
        .form {
            background-color: #fff;
            padding: 40px;
            padding-top:20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            position: relative;
            margin-top: 70px;
            margin-bottom: 100px;
            margin-left: 500px;
            /* background-image: radial-gradient(circle, #eeeeeebd, rgb(212 148 244 / 83%), rgb(85 138 252 / 74%));
             */
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

        /* Footer Styles */
        footer {
            background-color: #0c2635; /* Dark background color for the footer */
            color: white; /* Light text color for better contrast */
            text-align: center; /* Center align the text */
            padding: 20px; /* Add padding inside the footer */
            border-top: 1px solid #dee2e6; /* Add a subtle border at the top */
        }

        footer p {
            margin: 0; /* Remove default margin for the paragraph */
            font-size: 14px; /* Adjust font size if needed */
            font-family: "Poppins", Arial, sans-serif;
        }


        /* Booking form elements */
        .form label {
            display: block;
            margin-bottom: 8px;
            color: #000;
            font-weight: bold;
        }

        .form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form button:hover {
            background-color: #0056b3;
        }
        .form h2{
            font-weight: 600;
            text-align: center;
            margin-bottom:10px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-left">
                <ul>
                    <li><a href="index.php#service">Home</a></li>
                    <li><a href="catalog_car.php#home">Car Catalog</a></li>
                    <!-- <li><a href="payment.php">Payment</a></li> -->
                </ul>
            </div>
        </nav>
    </header>

    <section id="booking" class="book">
        <div class="form">
            
        <!-- SweetAlert for Successful Booking -->
        <?php
            // Check if the success flag and booking ID are set
            if (isset($_GET['success']) && $_GET['success'] == 1 && isset($_GET['booking_id'])) {
                $booking_id = $_GET['booking_id'];
                $total_price = $_GET['total_price'];
            ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Booking Successful!',
                            html: 'Your Booking ID is: <?php echo htmlspecialchars($_GET['booking_id'], ENT_QUOTES); ?><br><br>',
                            text: 'You will be redirected to the payment page shortly.',
                            timer: 5000, // 3 seconds timer
                            timerProgressBar: true,
                            willClose: () => {
                                // After the alert, redirect to the payment page
                                window.location.href = `payment.php?booking_id=<?php echo $booking_id; ?>&total_price=<?php echo $total_price; ?>`;
                            }
                        });
                    });
                </script>
            <?php
            } else {
                
            }
            ?>


            <h2>Booking</h2>

            <form action="book_car.php" method="POST" enctype="multipart/form-data">
                <label for="customer_id">Customer ID:</label>
                <input type="text" id="customer_id" name="customer_id" value="<?php echo htmlspecialchars($customer['id'], ENT_QUOTES); ?>" required>

                <label for="car_id">Car ID:</label>
                <input type="text" id="car_id" name="car_id" value="<?php echo htmlspecialchars($_GET['car_id'] ?? '', ENT_QUOTES); ?>" required>

                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>

                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>

                <label for="total_price">Total Price:</label>
                <input type="text" id="total_price" name="total_price" value="<?php echo htmlspecialchars($_GET['price'] ?? '', ENT_QUOTES); ?>" required readonly>

                <!-- Hidden input field for daily price -->
                <input type="hidden" id="daily_price" name="daily_price" value="<?php echo htmlspecialchars($_GET['price'] ?? '', ENT_QUOTES); ?>">

                <button type="submit">Book Now</button>
            </form>
        </div>
    </section>

    <footer>
        <p><b style="font-size:20px;">© 'carve'</b>, 2024. All Rights Reserved.</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var today = new Date().toISOString().split('T')[0];
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');
            var totalPriceInput = document.getElementById('total_price');
            var dailyPrice = parseFloat(document.getElementById('daily_price').value);

            startDateInput.min = today;
            endDateInput.min = today;

            function calculateTotalPrice() {
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);
                var timeDiff = endDate - startDate;
                var days = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Convert milliseconds to days

                if (days > 0) {
                    totalPriceInput.value = (days * dailyPrice).toFixed(2); // Calculate total price and update input field
                } else {
                    totalPriceInput.value = '';
                }
            }

            startDateInput.addEventListener('change', function() {
                if (startDateInput.value < today) {
                    startDateInput.value = today;
                }
                endDateInput.min = startDateInput.value;
                calculateTotalPrice();
            });

            endDateInput.addEventListener('change', function() {
                if (endDateInput.value < startDateInput.value) {
                    endDateInput.value = startDateInput.value;
                }
                calculateTotalPrice();
            });
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>