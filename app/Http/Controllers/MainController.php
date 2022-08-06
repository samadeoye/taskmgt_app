<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index() {
        $tasks = Task::orderBy('priority','asc')->skip(0)->take(10)->get();
        $all_tasks = Task::all();
        $projects = Project::all();
        $data = array(
            'tasks' => $tasks,
            'all_tasks' => $all_tasks,
            'projects' => $projects
        );
        return view('index', compact('data'));
    }

    public function loginView() {
        return view('login');
    }

    public function loginRun(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        $validated = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $user = User::where('email', $email)->first();
        if($user) {
            $pword = $user['password'];
            $ver_pass = Hash::check($password, $pword);
            if($ver_pass) {
                session(['Logged_in' => $user]);
                return redirect('/');
            }
            else {
                return back()->with('err_msg', 'Invalid email or password.');
            }
        }
        else {
            return back()->with('err_msg', 'User does not exist.');
        }
    }

    public function logout(Request $request) {
        $request->session()->forget('Logged_in');
        return redirect('/login');
    }

    public function profileView() {
        return view('profile');
    }

    public function profileRun(Request $request) {
        $name = Str::title($request->input('name'));
        $email = $request->input('email');

        $validated = $request->validate([
            'email' => 'email|required|unique:users,email,'.session('Logged_in')['id'],
            'name' => 'required|min:8|max:50',
        ]);

        $update = User::where('id', session('Logged_in')['id'])->update(['name' => $name, 'email' => $email]);
        if($update) {
            $user = User::where('email', $email)->first();
            session(['Logged_in' => $user]);
            return back()->with('suc_msg', 'Profile updated successfully.');
        }
        else {
            return back()->with('err_msg', 'Profile could not be updated. Please try again.');
        }
    }

    public function securityView() {
        return view('security');
    }

    public function securityRun(Request $request) {
        $old_password = $request->input('old_password');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');

        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if(Hash::check($old_password, session('Logged_in')['password'])) {
            $update = User::where('id', session('Logged_in')['id'])->update(['password' => Hash::make($password)]);
            if($update) {
                $user = User::where('email', session('Logged_in')['email'])->first();
                session(['Logged_in' => $user]);
                return back()->with('suc_msg', 'Password updated successfully.');
            }
            else {
                return back()->with('err_msg', 'Password could not be updated. Please try again.');
            }
        }
        else {
            return back()->with('err_msg', 'Old password is incorrect.');
        }
    }

}
