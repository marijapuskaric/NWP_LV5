<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;

class NastavnikController extends Controller
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

    //funkcija za prikaz stranice za nastavnika
    public function index()
    {
        $user = Auth::user();
        if ($user->getRole()=='nastavnik')
        {
            return view('nastavnik');
        }
        else
        {
            return view('notAuthorized');
        }
    }

    //funkcija za stvaranje novog rada
    public function createNewTask(Request $request)
    {
        $nastavnik = Auth::user();
        if ($nastavnik->getRole()=="nastavnik")
        {
            $request->validate([
                'naziv_rada' => 'required',
                'naziv_rada_en' => 'required',
                'zadatak_rada' => 'required',
                'tip_studija' => 'required'
            ]);

            $task = new Task();
            $task->naziv_rada = $request->input('naziv_rada');
            $task->naziv_rada_en = $request->input('naziv_rada_en');
            $task->zadatak_rada = $request->input('zadatak_rada');
            $task->tip_studija = $request->input('tip_studija');
            $task->nastavnik_id = $nastavnik->id;
            $task->student_id = null;
            $task->save();
            return redirect()->back()->with('success', __('messages.successCreate'));
        }
        else
        {
            return redirect()->back()->with('error', __('messages.errorCreate'));
        }
    }

    //funkcija za prikaz stranice sa prijavama
    //prikazuju se svi radovi koje je nastavnik stvorio te se za svaki prikazuju studenti koji su taj rad prijavili
    public function showApplications()
    {
        $user = Auth::user();
        if ($user->getRole()=='nastavnik') 
        {
            $userTasks = Task::with('students')->where('nastavnik_id', $user->id)->get();
            return view('prijave', compact('userTasks'));
        } 
        else 
        {
            return view('notAuthorized');
        }
    }

    //funkcija za prihvacanje studenta na radu
    //nakon sto se prihvati student, njemu je onemogucena prijava drugog rada te je ostalim studentima onemogucena prijava tog rada
    public function acceptStudent(Request $request, $studentId, $taskId)
    {
        $user = Auth::user();
        if ($user->getRole()=='nastavnik') 
        {
            $task = Task::findOrFail($taskId);
            $student = User::findOrFail($studentId);
            $task->student_id = $studentId;
            $task->save();
            $task->students()->detach();
            $student->tasks()->detach();
            return redirect()->back()->with('success', __('messages.successAccept'));
        } 
        else 
        {
            return redirect()->back()->with('error', __('messages.errorAccept'));
        }
    }
}
