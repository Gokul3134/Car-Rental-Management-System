<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="icon" type="image/x-icon" href="img/logo6.jpg"> -->
    <title>Car Rental Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    
    <style>
        body{
            /* background-image: */
            /* background-image: radial-gradient(circle, rgb(212, 148, 244), rgb(110, 217, 228), rgb(85, 138, 252));
             */
             background-color:#7bcbe6;
        }

        header{
            /* background-color:rgb(212, 223, 233); */
            /* padding:0; */
            background-color:#0c2635;
        }
        .nav-left{
            padding:3px 0;
        }
        .nav-right{
            margin-right:30px;
        }
        nav ul li a {
            /* color: rgb(0, 0, 0); */
            color: white;
            
        }

        nav ul li a:hover {
            border-bottom: 2px solid white;
            

        }
        .hero-text {
            text-align: center;
            position: absolute;
            bottom: 200px;
            left: 50%;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 2px;
            padding-right: 2px;
            transform: translate(-50%, -50%);
            color: white;
            background-color: rgb(255, 255, 255, 0.001);
            /* background-color: rgb(255, 255, 255, 0.5); */
            
        }

        .about-section {
            margin-top:5%;
            margin-bottom:5%;

        }
        .about-image img {
            display:block;
            margin-left: auto;
            margin-right: auto;
            max-width: 100%;
            height: auto;
            border-radius: 50%; /* Optional: Add rounded corners to the image */
        }
        .about-text{
            background-color: rgb(255, 255, 255, 0.001);
            flex: 2;
            max-width: 70%;
            background-image:url(img/b);
            /* font-family: "Poppins", Arial, sans-serif; */
            /* background-color: white; */
            /* background-color: rgb(255, 255, 255, 0.001); */
            border-radius: 8px;
            /* margin-left: 20px; */
        }
        .about-text p {
            font-family:"Poppins", Arial, sans-serif;
            font-size: 19px;
            font-weight:500;
            line-height: 1.5;
            text-align: justify;
            max-width: 85%;
            margin-left: 50px;
            /* padding-left: 20px; */
        }
        .about-text h1 {
            /* font-size: 40px; */
            text-align:center;
            /* margin-left: 55px; */
            text-decoration: none;
        }

        .about-text a{
            margin-left:45%;
        }

        

        .servic h2{
            /* color: white; */
            color: black;
            font-family: "Poppins", Arial, sans-serif;
            margin-top: 20px;
        }

        /* Demo Code: */
        

        /* .servic {
        margin-top: 100px;
        } */

        .projcard-container,
        .projcard-container * {
        box-sizing: border-box;
        }

        .container{
            /* padding:200px; */
            padding-top:20px;
            padding-bottom: 60px;
        }

        .projcard {
        position: relative;
        width: 100%;
        height: 250px;
        margin-bottom: 15px;
        border-radius: 10px;
        background-color: #fff;
        border: 2px solid #ddd;
        font-size: 18px;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 4px 21px -12px rgba(0, 0, 0, .66);
        transition: box-shadow 0.2s ease, transform 0.2s ease;
        }

        .projcard:hover {
        box-shadow: 0 34px 32px -33px rgba(0, 0, 0, .18);
        transform: translate(0px, -3px);
        }

        .projcard::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-image: linear-gradient(-70deg, #424242, transparent 50%);
        opacity: 0.07;
        }

        .projcard:nth-child(2n)::before {
        background-image: linear-gradient(-250deg, #424242, transparent 50%);
        }

        .projcard-innerbox {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        }

        .projcard-img {
        width: 50%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.2s ease;
        }

        .projcard-textbox {
        width: 100%;
        padding: 20px;
        }

        .projcard-title {
        font-family: "Poppins", Arial, sans-serif;
        font-size: 24px;
        }

        .projcard-subtitle {
        font-family: "Poppins", Arial, sans-serif;
        color: #888;
        }

        .projcard-bar {
        width: 50px;
        height: 5px;
        margin: 10px 0;
        border-radius: 5px;
        background-color: #424242;
        }

        .projcard-blue .projcard-bar { background-color: #0088FF; }
        .projcard-red .projcard-bar { background-color: #D62F1F; }
        .projcard-green .projcard-bar { background-color: #40BD00; }

        .projcard-description {
        font-size: 16px;
        color: #424242;
        text-align:justify;
        }

        .projcard-tagbox {
        font-size: 14px;
        }

        .projcard-tag {
        display: inline-block;
        background: #E0E0E0;
        color: #777;
        border-radius: 3px 0 0 3px;
        line-height: 26px;
        padding: 0 10px 0 23px;
        position: relative;
        margin-right: 20px;
        }

        .projcard-tag::before {
        content: '';
        position: absolute;
        background: #fff;
        border-radius: 10px;
        box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
        height: 6px;
        left: 10px;
        width: 6px;
        top: 10px;
        }

        .projcard-tag::after {
        content: '';
        position: absolute;
        border-bottom: 13px solid transparent;
        border-left: 10px solid #E0E0E0;
        border-top: 13px solid transparent;
        right: -10px;
        top: 0;
        }

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

        .hero-banner img{
            opacity: 0.6;
            background: #000000;
        }

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

        footer {
            background-color: #0c2635; /* Light background color for the footer */
            color:  white; /* Dark text color for better contrast */
            text-align: center; /* Center align the text */
            padding: 20px; /* Add padding inside the footer */
            border-top: 1px solid #dee2e6; /* Add a subtle border at the top */

        }

        footer p {
            margin: 0; /* Remove default margin for the paragraph */
            font-size: 14px; /* Adjust font size if needed */
            font-family: "Poppins", Arial, sans-serif;
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
        

        /* Toggle button styles */
        .nav-toggle {
            display: none;
            cursor: pointer;
        }

        .nav-toggle i {
            font-size: 28px;
            color: white;
        }

        /* Responsive styles */
        @media (max-width: 960px) {
            .nav-center ul, .nav-right ul {
                flex-direction: column;
                display: none;
                width: 100%;
                text-align: center;
            }

            .nav-toggle {
                display: block;
            }

            .nav-center ul.active, .nav-right ul.active {
                display: flex;
            }
        }


        
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-left">
                <img src="img/logo5.jpg" alt="Logo" style="width: 120px; height: 80px;margin-left:50px">
            </div>
            <div class="nav-toggle" id="navToggle">
                <i class="fas fa-bars"></i>
            </div>
            <div class="nav-center" id="navMenu">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#service">Services</a></li>
                    <li><a href="#review">Reviews</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <ul>
                    <li><a href="login.php" id="loginBtn"><i class="fas fa-user"></i> Login</a></li>
                </ul>
            </div>
        </nav>
    </header>


    <section id="home">
        <div class="hero-banner">
            <div class="slides">
                <video width="1600" height="900px" autoplay muted loop >
                    <source src="img/video3.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="hero-text">
                    <h1>Welcome to Our Self-Drive Car Rental <b>'carve'</b></h1>
                    <!-- <a href="registation.php" class="btn btn-primary">Click Here<br> For Registation</a> -->
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <div class="about-section">
            <div class="about-image">
                <img src="img/about2.jpg" alt="About Us" style="width: 22rem;height: 20rem">
            </div>
            <div class="about-text">
                <h1>About Us</h1>
                <!-- <hr class="new1"> -->
                <p>
                    Welcome to our Self-Drive Car Rental Service <b style="font-size:25px;">'carve'</b>. We offer a wide range of cars to suit your needs. At <b>'carve'</b>, we turn journeys into memories. Since 2020, we've been your trusted car rental partner, offering a diverse fleet – from city-friendly compacts to adventure-ready SUVs and luxurious sedans. Book your car online in minutes and choose from convenient locations for a hassle-free experience. We prioritize affordability with transparent pricing and competitive rates. But it's not just about the car. Our friendly team is available 24/7 to ensure a smooth ride, and meticulous maintenance and roadside assistance keep you safe on every mile.
                    
                </p>
                <a href="index.php#about" class="btn btn-primary">View More</a> 
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
                    <!-- <a href="catalog_car.php" class="btn btn-primary">Click Here</a> -->
                </div>
            </div>
            <div class="card">
                <img src="img/gps.jpg" class="card-img-top" alt="GPS Navigation Systems Image">
                <div class="card-body">
                    <h5 class="card-title">GPS Navigation Systems</h5>
                    <p class="card-text">GPS navigation systems in car rentals offer real-time directions, traffic updates, and safety features, enhancing customer convenience. They also enable fleet tracking, theft recovery, and improved operational efficiency for rental companies.</p>
                    <!-- <a href="navigation.php" class="btn btn-primary">Click Here</a> -->
                </div>
            </div>
            <div class="card">
                <img src="img/pic4.png" class="card-img-top" alt="24/7 Customer Support Image">
                <div class="card-body">
                    <h5 class="card-title">24/7 Customer Support</h5>
                    <p class="card-text">24/7 customer support in a car rental system offers round-the-clock assistance for booking issues, roadside emergencies, and general inquiries. This ensures timely help and a seamless rental experience, enhancing customer satisfaction and reliability.</p>
                    <!-- <a href="customer_support.php" class="btn btn-primary">Click Here</a> -->
                </div>
            </div>
            
        </div>
    </section>

    <!-- <section id="service" class="servic">
        <h2>Our Services</h2>
        <div class="container" style="padding-bottom: 100px;">
            
            <div class="projcard projcard-blue">
                <div class="projcard-innerbox">
                    <div class="projcard-textbox">
                        <div class="projcard-title">Rent Car</div>
                        <div class="projcard-subtitle">Car Rental Services</div>
                        <div class="projcard-bar"></div>
                        <div class="projcard-description">Experience effortless car rental with our user-friendly platform. Our extensive fleet features a variety of vehicles to meet every need, from compact cars to luxurious options. Enjoy a seamless booking process with transparent pricing and prompt service. Simply browse our selection, choose the perfect car, and complete your reservation online within minutes. Whether you're planning a weekend getaway or a business trip, our hassle-free rental experience ensures you get on the road quickly and easily</div>
                        <div class="projcard-tagbox">
                    
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="projcard projcard-red">
                <div class="projcard-innerbox">
                    <div class="projcard-textbox">
                        <div class="projcard-title">GPS Navigation Systems</div>
                        <div class="projcard-subtitle">Advanced Navigation</div>
                        <div class="projcard-bar"></div>
                        <div class="projcard-description">Elevate your driving experience with our state-of-the-art GPS navigation systems. These advanced systems provide real-time directions, live traffic updates, and essential safety features to ensure a smooth and secure journey. For rental companies, GPS technology enhances operational efficiency by enabling fleet tracking, theft recovery, and streamlined management. With GPS navigation, enjoy the convenience of precise route planning and stay informed about road conditions, making your travel experience both enjoyable and stress-free.</div>
                        <div class="projcard-tagbox">
                         
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="projcard projcard-green">
                <div class="projcard-innerbox">
                    <div class="projcard-textbox">
                        <div class="projcard-title">24/7 Customer Support</div>
                        <div class="projcard-subtitle">Round-the-Clock Assistance</div>
                        <div class="projcard-bar"></div>
                        <div class="projcard-description">Our 24/7 customer support ensures you receive assistance whenever you need it. Whether you're dealing with booking issues, roadside emergencies, or general questions, our dedicated team is available around the clock to provide prompt and effective help. This constant availability guarantees a smooth and worry-free rental experience, enhancing your satisfaction and confidence in our service. With our round-the-clock support, you can enjoy peace of mind knowing that assistance is always just a call away, making your rental journey as seamless as possible.</div>
                        <div class="projcard-tagbox">
                           
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </section> -->

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
                <a href="#" class="fa fa-linkedin"></a><br>
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
        <p> <b style="font-size:20px;">© 'carve'</b>, 2024. All Rights Reserved.</p>
        
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
        document.getElementById("navToggle").addEventListener("click", function() {
            var menu = document.getElementById("navMenu").getElementsByTagName("ul")[0];
            menu.classList.toggle("active");
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

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
