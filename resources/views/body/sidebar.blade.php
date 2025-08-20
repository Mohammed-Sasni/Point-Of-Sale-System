<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        
        <!-- Sidebar Menu -->
        <div id="sidebar-menu">
            <ul id="side-menu">

                <!-- Navigation -->
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ url('/dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboards </span>
                    </a>
                </li>

                @if(Auth::user()->can('pos.menu'))

                <li>
                    <a href="{{ route('pos') }}">
                        <span class="badge bg-pink float-end">Hot</span>
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> POS </span>
                    </a>
                </li>

                @endif

                <!-- Apps -->
                <li class="menu-title mt-2">Apps</li>

                 @if(Auth::user()->can('employee.menu'))

                <!-- Employee Manage -->
                <li>
                    <a href="#sidebarEmployee" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Employee Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmployee">
                        <ul class="nav-second-level">

                            @if(Auth::user()->can('employee.all'))

                            <li><a href="{{ route('all.employee') }}">All Employee</a></li>

                             @endif

                             @if(Auth::user()->can('employee.add'))
                            <li><a href="{{ route('add.employee') }}">Add Employee</a></li>

                              @endif
                        </ul>
                    </div>
                </li>

                @endif

                @if(Auth::user()->can('customer.menu'))

                <!-- Customer Manage -->
                <li>
                    <a href="#sidebarCustomer" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Customer Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCustomer">
                        <ul class="nav-second-level">
                             @if(Auth::user()->can('customer.all'))

                            <li><a href="{{ route('all.customer') }}">All Customer</a></li>

                            @endif

                             @if(Auth::user()->can('customer.add'))
                            <li><a href="{{ route('add.customer') }}">Add Customer</a></li>
                            @endif
                        </ul>
                    </div>
                </li>

                @endif

                @if(Auth::user()->can('supplier.menu'))

                <!-- Supplier Manage -->
                <li>
                    <a href="#sidebarSupplier" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Supplier Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSupplier">
                        <ul class="nav-second-level">
                            @if(Auth::user()->can('supplier.all'))
                            <li><a href="{{ route('all.supplier') }}">All Supplier</a></li>
                            @endif
                            @if(Auth::user()->can('supplier.add'))
                            <li><a href="{{ route('add.supplier') }}">Add Supplier</a></li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('employee.menu'))
                <!-- Employee Salary -->
                <li>
                    <a href="#sidebarSalary" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash"></i>
                        <span> Employee Salary </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSalary">
                        <ul class="nav-second-level">
                           
                            <li><a href="{{ route('add.advance.salary') }}">Add Advance Salary</a></li>
                            
                            <li><a href="{{ route('all.advance.salary') }}">All Advance Salary</a></li>
                          
                            <li><a href="{{ route('pay.salary') }}">Pay Salary</a></li>
                           
                            <li><a href="{{ route('month.salary') }}">Last Month Salary</a></li> 
                            
                        </ul>
                    </div>
                </li>
                 @endif

                  @if(Auth::user()->can('Attendance.menu'))

                <!-- Employee Attendance -->
                <li>
                    <a href="#attendence" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash"></i>
                        <span> Employee Attendance </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="attendence">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('employee.attend.list') }}">Employee Attendance</a></li>
                             
                        </ul>
                    </div>
                </li>

                 @endif

                <li>
                    <a href="#category" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash"></i>
                        <span> Category </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('all.category') }}">All Category</a></li>
                             
                        </ul>
                    </div>
                </li> 

                <li>
                    <a href="#product" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash"></i>
                        <span> Products </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('all.product') }}">All Product</a></li>
                             
                             <li><a href="{{ route('add.product') }}">Add Product</a></li>

                             <li><a href="{{ route('import.product') }}">Import Product</a></li>
                        </ul>
                    </div>
                </li>


                 <li>
                    <a href="#orders" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash"></i>
                        <span> Orders </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="orders">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('pending.order') }}">Pending Orders</a></li>
                             
                             <li><a href="{{ route('complete.order') }}">Complete Orders</a></li>

                             <li><a href="{{ route('pending.due') }}">Pending Due</a></li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#stock" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash"></i>
                        <span> Stock Mange </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="stock">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('stock.mange') }}">Stock </a></li>
                             
                             

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#permission" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash"></i>
                        <span> Roles And Permission </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="permission">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('all.permission') }}">All Permission </a></li>
                             
                            <li><a href="{{ route('all.roles') }}">All Roles </a></li>
                            
                            <li><a href="{{ route('add.roles.permission') }}">Roles In Permission </a></li> 

                            <li><a href="{{ route('all.roles.permission') }}">All Roles In Permission </a></li> 

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#admin" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash"></i>
                        <span>Setting Admin User</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="admin">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('all.admin') }}">All Admin</a></li>
                             
                            <li><a href="{{ route('all.admin') }}">Add Admin </a></li>       

                        </ul>
                    </div>
                </li>

                <!-- Custom -->
                <li class="menu-title mt-2">Custom</li>

                <!-- Auth Pages -->
                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Expence </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('add.expense') }}">Add Expence</a></li>
                            <li><a href="{{ route('today.expense') }}">Today Expence</a></li>
                            <li><a href="{{ route('month.expense') }}">Monthly Expence</a></li>
                            <li><a href="{{ route('year.expense') }}">Yearly Expence</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#backup" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Databace Backup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="backup">
                        <ul class="nav-second-level">
                            <li><a href="{{ route('database.backup') }}">Databace Backup</a></li>
                            
                        </ul>
                    </div>
                </li>

                <!-- Extra Pages -->
                <li>
                    <a href="#sidebarExtra" data-bs-toggle="collapse">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> Extra Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExtra">
                        <ul class="nav-second-level">
                            <li><a href="pages-starter.html">Starter</a></li>
                            <li><a href="pages-timeline.html">Timeline</a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
