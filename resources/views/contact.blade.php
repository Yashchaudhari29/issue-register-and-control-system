@extends('adminlte::page', ['sidebar' => true])
@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    
    <style>
        body {
            background-color: #f4f6f9;
        }
        .card {
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }
        .contact-input {
            border: none;
            border-bottom: 1px solid #ced4da;
            border-radius: 0;
            box-shadow: none;
            outline: none;
            display: none; /* Hidden initially */
        }
        .contact-span {
            display: block; /* Display text initially */
        }
        .btn-primary, .btn-secondary {
            width: 100%;
        }
        .btn-container {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-prob {
            width: 30%;
        }
        #location_inp {
            display: none;
            width: 100%;
        }
        #locate_btn {
            width: 30%;
        }
        #map {
            height: 500px;
            width: 100%;
            display: none; /* Hidden initially */
            margin-top: 20px;
        }
        @media (max-width: 576px) {
            #locate_btn {
                width: 30%;
                margin-left: 10px;
                flex-direction: row;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <h2 class="text-center" id="welcome">Welcome {{$user->username}},</h2>
            <div class="card-body">
                <form name="contacts" method="GET" action="{{ route('im.form') }}" id="newIssueForm">
                    @csrf
                    <div class="btn-container" id="div">
                        <button class="btn btn-primary" style="margin-bottom:20px">New Issue</button>
                    </div>
                </form>
                <form action="" id="before" style="display: none;">
                    <div style="font-size:20px; margin-bottom:20px;"><strong>Firestation:</strong> <span id="firestation-text">{{ $contact->fire ?? '' }}</span></div>
                    <div style="font-size:20px; margin-bottom:20px;"><strong>Hospital:</strong> <span id="hospital-text">{{ $contact->hospital ?? '' }}</span></div>
                    <div style="font-size:20px; margin-bottom:20px;"><strong> Police:</strong> <span id="police-text">{{ $contact->police ?? '' }}</span></div>
                    <div style="font-size:20px; margin-bottom:20px;"><strong> Location:</strong> <span id="location-text">{{ $contact->location ?? '' }}</span></div>
                    <div class="text-right mb-3">
                        <button type="button" class="btn btn-primary btn-prob" id="editButton" onclick="enableEditing()">Edit</button>
                    </div>
                </form>
                <form name="contacts" method="POST" action="{{ route('update.contact') }}" id="contactForm" style="display:none;">
                    @csrf
                    <div style="display:flex;justify-content:space-between">
                        <h3>Details:</h3>
                        <a href="{{route('im.page')}}"><button type="button" class="btn-close" aria-label="Close"></button></a>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="firestation" class="col-sm-4 col-form-label">Firestation:</label>
                        <span class="col-sm-8 contact-span" id="firestation-span">{{ $contact->fire ?? '' }}</span>
                        <input type="text" class="form-control contact-input col-sm-8" id="firestation" name="firestation" value="{{ $contact->fire ?? '' }}">
                    </div>
                    <div class="form-group row">
                        <label for="hospital" class="col-sm-4 col-form-label">Hospital:</label>
                        <span class="col-sm-8 contact-span" id="hospital-span">{{ $contact->hospital ?? '' }}</span>
                        <input type="text" class="form-control contact-input col-sm-8" id="hospital" name="hospital" value="{{ $contact->hospital ?? '' }}">
                    </div>
                    <div class="form-group row">
                        <label for="police" class="col-sm-4 col-form-label">Police:</label>
                        <span class="col-sm-8 contact-span" id="police-span">{{ $contact->police ?? '' }}</span>
                        <input type="text" class="form-control contact-input col-sm-8" id="police" name="police" value="{{ $contact->police ?? '' }}">
                    </div>
                    <div class="form-group row" style="justify-content:space-between;">
                        <label for="location" class="col-sm-4 col-form-label">Location:</label>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="saveButton" style="display:none;">Save</button>
                        </div>
                        <button class="btn btn-primary" id="locate_btn" type="button">Locate</button>
                        <input type="text" class="form-control contact-input col-sm-8" id="location_inp" name="location" value="{{ $contact->location ?? '' }}">
                        <div id="map"></div>
                    </div>
                </form>
                <form name="contacts" method="GET" action="{{ route('im.list') }}" id="issueListForm">
                    @csrf
                    <div class="text-center" id="div1">
                        <button class="btn btn-primary">Issue List</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        window.onload = function() {
            document.getElementById("contactForm").style.display = "none";
            document.getElementById("before").style.display = "block";
            wrapContactsInTelLinks();
            wrapLocationInMapLink();
        };

        function enableEditing() {
            document.getElementById('contactForm').style.display = 'block';
            document.getElementById('before').style.display = 'none';

            document.querySelectorAll('.contact-span').forEach(span => {
                span.style.display = 'none'; 
            });
            document.querySelectorAll('.contact-input').forEach(input => {
                input.style.display = 'block'; 
                input.removeAttribute('readonly');
            });

            document.getElementById('location_inp').style.display = 'none';

            document.getElementById('editButton').style.display = 'none';
            document.getElementById('div').style.display = 'none';
            document.getElementById('div1').style.display = 'none';
            document.getElementById('welcome').style.display = 'none';
        }
        
        function wrapContactsInTelLinks() {
            const contactIds = ['firestation-text', 'hospital-text', 'police-text'];
            contactIds.forEach(id => {
                const contactElement = document.getElementById(id);
                if (contactElement) {
                    const contactNumber = contactElement.textContent.trim();
                    contactElement.innerHTML = `<a href="tel:${contactNumber}">${contactNumber}</a>`;
                }
            });
        }
        
        function wrapLocationInMapLink() {
            const locationElement = document.getElementById('location-text');
            if (locationElement) {
                const locationText = locationElement.textContent.trim();
                const mapLink = `https://www.google.com/maps?q=${encodeURIComponent(locationText)}`;
                locationElement.innerHTML = `<a href="${mapLink}" target="_blank">${locationText}</a>`;
            }
        }
        
        document.getElementById('locate_btn').addEventListener('click', function(event) {
            document.getElementById('locate_btn').style.display="none";
            document.getElementById('saveButton').style.display = 'block';
            event.preventDefault();
            const mapElement = document.getElementById('map');
            mapElement.style.display = 'block'; // Show the map

            // Initialize the map and set a default view
            const map = L.map('map').setView([51.505, -0.09], 13);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add a marker at the default location
            const marker = L.marker([23.561042, 72.371945]).addTo(map)
                .bindPopup('Click to select this location').openPopup();

            // Add a click event to the map to update the location
            map.on('click', function(e) {
                const latlng = e.latlng;
                const locationInput = document.getElementById("location_inp");
                locationInput.style.display = "block";
                locationInput.value = `${latlng.lat},${latlng.lng}`;
                marker.setLatLng(latlng).update()
                    .bindPopup('Selected location').openPopup();
            });
        });
    </script>
</body>
</html>
@stop
