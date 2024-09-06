<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .detail{
            padding-top: 230px;
            padding-bottom: 180px;
            /* background-image:url(img/reg3.jpg); */
            background-repeat: no-repeat;
            background-attachment: fixed;
            
        }
        .car-details {
            max-width: 420px;
            margin: 20px auto;
            
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
            align-items: center;
        }
        .car-details img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .car-details h2 {
            margin-top: 20px;
        }
        .car-details p {
            font-size: 16px;
            line-height: 1.5;
        }
        .car-details .button-container {
            margin-top: 20px;
        }
        .car-details .button-container a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
                <li><a href="booking.php"><i class="fa fa-fw fa-car"></i> Book Car</a></li>
            </ul>
        </nav>
    </header>

    <section id="details" class="detail">
        <!-- <div class="car-catalog"> -->
            <div class="car-details">
                <?php include 'car_details.php'; ?>
            </div>
        <!-- </div> -->
    </section>

    <footer>
        <p>@ all writes are reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
