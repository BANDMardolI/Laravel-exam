<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewController extends Controller
{
    public function addNew(){
        $news = new News();
        return view('addnew',['page' => 'Add New', 'news' => $news] );
    }
    public function store(Request $request){
        $validate = $request->validate([
            'header'=>'max:150',
            'image' => 'pdf'
        ]);

        $new = new News();
        $new->summary = $request->header;
        if($request->hasFile('pdf')){
            $originalname = $request->file('pdf')->getClientOriginalName();
            $request->file('pdf')->move(public_path().'/instructions', $originalname);
            $new->imagepath = '/instructions/'.$originalname;
        }else{
            $new->imagepath = '';
        }


        if(!$new->save()){
            $err = $new->getErrors();
            return redirect()->action('App\Http\Controllers\NewController@addNew')->with('errors',$err)->withInputs();
        }return redirect()->action('App\Http\Controllers\NewController@addNew')->with('message', 'Инструкция с id '.$new->id.' отправлена на модерацию!');

    }
    public function index(){
        $news = new News();

        return view('index',['page'=>'Main page', 'news'=> $news]);
    }

    public function newView($id){

        $newView = News::where('id', '=', $id)->get();
        foreach ($newView->all() as $view){
            $title = $view->summary;
        }

        return view('view', ['page' => $title, 'view' => $newView]);

    }
}
