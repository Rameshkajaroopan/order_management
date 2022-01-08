<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBX4GRZHCs7t1pkpjrRaLoTlCgqX8o46wY&libraries=places&callback=initMap&libraries=places&v=weekly" defer></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div id="map" style=" height: 500px; width:100%"> </div>
<input id="pac-input" type="text" placeholder="Enter a location" class="dinput" />

<!-- ......................script for google map view.................... -->
<script>
    //.......................current location......................

    $(document).ready(function() {

        "use strict";
        $('#map').hide();

        initMap();

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -33.8688,
                    lng: 151.2195,
                },
                zoom: 13,
            });
            const card = document.getElementById("pac-card");
            const input = document.getElementById("pac-input");
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
            const autocomplete = new google.maps.places.Autocomplete(input); // Bind the map's bounds (viewport) property to the autocomplete object,


            autocomplete.bindTo("bounds", map); // Set the data fields to return when the user selects a place.

            autocomplete.setFields([
                "address_components",
                "geometry",
                "icon",
                "name",
            ]);
            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");
            infowindow.setContent(infowindowContent);
            const marker = new google.maps.Marker({
                map,
                anchorPoint: new google.maps.Point(0, -29),
            });

        }


    });
</script>
<!-- ...................end...script for google map view.................... -->