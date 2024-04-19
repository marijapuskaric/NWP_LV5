<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
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

    //funkcija za prikaz stranice za admina sa popisom korisnika i mogucnosti promjene uloge i dodavanja vrste studija
    public function index()
    {
        $user = Auth::user();
        if ($user->getRole()=='admin')
        {
            $users = User::all();
            return view('admin', compact('users'));
        }
        else
        {
            return view('notAuthorized');
        }
    }

    //funkcija za prikaz stranice za postavljanje uloge korisnicima, pristup ima samo admin
    public function editUserRole($id)
    {
        $admin = Auth::user();
        if ($admin->getRole()=="admin")
        {
            $user = User::findOrFail($id);
            return view('updateUserRole', compact('user'));
        }
        else
        {
            return view('notAuthorized');
        }
    }

    //funkcija za promjenu uloge korisnika
    //ako se mijenja iz studenta u drugu ulogu, tip studija se postavlja na null
    //default uloga je student
    public function updateUserRole(Request $request, $userId)
    {
        $admin = Auth::user();
        if ($admin->getRole()=="admin")
        {
            $user = User::findOrFail($userId);
            $request->validate([
                'role' => 'required'
            ]);
            if ($request->role != 'student')
            {
                $user->update([
                    'role' => $request->role,
                    'tip_studija' => null
                ]);
            }
            else
            {
                $user->update([
                    'role' => $request->role
                ]);
            }
            $user->save();
            return redirect('admin');
        }
        else
        {
            return redirect()->back()->with('error', __('messages.errorRole'));
        }
    }

    //funkcija za prikaz stranice za dodavanje vrste studija studentima, pristup ima samo admin
    public function editStudyType($id)
    {
        $admin = Auth::user();
        if ($admin->getRole()=="admin")
        {
            $user = User::findOrFail($id);
            return view('setStudyType', compact('user'));
        }
        else
        {
            return view('notAuthorized');
        }
    }

    //funkcija za postavljanje vrste studija studentima
    public function setStudyType(Request $request, $userId)
    {
        $admin = Auth::user();
        if ($admin->getRole()=="admin")
        {
            $user = User::findOrFail($userId);
            $request->validate([
                'tip_studija' => 'required'
            ]);
            $user->update([
                'tip_studija' => $request->tip_studija
            ]);
            $user->save();
            return redirect('admin');
        }
        else
        {
            return redirect()->back()->with('error', __('messages.errorStudyType'));
        }
    }
}
