<!DOCTYPE html>
<html lang="en">
<head>
  <title>Me</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .row.content {height: 1500px}
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-12">
                <h4><small>RECENT POSTS</small></h4>
                <hr>
                @foreach($posts as $post)
                <div class="col-sm-3">
                  <div style="padding: 10px">
                    <h3>{{$post->title}}</h3>
                    <h5><span class="glyphicon glyphicon-time"></span> Post by {{$post->creator->name}}, {{$post->created_at}}.</h5>
                    <p>{{$post->description}}</p>
                    <h5>Leave a Comment:</h5>
                    <form>
                        <div class="form-group">
                            <textarea class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                  </div>
                  <hr>
                </div>
                
                @endforeach
            </div>
        </div>
    </div>

    <footer class="container-fluid">
        <p>Mohamed Elshahat</p>
    </footer>
</body>
</html>
