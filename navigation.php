<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPS Navigation Systems</title>
    <link rel="stylesheet" href="navigation.css">
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
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

    <section id="controls">
        <!-- <video autoplay muted loop id="bg-video">
            <source src="images/video.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video> -->
        <div id="search-container">
            <input type="text" id="search" placeholder="Search for a location">
            <button id="search-button">Search</button>
        </div>
        <div id="route-search-container">
            <input type="text" id="start-location" placeholder="Start location">
            <input type="text" id="end-location" placeholder="End location">
            <button id="route-button">Find the Route</button>
        </div>
        <div id="map-container">
            <div id="map"></div>
        </div>
    </section>

    <!-- <section id="banner-section">
        <div id="banner">
            <h2>Welcome to the Interactive Map Application</h2>
            <p>Explore various locations and find your destination easily.</p>
        </div>
    </section> -->

    <footer>
        <!-- <p>&copy; 2024 Interactive Map Application. All rights reserved.</p> -->
        <p><b style="font-size:20px;">© 'carve'</b>, 2024. All Rights Reserved.</p>
    </footer>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script src="scripts.js"></script>

</body>
</html>
