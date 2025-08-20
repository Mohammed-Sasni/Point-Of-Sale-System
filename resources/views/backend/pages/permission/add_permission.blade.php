@extends('admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Add Pormission</a>
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">Add Pormission</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form id="myForm" method="post" action="{{ route('pormission.store') }}" enctype="multipart/form-data">
                        @csrf
                        <h5 class="mb-4 text-uppercase">
                            <i class="mdi mdi-account-circle me-1"></i> Add Pormission
                        </h5>

                        <!-- Product Name & Category -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Pormission Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Group Name</label>
                                    <select name="group_name" class="form-select">
                                        <option selected disabled>Select Group</option>
                                       
                                            <option value="pos">Pos</option>
                                            <option value="employee">Employee</option>
                                            <option value="customer">Customer</option>
                                            <option value="supplier">Supplier</option>
                                            <option value="salary">salary</option>
                                            <option value="attendence">Attendence</option>
                                            <option value="category">Category</option>
                                            <option value="product">Product</option>
                                            <option value="expence">Expence</option>
                                            <option value="orders">Orders</option>
                                            <option value="stock">Stock</option>
                                            <option value="roles">Roles</option>


                                       
                                    </select>
                                </div>
                            </div>
                        </div>

                      

                        

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2">
                                <i class="mdi mdi-content-save"></i> Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Validation -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: { required : true },
                group_name: { required : true },
                

            },
            messages :{
                name: { required : 'Please Enter Permission Name' },
                group_name: { required : 'Please Select Group Name' },
                
            },
            errorElement : 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>



@endsection
