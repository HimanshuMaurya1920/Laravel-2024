
<!doctype html>
<html lang="en">
   <head>
   
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Laravel 11 Multi Auth</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
   </head>
   <body class="bg-light">
  
        <nav class="navbar navbar-expand-md bg-white shadow-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret">
            <div class="container">
                <a class="navbar-brand" href="#">
                   <strong>Laravel 11 Multi Auth</strong>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1">
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello, {{Auth::user()->name}}</a>
                            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">                          
                                <li>
                                    <a class="dropdown-item" href="{{route('account.logout')}}">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </nav>
        <div class="container">
           <div class="card border-0 shadow my-5 pt-2">
                <div class="card-header bg-light ">
                    {{-- <span><h3 class="h5 pt-2">Add Task</h3></span> --}}
                    <nav style="--bs-breadcrumb-divider: '>'; pt-2" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{route('task.index')}}">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Edit Task</li>
                        </ol>
                      </nav>

                </div>
                <div class="card-body">


                    <form enctype="multipart/form-data" action="{{route('task.update',$task->task_id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label ">Task Title</label>
                          <input type="text" class="form-control border border-dark @error('title') is-invalid @enderror" value="{{old('title',$task->Task_Title)}}" id="exampleInputEmail1" name="title" aria-describedby="emailHelp">
                          @error('title')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1 " class="form-label">Task DESC</label>
                            <textarea class="form-control border border-dark @error('desc') is-invalid @enderror" id="exampleFormControlTextarea1" name="desc" rows="3">{{old('desc',$task->Task_Desc)}}</textarea>
                            @error('desc')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="newFile" class="form-label ">Selfie</label>
                            <input type="file" class="form-control border border-dark @error('newFile') is-invalid @enderror" value="{{old('newFile')}}" id="newFile" name="newFile" aria-describedby="newFile">
                            @error('newFile')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
<br>
                            @if ($task->Selfie != "")
                            <img class=" img-thumbnail " width="200" src="{{ asset('uploads/selfie/'.$task->Selfie) }}" alt="">
                            @endif
                          </div>

                          <div class="mb-3">
                          <label for="status">Task Status</label>
                        <select class="form-select form-select-lg mb-3" id="status" aria-label="Large select example" name="status">

                            @if ($task->Status===1)
                            <option value="0">Remaining</option>
                            <option selected value="1">Complate</option>
                            @else
                            <option selected value="0">Remaining</option>
                            <option value="1" >Complate</option>
                                
                            @endif
                            
                            
                          </select>
                        </div>
                          <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
                          </div>
                       
                      </form>
                    
                </div>
           </div>
        </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>