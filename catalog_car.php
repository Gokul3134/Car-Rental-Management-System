<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="carstyles.css">
</head>
<body>
    <header>
        <nav>
            <div class="nav-left">
                <ul>
                    <li><a href="index.php#service">Home</a></li>
                    <!-- <li><a href="booking.php">Book Car</a></li> -->
                </ul>
            </div>
        </nav>
    </header>

    <section id="rentcars" class="car">
        <div class="car-catalog">
            <?php include 'car_catalog.php'; ?>
        </div>
    </section>

    <footer>
        <p><b style="font-size:20px;">© 'carve'</b>, 2024. All Rights Reserved.</p>
    </footer>

    <script>
        function toggleDetails(carId) {
            // Get the details div for the clicked car
            var detailsDiv = document.getElementById('details-' + carId);

            // If the details are currently visible, hide them
            if (detailsDiv.style.display === 'block') {
                detailsDiv.style.display = 'none';
            } else {
                // Hide any currently visible car details
                var visibleDetails = document.querySelectorAll('.car-details[style*="display: block"]');
                visibleDetails.forEach(function(detail) {
                    detail.style.display = 'none';
                });

                // If the details are hidden, fetch and display them
                if (detailsDiv.innerHTML === '') {
                    fetch('car_details.php?id=' + carId)
                        .then(response => response.text())
                        .then(data => {
                            detailsDiv.innerHTML = data;
                            detailsDiv.style.display = 'block';
                        });
                } else {
                    // Toggle the visibility of the clicked car's details
                    detailsDiv.style.display = 'block';
                }
            }
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
