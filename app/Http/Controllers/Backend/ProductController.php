<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Image; 
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;

use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;

class ProductController extends Controller
{
    public function AllProduct(){

        $product = Product::latest()->get();
        return view('backend.product.all_product', compact('product'));

    } // End Method

    public function AddProduct(){

        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('backend.product.add_product',compact('category','supplier'));

    } // End Method

    public function StoreProduct(Request $request){

    // Generate unique product code
         $pcode = IdGenerator::generate([
        'table' => 'products',
        'field' => 'product_code',
        'length' => 6,   // Adjust length as needed
        'prefix' => 'PC'
        ]);

    // Handle product image upload if present
        if ($request->file('product_image')) {
         $image = $request->file('product_image');
         $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
         Image::make($image)->resize(300, 300)->save('upload/product/' . $name_gen);
         $save_url = 'upload/product/' . $name_gen;

    } else {
        $save_url = null;
    }

    // Insert product data into DB
    Product::insert([

        'product_name'   => $request->product_name,
        'category_id'    => $request->category_id,
        'supplier_id'    => $request->supplier_id,
        'product_code'   => $pcode,  // Correctly assign generated code here
        'product_garage' => $request->product_garage,
        'product_store'  => $request->product_store,
        'buying_date'    => $request->buying_date,
        'expire_date'    => $request->expire_date,
        'buying_price'   => $request->buying_price,
        'selling_price'  => $request->selling_price,
        'product_image'  => $save_url,
        'created_at'     => Carbon::now(),
        
    ]);

    // Notification message
    $notification = [
        'message'    => 'Product Inserted Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('all.product')->with($notification);
}

        public function EditProduct($id){

      $product = Product::findOrfail($id);
      $category = Category::latest()->get();
      $supplier = Supplier::latest()->get();
      return view ('backend.product.adit_product',compact('product','category','supplier'));


     } //End Method

     public function UpdateProduct(Request $request){

    $product_id = $request->id;

    if ($request->file('product_image')) {
        // Handle new image upload
        $image = $request->file('product_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/product/' . $name_gen);
        $save_url = 'upload/product/' . $name_gen;

        Product::findOrFail($product_id)->update([

            'product_name'   => $request->product_name,
            'category_id'    => $request->category_id,
            'supplier_id'    => $request->supplier_id,
            'product_code'   => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_store'  => $request->product_store,
            'buying_date'    => $request->buying_date,
            'expire_date'    => $request->expire_date,
            'buying_price'   => $request->buying_price,
            'selling_price'  => $request->selling_price,
            'product_image'  => $save_url,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
        'message'    => 'Product Updated Successfully',
        'alert-type' => 'success'
    );

        return redirect()->route('all.product')->with($notification);

    } else {
        // Update without changing the image
        Product::findOrFail($product_id)->update([
            'product_name'   => $request->product_name,
            'category_id'    => $request->category_id,
            'supplier_id'    => $request->supplier_id,
            'product_code'   => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_store'  => $request->product_store,
            'buying_date'    => $request->buying_date,
            'expire_date'    => $request->expire_date,
            'buying_price'   => $request->buying_price,
            'selling_price'  => $request->selling_price,
            'updated_at' => Carbon::now(),
        ]);
    }

    $notification = array(
        'message'    => 'Product Updated Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('all.product')->with($notification);

    } // End  Method
     

     public function DeleteProduct($id){

         $product = Product::findOrFail($id);
         $img = $product->product_image;

         if ($img && file_exists($img)) {
        unlink($img);
          }

         $product->delete();

        $notification = [
        'message'    => 'Product Deleted Successfully',
        'alert-type' => 'success'
         ];

         return redirect()->back()->with($notification);

        } // End  Method

        public function BarcodeProduct($id){

            $product = Product::findOrFail($id);
            return view ('backend.product.barcode_product',compact('product'));

        } // End  Method

        public function ImportProduct(){

            return view('backend.product.import_product');

        } // End  Method

        public function Export(){

            return Excel::download(new ProductExport,'products.xlsx');

        } // End  Method

        public function import(Request $request)
{
    $request->validate([
        'import_file' => 'required|mimes:xlsx,xls,csv'
    ]);

    $file = $request->file('import_file');

    // சரியான நீட்டிப்புடன் தற்காலிக பெயர் அமைக்கவும்
    $filePath = $file->getRealPath();
    $extension = $file->getClientOriginalExtension(); // xlsx, xls, csv

    \Excel::import(new ProductImport, $filePath, $extension);

    $notification = [
        'message'    => 'Product Imported Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->back()->with($notification);
}



}
