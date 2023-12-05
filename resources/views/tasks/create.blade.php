<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>File Upload</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400;500;600&family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
        <!-- Bootstrap Links -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="/resources/css/app.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
     
        <style>
        
.card{
    margin: 5px auto;
}
.card img{
    width: 250px ;
}
        </style>
    </head>
    <body >
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-md">
              <a class="navbar-brand" href="#">Upload Documents</a>
            </div>
          </nav>

          <div class="container">
            <div class="row">
              <div class="col-lg-5" >
                <img src="https://cdn-icons-png.flaticon.com/512/3820/3820184.png" class="rounded mx-auto d-block fullimage" alt="...">
                    
                    <form method="POST" action='{{url("/tasks")}}' enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                        <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="task" name="task">
                        <input class="btn btn-outline-success" type="submit" id="inputGroupFileAddon04" value="submit">
                    </div>
                    </form>
                    <p class="text-task text-center">View your uploaded image/task. - <a href="{{url('/tasks')}}">Click here</a>.</p>
              </div>
              <div class="col-lg-7 ">

                @if( ! empty($id) )	
                    
                   <br>
                   <div class="alert alert-success" role="alert">
                    You have tasked the file successfully!
                  </div>
                   <br>
                    <div class="card" style="width: 25rem;">
                        @if(substr($mimeType, 0, 5) == 'image')
                        <img src='{{url('/tasks',[$id,$originalName])}}' class="card-img-top rounded mx-auto d-block" alt="...">
                       @endif
                       
                        <ul class="list-group list-group-flush">
                         @isset($id) 
                          <li class="list-group-item"><span>No: </span>{{ $id }}</li>
                          <li class="list-group-item"><span>Path: </span>{{ $path }}</li>
                          <li class="list-group-item"><span>File name: </span>{{ $originalName }}</li>
                          <li class="list-group-item"><span>File type: </span>{{ $mimeType }}</li>
                          @endisset
                        </ul>

                        <div class="card-body">
                            <a href="{{url('/tasks',[$id,$originalName])}}" class="card-link" target="_blank">Click Here to View "{{ $id }} {{$originalName}}"</a>
                          
                        </div>
                      </div>

                @endif


              </div>

              
            </div>
          </div>


    </body>
</html>
