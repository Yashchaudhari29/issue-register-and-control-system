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
    <title>Contacts</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .data-card {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        .vertical-center {
            min-height: 100%;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Add Issue Button (Top) -->
        <div class="d-flex justify-content-end mb-3 vertical-center">
            <form action="{{ route('om.list.form') }}" method="GET">
                <button type="submit" class="btn btn-primary">Add Issue</button>
            </form>
        </div>
        <!-- Rig Details -->
        <div class="row">
        @foreach($contacts as $contact)
    <div class="col-md-4 col-sm-6">
        <div class="card data-card">
            <div class="card-body">
                <h5 class="card-title">Details</h5>
                <p class="card-text"><strong>Rigname:</strong> <span>{{ $contact->rig }}</span></p>
                @if(isset($imUsersByRig[$contact->rig]))
                <p class="card-text contact"><strong>IM Contact:</strong> <span>{{ $imUsersByRig[$contact->rig]->mob_number }}</span></p>
                @else
                <p class="card-text"><strong>IM Contact:</strong> <span>N/A</span></p>
                @endif
                <p class="card-text contact"><strong>Firestation:</strong> <span>{{ $contact->fire }}</span></p>
                <p class="card-text contact"><strong>Hospital:</strong> <span>{{ $contact->hospital }}</span></p>
                <p class="card-text contact"><strong>Police:</strong> <span>{{ $contact->police }}</span></p>
                
                
                <p class="card-text location"><strong>Location:</strong> <span>{{ $contact->location }}</span></p>
            </div>
        </div>
    </div>
@endforeach

        </div>

        <!-- Issue List Button (Bottom) -->
        <div class="d-flex justify-content-end mt-3">
            <form action="{{ route('om.list') }}" method="GET">
                <button type="submit" class="btn btn-primary">Issue List</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
    window.onload = function() {
        wrapContactsInTelLinks();
        wrapLocationInMapLinks();
    };

    function wrapContactsInTelLinks() {
        const contactElements = document.querySelectorAll('.contact span');
        contactElements.forEach(element => {
            const contactNumber = element.textContent.trim();
            element.innerHTML = `<a href="tel:${contactNumber}">${contactNumber}</a>`;
        });
    }

    function wrapLocationInMapLinks() {
        const locationElements = document.querySelectorAll('.location span');
        locationElements.forEach(element => {
            const locationText = element.textContent.trim();
            const mapLink = `https://www.google.com/maps?q=${encodeURIComponent(locationText)}`;
            element.innerHTML = `<a href="${mapLink}" target="_blank">${locationText}</a>`;
        });
    }
</script>
</html>
@stop
