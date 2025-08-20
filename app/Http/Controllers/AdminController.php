<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;// chat gpt
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
   public function AdminDestroy(Request $request): RedirectResponse{
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
        'message' => 'Admin Logout Succcesfully',
        'alert-type' =>'info'

        );

        return redirect('/logout')->with($notification);

    } //End Method

    public function AdminLogoutPage(){

        return view('admin.admin_logout');

    } //End Method

    public function AdminProfile(){

        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view ('admin.admin_profile_view',compact('adminData'));

    } //End Method

    public function AdminProfileStore(Request $request){
    $id = Auth::user()->id;
    $data = User::find($id); 
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;

    if ($request->file('photo')) {
        $file = $request->file('photo');
        @unlink(public_path('upload/admin_image/'.$data->photo));
        $filename = date('YmHi') . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload/admin_image'), $filename);
        $data->photo = $filename; 
    }
    
    $data->save(); 

    $notification = array(
        'message' => 'Admin Profile Update Succcesfully',
        'alert-type' =>'success'

    );
    return redirect()->back()->with($notification);

    } //End Method

    public function ChangePassword(){

        return view('admin.change_password');


    } //End Method

    public function UpdatePassword(Request $request){
    // Validation
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|confirmed',
    ]);

    // Match Old Password
    if (!Hash::check($request->old_password, Auth::user()->password)) {
        $notification = [
            'message' => 'Old Password Does not Match!!',
            'alert-type' => 'error'
        ];
        return back()->with($notification);
    }

    // Update The New Password
    User::whereId(Auth::user()->id)->update([
        'password' => Hash::make($request->new_password)
    ]);

    $notification = [
        'message' => 'Password Changed Successfully',
        'alert-type' => 'success'
    ];
    return back()->with($notification);

    }//End Method


    /////////// Admin User All Merhod //////////////////

    public function AllAdmin(){

        $alladminuser = User::latest()->get();
        return view('backend.admin.all_admin',compact('alladminuser'));

    } //End Method

    public function AddAdmin(){

        $roles = Role::all();
        return view('backend.admin.add_admin',compact('roles'));

    } //End Method

    public function StoreAdmin(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->roles) {
         $role = Role::find($request->roles);
        if ($role) {
        $user->assignRole($role);
          }
        }

        $notification = array(
        'message' => ' New Admin User Created Succcesfully',
        'alert-type' =>'success'

        );

        return redirect()->route('all.admin')->with($notification);

    } //End Method

    public function EditAdmin($id){

        $roles = Role::all();
        $adminuser = User::findOrfail($id);
        return view('backend.admin.edit_admin',compact('roles','adminuser'));

    } //End Method

    public function UpdateAdmin(Request $request){

        $admin_id = $request->id;

        $user = User::findOrfail($admin_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
         $role = Role::find($request->roles);
        if ($role) {
        $user->assignRole($role);
          }
        }

        $notification = array(
        'message' => 'Admin User Update Succcesfully',
        'alert-type' =>'success'

        );

        return redirect()->route('all.admin')->with($notification);

    } //End Method

    public function DeleteAdmin($id){

        $user = User::findOrfail($id);
        if(!is_null($user)){
            $user->delete();
        }

        $notification = array(
        'message' => 'Admin User Delete Succcesfully',
        'alert-type' =>'success'

        );

        return redirect()->back()->with($notification);

    } //End Method


    //////////////// DatabaceBackup //////////////////


    public function DatabaseBackup(){

    $backupPath = storage_path('app/A2imultibel');
    
    // Check if directory exists first
    if (!File::exists($backupPath)) {
        File::makeDirectory($backupPath, 0755, true, true);
    }
    
    $files = File::allFiles($backupPath);
    
    return view('admin.db_backup', compact('files'));

    } //End Method

    public function BackupNow(){

        \Artisan::call('backup:run');

        $notification = array(
        'message' => 'Database Backup Succcesfully',
        'alert-type' =>'success'

        );

        return redirect()->back()->with($notification);

    }

    public function DownloadDatabase($getFilename){

        $path = storage_path('app\A2imultibel/'.$getFilename);
        return response()->download($path);
    }

    public function DeleteDatabase($getFilename){

        Storage::delete('A2imultibel/'.$getFilename);

        $notification = array(
        'message' => 'Database Delete Succcesfully',
        'alert-type' =>'success'

        );

        return redirect()->back()->with($notification);

    }


}
