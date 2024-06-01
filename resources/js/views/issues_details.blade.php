<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Issue Detail</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .issue-detail-container {
      margin-top: 5%;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .issue-detail-container h2 {
      color: #333333;
    }
    #detailImage{
      width: 30%;
      height:30%
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 issue-detail-container">
        <h2>Issue Detail</h2>
        <p><strong>Title:</strong> <span id="detailTitle">{{ $issue->title }}</span></p>
        <p><strong>Description:</strong> <span id="detailDescription">{{ $issue->description }}</span></p>
        <p><strong>Date:</strong> <span id="detailDate">{{ $issue->date }}</span></p>
        <img src="{{ asset('issue_img/' . $issue->images) }}" alt="Issue Image" id="detailImage">
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
