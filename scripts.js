// Initialize the map
var map = L.map('map').setView([22.5726, 88.3639], 13); // Default location set to Kolkata

// Set up the OpenStreetMap tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Add markers with pop-up details
var markers = [
    {
        coords: [22.5726, 88.3639],
        popup: "Kolkata: This is a marker for Kolkata."
    
    },
    {
        coords: [19.0760, 72.8777],
        popup: "Mumbai: This is a marker for Mumbai."
    },
    {
        coords: [28.6139, 77.2090],
        popup: "Delhi: This is a marker for Delhi."
    }
];

markers.forEach(function(marker) {
    L.marker(marker.coords)
        .addTo(map)
        .bindPopup(marker.popup);
});

// Geocoder
var geocoder = L.Control.geocoder({
    defaultMarkGeocode: false
}).addTo(map);

geocoder.on('markgeocode', function(e) {
    var bbox = e.geocode.bbox;
    var poly = L.polygon([
        bbox.getSouthEast(),
        bbox.getNorthEast(),
        bbox.getNorthWest(),
        bbox.getSouthWest()
    ]).addTo(map);
    map.fitBounds(poly.getBounds());
});

// Search functionality
function searchLocation() {
    var searchQuery = document.getElementById('search').value.toLowerCase();
    var found = false;
    map.eachLayer(function(layer) {
        if (layer instanceof L.Marker) {
            var popupContent = layer.getPopup().getContent().toLowerCase();
            if (popupContent.includes(searchQuery)) {
                map.setView(layer.getLatLng(), 13); // Move the map to the marker location
                layer.openPopup(); // Open the marker's popup
                found = true;
            } else {
                layer.closePopup();
            }
        }
    });
    if (!found) {
        geocoder.options.geocoder.geocode(searchQuery, function(results) {
            if (results.length > 0) {
                var result = results[0];
                map.fitBounds(result.bbox);
                var marker = L.marker(result.center).addTo(map).bindPopup(result.name).openPopup();
            } else {
                alert('Location not found');
            }
        });
    }
}

document.getElementById('search-button').addEventListener('click', searchLocation);

// Route calculation
var control = L.Routing.control({
    waypoints: [],
    createMarker: function() { return null; }
}).addTo(map);

function findRoute() {
    var startLocation = document.getElementById('start-location').value;
    var endLocation = document.getElementById('end-location').value;

    geocoder.options.geocoder.geocode(startLocation, function(startResults) {
        if (startResults.length > 0) {
            var startPoint = startResults[0].center;

            geocoder.options.geocoder.geocode(endLocation, function(endResults) {
                if (endResults.length > 0) {
                    var endPoint = endResults[0].center;

                    control.setWaypoints([
                        L.latLng(startPoint.lat, startPoint.lng),
                        L.latLng(endPoint.lat, endPoint.lng)
                    ]);
                } else {
                    alert('End location not found');
                }
            });
        } else {
            alert('Start location not found');
        }
    });
}

document.getElementById('route-button').addEventListener('click', findRoute);
