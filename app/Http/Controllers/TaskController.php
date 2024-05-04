<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $tasks = $user->task ;
        
        return view('welcome',compact('tasks'));
        // return $task ;
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Create');
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'desc'=>'required|string',
            // 'file'=>'required',
        ]);

        // for image
        if ($request->file != "") {
            $request->validate([
                'file'=>'image|mimes:jpeg,png,jpg,gif|max:3000',
            ]);
        }

        $task = new Task() ;
        $task->Task_Title = $request->title ;
        $task->Task_Desc = $request->desc ;
        $task->Status = false ;
        $task->user_id = Auth::user()->id ;
        $task->save();

        if ($request->file != "") {
            //store image if image is uploaded
            $image = $request->file ;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().".".$ext ; // unique image name
            echo $imageName ;

            //same image to directory
            $image->move(public_path('uploads/selfie'),$imageName);

            $task->Selfie = $imageName ;
            $task->save();
        }
        return redirect()->route('task.index')->with('success','Task Added Successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {   //validation so user can't accesss other user's Post
        if ($task->user_id === Auth::user()->id) {
            return view('Edit',compact('task'));
        }else {
            return redirect()->route('task.index')->with('error','Trying to access other user data');
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::user()->id) {
            return redirect()->route('task.index')->with('error','Trying to access other user data');
        }
        $request->validate([
            'title'=>'required|string',
            'desc'=>'required|string',
        ]);
        // for image
        if ($request->newFile != "") {
            $request->validate([
                'newFile'=>'image|mimes:jpeg,png,jpg,gif|max:3000',
            ]);
        }

        // $task = Task::where('task_id',$task)->first();
        $task->Task_Title = $request->title ;
        $task->Task_Desc = $request->desc ;
        $task->Status = $request->status ;
        $task->save();

        if ($request->newFile != "") {
            echo "hiiiii";
            //delete old image
            File::delete(public_path('uploads/selfie/'.$task->Selfie));


            //store image if image is uploaded
            $image = $request->newFile ;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().".".$ext ; // unique image name

            //same image to directory
            $image->move(public_path('uploads/selfie'),$imageName);

            $task->Selfie = $imageName ;
            $task->save();
        }
        return redirect()->route('task.index')->with('success','Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(Task $task)
    {
        //validation so user can't accesss other user's Post
        if ($task->user_id === Auth::user()->id) {
            $task->delete();
            return redirect()->route('task.index')->with('success','Task Delete Successfully');
        }else {
            return redirect()->route('task.index')->with('error','Trying to access other user data');
        }
        
    }

}
