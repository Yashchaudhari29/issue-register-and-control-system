<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      margin-top: 15%;
    }
    .background-image {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      opacity: 0.8;
    }
    fieldset {
      margin: auto;
    }
    .card {
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background-color: #007bff;
      color: white;
      text-align: center;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      padding: 20px;
    }
    .card-body {
      padding: 20px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      font-weight: bold;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ced4da;
    }
    button[type="submit"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #007bff;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    button[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <!-- Watermark Image -->
  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif

@if (session('cfId'))
    <div class="alert alert-danger" role="alert">
        {{ session('cfId') }}
    </div>
@endif

  <div style="display: flex;margin-top: 20px; padding-top: 20px;">
    <img class="background-image" src="{{ asset('assets/ongc.png') }}"  alt="Background Image">
</div>

  

  <div class="container">
    <div class="row justify-content-center"> 
      <div class="col-md-6 login-container">
        <div class="card">
          <div class="card-header">
            <!-- Logo -->
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="100" height="100">
            <div>
                Login Page
              </div>
          </div>
          
          <fieldset>
            <div class="card-body">
              <form id="loginForm" action="{{ route('login.index') }}" method="POST"> @csrf
                <div class="form-group">
                  <label for="cfId">CF ID</label>
                  <input type="text" class="form-control" id="cfId" name="cfId" placeholder="Enter CF ID">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
              </form>
            </div>
          </fieldset>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
