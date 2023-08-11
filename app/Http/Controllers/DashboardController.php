<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    
    //Show Login Form
    public function login(){
        return view('dashboard.login');
    }

    //Show Dashboard Landing Page 
    public function dashboardLanding(){

        $templates = File::files(resource_path('views/dashboard/templates'));
        $templateName = request('template');

        if ($templateName) {
            $templatePath = resource_path('views\dashboard\templates/' . $templateName);

            if(!File::exists($templatePath)){
                abort(404);
            }
            $templateContent = File::get($templatePath);

            return view('dashboard.index',[
                'template' => $templateName
            ] ,compact('templateContent', 'templates', 'templateName'));
        }else{
            return view('dashboard.index', compact('templates', 'templateName'));
        }
        

        // dd(File::exists($templatePath));

        
        // return view('dashboard.index', compact('templates', 'templateName'));
    }

    public function show($templateName) {

        $templates = File::files(resource_path('views/dashboard/templates'));
        $templatePath = resource_path('views/dashboard/templates/' . $templateName);

        if(!File::exists($templatePath)){
            abort(404);
        }
        $templateContent = File::get($templatePath);
        // dd($templateContent);
        return view('dashboard.index', compact('templateContent', 'templates', 'templateName'));
    }


    //update template
    public function saveTemplate(Request $req, $templateName) : RedirectResponse {
        
        $modifiedContent = $req->input('modifiedBody');
        $templateFilePath = resource_path('views/dashboard/templates/' . $templateName);
        File::put($templateFilePath, $modifiedContent);

        return redirect('/dashboard');
    }
    
}
