<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Upload Files</title>

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
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
     
    </head>
    <body >
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-md">
              <a class="navbar-brand" href="#">Uploaded Files</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                 
                  <li class="nav-item">
                    <a class="btn btn-primary" href="/tasks/create">Add File</a>

                  </li>
                 
                </ul>
               
              </div>
            </div>
          </nav>
          <div class="container-fluid">
            <div class="row">

                @foreach ($tasks as $task)
                
                <div class="col-lg-3">
        
                    <div class="card d-flex flex-column" style="width: 18rem;">
                  <img src='{{url("/tasks/{$task->id}/{$task->originalName}")}}' class="card-img-top mx-auto d-block" alt="...">
                  <hr>
                  <div class="card-body">
                    <h5 class="card-title"><span>File name: </span><a href='{{url("/tasks/{$task->id}/{$task->originalName}")}}'>{{$task->originalName}}</a></h5>
                  </div>
                 <hr>
                  <div class="card-body d-flex ">
                      <form method="Post" action='{{url("/tasks/{$task->id}/edit")}}' {{-- NOTE ROUTE STYLE --}} style="display:inline!important;">
                      @csrf
                      @method('get') {{-- NOTE METHOD --}}
                      <input type="submit" value="Edit" style="display:inline!important;" class="btn btn-outline-secondary circle-button ">
                  </form> 
              
                      <form method="POST" action='{{url("/tasks/{$task->id}")}}' style="display:inline!important;">
                        @csrf
                        @method('delete') {{-- NOTE METHOD --}}
                        <input type="submit" value="Delete" style="display:inline!important;" class="btn btn-outline-danger circle-button" >
                     </form>
                  </div>
                </div>
                      
              </div>
             
            @endforeach


            </div>
          </div>
         
        
        @if (session('operation'))
                {{ session('operation') }} {{ session('id')  }}
        @endif   


       

    </body>
</html>