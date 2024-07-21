<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructions;
use App\Models\Complaints;
use Illuminate\Support\Facades\Storage;

class NewController extends Controller
{
    public function addInstr(){
        $instr = new Instructions();
        return view('addinstr',['page' => 'Add Instructions', 'instructions' => $instr] );
    }
    
    public function downloadInstr($id){
        $instructions = Instructions::where('id', '=', $id)->get();
        foreach ($instructions->all() as $instr){
            $path = public_path().$instr->imagepath;
        }
        return response()->download($path, basename($path));
    }
    
    public function showInstr($id){
        $instructions = Instructions::where('id', '=', $id)->get();
        foreach ($instructions->all() as $instr){
            $path = public_path().$instr->imagepath;
        }
        return response()->file($path);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'header'=>'max:150',
            'image' => 'pdf'
        ]);

        $instr = new Instructions();
        $instr->summary = $request->header;
        if($request->hasFile('pdf')){
            $originalname = $request->file('pdf')->getClientOriginalName();
            $request->file('pdf')->move(public_path().'/instructions', $originalname);
            $instr->imagepath = '/instructions/'.$originalname;
        }else{
            $instr->imagepath = '';
        }


        if(!$instr->save()){
            $err = $instr->getErrors();
            return redirect()->action('App\Http\Controllers\NewController@addInstr')->with('errors',$err)->withInputs();
        }return redirect()->action('App\Http\Controllers\NewController@addInstr')->with('message', 'Инструкция с id '.$instr->id.' отправлена на модерацию!');

    }
    
    public function index(){
        $instr = new Instructions();
        return view('index',['page'=>'Main page', 'instructions'=> $instr]);
    }

    public function indexSearch(Request $request){
        $name = $request->search;
        $instr = Instructions::where('summary', '=', $name)->get();
        return view('index',['page'=>'Main page', 'instructions'=> $instr]);
    }

    public function report($id){
        $instr = Instructions::where('id', '=', $id)->get();
        return view('report', ['page'=>'Main page', 'instructions' => $instr]);
    }

    public function sendReport(Request $request){
        $compl = new Complaints();
        $compl->summary = $request->instrName;
        $compl->description = $request->report;

        if(!$compl->save()){
            $err = $compl->getErrors();
            return redirect()->action('App\Http\Controllers\NewController@index')->with('errors',$err)->withInputs();
        }return redirect()->action('App\Http\Controllers\NewController@index')->with('message', 'Жалоба на инструкцию с id '.$compl->id.' отправлена!');
    }
}
