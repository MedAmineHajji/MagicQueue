<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dimension;
use App\Models\Element;
use App\Models\Logo;
use App\Models\Template;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Dimensions;

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



////////////////////////////////////////////////////////////////////////////////
//                      Dev APIs of Front-side React App                      //
////////////////////////////////////////////////////////////////////////////////


//GET all the templates Names:
    public function showTemplatesNames() {
        
        $templates = File::files(resource_path('views\\dashboard\\templates'));
        $templateData = [];
        foreach ($templates as $template) {
            $templateData[] = [
                'templateName' => $template->getFilename(),
                'templatePath' => $template->getPathname()
            ];
        }

        return response($templateData);
    }

//GET innerHTML of template By Name:
    public function showTemplateByName(string $templateName) {
        
        // $templates = File::files(resource_path('views\\dashboard\\templates'));

        if ($templateName) {
            $templatePath = resource_path('views\dashboard\templates/' . $templateName);

            if (!File::exists($templatePath)) {
                return response("Template NOT FOUND",$status=404);
            }else{
                $templateContent = File::get($templatePath);
                $data = [
                    'templateContent' => $templateContent
                ];
                return response()->json($data);
            }
        }else{
            return response("Please provide a templateName", $status=402);
        }
    }

//POST innerHTML of template By Name and update : 
    public function updateTemplateByName(Request $req) {

        $templateName = $req->input('templateName');
        $modifiedContent = $req->input('modifiedTemplateContent');
        
        if ($templateName && $modifiedContent) {
            $templatePath = resource_path('views\dashboard\templates/' . $templateName);

            if (!File::exists($templatePath)) {
                return response("Template NOT FOUND",$status=404);
            }else{
                File::put($templatePath, $modifiedContent);
                return response("File updated SUCCESSFULLY", $status=200);
            }
        } else {
            return response("Please provide a templateName & modifiedTemplateContent",
                            $status=400);
        }
    }
    

////////////////////////////////////////////////////////////////////////////////
//                      API working the DB method                             //
////////////////////////////////////////////////////////////////////////////////

//GET Array of objects where each object represent a Template in the DB
    public function getAllTemplatesList(){

        $templates = Template::all();
        $templatesArray = [];

        foreach ($templates as $templateKey => $templateValue) {
            $templatesArray[] = [
                'template_id' => $templateValue->id,
                'template_name' => $templateValue->name,
                'template_path' => $templateValue->path
            ];
        }

        return response($templatesArray, $status=200);
    }

//GET Array of Elements of a Template By Id : 
    public function getElementsOfTemplateById(int $id_template) {

        $template = Template::find($id_template);
        if ($template) {
            
            $elements = $template->elements;
            $elementsArray =[];

            foreach ($elements as $elementKey => $elementValue) {
                
                $elementContent = '<div id="';

                $elementContent .= $elementValue->identifier . '" class="' . $elementValue->class . '" style="' 
                                    .$elementValue->style . '">' . "\n" . $elementValue->content . '</div>';
                $elementsArray[] = [
                    'element_ID' => $elementValue->id,
                    'element_id' => $elementValue->identifier,
                    'element_is_hidden' => $elementValue->hidden,
                    'element_class' => $elementValue->class,
                    'element_style' => $elementValue->style,
                    'element_content' => $elementValue->content,
                    'element_all_content' => $elementContent
                ];
            }

            return response($elementsArray, $status=200);
        }else{
            return response("Template NOT FOUND", $status=404);
        }
        
    }

//GET innerHTML of a Template By Id:
    public function showTemplateXdimensionById(int $id_template){

        $template = Template::find($id_template);
        if($template){
            
            $elements = $template->elements;

            $templateContent = '';

            foreach ($elements as $elementKey => $elementValue) {

                $templateContent .= '<div id="';
                $templateContent .= $elementValue->identifier . '" class="' . $elementValue->class . '" style="' 
                                    .$elementValue->style . '">' . $elementValue->content . '</div>';
            }
            $dimension = Dimension::find($template->dimension_id);
            $resData = [
                'content' => $templateContent,
                'dimension_name' => $dimension->name,
                'dimension_width' => $dimension->width,
                'dimension_height' => $dimension->height,
                'logo_id' => $template->logo_id
            ];

            return response($resData, $status=200);
        }else{
            return response("Template NOT FOUND", $status=404);
        }
        


    }

//Update style positioning of Element By Id: 
    public function updateStyleElementById(Request $req, int $id_element){

        $element = Element::find($id_element);
        if(!$element){
            return response('Element NOT FOUND', $status=404);
        }

        $left_styling = $req->input('left');
        $top_styling = $req->input('top');
        $new_style = "left: ". $left_styling . "px; top: " . $top_styling . "px;";
        
        $element->style = $new_style;
        $element->save();

        return response('Element Updated Successfully', $status=200);

    }

//Update content of Element By Id:
    public function updateContentElementById(Request $req, int $id_element){

        $element = Element::find($id_element);
        if(!$element){
            return response("Element NOT FOUND", $status=404);
        }

        $newContent = $req->input("content");
        if(!$newContent){
            return response("Please provide a content", $status=403);
        }

        $element->content = $newContent;
        $element->save();

        return response("Element Updated Successfully", $status=200);
    }

//Create new Element and passing the identifier of this element:
    public function createNewElement(Request $req){

        // $validationRules = [
        //     'identifier' => 'required | unique:elements',
        //     'class' => 'nullable',
        //     'style' => 'nullable',
        //     'content' => 'nullable',
        //     'template_id' => 'required',
        // ];
        // $res = $req->validate($validationRules);
        // dd($res);

        $reqData = [
            'identifier' => $req->input("identifier"),
            'class' => $req->input("class"),
            'style' => $req->input("style"),
            'content' => $req->input("content"),
            'template_id' => $req->input("template_id"),
            'hidden' => true
        ];
        
        $newElement = Element::create($reqData);

        return response($newElement, $status=200);
    }

