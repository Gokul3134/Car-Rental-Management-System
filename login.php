<?php
session_start(); // Start session at the top

// Check if the user is already logged in
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once "db.php"; // Include the database connection file

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM customers WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("SQL error: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // Check if user exists and password is correct
    if ($user) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["id"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["user"] = $user; // Store user data in session
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Password does not match";
        }
    } else {
        $error_message = "Email does not match";
    }

    $conn->close(); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            /* background-image: radial-gradient(circle, rgb(212, 148, 244), rgb(110, 217, 228), rgb(85, 138, 252)); */

            background-color:#7bcbe6;

        }

        .container {
            background-color: #fff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            position: relative;
            /* background-image: radial-gradient(circle, #eeeeeebd, rgb(212 148 244 / 83%), rgb(85 138 252 / 74%));
             */
        }

        h2 {
            margin-bottom: 20px;
            color: #000;
            text-align: center;
            font-size: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #000;
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

        .alert {
            color: #e74c3c;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        header {
            background-color: #0c2635;
            padding: 20px 0;
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
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-left"></div>
            <div class="nav-center">
                <ul>
                    <li><a href="front.php">Back</a></li>
                </ul>
            </div>
            <div class="nav-right"></div>
        </nav>
    </header>

    <div class="container">
        <?php
        // Display the error message if it exists
        if (isset($error_message)) {
            echo "<div class='alert'>$error_message</div>";
        }
        ?>

        <h2>Login</h2>
        
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="registration.php">Register Here</a></p>
    </div>
</body>
</html>
