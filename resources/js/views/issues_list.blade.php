<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Issues List</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .issues-container {
      margin-top: 5%;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .issues-container h2 {
      color: #333333;
    }

    #addIssueBtn {
      margin-top: 20px;
    }
  </style>
</head>
<body>
@if (session('success') || isset($success))
       <div class="alert alert-success" role="alert">
           {{ session('success') ?? $success }}
       </div>
   @endif
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 issues-container">
        <h2>Issues List</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Issue ID</th>
              <th scope="col">Issue Title</th>
              <th scope="col">Issue_Desc.</th> 
              <th scope="col">Date</th>    
              
            </tr>
          </thead>
          <tbody>
          @foreach ($issues as $index => $issue)
          <tr onclick="window.location='{{ url('/issues_details', ['IssueId' => $issue->IssueId]) }}';" style="cursor: pointer;">
            <td>{{ $issue->IssueId }}</td>
            <td>{{ $issue->title }}</td>
            <td>{{ $issue->description }}</td>
            <td>{{ $issue->date }}</td>
          </tr>
          @endforeach
          </tbody>
        </table>
        <a id="addIssueBtn" class="btn btn-primary mt-3" href="{{ url('/issues_form') }}">Add More</a>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