//Make an Element Visible 
    public function makeElementVisibleById($id_element){
        
        $element = Element::find($id_element);
        if(!$element){
            return response("Element NOT FOUND", $status=404);
        }

        $element->hidden = false;
        $element->save();

        return response("Element made VISIBLE", $status=200);
    }

//Make an Element Hidden
    public function makeElementHiddenById($id_element){

        $element = Element::find($id_element);
        if(!$element){
            return response("Element NOT FOUND", $status=404);
        }

        $element->hidden = true;
        $element->save();

        return response("Element made INVISIBLE", $status=200);
    }

//Delete an Element from DB
    public function destroyElement($id_element){

        $element = Element::find($id_element);
        if(!$element){
            return response("Element NOT FOUND", $status=404);
        }

        $element->delete();
        return response("Element deleted Successfully", $status=200);
    }

//Show All Dimensions in the DB
    public function showAllDimensions(){

        $dimensions = Dimension::all();
        $dimensionsArray = [];

        foreach ($dimensions as $dimensionKey => $dimensionValue) {
            $dimensionsArray[] = [
                'dimension_id' => $dimensionValue->id,
                'dimension_name' => $dimensionValue->name,
                'dimension_width' => $dimensionValue->width,
                'dimension_height' => $dimensionValue->height
            ];
        }

        return response($dimensionsArray, $status=200);
    }

//Update Template Dimension
    public function updateTemplateDimension(Request $req, $id_template){

        $id_dimension = $req->input("id_dimension");
        $dimension = Dimension::find($id_dimension);
        $template = Template::find($id_template);
        if(!$template || !$dimension){
            return response("Template || dim NOT FOUND", $status=404);
        }

        $template->dimension_id = $id_dimension;
        $template->save();

        return response("Template Dimension Updated Successfully", $status=200);
    }

//Upload a file # THIS IS FOR DOCUMENTION #
    public function uploadLogo(Request $req){

        $logo = $req->file('logo');
        if(!$logo){
            return response('File Required', $status=401);
        }

        $logoName = time() . '_' . $logo->getClientOriginalName();
        $path = 'C:\xampp\htdocs\MagicQueueDev\storage\app' . $logo->storeAs('uploads/logo', $logoName);

        
        
        return response($path, $status=200);
    }

//Verify if the Identifier of the Logo sent is Ok :
    // public function verifyIdentifierIsUnique($str){

    //     $identifier = $str;

    //     $arrayOfLogos = Logo::all();
    //     foreach ($arrayOfLogos as $key => $logo) {
    //         if($logo->identifier == $identifier){
    //             return false;
    //         }
    //     }
    //     return true;
    // }

//Add a New Logo to a Template 
    public function uploadNewLogo(Request $req){

        $logo = $req->file('logo');
        if(!$logo){
            return response('File Required', $status=401);
        }

        $logoName = time() . '_' . $logo->getClientOriginalName();
        $path = 'C:\xampp\htdocs\MagicQueueDev\storage\app/' . $logo->storeAs('uploads/logo', $logoName);

        $fileData = [
            'file_name' => $req->input('logo_name'),
            'identifier' => $req->input('logo_id'),
            'style' => 'left: 0px; top: 0px;',
            'file_path' => $path
        ];

        $logo = Logo::create($fileData);

        $current_template_id = $req->input('template_id');

        $template = Template::find($current_template_id);
        $template->logo_id = $logo->id;
        $template->save();

        return response('File uploaded successfully', $status=200);

    }

//Get the Logo By Id : 
    public function getLogoDataById($id_logo){

        $logo = Logo::find($id_logo);
        if(!$logo){
            return response('Logo NOT FOUND', $status=404);
        }

        $resData = [
            'logo_id' => $logo->id,
            'logo_name' => $logo->file_name,
            'logo_identifier' => $logo->identifier,
            'logo_style' => $logo->style,
            'logo_data' => $logo->file_path,
        ];
        return response($resData, $status=200);
    }

//Get the logo File By Id : 
    public function getLogoFileById($id_logo){

        $logo = Logo::find($id_logo);
        if(!$logo){
            return response('Logo NOT FOUND', $status=404);
        }

        $filePath = $logo->file_path;
        if (!File::exists($filePath)) {
            return response()->json(['message' => 'Image file not found.'], 404);
        }

        // Get the image file's MIME type.
        $mimeType = File::mimeType($filePath);

        // Read the image file content.
        $fileContent = File::get($filePath);

        return Response::make($fileContent, 200, [
            'content-type' => $mimeType,
            'content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
        ]);

    }

//update Logo By Id : 
    public function updateLogoById(Request $req, $id_logo){

        $oldLogo = Logo::find($id_logo);
        if(!$oldLogo){
            return response('Logo NOT FOUND', $status=404);
        }

        $logo_name = $req->input('logo_name');
        $logo_file = $req->file('logo');
        return response("$logo_name");
        // if(!$logo_name || !$logo_file){
        //     return response('please provide a name and a file', $status=401);
        // }

        // $logoName = time() . '_' . $logo_file->getClientOriginalName();
        // $path = 'C:\xampp\htdocs\MagicQueueDev\storage\app' . $logo_file->storeAs('uploads/logo', $logoName);

        // $oldLogo->file_name = $logo_name;
        // $oldLogo->file_path = $path;
        // $oldLogo->save();

        // return response('update done successfully', $status=200);
    }

}
