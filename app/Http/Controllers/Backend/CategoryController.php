<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;


class CategoryController extends Controller
{
    public function AllCategory(){

        $category = Category::latest()->get();
        return view ('backend.category.all_category',compact('category'));

    } // End Method

    public function StoreCategory(Request $request){

        Category::insert([
            'category_name' =>$request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('all.category')->with($notification);

    } // End Method


    public function EditCategory($id){

     $category = Category::findOrfail($id);
      return view ('backend.category.adit_category',compact('category'));


    } // End Method

    public function UpdateCategory(Request $request){

        $category_id = $request->id;

        Category::findOrfail($category_id)->update([
            'category_name' =>$request->category_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Update Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('all.category')->with($notification);

    } // End Method

    public function DeleteCategory($id){

        Category::findOrfail($id)->delete();
        
        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->back()->with($notification);

    } // End Method



}
