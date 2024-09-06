<?php
include 'db.php';

$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
$total_price = isset($_GET['total_price']) ? floatval($_GET['total_price']) : 0.00;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'];
    $amount = $_POST['amount'];

    if ($amount == $total_price) {
        $sql = "INSERT INTO payments (booking_id, payment_method, amount) VALUES ('$booking_id', '$payment_method', '$amount')";

        if ($conn->query($sql) === TRUE) {
            $payment_id = $conn->insert_id;
            header("Location: payment.php?success=1&payment_id=$payment_id");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Amount does not match the total price.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
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
            /* height: 100vh; */
            /* display: flex; */
            justify-content: center;
            align-items: center;
        }

        

        /* Container for the booking form */
        .form {
            background-color: #fff;
            padding: 40px;
            padding-top: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            position: relative;
            margin-top: 200px;
            margin-bottom: 120px;
            margin-left: 520px;
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

        /* .form select {
            padding: 10px 149px;
        } */
        .form select {
            padding: 5px 50px;
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
            margin-bottom:30px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-left">
                <ul>
                    <li><a href="index.php#service">Home</a></li>
                    <li><a href="payment_receipt.php">Payment Receipt</a></li>
                </ul>
            </div>
            <div class="nav-center">
            </div>
            <div class="nav-right">
            </div>
        </nav>
    </header>
    
    <div class="form">
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Payment Successful!',
                        html: 'Your Payment ID is: <?php echo htmlspecialchars($_GET['payment_id'], ENT_QUOTES); ?><br><br>',
                        showConfirmButton: true
                    });
                });
            </script>
        <?php endif; ?>



        <h2>Payment</h2>
        <form action="payment.php?booking_id=<?php echo $booking_id; ?>&total_price=<?php echo $total_price; ?>" method="POST">
            
            <label for="booking_id">Booking ID:</label>
            <input type="text" id="booking_id" name="booking_id" value="<?php echo htmlspecialchars($booking_id); ?>" required readonly>
            
        
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="Select">Select</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="Bank Transfer">Bank Transfer</option>
            </select>
            <br>
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" step="0.01" value="<?php echo $total_price; ?>" readonly required>
            
            <button type="submit">Proceed to Pay</button>
        </form>
    </div>

    <footer>
        <p><b style="font-size:20px;">© 'carve'</b>, 2024. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
