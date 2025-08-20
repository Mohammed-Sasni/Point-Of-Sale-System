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
    <a href="{{route('add.advance.salary')}}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Advance Salary</a>                                         
                                        </ol>
                                    </div>
                                    <h4 class="page-title">All Pay Salary</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">{{date("F Y")}}</h4>
            

            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Month</th>                       
                        <th>Salary</th>
                        <th>Advance</th>
                        <th>Dev</th>
                        <th>Action</th>
                    </tr>
                </thead>
         	
            
<tbody>
	@foreach($employee as $key=>$item)
<tr>
    <td>{{ $key+1 }}</td>
    <td> <img src="{{ asset($item->image) }}" style="width: 50px; height: 40px;"> </td>
    <td>{{ $item->name}}</td>
    <td> <span class="badge bg-info">{{ date("F", strtotime('-1 month')) }} </span> </td>
    <td>{{$item->salary}}</td>
    <td>

         {{ $item->advance?->advance_salary ?? 'No Advance' }}

    </td>
    
    <td>

        @php
            $salary = is_numeric($item->salary) ? $item->salary : 0;
            $advance = is_numeric($item->advance?->advance_salary) ? $item->advance->advance_salary : 0;
        $amount = $salary - $advance;

       @endphp

         <strong style="color: #fff;">{{ round($amount) }}</strong>

    </td>

    <td>
        <a href="{{route('pay.now.salary',$item->id)}}" class="btn btn-blue rounded-pill waves-effect waves-light">
            Pay Now
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
