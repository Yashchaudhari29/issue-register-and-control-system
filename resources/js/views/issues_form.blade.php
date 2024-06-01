<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Issues Form</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .form-container {
      margin-top: 5%;
    }
    .image-preview-container {
      margin-top: 20px;
      display: flex;
      flex-wrap: wrap;
    }
    .image-preview-item {
      width: calc(20% - 20px);
      margin-right: 10px;
      margin-bottom: 10px;
      position: relative;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
      border-radius: 8px;
    }
    .image-preview-item img {
      width: 100%;
      height: auto;
      border-radius: 8px;
    }
    .image-preview-item .close {
      position: absolute;
      top: -8px;
      right: -8px;
      background-color: white;
      border: 1px solid black;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      line-height: 18px;
      text-align: center;
      cursor: pointer;
    }
    .add-image-button-container {
      width: calc(100% - 10px);
      margin-top: 10px;
      display: flex;
      justify-content: flex-end;
    }
    .add-image-button {
      margin-right: 10px;
    }
    .is-invalid {
      border-color: red !important;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 form-container">
        <h2>Add New Issue</h2>

        <!-- <form id="issueForm" action="{{ url('/issue_list') }}" method="GET" onsubmit="return validateForm()" class="needs-validation" novalidate> -->

        <form id="issueForm" action="{{ url('/issues_list') }}" method="POST" onsubmit="return validateForm()" enctype='multipart/form-data' class='needs-validation' novalidate > @csrf

          <div class="form-group">
            <label for="issueTitle">Title</label>
            <input type="text" class="form-control" id="issueTitle" name="issueTitle" placeholder="Enter issue title" required>
            <div class="invalid-feedback">Please enter a title.</div>
          </div>
          <div class="form-group">
            <label for="issueDescription">Description</label>
            <textarea class="form-control" id="issueDescription" name="issueDescription" rows="3" placeholder="Enter issue description" required></textarea>
            <div class="invalid-feedback">Please enter a description.</div>
          </div>
          <div class="form-group">
  <label for="issueDate">Date</label>
  <input type="date" class="form-control" id="issueDate" name="issueDate" required>
  <div class="invalid-feedback">Please select a date.</div>
</div>
          <div class="image-preview-container" id="imagePreview"></div>
          <div class="add-image-button-container">
            <button type="button" class="btn btn-primary add-image-button" onclick="addMoreImageUpload()" id="addImageButton">Add Image</button>
            <input type="file" class="form-control-file d-none" id="imageUpload" name="imageUpload" accept="image/*" multiple required>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    var imageUpload = document.getElementById('imageUpload');
    var addImageButton = document.getElementById('addImageButton');
    var imagePreview = document.getElementById('imagePreview');

    imageUpload.addEventListener('change', function(event) {
      var files = event.target.files;

      if (files.length > 5) {
        alert('You can upload maximum 5 images.');
        this.value = ''; 
        return;
      }

      for (var i = 0; i < files.length; i++) {
        var reader = new FileReader();
        reader.onload = function(e) {
          var image = document.createElement('div');
          image.classList.add('image-preview-item', 'card');
          image.innerHTML = '<img src="' + e.target.result + '" class="card-img-top" alt="Image Preview">' +
                            '<span class="close" onclick="removeImage(this)">×</span>';
          imagePreview.appendChild(image);
        };
        reader.readAsDataURL(files[i]);
      }

     
      if (imagePreview.children.length === 5) {
        addImageButton.disabled = true;
      }
    });

    function removeImage(element) {
      element.parentNode.remove();

     
      if (imagePreview.children.length < 5) {
        addImageButton.disabled = false;
      }
    }

    function addMoreImageUpload() {
      imageUpload.click();
    }

    function validateForm() {
      var form = document.getElementById('issueForm');
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
      return form.checkValidity();
    }
  </script>
</body>
</html>
