<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructions;
use App\Models\UsersInstructions;
use App\Models\Complaints;
use App\Models\User;
use App\Models\BannedUsers;
use Illuminate\Support\Facades\Auth;

class NewController extends Controller
{
    public function addInstr(){
        $instr = new UsersInstructions();
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

        $instr = new UsersInstructions();
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
        if(Auth::check() && Auth::user()->name == 'admin'){
            $instr = new Instructions();
            $reportedInstr = new Complaints();
            return view('index',['page'=>'Instruction page', 'instructions'=> $instr, 'reportedInstructions' => $reportedInstr]);
        } else {
            $instr = new Instructions();
            return view('index',['page'=>'Main page', 'instructions'=> $instr]);
        }
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

    public function delinstr($id){
        Instructions::where('id', '=', $id)->delete();
        return redirect()->action('App\Http\Controllers\NewController@index');
    }

    public function cancelinstr($id){
        UsersInstructions::where('id', '=', $id)->delete();
        return redirect()->action('App\Http\Controllers\NewController@usersinstr');
    }

    public function apprinstr($id){
        $userInstr = UsersInstructions::where('id', '=', $id)
            ->each(function($old){
                $new = $old->replicate();
                $new->setTable('instructions');
                $new->save();
                $old->delete();
            });
        return redirect()->action('App\Http\Controllers\NewController@usersinstr');
    }

    public function usersinstr(){
        $instr = new UsersInstructions();
        return view('usersinstr', ['page' => 'User`s Instructions', 'instructions' => $instr]);
    }

    public function adminstore(Request $request){
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
            return redirect()->action('App\Http\Controllers\NewController@index')->with('errors',$err)->withInputs();
        }return redirect()->action('App\Http\Controllers\NewController@index')->with('message', 'Инструкция с id '.$instr->id.' добавлена!');

    }

    public function users(){
        $users = new User();
        $bannedUsers = new BannedUsers();
        return view('users',['page'=>'Users page', 'users'=> $users, 'bannedUsers' => $bannedUsers]);
    }

    public function deleteuser($id){
        User::where('id', '=', $id)->delete();
        return redirect()->action('App\Http\Controllers\NewController@users');
    }

    public function ban($id){
        $users = User::where('id', '=', $id)
            ->each(function($old){
                $new = $old->replicate();
                $new->setTable('banned_users');
                $new->save();
                $old->delete();
            });
        return redirect()->action('App\Http\Controllers\NewController@users');
    }

    public function unban($id){
        $bannedUser = BannedUsers::where('id', '=', $id)
            ->each(function($old){
                $new = $old->replicate();
                $new->setTable('users');
                $new->save();
                $old->delete();
            });
        return redirect()->action('App\Http\Controllers\NewController@users');
    }
}
