<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Rules\FilterRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

   protected $rules = [
      'name' => [
         'required',
         'string',
         'between:2,255',
         'filter'
        
         ],
     'parent_id' => 'nullable|int|exists:categories,id',
     'description'=> ['nullable' , 'string' , ],
     'art_path' => ['nullable' , 'image'],

];
 protected $message = [
'name.required' => 'The :attribute is mandatory'
];
    //Actions

    public function index($id =0){
       
      // $entries =  DB::table('categories')->get();
    //  $categories =  DB::table('categories')->get();

    $categories = Category::get();
    
      // $title = 'Categories';
      //return $entries;
      return view('categories.index')->with([
         'categories'  => $categories,
         'title'=> 'Categories',
         'flashMessage' => session('success')


     ]) ;

      // instead of send array , another way 
         //  dd(compact('categories' , 'title'))    ;  
     // return view('categories.index' , compact('categories' , 'title'));

      //echo  $entries->count();
       //dd($entries);

    }

    public function show($id){

       //return $id;

        
    //  $category =  DB::table('categories')->where('id', '=' , $id)->first();
         //  = 
     // $category = Category:: where('id' , '=' , $id)->first();
           // =

           $category = Category::findOrFail($id);

          //fondOrFail
      // if($category == null){
      //    abort(404);
      // }   

     // dd($category);
     return view('categories.show' , [
        'category' => $category
     ]);
    }

public function create(){
   $parents = Category::all();
   $category = new Category;
   return view('categories.create' , compact('category','parents'));
} 


public function store(Request $request){
    // dd($request);
   //  DB::table('categories')->insert([]);
//   $clean =   $request->validate([
//        'name'=> 'required|string|max:255|min:2',
//        'parent_id' => 'nullable|int|exists:categories,id',
//        'description'=> ['nullable' , 'string' , ],
//        'art_file' => ['nullable' , 'image']
//     ]);


// validation another way 

$validator  = Validator::make($request->all(), $this->rules() , $this->message);
if($validator->fails()){
   return redirect()->back()->withErrors($validator);
}

   $category = new Category();
   $category->name = $request->input('name');
   $category->description = $request->input('description');
   $category->parent_id = $request->input('parent_id');
   $category->slug = Str::slug($category->name);
   $category->save();

     return redirect('/categories')->with('success' , 'Category Created!');
}

public function edit($id){

   $category = Category::findOrFail($id);
   $parents = Category::all();
 return view('categories.edit' , compact('category' , 'parents'));
}
 public function update(  Request $request ,$id){
    
         $category = Category::findOrFail($id);
         $validator  = Validator::make($request->all(), $this->rules() , $this->message);
         if($validator->fails()){
            return redirect()->back()->withErrors($validator);
         }
        
         $category->name = $request->input('name');
         $category->description = $request->input('description');
         $category->parent_id = $request->input('parent_id');
         $category->slug = Str::slug($category->name);
         $category->save();
         return redirect('/categories')->with('warning' , 'Category Updated!');
 } 

 public function destroy($id){
   $category = Category::findOrFail($id);
   $category->delete();
   return redirect('/categories')->with('success' , 'Category Deleted!');

 }

         protected function rules(){

            $rules = $this->rules;
   //          $rules['name'][]=  function($attribute , $value , $fail){
   //             if($value =='god'){
   //                $fail('This word is not allowed');
   //             }
   //   };
    // from filter rule  class ,another way 
        //$rules['name'][] =new  FilterRule();
       // $rules['name'][] = 'filter';
            return $rules;
         }
}
