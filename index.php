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
    <title>Car Rental Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <style>
        /* header{
            padding:0;
        } */
        .nav-left, .nav-center, .nav-right {
            padding: 0;
        }
        /* Basic styles for dropdown */
        .dropdown {
        position: relative;
        display: inline-block;
        }

        .dropbtn {
        background-color: #0c2635;
        color: white;
        /* padding: 10px; */
        font-size: 20px;
        border: none;
        cursor: pointer;
        }

        /* .dropdown:hover .dropbtn {
        background-color: #4CAF50;
        } */

        .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        }

        .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        font-size:18px;
        display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1;}

        .dropdown:hover .dropdown-content {
        display: block;
        }

        /* Responsive navbar styles */
        .icon {
        display: none;
        }

        @media screen and (max-width: 600px) {
            .icon {
                display: block;
            }
            
            .topnav.responsive {position: relative;}
            .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
            }
            
            .topnav.responsive .dropdown {float: none;}
            .topnav.responsive .dropdown-content {position: relative;}
            .topnav.responsive .dropdown .dropbtn {
                display: block;
            }
        }
        .profile-container {
            display: flex;
            flex-wrap: wrap; /* Allows items to wrap to the next line if necessary */
            align-items: center; /* Vertically center items */
            justify-content: space-between; /* Distribute space between items */
        }

        .profile-info {
            display: grid;
            align-items: center; /* Center items vertically */
            /* gap: 15px; Space between image and name */
            /* margin-right: 20px; */
        }

        .profile-img {
            border-radius: 50%; /* Makes the image circular */
            width: 50px; /* Set the width of the profile image */
            height: 50px; /* Set the height of the profile image */
        }

        /* Review Section */
        .review {
            padding: 2rem 0;
            background-color: #7bcbe6;
            /* background-image: radial-gradient(circle, rgb(212, 148, 244), rgb(110, 217, 228), rgb(85, 138, 252));
             */
        }

        .review .heading {
            text-align: center;
            font-size: 3rem;
            margin-bottom: 2rem;
        }

        .review .heading span {
            color: #6c757d;
        }

        .review-slider {
            padding: 1rem 8rem;
            max-width:85%;
        }

        .review-slider .swiper-slide {
            background: #fff;
            border-radius: .5rem;
            text-align: center;
            padding: 2rem 1rem;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.2s ease;
        }

        .review-slider .swiper-slide:hover {
            box-shadow: 1px 1px 10px 4px rgba(0, 123, 255, 0.2);
        }

        .review-slider .swiper-slide img {
            height: 5rem;
            width: 5rem;
            border-radius: 50%;
            object-fit: cover;
            /* margin-bottom: 1rem; */
        }

        .review-slider .swiper-slide p {
            padding: 1rem 5.5rem;
            line-height: 1.8;
            color: #6c757d;
            /* font-size: 1.5rem; */
        }

        .review-slider .swiper-slide h3 {
            /* padding-bottom: .5rem; */
            color: #343a40;
            font-size: 2.2rem;
        }

        .review-slider .swiper-slide .stars {
            color: orange;
            /* font-size: 1.7rem; */
        }
        /* .hero-banner img{
            opacity: 0.7;
            background: #000000;
        } */

        .host-counter{
            background-color: #0c2635;
        }

        .host-counter-ele {
            color: #f5f5f5;
            text-align: center;
        }

        .host-counter-container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            
            padding: 20px 100px;
        }

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
                <img src="img/logo5.jpg" alt="Logo" style="width: 120px; height: 80px;margin-left:50px">
            </div>
            <div class="nav-center">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#service">Services</a></li>
                    <li><a href="#review">Reviews</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <div class="profile">
                    <div class="profile-container">
                        <div class="profile-info">
                            <img src="https://as2.ftcdn.net/v2/jpg/02/10/70/13/1000_F_210701394_juARL2AoYEzgYZWI5zHmcGXmqWwQS8L2.jpg" alt="profile_picture" class="profile-img"/>
                            
                            <div class="dropdown">
                                <button class="dropbtn">
                                <?php echo htmlspecialchars($customer['name']);?><i class="fa fa-caret-down" style="color:white; height:20px; padding: 0;font-size: 25px;width: 60px;text-align: center;text-decoration: none;border-radius: 50%;"></i>
                                </button>
                                <div class="dropdown-content">
                                    <a href="profile.php">Profile</a>
                                    <!-- <a href="#">Settings</a> -->
                                    <a href="logout.php">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hamburger Icon for Responsive Navbar -->
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                </div>
                <!-- <ul>
                    <li><a href="login.php" id="loginBtn">Login / Register</a></li>
                    <button onclick=window.parent.location.href='login.php'>Login</button>
                    <li><a href="logout.php"><i class="fas fa-user"></i> Logout</a></li>
                </ul> -->
            </div>
        </nav>
    </header>

    <section id="home">
        <div class="hero-banner">
            <div class="slides">
                <img src="img/web_banner.jpg" alt="Hero Banner 2">
                <!-- <video width="320" height="240" controls>
                    <source src="img/video.mp4" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                    Your browser does not support the video tag.
                </video> -->
                <div class="hero-text">
                    <h1>Welcome to Our Self-Drive Car Rental System <b>'carve'</b></h1>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="homepage" id="home">
        <div class="content">
            <div class="text">
                <h1>Camping Gear and Essentials</h1>
                <p>Discover top-quality camping gear for unforgettable outdoor adventures. <br> Gear up and make lasting memories.</p>
            </div>
            <a href="#services">Our Services</a>
        </div>
    </section> -->

    <section id="about" class="about">
        <div class="about-section">
            <div class="about-image">
                <img src="img/about3.png" alt="About Us" style="width: 43rem;height: 30rem">
            </div>
            <div class="about-text">
                <h1>About Us</h1>
                <!-- <hr class="new1"> -->
                <p>
                    Welcome to our Car Rental Service <b style="font-size:25px;">'carve'</b>. We offer a wide range of cars to suit your needs. At <b >'carve'</b>, we turn journeys into memories. Since 2020, we've been your trusted car rental partner, offering a diverse fleet – from city-friendly compacts to adventure-ready SUVs and luxurious sedans. Book your car online in minutes and choose from convenient locations for a hassle-free experience. We prioritize affordability with transparent pricing and competitive rates. But it's not just about the car. Our friendly team is available 24/7 to ensure a smooth ride, and meticulous maintenance and roadside assistance keep you safe on every mile. We're passionate about exploration, empowering you with the freedom of the open road. Weekend escapes, business trips, or family adventures – we're here to get you there comfortably. Visit our website today to browse our cars and embark on your next adventure with confidence.
                </p>
            </div>
        </div>

    </section>

    <section id="service" class="servic">
        <h2>Our Services</h2>
        <!-- <hr class="new2"> -->
        <div class="container">
            
            <div class="card">
                <img src="img/pic6.jpg" class="card-img-top" alt="Rent Car Image">
                <div class="card-body">
                    <h5 class="card-title">Rent Car</h5>
                    <p class="card-text">Renting a car on our website is simple and convenient. Browse our extensive fleet, choose the vehicle that suits your needs, and book online in minutes. Enjoy transparent pricing, easy booking, and prompt service for a hassle-free rental experience.</p>
                    <a href="catalog_car.php" class="btn btn-primary">Click Here</a>
                </div>
            </div>
            <div class="card">
                <img src="img/gps.jpg" class="card-img-top" alt="GPS Navigation Systems Image">
                <div class="card-body">
                    <h5 class="card-title">GPS Navigation Systems</h5>
                    <p class="card-text">GPS navigation systems in car rentals offer real-time directions, traffic updates, and safety features, enhancing customer convenience. They also enable fleet tracking, theft recovery, and improved operational efficiency for rental companies.</p>
                    <a href="navigation.php" class="btn btn-primary">Click Here</a>
                </div>
            </div>
            <div class="card">
                <img src="img/pic4.png" class="card-img-top" alt="24/7 Customer Support Image">
                <div class="card-body">
                    <h5 class="card-title">24/7 Customer Support</h5>
                    <p class="card-text">24/7 customer support in a car rental system offers round-the-clock assistance for booking issues, roadside emergencies, and general inquiries. This ensures timely help and a seamless rental experience, enhancing customer satisfaction and reliability.</p>
                    <a href="customer_support.php" class="btn btn-primary">Click Here</a>
                </div>
            </div>
            
        </div>
    </section>

    <section class="review" id="review">
        <div class="container" style="padding: 100px; padding-top: 75px;">
            <div class="heading">
                <h2>Customers <span>Reviews</span></h2>
            </div>
            <div class="review-slider swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div>
                            <img src="img/guest_one.jpg" alt="User 1">
                            <h3>Arvind, Bengaluru</h3>
                            <p>
                                "I had a fantastic experience with 'carve'. The car selection was great, and I found the perfect vehicle for my trip. The staff was friendly and efficient, making the pick-up and drop-off process a breeze. The car was spotless and ran perfectly. Overall, it was a hassle-free experience from start to finish. Highly recommended!"
                            </p>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div>
                            <img src="img/guest_two.jpg" alt="User 2">
                            <h3>Gaurav, Delhi</h3>
                            <p>
                            Renting a car from 'carve' was an absolute pleasure. The entire process was seamless, and the customer service was exceptional. The vehicle was in perfect condition, and I appreciated the quick and easy paperwork. I felt safe and comfortable throughout my trip. I will definitely rent from them again!"
                            </p>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div>
                            <img src="img/guest_three.jpg" alt="User 3">
                            <h3>Himanshu, Hyderabad</h3>
                            <p>
                                "I can't say enough good things about 'carve'. Their website made it easy to book the car I needed, and the rates were very competitive. The vehicle was ready on time, and the staff provided excellent customer service. They went above and beyond to ensure my rental experience was positive. I will be recommending them to all my friends and family."
                            </p>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div>
                            <img src="img/guest_four.jpg" alt="User 3">
                            <h3>Krishnan, Kerala</h3>
                            <p>
                                "My experience with 'carve' was exceptional. From the moment I made the reservation to the time I returned the car, everything went smoothly. The car was well-maintained and very comfortable to drive. The staff was friendly and made sure I had everything I needed. I couldn't have asked for a better rental experience!"
                            </p>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div>
                            <img src="img/guest_five.jpg" alt="User 3">
                            <h3>Lavanya, Chennai</h3>
                            <p>
                                "Excellent service from 'carve', The staff was knowledgeable and accommodating, making the rental process quick and easy. The car was in great shape and performed flawlessly during my trip. I was especially impressed with how straightforward the return process was. I will definitely be a repeat customer!" 
                            </p>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Add more reviews as needed -->

                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination" style="padding-bottom:10px;"></div>
                <!-- Add Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <section>
        <div class="host-counter">
            <div class="host-counter-container">
                <div class="host-counter-ele">
                    <h3 class="host-counter-ele-number">25,000+ </h3> 
                    <p class="host-counter-ele-text">Verified Cars</p>
                </div>
                <!-- <div class="host-counter-ele">
                    <h3 class="host-counter-ele-number">20,000+ </h3> 
                    <p class="host-counter-ele-text">Trusted Hosts</p>
                </div> -->
                <div class="host-counter-ele">
                    <h3 class="host-counter-ele-number">2 Billion+ </h3> 
                    <p class="host-counter-ele-text">KMs Driven</p>
                </div>
                <div class="host-counter-ele">
                    <h3 class="host-counter-ele-number">38+ Cities</h3> 
                    <p class="host-counter-ele-text">And Counting... </p>
                </div>
                <div class="host-counter-ele">
                    <h3 class="host-counter-ele-number">20+ Airports</h3> 
                    <p class="host-counter-ele-text">Live On <b>'Carve'</b> Platform</p>
                </div>
            </div>
        </div>
    </section>

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
        <div class="row">
            <div class="address">
                <h3>Office Address:</h3>
                <hr>
                <h5>Main Office:</h5>
                <p>ANO 717, Astra Towers, Action Area IIC, <br>Newtown, New Town, West Bengal 700135</p>
                <h5>Tech Office:</h5>
                <p>Unit no: EKT_GR_1B, Premises no. 04-702, <br>Plot no.- IID, Ek Tower 30, Ek Tower, <br>Action Area II, Action Area IID, Newtown, <br>Kolkata, New Town, West Bengal 700161</p>
            </div>
            <div class="contact_info">
                <h3>Contact Info:</h3>
                <hr>
                <h5>Call Us:</h5>
                <p>+91 9648571234</p>
                <p>+91 9875642317</p>
                <h5>E-mail Us:</h5>
                <p>rentcar@gmail.com</p>
                <p>carrent@gmail.com</p>
            </div>
            <div class="follow">
                <h3>Follow Us:</h3>
                <hr>
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-linkedin"></a> <br>
                <a href="#" class="fa fa-youtube"></a>
                <a href="#" class="fa fa-instagram"></a>
            </div>
            <div class="map">
                <h3>Our Office Location</h3>
                <hr>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1094.923259271096!2d88.46469283000823!3d22.621397370167617!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89f308e3e063d%3A0x4cb8ec196b283f75!2sAstra%20Tower!5e0!3m2!1sen!2sin!4v1722242783399!5m2!1sen!2sin" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
        </div>
        <!-- <p>Copyright © all writes are reserved</p> -->
        <p><b style="font-size:20px;">© 'carve'</b>, 2024. All Rights Reserved.</p>
        
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Perform form validation and submission using AJAX (if needed)
            var form = event.target;
            var formData = new FormData(form);

            // Example AJAX request (replace with your actual AJAX call)
            fetch(form.action, {
                method: form.method,
                body: formData
            }).then(response => response.json())
            .then(data => {
                // Assuming the server returns a success message in JSON format
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Your message has been sent successfully!',
                    });
                    form.reset(); // Reset the form after successful submission
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error sending your message. Please try again later.',
                    });
                }
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error sending your message. Please try again later.',
                });
            });
        });
    </script>

    <script>
        function bookCar(carId) {
            window.location.href = `car_details.php?id=${carId}`;
        }
    </script>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>


<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
