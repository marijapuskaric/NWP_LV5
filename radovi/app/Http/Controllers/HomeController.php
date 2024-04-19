<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     //funkcija za prikaz stranice za studenta
     //dohvacanje rada na kojem je prihvacen,
     //u slucaju da ne postoji dohvacaju se svi radovi koje moze prijaviti (prema vrsti studija)
     //i svi radovi koje je prijavio
    public function index()
    {
        $user = Auth::user();
        if ($user->getRole()=='student')
        {
            $assignedTask = Task::where('student_id', $user->id)->get();
            if ($assignedTask->isEmpty())
            {
                $tasks = Task::where('tip_studija', '=', $user->tip_studija)
                ->where('student_id',"=", null)
                ->whereDoesntHave('students', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                })->get();
                $userTasks = Task::whereHas('students', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                })->get();
            }
            else
            {
                $tasks = collect();
                $userTasks = collect();
            }
            return view('home', compact('tasks', 'userTasks', 'assignedTask'));
        }
        else
        {
            return view('notAuthorized');
        }
    }

    //funkcija za prijavu rada, omogucena samo studentu
    public function apply(Request $request, $taskId)
    {
        $user = Auth::user();
        if ($user->getRole()=='student')
        {
            $task = Task::findOrFail($taskId);
            $user->tasks()->attach($task);
            return redirect()->back()->with('success', __('messages.successApply'));
        }
        else
        {
            return redirect()->back()->with('error', __('messages.errorApply'));
        }
    }

    //funkcija za odjavu rada, omogucena samo studentu
    public function cancel(Request $request, $taskId)
    {
        $user = Auth::user();
        if ($user->getRole()=='student')
        {
            $task = Task::findOrFail($taskId);
            $user->tasks()->detach($task);
            return redirect()->back()->with('success', __('messages.successCancel'));  
        }
        else
        {
            return redirect()->back()->with('error', __('messages.errorCancel'));
        }
    }
}
