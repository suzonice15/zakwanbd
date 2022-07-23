<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use  Session;
use Image;
use Illuminate\Support\Facades\Redirect;
use AdminHelper;
use URL;

class AdminNoteController extends Controller
{
    public function index()
    {
        $data['notes'] = DB::table('admin_note')->orderBy('id', 'desc')->get();
        return view('admin.note.index', $data);
    }
    
    public function note_save(Request $request)
    {
        $data['note'] = $request->note;
        $data['created_at'] = date('Y-m-d');
        $result = DB::table('admin_note')->insert($data);
        if ($result) {
            return "ok";
        } else {
            return "no";
        }
    } 
    public function noteUpdated(Request $request)
    {   
        $data['note'] =$request->data;
        $result = DB::table('admin_note')->where('id',$request->id)->update($data);
        if ($result) {
            return "ok";
        } else {
            return "no";
        }
    } 

    


    public function noteDelete($id)
    {
        if(session::get('status') !='super-admin'){
           exit();
        }
        $result = DB::table('admin_note')->where('id', $id)->delete();
        if ($result) {
            return "ok";
        } else {
            return "no";
        }
    }
    public function noteDone($id)
    {
        $data['status']=0;
        $result = DB::table('admin_note')->where('id', $id)->update($data);
        if ($result) {
            return "ok";
        } else {
            return "no";
        }
    }

}
