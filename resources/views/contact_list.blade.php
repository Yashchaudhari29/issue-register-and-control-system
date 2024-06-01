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
    <title>Contact Numbers</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .scrollable-card {
            max-height: 300px;
            overflow-y: auto;
        }
        .card {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-5">
        <h2 class="text-center mb-4">Emergency Contact Numbers</h2>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Fire Station Contacts</h4>
                    </div>
                    <div class="card-body scrollable-card">
                        <ul class="list-group">
                            <li class="list-group-item">Fire Station 1: <a href="tel:+1234567890">(123) 456-7890</a></li>
                            <li class="list-group-item">Fire Station 2: <a href="tel:+1234567891">(123) 456-7891</a></li>
                            <li class="list-group-item">Fire Station 2: <a href="tel:+1234567891">(123) 456-7891</a></li>
                            <li class="list-group-item">Fire Station 2: <a href="tel:+1234567891">(123) 456-7891</a></li>
                            <li class="list-group-item">Fire Station 2: <a href="tel:+1234567891">(123) 456-7891</a></li>
                            <!-- Add more contacts as needed -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Hospital Contacts</h4>
                    </div>
                    <div class="card-body scrollable-card">
                        <ul class="list-group">
                            <li class="list-group-item">Hospital 1: <a href="tel:+2345678901">(234) 567-8901</a></li>
                            <li class="list-group-item">Hospital 2: <a href="tel:+2345678902">(234) 567-8902</a></li>
                            <li class="list-group-item">Hospital 2: <a href="tel:+2345678902">(234) 567-8902</a></li>
                            <li class="list-group-item">Hospital 2: <a href="tel:+2345678902">(234) 567-8902</a></li>
                            <li class="list-group-item">Hospital 2: <a href="tel:+2345678902">(234) 567-8902</a></li>

                            <!-- Add more contacts as needed -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Police Contacts</h4>
                    </div>
                    <div class="card-body scrollable-card">
                        <ul class="list-group">
                            <li class="list-group-item">Police Station 1: <a href="tel:+3456789012">(345) 678-9012</a></li>
                            <li class="list-group-item">Police Station 2: <a href="tel:+3456789013">(345) 678-9013</a></li>
                            <li class="list-group-item">Police Station 2: <a href="tel:+3456789013">(345) 678-9013</a></li>
                            <li class="list-group-item">Police Station 2: <a href="tel:+3456789013">(345) 678-9013</a></li>
                            <li class="list-group-item">Police Station 2: <a href="tel:+3456789013">(345) 678-9013</a></li>
                            <!-- Add more contacts as needed -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Ambulance Contacts</h4>
                    </div>
                    <div class="card-body scrollable-card">
                        <ul class="list-group">
                            <li class="list-group-item">Ambulance Service 1: <a href="tel:+4567890123">(456) 789-0123</a></li>
                            <li class="list-group-item">Ambulance Service 2: <a href="tel:+4567890124">(456) 789-0124</a></li>
                            <li class="list-group-item">Ambulance Service 2: <a href="tel:+4567890124">(456) 789-0124</a></li>
                            <li class="list-group-item">Ambulance Service 2: <a href="tel:+4567890124">(456) 789-0124</a></li>
                            <li class="list-group-item">Ambulance Service 2: <a href="tel:+4567890124">(456) 789-0124</a></li> 
                            <!-- Add more contacts as needed -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

@stop
