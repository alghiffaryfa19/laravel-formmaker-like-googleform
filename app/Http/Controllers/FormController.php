<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use App\Category;
use Validator;
use File;

class FormController extends Controller
{
    public function index()
     {
        $category = Category::select('id', 'nama_kategori')->get();
         if(request()->ajax())
         {
             return datatables()->of(Form::all())
                     ->addColumn('action', function($data){
                         $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                         $button .= '&nbsp;&nbsp;';
                         $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                         return $button;
                     })
                     ->rawColumns(['action'])
                     ->make(true);
         }
         return view('form.index', compact('category'));
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         //
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         $rules = array(
            'name' => 'required',
            'typedata' => 'required'
         );
 
         $error = Validator::make($request->all(), $rules);
 
         if($error->fails())
         {
             return response()->json(['errors' => $error->errors()->all()]);
         }
     
 
         $form_data = array(
            'name' => $request->name,
            'typedata' => $request->typedata,
             'categories_id' => $request->categories_id
         );

         
 
         Form::create($form_data);
 
         return response()->json(['success' => 'Data Added successfully.']);
     }
 
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         if(request()->ajax())
         {
            $category = Category::select('id', 'nama_kategori')->get();
             $data = Form::findOrFail($id);
             return response()->json(['data' => $data]);
         }
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request)
     {
        $data = Form::find($request->hidden_id);
        $rules = array(
            'name' => 'required',
            'typedata' => 'required'
        );

        $error = Validator::make($request->all(), $rules);
 
         if($error->fails())
         {
             return response()->json(['errors' => $error->errors()->all()]);
         }

        $form_data = array(
            'name' => $request->name,
            'typedata' => $request->typedata,
             'categories_id' => $request->categories_id
        );
        Form::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $data = Form::findOrFail($id);
         $data->delete();

         
     }

     
 }
