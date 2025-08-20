<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Image; 
use Carbon\Carbon;


class CustomerController extends Controller
{
    public function AllCustomer(){
        $customer = Customer::latest()->get();
        return view('backend.customer.all_customer', compact('customer'));

    } // End Method

    public function AddCustomer(){
        return view('backend.customer.add_customer');

    } // End Method

    public function StoreCustomer(Request $request){
        $validataData = $request->validate([
        'name' => 'required|max:200',
        'email' => 'required|unique:customers|max:200',
        'phone' => 'required|max:200',
        'address' => 'required|max:400',
        'shopname' => 'required|max:200',
        'account_holder' => 'required|max:200',
        'account_number' => 'required|max:200',
        'image' => 'required',
    ]);

        $save_url = null;

        if ($request->file('image')) {
         $image = $request->file('image');
          $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       Image::make($image)->resize(300, 300)->save('upload/customer/'.$name_gen);
          $save_url = 'upload/customer/'.$name_gen;
        }else{
            $save_url = null;
        }

         Customer::insert([

        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'shopname' => $request->shopname,
        'account_holder' => $request->account_holder,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'bank_branch' => $request->bank_branch,
        'city' => $request->city,
        'image' => $save_url,
        'created_at' => Carbon::now(),
        ]);

        $notification = [
           'message' => 'Customer Inserted Successfully',
           'alert-type' => 'success'
         ]; 

        return redirect()->route('all.customer')->with($notification);

        }// End Method

        public function EditCustomer($id){

      $customer = Customer::findOrfail($id);
      return view ('backend.customer.adit_customer',compact('customer'));


     } //End Method

     public function UpdateCustomer(Request $request){
         $customer_id = $request->id;

     if($request->file('image')){
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/customer/'.$name_gen);
        $save_url = 'upload/customer/'.$name_gen;
        
        Customer::findOrfail($customer_id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'shopname' => $request->shopname,
        'account_holder' => $request->account_holder,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'bank_branch' => $request->bank_branch,
        'city' => $request->city,
        'image' => $save_url,
        'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Customer Uptade Successfully',
            'alert-type' => 'success'
        ]; 

        return redirect()->route('all.customer')->with($notification);

    } 

    else {
        Customer::findOrfail($customer_id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'shopname' => $request->shopname,
        'account_holder' => $request->account_holder,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'bank_branch' => $request->bank_branch,
        'city' => $request->city,
        'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Customer Uptade Successfully',
            'alert-type' => 'success'
        ]; 

        return redirect()->route('all.customer')->with($notification);

         } // end else

     } // End  Method

     public function DeleteCustomer($id){

      $customer_img = Customer::findOrfail($id);
      $img = $customer_img->image;
      unlink($img);

      Customer::findOrfail($id)->delete();

      $notification = [
            'message' => 'Customer Delete Successfully',
            'alert-type' => 'success'
        ]; 

        return redirect()->back()->with($notification);


   } // End method
}
