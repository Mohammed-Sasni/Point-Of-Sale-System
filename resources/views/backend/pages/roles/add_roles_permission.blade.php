@extends('admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<style type="text/css">

    .form-check-label{
        text-transform: capitalize;
    }
</style>

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Add Role In Pormission</a>
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">Add Role In Pormission</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form id="myForm" method="post" action="{{ route('role.pormission.store') }}" enctype="multipart/form-data">
                        @csrf
                        <h5 class="mb-4 text-uppercase">
                            <i class="mdi mdi-account-circle me-1"></i>Add Role In Pormission
                        </h5>

            
        <div class="row"> 

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">All Roles</label>
                    <select name="role_id" class="form-select">

                        <option selected disabled>Select Roles</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                    </select>
                </div>
            </div>

         </div>      

            <div class="form-check mb-2 form-check-primary">
                <input class="form-check-input" type="checkbox" value="" id="customckeck15">
                <label class="form-check-label" for="customckeck15">Primary</label>
            </div>

        <hr>
        @foreach($permission_groups as $group)
        <div class="row">
            <div class="col-3">
                <div class="form-check mb-2 form-check-primary">
                <input class="form-check-input" type="checkbox" value="" id="customckeck1">
                <label class="form-check-label" for="customckeck1">{{$group->group_name}}</label>
            </div>
            </div>

            <div class="col-9">
        @php
        $permission = App\Models\User::getpermissionGroupName($group->group_name);
        @endphp        

                @foreach( $permission as $permission )
                <div class="form-check mb-2 form-check-primary">
                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id}}" id="customckeck{{ $permission->id}}" >
                <label class="form-check-label" for="customckeck{{ $permission->id}}">{{$permission->name }}</label>
                </div>
                @endforeach
                <br>
            </div>
            
        </div>
        @endforeach   
        

                      

                        

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


<script type="text/javascript">
  $('#customckeck15').click(function(){
    if($(this).is(':checked')){

        $('input[type= checkbox]').prop('checked',true);   
    } else{ 
        $('input[type= checkbox]').prop('checked',false);

    }
  });
</script>




@endsection
