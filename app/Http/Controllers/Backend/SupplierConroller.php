<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Image; 
use Carbon\Carbon;

class SupplierConroller extends Controller
{
    public function AllSupplier(){
        $supplier = Supplier::latest()->get();
        return view('backend.supplier.all_supplier', compact('supplier'));

    } // End Method

    public function AddSupplier(){
        return view('backend.supplier.add_supplier');

    } // End Method

    public function StoreSupplier(Request $request){
        $validataData = $request->validate([
        'name' => 'required|max:200',
        'email' => 'required|unique:customers|max:200',
        'phone' => 'required|max:200',
        'address' => 'required|max:400',
        'shopname' => 'required|max:200',
        'account_holder' => 'required|max:200',
        'account_number' => 'required',
        'type' => 'required',
        'image' => 'required',
    ]);

        $save_url = null;

        if ($request->file('image')) {
         $image = $request->file('image');
          $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       Image::make($image)->resize(300, 300)->save('upload/supplier/'.$name_gen);
          $save_url = 'upload/supplier/'.$name_gen;
        }

         Supplier::insert([

        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'shopname' => $request->shopname,
        'type' => $request->type,
        'account_holder' => $request->account_holder,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'bank_branch' => $request->bank_branch,
        'city' => $request->city,
        'image' => $save_url,
        'created_at' => Carbon::now(),
        ]);

        $notification = [
           'message' => 'Supplier Inserted Successfully',
           'alert-type' => 'success'
         ]; 

        return redirect()->route('all.supplier')->with($notification);

        }// End Method


     public function EditSupplier($id){

      $supplier = Supplier::findOrfail($id);
      return view ('backend.supplier.adit_supplier',compact('supplier'));


     } //End Method

     public function UpdateSupplier(Request $request){
         $supplier_id = $request->id;

     if($request->file('image')){
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/supplier/'.$name_gen);
        $save_url = 'upload/supplier/'.$name_gen;
        
        Supplier::findOrfail($supplier_id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'shopname' => $request->shopname,
        'type' => $request->type,
        'account_holder' => $request->account_holder,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'bank_branch' => $request->bank_branch,
        'city' => $request->city,
        'image' => $save_url,
        'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Supplier Uptade Successfully',
            'alert-type' => 'success'
        ]; 

        return redirect()->route('all.supplier')->with($notification);

    } 

    else {
        Supplier::findOrfail($supplier_id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'shopname' => $request->shopname,
        'type' => $request->type,
        'account_holder' => $request->account_holder,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'bank_branch' => $request->bank_branch,
        'city' => $request->city,
        'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Supplier Uptade Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('all.supplier')->with($notification);

         } // end else

     } // End  Method


     public function DeleteSupplier($id){

      $supplier_img = Supplier::findOrfail($id);
      $img = $supplier_img->image;
      unlink($img);

      Supplier::findOrfail($id)->delete();

      $notification = [
            'message' => 'Supplier Delete Successfully',
            'alert-type' => 'success'
        ]; 

        return redirect()->back()->with($notification);


   } // End method

   public function DetailsSupplier($id){

      $supplier = Supplier::findOrfail($id);
      return view ('backend.supplier.details_supplier',compact('supplier'));


     } //End Method

}
