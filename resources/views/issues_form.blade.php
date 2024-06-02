@extends('adminlte::page', ['sidebar' => true])
@section('title', 'Issues Form')

@section('content_header')
@stop

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
  <link rel="manifest" href="{{ asset('/manifest.json') }}">
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

        <form id="issueForm" action="{{ route('issue.submit') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
          @csrf
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
            <input type="file" class="form-control-file d-none" id="imageUpload" accept="image/*" multiple>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <script>
  var imageUpload = document.getElementById('imageUpload');
  var addImageButton = document.getElementById('addImageButton');
  var imagePreview = document.getElementById('imagePreview');
  var issueDate = document.getElementById('issueDate');
  var selectedFiles = [];

  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
  var yyyy = today.getFullYear();
  today = yyyy + '-' + mm + '-' + dd;
  issueDate.value = today;

  imageUpload.addEventListener('change', function(event) {
    var files = event.target.files;

    if (selectedFiles.length + files.length > 5) {
      alert('You can upload a maximum of 5 images.');
      this.value = '';
      return;
    }

    for (var i = 0; i < files.length; i++) {
      selectedFiles.push(files[i]);
    }

    updateImagePreview();
  });

  function updateImagePreview() {
    imagePreview.innerHTML = '';
    selectedFiles.forEach((file, index) => {
      let reader = new FileReader();
      reader.onload = function(e) {
        var image = document.createElement('div');
        image.classList.add('image-preview-item', 'card');
        image.innerHTML = '<img src="' + e.target.result + '" class="card-img-top" alt="Image Preview">' +
                          '<span class="close" onclick="removeImage(' + index + ')">×</span>';
        imagePreview.appendChild(image);
      };
      reader.readAsDataURL(file);
    });

    if (selectedFiles.length === 5) {
      addImageButton.disabled = true;
    } else {
      addImageButton.disabled = false;
    }
  }

  function removeImage(index) {
    selectedFiles.splice(index, 1);
    updateImagePreview();
  }

  function addMoreImageUpload() {
    imageUpload.click();
  }

  function validateForm(event) {
    var form = document.getElementById('issueForm');

    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }

    form.classList.add('was-validated');
    return form.checkValidity();
  }

  document.getElementById('issueForm').addEventListener('submit', function(event) {
    event.preventDefault();
    if (validateForm(event)) {
      var form = event.target;
      var formData = new FormData(form);

      selectedFiles.forEach((file, index) => {
        formData.append('imageUpload[]', file);
      });

      fetch(form.action, {
        method: form.method,
        body: formData,
        headers: {
          'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success' && data.redirect_url) {
          window.location.href = data.redirect_url;
        } else {
          alert('Error submitting issue!');
        }
      })
      .catch(error => {
        console.error(error);
        alert('Error submitting issue!');
      });
    }
  });
</script>

</body>
</html>
@stop
