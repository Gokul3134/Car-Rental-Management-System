<?php
session_start();
include 'db.php';

if (isset($_SESSION["user"])) {
    header("Location: profile.php");
    exit();
}

$errors = array(); // Initialize an array to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    // Validate input
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($phone) || empty($address)) {
        array_push($errors, "All fields are required.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid.");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long.");
    }
    if ($password !== $confirm_password) {
        array_push($errors, "Passwords do not match.");
    }
    
    // Check if email already exists
    $check_sql = "SELECT * FROM customers WHERE email='$email'";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
        array_push($errors, "Email already exists.");
    }
    
    if (count($errors) == 0) {
        // Insert new user into the database
        $sql = "INSERT INTO customers (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $passwordHash, $phone, $address);
            mysqli_stmt_execute($stmt);
            
            // Get the last inserted ID (customer_id)
            $customer_id = mysqli_insert_id($conn);
            
            // Redirect with success message
            header("Location: registration.php?success=1&customer_id=$customer_id");
            exit();
        } else {
            array_push($errors, "Error: " . mysqli_error($conn));
        }
    }
    
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding-bottom:200px;
            overflow-x: hidden;
            /* background-image: radial-gradient(circle, rgb(212, 148, 244), rgb(110, 217, 228), rgb(85, 138, 252));
             */
            background-color:#7bcbe6;
        }

        .container {
            background-color: rgb(255, 255, 255);
            padding: 0 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin-top:200px;
            /* background-image: radial-gradient(circle, #eeeeeebd, rgb(212 148 244 / 83%), rgb(85 138 252 / 74%));
             */
        }

        h2 {
            margin-bottom: 20px;
            color: #000000;
            text-align: center;
            font-size: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #000000;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            text-decoration: underline;
        }

        header {
            background-color: #0c2635;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .nav-left,
        .nav-center,
        .nav-right {
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        nav ul li {
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

        .error-container {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-left"></div>
            <div class="nav-center">
                <ul>
                    <li><a href="login.php">Back</a></li>
                </ul>
            </div>
            <div class="nav-right"></div>
        </nav>
    </header>

    <div class="container">
        <?php if (count($errors) > 0): ?>
            <div class="error-container">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error, ENT_QUOTES); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful!',
                        html: 'Your Registration ID is: <?php echo htmlspecialchars($_GET['customer_id'], ENT_QUOTES); ?><br><br>',
                        showConfirmButton: true
                    });
                });
            </script>
        <?php endif; ?>

        <h2>Register</h2>
        <form action="registration.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <button type="submit">Register</button>

            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
