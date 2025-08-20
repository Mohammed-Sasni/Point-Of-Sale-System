@extends('admin_dashboard')
@section('admin')

<div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
    <a href="{{route('add.advance.salary')}}" class="btn btn-primary rounded-pill waves-effect waves-light">Last Month Salary</a>                                         
                                        </ol>
                                    </div>
                                    <h4 class="page-title">All Advance Salary</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            
            

            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Month</th>                       
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
         	
            
<tbody>
    @foreach($paidsalary as $key=>$item)
    <tr>
        <td>{{ $key+1 }}</td>
        <td>
            @if($item->employee && $item->employee->image)
                <img src="{{ asset($item->employee->image) }}" style="width: 50px; height: 40px;">
            @else
                <img src="{{ asset('default-avatar.png') }}" style="width: 50px; height: 40px;">
            @endif
        </td>
        <td>{{ $item->employee->name ?? 'N/A' }}</td>
        <td>{{ $item->salary_month }}</td>
        <td>{{ $item->employee->salary ?? '0' }}</td>
        <td>
            <span class="badge bg-success">Full Paid</span>
        </td>
        <td>
            <a href="#" class="btn btn-blue rounded-pill waves-effect waves-light">
                History
            </a>
        </td>
    </tr>
    @endforeach
</tbody>
            </table>

        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>
                        <!-- end row-->
                        
                    </div> <!-- container -->

                </div> <!-- content -->


@endsection
