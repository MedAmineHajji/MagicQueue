<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //Show Landing Page
    public function index(){
        return view('landingPage');
    }
    
    //Show View Mode Page
    public function showLandingView() {

        $templates = File::files(resource_path('views/dashboard/templates'));

        return view('viewMode.viewMode', compact('templates'));
    }

    //Log In Admin
    public function authentificate(Request $req) {

        $formFields = $req->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $req->session()->regenerate();

            return redirect('/dashboard')->with('message', 'Welcome Admin');
        }

        return back()->withErrors(['username' => 'Invalid Credentials'])->onlyInput('username');

    }

    //Log Out Admin
    public function disconnect(Request $req){
        auth()->logout();

        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/')->with('message', 'You have successfully Logged Out');
    }
    

    //Show Templates
    public function showTemplateView(string $templateName) {

        $templates = File::files(resource_path('views/dashboard/templates'));
        $templatePath = resource_path('views/dashboard/templates/' . $templateName);

        if(!File::exists($templatePath)){
            abort(404);
        }
        $templateContent = File::get($templatePath);
        // dd($templateContent);
        return view('viewMode.viewMode', compact('templateContent', 'templates', 'templateName', 'editable'));
    }
}
