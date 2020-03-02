<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Validator;
use File;

class CategoryController extends Controller
{
    
     public function index()
     {
         if(request()->ajax())
         {
             return datatables()->of(Category::latest()->get())
                     ->addColumn('action', function($data){
                         $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                         $button .= '&nbsp;&nbsp;';
                         $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                         return $button;
                     })
                     ->rawColumns(['action'])
                     ->make(true);
         }
         return view('category.index');
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
             'nama_kategori'    =>  'required',
             'slug'     =>  'required',
             'gambarkategori'         =>  'required|image|max:2048'
         );
 
         $error = Validator::make($request->all(), $rules);
 
         if($error->fails())
         {
             return response()->json(['errors' => $error->errors()->all()]);
         }
 
         $image = $request->file('gambarkategori');
 
         $new_name = rand() . '.' . $image->getClientOriginalExtension();
 
         $image->move(public_path('uploads/category'), $new_name);
 
         $form_data = array(
             'nama_kategori'        =>  $request->nama_kategori,
             'slug'         =>  $request->slug,
             'gambarkategori'             =>  $new_name
         );
 
         Category::create($form_data);
 
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
             $data = Category::findOrFail($id);
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
        $data = Category::find($request->hidden_id);
         $image_name = $request->hidden_image;
         $image = $request->file('gambarkategori');
         if($image != '')
         {
             $rules = array(
                'nama_kategori'    =>  'required',
                'slug'     =>  'required',
                'gambarkategori'         =>  'required|image|max:2048'
             );
             $error = Validator::make($request->all(), $rules);
             if($error->fails())
             {
                 return response()->json(['errors' => $error->errors()->all()]);
             }
 
             $image_name = $data->gambarkategori;
             $image->move(public_path('uploads/category'), $image_name);
         }
         else
         {
             $rules = array(
                'nama_kategori'    =>  'required',
                'slug'     =>  'required'
             );
 
             $error = Validator::make($request->all(), $rules);
 
             if($error->fails())
             {
                 return response()->json(['errors' => $error->errors()->all()]);
             }
         }
 
         $form_data = array(
            'nama_kategori'        =>  $request->nama_kategori,
            'slug'         =>  $request->slug,
            'gambarkategori'             =>  $image_name
         );
         Category::whereId($request->hidden_id)->update($form_data);
 
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
         $data = Category::findOrFail($id);
         File::delete(public_path('uploads/category/'.$data->gambarkategori));
         $data->delete();
     }
 }