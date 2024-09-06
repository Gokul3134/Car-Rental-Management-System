<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>24/7 Customer Support</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    
    <style>
        .form {
            background-color: #fff;
            /* background-image: radial-gradient(circle, #eeeeeebd, rgb(212 148 244 / 83%), rgb(85 138 252 / 74%));
             */
            padding: 5px 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            position: relative;
            margin-left: 210px;
        }

        .form label {
            display: block;
            margin-bottom: 8px;
            color: #000;
            font-weight: bold;
        }

        .form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 5px;
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
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-left">
                <ul>
                    <li><a href="index.php#service">Home</a></li>
                </ul>
            </div>
            <div class="nav-center">
                
            </div>
            <div class="nav-right">
                
            </div>
        </nav>
    </header>
    
    <section id="contact" class="conta">
        <h2>Contact Us</h2>
        <!-- <hr class="new3"> -->
        <div class="form">
            <form id="contactForm" action="contact.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
    </section>


    <footer>
        <!-- <p style="color:white">@ all writes are reserved</p> -->
        <p><b style="font-size:20px;">© 'carve'</b>, 2024. All Rights Reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>



