<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierConroller;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\CategoryController; 
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\Poscontroller;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\RoleController;




Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
Route::get('/logout', [AdminController::class, 'AdminLogoutPage'])->name('admin.logout.page');

Route::middleware(['auth'])->group(function(){

Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');

Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');

// Employee  All Route
Route::group(['controller' => EmployeeController::class], function(){
    Route::get('/all/employee', 'AllEmployee')->name('all.employee');
    Route::get('/add/employee', 'AddEmployee')->name('add.employee');
    Route::post('/store/employee', 'StoreEmployee')->name('employee.store');
    Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit.employee');
    Route::post('/update/employee', 'UpdateEmployee')->name('employee.update');
    Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee');   
});

// Customer  All Route
Route::group(['controller' => CustomerController::class], function(){
    Route::get('/all/customer', 'AllCustomer')->name('all.customer');
    Route::get('/add/customer', 'AddCustomer')->name('add.customer');
    Route::post('/store/customer', 'StoreCustomer')->name('customer.store');
    Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer');
    Route::post('/update/customer', 'UpdateCustomer')->name('customer.uptade');
    Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete.customer'
);
});
// Sapplier All Route
Route::group(['controller' => SupplierConroller::class], function(){
    Route::get('/all/supplier', 'AllSupplier')->name('all.supplier');
    Route::get('/add/supplier', 'AddSupplier')->name('add.supplier');
    Route::post('/store/supplier', 'StoreSupplier')->name('supplier.store');
    Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit.supplier');
    Route::post('/update/supplier', 'UpdateSupplier')->name('supplier.uptade');
    Route::get('/delete/supplier/{id}', 'DeleteSupplier')->name('delete.supplier');
    Route::get('/details/supplier/{id}', 'DetailsSupplier')->name('details.supplier');
});


// Advance Salary  All Route
Route::group(['controller' => SalaryController::class], function(){
    Route::get('/add/advance/salary', 'AddAdvanceSalary')->name('add.advance.salary');
    Route::post('/advance/salary/store', 'AdvanceSalaryStore')->name('advance.salary.store');
    Route::get('/all/advance/salary', 'AllAdvanceSalary')->name('all.advance.salary');
Route::get('/edit/advance/salary/{id}', 'EditAdvanceSalary')->name('edit.advance.salary');

Route::post('/advance/salary/update', 'AdvanceSalaryUpdate')->name('advance.salary.update');
   Route::get('/delete/advance/salary/{id}', 'DeleteAdvanceSalary')->name('delete.advance.salary');
});

// Pay Salary  All Route
Route::group(['controller' => SalaryController::class], function(){
    Route::get('/pay/salary', 'PaySalary')->name('pay.salary');
    Route::get('/pay/now/salary/{id}', 'PayNowSalary')->name('pay.now.salary');
    Route::post('/employee/salary/store', 'EmployeeSalaryStore')->name('employee.salary.store');
    Route::get('/month/salary', 'MonthSalary')->name('month.salary');
    //Route::get('/month/history/salary/{id}', 'MonthHistorySalary')->name('month.history.salary');
});

//  All EmployeeAttendence Route
Route::group(['controller' => AttendanceController::class], function(){
    Route::get('/employee/attend/list', 'EmployeeAttendenceList')->name('employee.attend.list');
    Route::get('/add/employee/attend', 'AddEmployeeAttend')->name('add.employee.attend');
    Route::post('/employee/attend/store', 'EmployeeAttendStore')->name('employee.attend.store');
    Route::get('/edit/employee/attend/{date}', 'EditEmployeeAttend')->name('employee.attend.edit');
    Route::get('/view/employee/attend/{date}', 'ViewEmployeeAttend')->name('employee.attend.view');   
});

//  All Category Route
Route::group(['controller' => CategoryController::class], function(){
    Route::get('/all/category', 'AllCategory')->name('all.category');
    Route::post('/store/category', 'StoreCategory')->name('category.store');
    Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
    Route::post('/update/category/{id}', 'UpdateCategory')->name('category.update');
    Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
});

//  All Product Route
Route::group(['controller' => ProductController::class], function(){
    Route::get('/all/product', 'AllProduct')->name('all.product');
    //Route::post('/store/category', 'StoreCategory')->name('product.store');
    Route::get('/add/product', 'AddProduct')->name('add.product');
    Route::post('/store/product', 'StoreProduct')->name('product.store');
    Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
    Route::post('/update/product/{id}', 'UpdateProduct')->name('product.update');
    Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
    Route::get('/barcode/product/{id}', 'BarcodeProduct')->name('barcode.product');
    Route::get('/import/product', 'ImportProduct')->name('import.product');
    Route::get('/export', 'Export')->name('export');
    Route::get('/import', 'Import')->name('import');
});

 //  All ExpenseController Route
Route::group(['controller' => ExpenseController::class], function(){
    Route::get('/add/expense', 'AddExpense')->name('add.expense');
    Route::post('/store/expense', 'StoreExpense')->name('expense.store');
    Route::get('/today/expense', 'TodayExpense')->name('today.expense');
    Route::get('/edit/expense/{id}', 'EditExpense')->name('edit.expense');
    Route::post('/update/expense', 'UpdateExpense')->name('expense.update');
    Route::get('/month/expense', 'MonthExpense')->name('month.expense');
    Route::get('/year/expense', 'YearExpense')->name('year.expense');
});

 //  All Pos Controller Route
Route::group(['controller' => Poscontroller::class], function(){
    Route::get('/pos', 'Pos')->name('pos');
    Route::post('/add-cart', 'AddCart');
    Route::get('/allitem', 'AllItem');
    Route::post('/cart-update/{rowId}', 'CartUpdate');
    Route::GET('/cart-remove/{rowId}', 'CartRemove');
    Route::post('/create-invoice', 'CreateInvoice');
});


 //  All Order Controller Route
Route::group(['controller' => OrderController::class], function(){
    Route::post('/final-invoice', 'FinalInvoice');
    Route::get('/pending/order', 'PendingOrder')->name('pending.order');
    Route::get('/order/details/{order_id}', 'OrderDetails')->name('order.details');
    Route::post('/order/status/update', 'OrderStatusUpdate')->name('order.status.update');
    Route::get('/complete/order', 'CompleteOrder')->name('complete.order');
    Route::get('/stock/mange', 'StockMange')->name('stock.mange');
    Route::get('/order/invoice-download/{order_id}', 'OrderInvoice');

    ////// Due All Route

    Route::get('/pending/due', 'PendingDue')->name('pending.due');
    Route::get('/order/due/{id}', 'OrderDueAjax');
    Route::post('/update/due', 'UpdateDue')->name('update.due');

    
});

 //  All Permission Controller Route
Route::group(['controller' => RoleController::class], function(){

    Route::get('/all/permission', 'AllPermission')->name('all.permission');
    Route::get('/add/permission', 'AddPermission')->name('add.permission');
    Route::post('/store/permission', 'PermissionStore')->name('pormission.store');
    Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
    Route::post('/update/permission', 'UpdatePermission')->name('pormission.update');
    Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
});

//  All Role Controller Route
Route::group(['controller' => RoleController::class], function(){

    Route::get('/all/roles', 'AllRoles')->name('all.roles');
    Route::get('/add/roles', 'AddRoles')->name('add.roles');
    Route::post('/store/roles', 'RolesStore')->name('roles.store');
    Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
    Route::post('/update/roles', 'UpdateRoles')->name('roles.update');
    Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');
});

//  All Add Roles in Permission Controller Route
Route::group(['controller' => RoleController::class], function(){

    Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
    Route::post('/all/permission/store', 'StoreRolesPermission')->name('role.pormission.store');
    Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
    Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');

    Route::post('/role/permission/update/{id}', 'RolePermissionUpdate')->name('role.permission.update');

    Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');

});

//  All Admiin User Controller Route
Route::group(['controller' => AdminController::class], function(){

    Route::get('/all/admin', 'AllAdmin')->name('all.admin');
    Route::get('/add/admin', 'AddAdmin')->name('add.admin');
    Route::post('/store/admin', 'StoreAdmin')->name('admin.store');
    Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
    Route::post('/update/admin', 'UpdateAdmin')->name('admin.update');
    Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
   
});

//  All DataBace Backup Controller Route
Route::group(['controller' => AdminController::class], function(){

    Route::get('/database/backup', 'DatabaseBackup')->name('database.backup');
    Route::get('/backup/now', 'BackupNow')->name('backup.now');
    Route::get('{getFilename}', 'DownloadDatabase');
    Route::get('/delete/database/{getFilename}', 'DeleteDatabase')->name('delete.database');



});






}); // End User Middleware


