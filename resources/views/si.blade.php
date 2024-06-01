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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Form Container -->
        <div class="card">
            <h2 class="text-center" id="welcome">Welcome {{$user->username}},</h2>
            <div class="card-body">
                <form name="contacts" method="GET" action="{{ route('user.issues.form') }}" id="newIssueForm">
                    @csrf
                    <div class="btn-container" id="div">
                        <button class="btn btn-primary" style="margin-bottom:20px">New Issue</button>
                    </div>
                </form>
                <form name="contacts" action="{{ route('update.contact') }}" method="POST" id="contactForm">
                    <div style="font-size:20px; margin-bottom:20px;"><strong>Firestation:</strong> <span id="firestation-text">{{ $contact->fire ?? '' }}</span></div>
                    <div style="font-size:20px; margin-bottom:20px;"><strong>Hospital:</strong> <span id="hospital-text">{{ $contact->hospital ?? '' }}</span></div>
                    <div style="font-size:20px; margin-bottom:20px;"><strong> Police:</strong> <span id="police-text">{{ $contact->police ?? '' }}</span></div>
                    <div style="font-size:20px; margin-bottom:20px;"><strong> Location:</strong> <span id="location-text">{{ $contact->location ?? '' }}</span></div>
                    
                </form>
                <!-- Contact Form -->
                

                <form name="contacts" method="GET" action="{{ route('si.issue.list') }}" id="issueListForm">
                    @csrf
                    <div class="text-center" id="div1">
                        <button class="btn btn-primary">Issue List</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        window.onload = function(){
            wrapContactsInTelLinks();
            wrapLocationInMapLink();
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
        function enableEditing() {
            document.querySelectorAll('.contact-span').forEach(span => {
                span.style.display = 'none'; // Hide text spans
            });
            document.querySelectorAll('.contact-input').forEach(input => {
                input.style.display = 'block'; // Show input fields
                input.removeAttribute('readonly');
            });
            document.getElementById('saveButton').style.display = 'block';
            document.getElementById('editButton').style.display = 'none';
            document.getElementById('div').style.display = 'none';
            document.getElementById('div1').style.display = 'none';
            document.getElementById('welcome').style.display = 'none';
        }
    </script>
</body>
</html>
@stop