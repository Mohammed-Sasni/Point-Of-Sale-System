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
                            <a href="javascript: void(0);">Add Product</a>
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">Add Product</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form id="myForm" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <h5 class="mb-4 text-uppercase">
                            <i class="mdi mdi-account-circle me-1"></i> Add Product
                        </h5>

                        <!-- Product Name & Category -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" name="product_name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" class="form-select">
                                        <option selected disabled>Select Category</option>
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier & Product Code -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Supplier</label>
                                    <select name="supplier_id" class="form-select">
                                        <option selected disabled>Select Supplier</option>
                                        @foreach($supplier as $sup)
                                            <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Product Garage</label>
                                    <input type="text" name="product_garage" class="form-control">
                                </div>
                            </div>
                            
                        </div>

                        <!-- Product Garage & Store -->
                        <div class="row">
                            

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Product Store</label>
                                    <input type="text" name="product_store" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Buying Date</label>
                                    <input type="date" name="buying_date" class="form-control">
                                </div>
                            </div>

                        </div>

                        <!-- Buying Date and Expire Date  -->
                        <div class="row">
                            

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Expire Date</label>
                                    <input type="date" name="expire_date" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Buying Price</label>
                                    <input type="text" name="buying_price" class="form-control">
                                </div>
                            </div>

                        </div>

                        <!-- Buying Price Selling Price -->
                        
                            
                        <div class="row">
                            
                        
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Selling Price</label>
                                    <input type="text" name="selling_price" class="form-control">
                                </div>
                            </div>
                         </div>   

                        <!-- Image -->
                        
                            

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Product Image</label>
                                    <input type="file" name="product_image" id="image" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Preview Image -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <img id="showImage" src="{{ url('upload/no_image.jpg') }}"
                                         class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
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
                product_name: { required : true },
                category_id: { required : true },
                supplier_id: { required : true },
                product_garage: { required : true },
                product_store: { required : true },
                buying_date: { required : true },
                expire_date: { required : true },
                buying_price: { required : true },
                selling_price: { required : true },
                product_image: { required : true },

            },
            messages :{
                product_name: { required : 'Please Enter Product Name' },
                category_id: { required : 'Please Select Category Name' },
                supplier_id: { required : 'Please Select Supplier Name' },
                product_garage: { required : 'Please Enter Product Garage' },
                product_store: { required : 'Please Enter Product Store' },
                buying_date: { required : 'Please Select Buying Date' },
                expire_date: { required : 'Please Select Expire Date' },
                buying_price: { required : 'Please Enter Buying Price' },
                selling_price: { required : 'Please Enter Selling Price' },
                product_image: { required : 'Please Select Product Image' },
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

<!-- Image Preview -->
<script>
$(document).ready(function() {
    $('#image').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });
});
</script>

@endsection
