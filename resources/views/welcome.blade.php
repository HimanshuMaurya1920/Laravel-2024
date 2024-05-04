
<!doctype html>
<html lang="en">
   <head>
   
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Laravel 11 Multi Auth</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
      <script>
        function confirmSubmit(){
            if (confirm('Are You Sure')) {
                document.getElementById('myForm').submit();
            } else {
                return false ;
            }
        }
      </script>
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
        <div class="container my-2">
            <div class="row">
                <div class="col-12">
                   @if (Session::has('success'))
                       <div class="alert alert-success">{{Session::get('success')}}</div>
                   @endif

                   @if (Session::has('error'))
                       <div class="alert alert-danger">{{Session::get('error')}}</div>
                   @endif
                </div>
            </div>
        </div>
        <div class="container">
           <div class="card border-0 shadow my-5">
                <div class="card-header bg-light">
                    <span><h3 class="h5 pt-2">Dashboard</h3></span>
                    <a href="{{route('task.create')}}" class="btn btn-success btn">Add Task</a>

                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Selfie</th>
                            <th scope="col">Task</th>
                            <th scope="col">Desc</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @if (count($tasks)>0)
                            @php $no = 1 @endphp
                                
                            
                            @foreach ($tasks as $task)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <td>
                                    @if ($task->Selfie != "")
                                    <img width="50" src="{{ asset('uploads/selfie/'.$task->Selfie) }}" alt="">
                                    
                                        
                                    @endif
                                </td>
                                <td>{{$task->Task_Title}}</td>
                                <td>{{$task->Task_Desc}}</td>
                                <td>
                                    @if ($task->Status===1)
                                    <span class="badge rounded-pill text-bg-success">Complated</span>
                                    @else
                                    <span class="badge rounded-pill text-bg-secondary">Rmaining</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('task.edit',$task->task_id)}}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <td>
                                    <form action="{{route('task.destroy',$task->task_id)}}" method="POST" id="myForm" onsubmit="return confirmSubmit()">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    
                                    </form>
                                </td>
                              </tr>

                                
                            @endforeach
                            @else
                            <tr><td class="text-center" colspan="6">No Record Fount</td></tr>
                                
                            @endif

                            
                           
                                
                           
                                
                          
                        
                         
                         
                        </tbody>
                      </table>
                    
                </div>
           </div>
        </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>