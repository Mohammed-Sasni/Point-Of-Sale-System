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
                                             
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Pending Oders</h4>
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
                        <th>Order Date</th>                       
                        <th>Payment</th>
                        <th>Invoice</th>
                        <th>Pay</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
         	
            
<tbody>
    @foreach($orders as $key=>$item)
    <tr>
        <td>{{ $key+1 }}</td>
        
        <!-- Solution 1: Using optional() helper (Recommended) -->
        <td> 
            <img src="{{ asset(optional($item->customer)->image ?? 'default-avatar.png') }}" 
                 style="width: 50px; height: 40px;"> 
        </td>
        <td>{{ optional($item->customer)->name ?? 'No Customer' }}</td>
        
        <!-- Alternative Solution 2: Using null coalescing with conditional -->
        <!--
        <td> 
            <img src="{{ asset($item->customer?->image ?? 'default-avatar.png') }}" 
                 style="width: 50px; height: 40px;"> 
        </td>
        <td>{{ $item->customer?->name ?? 'No Customer' }}</td>
        -->
        
        <!-- Alternative Solution 3: Using if-else condition -->
        <!--
        <td> 
            @if($item->customer && $item->customer->image)
                <img src="{{ asset($item->customer->image) }}" style="width: 50px; height: 40px;">
            @else
                <img src="{{ asset('default-avatar.png') }}" style="width: 50px; height: 40px;">
            @endif
        </td>
        <td>
            @if($item->customer)
                {{ $item->customer->name }}
            @else
                No Customer
            @endif
        </td>
        -->
        
        <td>{{ $item->order_date }}</td>
        <td>{{ $item->payment_status }}</td>
        <td>{{ $item->invoice_no }}</td>
        <td>{{ $item->pay }}</td>
        <td><span class="badge bg-danger">{{ $item->order_status }}</span></td>
        <td>
            <a href="{{ route('order.details', $item->id) }}" 
               class="btn btn-blue rounded-pill waves-effect waves-light">
                Details
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
