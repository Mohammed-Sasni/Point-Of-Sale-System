<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function EmployeeAttendenceList(){

        $allData = Attendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
        return view('backend.attendance.view_employee_attend',compact('allData'));

    } // End Method

    public function AddEmployeeAttend(){

        $employees = Employee::all();
        return view('backend.attendance.add_employee_attend',compact('employees'));

    } // End Method

    public function EmployeeAttendStore(Request $request){

 Attendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();

        $countemployee = count($request->employee_id);

        for ($i=0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status'.$i;
            $attend = new Attendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }

        $notification = array(
            'message' => 'Data Inserted Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('employee.attend.list')->with($notification);

    } // End Method

    public function EditEmployeeAttend($date){

        $employees = Employee::all();
        $editData = Attendance::where('date',$date)->get();
        return view('backend.attendance.edit_employee_attend',compact('employees','editData'));
    } // End Method

    public function ViewEmployeeAttend($date){

         $details = Attendance::where('date', $date)->get();
         return view('backend.attendance.details_employee_attend', compact('details'));

    } // End Method



}