@extends('adminlte::page', ['sidebar' => true])
@section('title', 'Dashboard')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 issue-detail-container">
      @if(auth()->user()->hasRole('om'))
        <p class='btn_p'>
          <a href="{{ route('om.list') }}" class="btn btn-primary go-back-btn">Go Back</a>
        </p>
      @endif
      @if(auth()->user()->hasRole('im'))
        <p class='btn_p'>
          <a href="{{ route('im.list') }}" class="btn btn-primary go-back-btn">Go Back</a>
        </p>
      @endif
      @if(auth()->user()->hasRole('si'))
        <p class='btn_p'>
          <a href="{{ route('si.issue.list') }}" class="btn btn-primary go-back-btn">Go Back</a>
        </p>
      @endif
      <h4><strong>Created by : </strong>{{ $issue->username }}</h4>
      @if($issue->status != 'Pending')
        <span class="badge" style="background-color:green; color:white;" >{{ $issue->status }} by {{ $issue->closed_by }} </span> 
      @endif
      @if($issue->status != 'Closed')
      <span class="badge" style="background-color:blue; color:white;" >{{ $issue->status }} </span> 
      @endif
      <p><strong>Title:</strong> <span id="detailTitle">{{ $issue->title }}</span></p>
      <p><strong>Description:</strong> <span id="detailDescription">{{ $issue->description }}</span></p>
      <p><strong>Date:</strong> <span id="detailDate">{{ $issue->date }}</span></p>
      
      <div class="image-gallery">
        @if(!empty($imageNames))
          @foreach($imageNames as $imageName)
            <div class="image-wrapper">
              <img src="{{ asset('issue_img/' . $imageName) }}" alt="Issue Image {{ $loop->iteration }}" class="img-thumbnail">
            </div>
          @endforeach
        @else
          <p>No images available.</p>
        @endif
      </div>
      @if(auth()->user()->hasRole('om') && $issue->status != 'Closed')
        <p class='btn_p'>
          <form action="{{ route('close.om', ['IssueId' => $issue->IssueId]) }}" method="POST" style='text-align: right;'>
              @csrf
              <button type="submit" class="btn btn-primary close-btn">Close Issue</button>
          </form>
        </p>
      @endif
      @if(auth()->user()->hasRole('im') && $issue->status != 'Closed')
    <p class='btn_p'>
        <form action="{{ route('close.im', ['IssueId' => $issue->IssueId]) }}" method="POST"style='text-align: right;'>
            @csrf
            <button type="submit" class="btn btn-primary close-btn">Close Issue</button>
        </form>
    </p>
@endif

@if(auth()->user()->hasRole("si") && $issue->status != 'Closed')
    <p class='btn_p'>
        <form action="{{ route('close.si', ['IssueId' => $issue->IssueId]) }}" method="POST"style='text-align: right;'>
            @csrf
            <button type="submit" class="btn btn-primary close-btn">Close Issue</button>
        </form>
    </p>
@endif

      </div>
  </div>
</div>

<!-- Full-Screen Image Overlay -->
<div id="imageOverlay" class="image-overlay">
  <span class="close-btn" style="margin-top:40px">&times;</span>
  <img class="overlay-image" id="fullScreenImage" src="" alt="Full Size Image">
</div>

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

  .image-gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
  }

  .image-wrapper {
    flex: 1 1 200px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .image-wrapper img {
    max-width: 100%;
    max-height: 200px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    cursor: pointer;
  }

  .btn_p {
    text-align: right;  
  }

  .image-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }

  .image-overlay .overlay-image {
    max-width: 90%;
    max-height: 90%;
  }

  .image-overlay .close-btn {
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 40px;
    color: #fff;
    cursor: pointer;
  }
  /* .close-btn{
    align-items:right;
  } */

  @media (max-width: 768px) {
    .issue-detail-container {
      margin-top: 20px;
      padding: 15px;
    }

    .image-wrapper {
      flex: 1 1 100%;
    }
  }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('.image-wrapper img').on('click', function() {
      var src = $(this).attr('src');
      $('#fullScreenImage').attr('src', src);
      $('#imageOverlay').css('display', 'flex');
    });

    $('.close-btn').on('click', function() {
      $('#imageOverlay').css('display', 'none');
    });

    $('#imageOverlay').on('click', function(event) {
      if (event.target.id === 'imageOverlay') {
        $('#imageOverlay').css('display', 'none');
      }
    });
  });
</script>
@stop
